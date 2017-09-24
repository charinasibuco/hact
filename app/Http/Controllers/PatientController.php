<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Patient;
use App\VCT;
use App\MedicalAbstract;
use App\Infections;
use App\TuberculosisModel;
use App\Laboratory;
use App\Mortality;
use App\ObGyne;
use App\ARV;
use App\Checkup;
use App\LaboratoryType;
use App\LaboratoryTest;
use Hact\Log\ActivityLogRepository;
use Auth;
use Hact\Patient\PatientRepository;
use Hact\VCT\VCTRepository;
use Hact\Infections\InfectionsRepository;
use Hact\Ob\ObGyneRepository;
use Hact\Tuberculosis\TuberculosisRepository;
use Hact\Mortality\MortalityRepository;
use Hact\MedicalAbstract\MedicalAbstractRepository;

class PatientController extends Controller
{
    // private $log;

    public function __construct(PatientRepository $patient,MedicalAbstractRepository $medical_abstract, VCTRepository $vct, ObGyneRepository $obgyne, InfectionsRepository $infections, TuberculosisRepository $tuberculosis, MortalityRepository $mortality, ActivityLogRepository $log){
        $this->patient          = $patient;
        $this->vct              = $vct;
        $this->medical_abstract = $medical_abstract;
        $this->obgyne           = $obgyne;
        $this->infections       = $infections;
        $this->tuberculosis     = $tuberculosis;
        $this->mortality        = $mortality;
        $this->log              = $log;

    }

    public function permission($id, $method)
    {
        $patient = Patient::join('patient_doctor','patient.id','=','patient_doctor.patient_id')
            ->where('user_id', Auth::user()->id);
        if($method=='edit' && $this->patient->find($id))
        {
            $patient = $patient->where('patient.id',$this->patient->find($id)->patient_id);
        }
        else
        {
            $patient = $patient->where('patient.id',$id);
        }
        $patient = $patient->first();
        if(Auth::user()->access != 1 && is_null($patient))
        {
            abort(403);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['search']     = trim($request->input('search'));
        $order_by           = $this->order_by($request);
        $sort               = ($request->input('sort') == 'asc') ? 'desc':'asc';

        $data['patients']   = $this->patient->getPatients($request);
        $data['pagination'] = ['search' => $data['search'], 'order_by' => $order_by, 'sort' => $sort];
        $data['code_name_sort']     = $this->link_sort('code_name', $data['search'], $sort, $request);
        $data['birth_date_sort']    = $this->link_sort('birth_date', $data['search'], $sort, $request);
        $data['gender_sort']        = $this->link_sort('gender', $data['search'], $sort, $request);
        $data['saccl_code_sort']    = $this->link_sort('saccl_code', $data['search'], $sort, $request);
        $data['ui_code_sort']       = $this->link_sort('ui_code', $data['search'], $sort, $request);
        return view('hact.patient.index', $data);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
        $data = $this->patient->create($id);
        return view('hact.patient.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\PatientStoreRequest $request)
    {
        $input          = $request->all();
        $result         = $this->patient->store($input, $request);
        if($result['status'] == false){
            return redirect()->route('patient_create')->withErrors($result['results'])->withInput();
        }
        $this->log->store([
                'page' => 'Patient',
                'message' => $request->code_name . ' has been created!',
                'user_id' => Auth::user()->id
            ],$request);
        return redirect()->route('patient_create')->with('status', 'Patient successfully added.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
        $data               = $this->patient->edit($id);
        $data['patient']    = $this->patient->find($id);
        $data['id']         = $id;
//        dd($data);
        return view('hact.patient.form',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\PatientUpdateRequest $request, $id)
    {
        $input  = $request->all();
        $result = $this->patient->update($id, $input, $request);
        if($result['status'] == false){
             return redirect()->route('patient_edit', ['id' => $id])->withErrors($result['results'])->withInput();
        }
        $this->log->store([
                'page' => 'Patient',
                'message' => $request->code_name . ' has been updated!',
                'user_id' => Auth::user()->id
            ],$request);
        return redirect()->route('patient_edit', $id)->with('status', 'Patient successfully updated.');
    }

    public function profile($id)
    {
        $this->permission($id,'create');
        $patient                    = $this->patient->find($id);
        $data['patient']            = $patient;
        $data['vct']                = ($this->vct->find($id) != null) ? $this->vct->find($id)->where('patient_id', $id)->orderBy('vct_date', 'DESC')->paginate(50): '';
        $data['medical_abstract']   = MedicalAbstract::where('patient_id', $id)->orderBy('date', 'DESC')->paginate(50);
        $data['other_laboratories'] = Laboratory::where('other','!=','')->select('other')->distinct()->get();
        $data['infections_report']  = ($this->infections->find($id) != null) ? $this->infections->find($id)->where('patient_id', $id)->orderBy('order_number','desc')->paginate(50) : '';
        $data['tuberculosis']       = ($this->tuberculosis->find($id) != null) ? $this->tuberculosis->find($id)->where('patient_id', $id)->orderBy('order_number','desc')->get() : '';
        $data['ob']                 = ObGyne::where('patient_id', '=', $id )->paginate(5);
        $data['mortality']          = ($this->mortality->find($id) != null) ? $this->mortality->find($id)->where('patient_id', $id)->first() : '';
        $data['checkups']           = Checkup::where('patient_id', $id)->orderBy('checkup_date', 'DESC')->paginate(50);
        $data['arv']                = ARV::where('patient_id', $id)->orderBy('created_at', 'DESC')->paginate(50);

        $data['ui_code']            = explode('-',$patient->ui_code);
        $data['ui_code1']           = $data['ui_code'][0];
        $data['ui_code2']           = $data['ui_code'][1];
        $data['ui_code3']           = $data['ui_code'][2];


        /**
         * for laboratory tab
         */
        $data['laboratories'] = Laboratory::leftJoin('laboratory_type','laboratory.laboratory_type_id','=','laboratory_type.id')
            ->select('laboratory.*','laboratory_type.laboratory_test_id')
            ->where('patient_id', $id)->orderBy('result_date','desc')->get();
        $data['laboratory_tests'] = LaboratoryTest::orderBy('group','asc')->get();
        foreach($data['laboratory_tests'] as $key => $test)
        {
            $lab_type = LaboratoryType::where('laboratory_test_id',$test->id)->get();
            foreach($lab_type as $row)
            {
                if($data['laboratories']->where('laboratory_type_id', $row->id)->count() == 0)
                {
                    unset($data['laboratory_tests'][$key]);
                }
            }

        }
        $data['other_laboratories'] = Laboratory::where('other','!=','')->select('other')->distinct()->get();

        return view('hact.patient.profile',$data);
        // dd($this->infections->find($id));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function masterlist($id)
    {
        $this->permission($id,'create');
        $data['patient']      = Patient::where('id', $id)->first();
        $data['vct']          = VCT::where('patient_id', $id)->orderBy('vct_date', 'DESC')->paginate(50);
        $data['medical_abstracts'] = MedicalAbstract::where('patient_id', $id)->orderBy('date','desc')->get();
        $data['infections_report']   = Infections::where('patient_id', $id)->orderBy('order_number','desc')->get();
        $data['tuberculosis'] = TuberculosisModel::where('patient_id', $id)->orderBy('order_number','desc')->get();
        $data['ob']           = ObGyne::where('patient_id', '=', $id )->paginate(5);
        $data['mortality']    = Mortality::where('patient_id', $id)->first();
        $data['checkups']     = Checkup::where('patient_id', $id)->orderBy('checkup_date', 'DESC')->paginate(50);
        $data['arv']          = ARV::where('patient_id', $id)->orderBy('created_at', 'DESC')->paginate(50);

        /**
         * for laboratory tab
         */
        $data['laboratories'] = Laboratory::leftJoin('laboratory_type','laboratory.laboratory_type_id','=','laboratory_type.id')
            ->select('laboratory.*','laboratory_type.laboratory_test_id')
            ->where('patient_id', $id)->orderBy('result_date','desc')->get();
        $data['laboratory_tests'] = LaboratoryTest::orderBy('group','asc')->get();
        foreach($data['laboratory_tests'] as $key => $test)
        {
            $lab_type = LaboratoryType::where('laboratory_test_id',$test->id)->get();
            foreach($lab_type as $row)
            {
                if($data['laboratories']->where('laboratory_type_id', $row->id)->count() == 0)
                {
                    unset($data['laboratory_tests'][$key]);
                }
            }

        }
        $data['other_laboratories'] = Laboratory::where('other','!=','')->select('other')->distinct()->get();
        //$data = compact('patient', 'vct', 'infections_report', 'tuberculosis', 'mortality', 'ob', 'laboratories','laboratory_types','other_laboratories','arv', 'checkups');

        return view('hact.patient.masterlist',$data);
    }

    public function printMasterList($id){
        $data['patient']      = Patient::where('id', $id)->first();
        $data['vct']          = VCT::where('patient_id', $id)->orderBy('vct_date', 'DESC')->paginate(50);
        $data['medical_abstracts'] = MedicalAbstract::where('patient_id', $id)->orderBy('date','desc')->get();
        $data['infections_report']   = Infections::where('patient_id', $id)->orderBy('order_number','desc')->get();
        $data['tuberculosis'] = TuberculosisModel::where('patient_id', $id)->orderBy('order_number','desc')->get();
        $data['ob']           = ObGyne::where('patient_id', '=', $id )->paginate(5);
        $data['mortality']    = Mortality::where('patient_id', $id)->first();
        $data['checkups']     = Checkup::where('patient_id', $id)->orderBy('checkup_date', 'DESC')->paginate(50);
        $data['arv']          = ARV::where('patient_id', $id)->orderBy('created_at', 'DESC')->paginate(50);

        /**
         * for laboratory tab
         */
        $data['laboratories'] = Laboratory::leftJoin('laboratory_type','laboratory.laboratory_type_id','=','laboratory_type.id')
            ->select('laboratory.*','laboratory_type.laboratory_test_id')
            ->where('patient_id', $id)->orderBy('result_date','desc')->get();
        $data['laboratory_tests'] = LaboratoryTest::orderBy('group','asc')->get();
        foreach($data['laboratory_tests'] as $key => $test)
        {
            $lab_type = LaboratoryType::where('laboratory_test_id',$test->id)->get();
            foreach($lab_type as $row)
            {
                if($data['laboratories']->where('laboratory_type_id', $row->id)->count() == 0)
                {
                    unset($data['laboratory_tests'][$key]);
                }
            }

        }
        $data['other_laboratories'] = Laboratory::where('other','!=','')->select('other')->distinct()->get();


        return view('hact.patient.print',$data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $patients = $this->patient->search($request);
        return $patients->toJson();
    }

    public function record(Request $request)
    {
        $patient = $this->patient->record($request);
        return $patient->toJson();
    }

    public function order_by($request)
    {
        if($request->has('order_by'))
        {
            $order_by = $request->order_by;
            return $order_by;
        }
        else{
            return 'code_name';
        }
    }

    public function link_sort($order_by, $search, $sort, $request)
    {
        $sort     = ($request->input('sort') == 'asc') ? 'desc':'asc';

        if($request->has('page'))
        {
            return route('patient', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);
        }
        else
        {
            return route('patient', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
    }

    public function destroy($id)
    {
        $this->patient->destroy($id);
        return redirect()->route('patient')->with('status', 'Patient successfully deleted.');
    }

    public function validation_ajax(Request $request)
    {
        $check = $this->patient->validation_ajax($request);

        return $check;
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Patient;
use App\PatientDoctor;
use App\VCT;
use App\VCTSuplementalMother;
use App\VCTSuplementalMotherChildrens;
use App\VCTSuplementalChildren;
use App\ConfirmatoryDate;
use App\User;
use Hact\VCT\VCTRepository;
use Hact\Patient\PatientRepository;
use App\ActivityLog;
use Auth;

class VCTController extends Controller
{
    protected $patient;

    public function __construct(VCTRepository $vct, PatientRepository $patient){
        $this->vct = $vct;
        $this->patient = $patient;
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
    }

    public function index(Request $request)
    {
        $data['doctors']    = User::where('access', 2)->get();
        $data['search']             = trim($request->input('search'));
        $order_by           = $this->order_by($request);
        $sort               = ($request->input('sort') == 'asc') ? 'desc':'asc';
        $data['patients']           = $this->vct->getPatientsOnVCT($request);

        $data['code_name_sort']     = $this->link_sort('code_name', $data['search'], $sort, $request);
        $data['birth_date_sort']    = $this->link_sort('birth_date', $data['search'], $sort, $request);
        $data['gender_sort']        = $this->link_sort('gender', $data['search'], $sort, $request);
        $data['saccl_code_sort']    = $this->link_sort('saccl_code', $data['search'], $sort, $request);
        $data['ui_code_sort']       = $this->link_sort('ui_code', $data['search'], $sort, $request);

        $data['pagination']         = ['search' => $data['search'], 'order_by' => $order_by, 'sort' => $sort];
        return view('hact.vct.index', $data);
    }

    public function records($id, $patient_id)
    {
        $vct        = $this->vct->find($id)->where('id', $id)->orderBy('vct_date', 'DESC')->paginate(50);
        $patient    = $this->patient->find($id)->where('id', $patient_id)->first();
        $doctors    = User::where('access', 2)->get();

        $data = compact('vct', 'patient', 'doctors');

        return view('hact.vct.records', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $data = $this->vct->create($id);
        return view('hact.vct.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\VCTStoreRequest $request)
    {
        $input          = $request->all();
        $result         = $this->vct->store($input, $request);
        if($result['status'] == false){
            return redirect()->route('vct_create')->withErrors($result['results'])->withInput();
        }
        return redirect()->route('patient_profile',$input['patient_id'])->with('status', 'VCT Record successfully added to Patient!');
        // dd($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['patient']    = $this->vct->find($id);
        $data = $this->vct->edit($id);

        return view('hact.vct.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\VCTUpdateRequest $request, $id)
    {
        $input  = $request->all();
        $result = $this->vct->update($id, $input, $request);

        if($result['status'] == false){
             return redirect()->route('vct_edit', ['id' => $id])->withErrors($result['results'])->withInput();
        }
        return redirect()->route('vct_edit', $id)->with('status', 'VCT record successfully updated.');
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
        $sort     = ($request->input('sort') == 'desc') ? 'asc':'desc';

        if($request->has('page'))
        {
            return route('vct', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);
        }
        else
        {
            return route('vct', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
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
        return response()->json($patients);
    }

    public function result(Request $request)
    {
        $this->vct->result($request);
        return redirect()->route('patient')->with('status', 'Patient result successfully updated!');
    }

    public function doctor(Request $request, $id)
    {
        $data = $this->vct->doctor($request, $id);
        return view('hact.vct.doctor', $data);
    }

    public function assign_doctor(Requests\DoctorRequest $request, $id)
    {
        $this->vct->assign_doctor($request, $id);
        return redirect()->route('vct_doctor', $id)->with('status', 'Patient doctor successfully added!');
    }

    public function disable_doctor($id, $patient_id)
    {
        $this->vct->disable_doctor($id, $patient_id);
        return redirect()->route('vct_doctor', $patient_id)->with('status', 'Patient doctor successfully removed!');
    }

    public function enable_doctor($id, $patient_id)
    {
        $this->vct->enable_doctor($id, $patient_id);
        return redirect()->route('vct_doctor', $patient_id)->with('status', 'Patient doctor successfully enabled!');
    }

    public function destroy($id)
    {
        $patient_id = $this->vct->find($id)->Patient->id;
        $this->vct->destroy($id);

        return redirect()->route('patient_profile', $patient_id)->with('status', 'VCT Record successfully deleted!');
    }


}

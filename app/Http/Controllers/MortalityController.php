<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mortality;
use App\Patient;
use Hact\Mortality\MortalityRepository;
use Hact\Patient\PatientRepository;
use Auth;

class MortalityController extends Controller
{
    public function __construct(MortalityRepository $mortality, PatientRepository $patient)
    {
        $this->mortality = $mortality;
        $this->patient   = $patient;
    }

    /**
     * @param $id
     * @param $method
     */
    public function permission($id, $method)
    {
        $patient = Patient::join('patient_doctor','patient.id','=','patient_doctor.patient_id')
            ->where('user_id', Auth::user()->id);
        if($method=='edit' && $this->mortality->find($id))
        {
            $patient = $patient->where('patient_id',$this->mortality->find($id)->patient_id);
        }
        else
        {
            $patient = $patient->where('patient_id',$id);
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
        $data['search']             = trim($request->input('search'));
        $order_by                   = $this->order_by($request);
        $sort                       = ($request->input('sort') == 'asc') ? 'desc':'asc';

        $data['code_name_sort']     = $this->link_sort('code_name_code', $data['search'], $sort, $request);
        $data['birth_date_sort']    = $this->link_sort('birth_date', $data['search'], $sort, $request);
        $data['gender_sort']        = $this->link_sort('gender', $data['search'], $sort, $request);
        $data['saccl_code_sort']    = $this->link_sort('saccl_code', $data['search'], $sort, $request);
        $data['ui_code_sort']       = $this->link_sort('ui_code', $data['search'], $sort, $request);

        $data['pagination']         = ['search' => $data['search'], 'order_by' => $order_by, 'sort' => $sort];

        $data['patients'] = $this->mortality->getPatientOnMortality($request);

        return view('hact.mortality.index', $data);

    }

    public function search(Request $request)
    {
        $patients = $this->mortality->search($request);
        return response()->json($patients);
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
            return route('mortality', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);
        }
        else
        {
            return route('mortality', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $this->permission($id,'create');
        $data = $this->mortality->create($id);

        return view('hact.mortality.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\MortalityStoreRequest $request, $id = null)
    {
        $input = $request->all();
        $this->mortality->store($input, $request);
        if($id){
            return redirect()->route('patient_profile', $id)->with('status', 'Mortality Record Successfully Added to Patient!');
        }else{
            return redirect()->route('mortality')->with('status', 'Mortality Record Successfully Added!');
        }
//        return redirect()->route('patient_profile')->with('status', 'Mortality Report Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->mortality->show($id);
        return view('hact.mortality.show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search_edit(Requests $request)
    {
        return redirect()->route('mortality_edit',$request->patient_id);
    }

    public function edit($id)
    {
        $this->permission($id,'create');
        $data = $this->mortality->edit($id);
        #dd($data);
        return view('hact.mortality.form',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\MortalityUpdateRequest $request, $id)
    {
        $input = $request->all();
        $this->mortality->update($request, $id, $input);
        return redirect()->route('mortality_edit',$id)->with('status', 'Mortality Record Successfully Updated!');
//        return redirect()->route('mortality')->with('status', 'Mortality Report Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->permission($id,'create');
        $this->mortality->destroy($id);
        return redirect()->route('mortality')->with('status', 'Mortality Record Successfully Removed!');
    }
}

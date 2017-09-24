<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hact\Patient\PatientRepository;
use Hact\MedicalAbstract\MedicalAbstractRepository;
use Hact\Log\ActivityLogRepository;
use Auth;
use App\Patient;
class MedicalAbstractController extends Controller
{

    public function __construct(PatientRepository $patient,MedicalAbstractRepository $medical_abstract,ActivityLogRepository $log){
        $this->auth = Auth::user();
        $this->medical_abstract = $medical_abstract;
        $this->medical_abstract->setListener($this);
        $this->log = $log;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function permission($id, $method)
    {
        $patient = Patient::join('patient_doctor','patient.id','=','patient_doctor.patient_id')
            ->where('user_id', $this->auth->id);
        if($method=='edit' && $this->medical_abstract->find($id))
        {
            $patient = $patient->where('patient_id',$this->medical_abstract->find($id)->patient_id);
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

    public function index()
    {

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMedicalAbstracts($id)
    {
        $this->medical_abstract->getMedicalAbstracts($id);
    }

    public function create($id)
    {
        $this->permission($id, "create");
        $data = $this->medical_abstract->create($id);
        return view('hact.medical_abstract.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except(['_token','search_patient']);
        return $this->medical_abstract->store($input, $request);
        //return redirect()->route('patient_profile',$return_id)->with('success','Medical Abstract has been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->permission($id, "edit");
        $data = $this->medical_abstract->edit($id);
        return view('hact.medical_abstract.form', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except(['_token','search_patient']);
        return $this->medical_abstract->update($input, $request, $id);
        //return redirect()->route('medical_abstract_edit',$id)->with('success','Medical Abstract has been Updated');
    }

    public function print_medical_abstract($id){
        $data = [];
        $data['medical_abstract'] = $this->medical_abstract->print_medical_abstract($id);
        return view('hact.medical_abstract.print',$data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient_id = $this->medical_abstract->destroy($id);
        return redirect()->route('patient_profile',$patient_id)->with('status', 'Medical Abstract successfully deleted!');
    }

    public function createPassed($id){
        return redirect()->route('patient_profile', $id)->with('status', 'Medical Abstract successfully added to Patient!');
    }

    public function createFail($validator, $id){
        return redirect()->route('medical_abstract_create', $id)->withErrors($validator)->withInput();
    }

    public function updatePassed($id){
        return redirect()->route('medical_abstract_edit', $id)->with('status', 'Medical Abstract successfully updated!');
    }

    public function updateFail($validator, $id){
        return redirect()->route('medical_abstract_edit', $id)->withErrors($validator)->withInput();
    }
}

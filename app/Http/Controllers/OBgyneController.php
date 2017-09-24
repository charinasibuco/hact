<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hact\Ob\ObGyneRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Patient;
use Auth;

class ObGyneController extends Controller
{
    protected $obgyne;

    public function __construct(ObGyneRepository $obGyne){
//    public function __construct(ObGyneRepository $obGyne){
        $this->obgyne = $obGyne;
    }

    public function permission($id, $method)
    {
        $patient = Patient::join('patient_doctor','patient.id','=','patient_doctor.patient_id')
            ->where('user_id', Auth::user()->id);
        if($method=='edit' && $this->obgyne->find($id))
        {
            $patient = $patient->where('patient_id',$this->obgyne->find($id)->patient_id);
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
     * Get the patients.
     *
     * @param      Request  $request  
     *
     * @return     JSON Object.
     */
    public function getPatients(Request $request){
        $results        = $this->obgyne->getPatients($request);
        return json_encode($results);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['obgynes']    = $this->obgyne->getObGynes($request);
        $data['sort']       = ($request->input('sort') == 'asc') ? 'desc':'asc';
        $data['search']     = $request->input('search');
        $order_by           = $this->order_by($request);
        $data['pagination'] = ['search' => $data['search'], 'order_by' => $order_by, 'sort' => $data['sort']];
        #dd($data);
        return view('hact.ob_gyne.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = '')
    {
        $this->permission($id,'create');
        $data = $this->obgyne->create($id);
        $data['patient_id'] = $id;
        if($data['gender'] == 0)
        {
          return view('hact.ob_gyne.create',$data);  
        }
        else
        {
            return redirect()->route('patient');
        }
    }

    public function history(Request $request, $id){
        $this->permission($id,'create');
        $data['patient']        = $this->obgyne->findPatient($id);
        $data['histories']      = $this->obgyne->obGyneHistory($id, $request);
        $data['search']         = '';           
        $data['sort']           = ($request->input('sort') == 'asc') ? 'desc':'asc';
        return view('hact.ob_gyne.history',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input          = $request->all();
        $result         = $this->obgyne->store($input, $request);
//        dd($input['patient_id']);
        if($result['status'] == false){
            return redirect()->route('ob_gyne_patient_create',[$request->patient_id])->withErrors($result['results'])->withInput();
//            return redirect()->route('ob_gyne_create')->withErrors($result['results'])->withInput();
        }
        #dd($result);
        return redirect()->route('patient_profile',$request->patient_id)->with('status', 'OB Gyne record successully added!');
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
        $this->permission($id,'edit');
        $obgyne    = $this->obgyne->find($id);
        $data['patient']   = $obgyne->patient;
        $data['patient_id'] = $obgyne->patient->id;
        $data['action'] = route('ob_gyne_update',$id);
        $data['search_vct']                 = $data['patient']->code_name;
        $data['currently_pregnant']         = $obgyne->currently_pregnant;
        $data['gestation_age']              = $obgyne->currently_pregnant_if_yes_gestation_age;
        $data['delivery_date']              = $obgyne->if_delivered_date;
        $data['feeding_type']              = $obgyne->infant_type;
        $data['pap_smear']                  = $obgyne->pap_smear;
        $data['action_name'] = 'Edit';
        return view('hact.ob_gyne.create',$data);
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
        $input              = $request->all();
        $result             = $this->obgyne->update($request, $id, $input);
        if($result['status'] == false){
            return redirect()->route('ob_gyne_edit', ['id' => $id])->withErrors($result['results'])->withInput();
        }

        return redirect()->route('ob_gyne_edit',$id)->with('status', 'OB Gyne record successully updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient_id = $this->obgyne->find($id)->Patient->id;
        $this->obgyne->destroy($id);
        return redirect()->route('patient_profile',$patient_id)->with('status', 'OB Gyne record successfully deleted.');
    }

    public function search(Request $request){

        $patients           = $this->obgyne->search($request);
        return response()->json($patients);
    }

    public function record(Request $request)
    {
        $patient = $this->obgyne->record($request);
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

}

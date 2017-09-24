<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Infections;
use App\InfectionsClinicalStage;
use App\Patient;
use App\ClinicalStaging;
use Hact\Infections\InfectionsRepository as Infection;
use Auth;


class InfectionsController extends Controller
{
    private $log;
    private $infection;

    /**
     * Inject dependencies
     *
     * @param      InfectionsRepository  $infections  (description)
     * @param      PatientRepository     $patient     (description)
     */
    public function __construct(Infection $infection, Patient $patient){
        $this->infection = $infection;
        $this->patient    = $patient;
        if(Auth::user()->access != 1)
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
        $data['patients']   = $this->infection->getPatientOnInfections($request); 
        $data['code_name_sort']     = $this->link_sort('code_name', $data['search'], $sort, $request);
        $data['birth_date_sort']    = $this->link_sort('birth_date', $data['search'], $sort, $request);
        $data['gender_sort']        = $this->link_sort('gender', $data['search'], $sort, $request);
        $data['saccl_code_sort']    = $this->link_sort('saccl_code', $data['search'], $sort, $request);
        $data['ui_code_sort']       = $this->link_sort('ui_code', $data['search'], $sort, $request);

        $data['pagination']         = ['search' => $data['search'], 'order_by' => $order_by, 'sort' => $sort];
        return view('hact.infections.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($id)
    {
        $data = $this->infection->create($id);
        return view('hact.infections.form', $data);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\InfectionsStoreRequest $request, $id)
    {
        $input          = $request->all();
        $result         = $this->infection->storeInfections($input, $request, $id);
        return redirect()->route('infections_create', $id)->with('status', 'Infections report successfully created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->infection->show($id);
        return view('hact.infections.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function dropdown_edit(Request $request){
        $order_number = $request->dd_order_number;
        $id = $request->dd_patient_id;

        return redirect()->route('infections_edit',[$id, $order_number]);
    }

    public function edit($id, $order_number)
    {
        $data = $this->infection->editInfection($id, $order_number);
        return view('hact.infections.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\InfectionsStoreRequest $request, $id, $order_number)
    {
        $result = $this->infection->update($request, $id, $order_number);
        if($result['status'] == false){
             return redirect()->route('infections_show', ['id' => $id])->withErrors($result['results'])->withInput();
        }
       return redirect()->route('infections_show', $id)->with('status', 'Infections report successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $patients = $this->infection->search($request);
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
            return route('infections', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);
        }
        else
        {
            return route('infections', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
    }
}

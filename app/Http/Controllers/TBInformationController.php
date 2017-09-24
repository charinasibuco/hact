<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\TuberculosisModel;
use App\Patient;
use App\VCT;
use App\Laboratory;
use DB;
use Hact\Tuberculosis\TuberculosisRepository;
use Hact\Patient\PatientRepository;
use Hact\Log\ActivityLogRepository as ActivityLog;
use Auth;

class TBInformationController extends Controller
{

    private $log;

    public function __construct(ActivityLog $log, TuberculosisRepository $tuberculosis, PatientRepository $patient)
    {
      $this->log          = $log;
      $this->tuberculosis = $tuberculosis;
      $this->patient      = $patient;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(Request $request)
    {
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
      $data['search']     = trim($request->input('search'));
      $order_by           = $this->order_by($request);
      $sort               = ($request->input('sort') == 'asc') ? 'desc':'asc';

      $data['code_name_sort']     = $this->link_sort('code_name', $data['search'], $sort, $request);
      $data['birth_date_sort']    = $this->link_sort('birth_date', $data['search'], $sort, $request);
      $data['gender_sort']        = $this->link_sort('gender', $data['search'], $sort, $request);
      $data['saccl_code_sort']    = $this->link_sort('saccl_code', $data['search'], $sort, $request);
      $data['ui_code_sort']       = $this->link_sort('ui_code', $data['search'], $sort, $request);

      $data['patients']           = $this->tuberculosis->getPatientOnTuberculosis($request);
      $data['pagination'] = ['search' => $data['search'], 'order_by' => $order_by, 'sort' => $sort];
      #return $data['pagination'];
      return view('hact.tb.index', $data);
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
            return route('tuberculosis', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);
        }
        else
        {
            return route('tuberculosis', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $data = $this->tuberculosis->create($id);
      return view('hact.tb.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\TBinformationStoreRequest $request)
    {
        $input          = $request->all();
        $result         = $this->tuberculosis->store($input, $request);
        $code_name = $this->patient->getPatientName()->where('id', $request->patient_id)->first();
        $this->log->store([
                'page' => 'TB Information', 
                'message' => $code_name->code_name . ' has been created!', 
                'user_id' => Auth::user()->id
            ],$request);
        return redirect()->route('patient_profile',$request->patient_id)->with('status', 'TB Information successfully added to Patient!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data = $this->tuberculosis->show($id);
      return view('hact.tb.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = $this->tuberculosis->edit($id);
      return view('hact.tb.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\TBinformationStoreRequest $request, $id)
    {
      $input          = $request->all();
      $this->tuberculosis->update($request, $id, $input);
      $patient = TuberculosisModel::find($id);
      $this->log->store([
            'page' => 'TB Information',
            'message' => $patient->code_name . ' has been updated!',
            'user_id' => Auth::user()->id
        ],$request);
        return redirect()->route('tuberculosis_edit',$id)->with('success', "TB information successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient_id = TuberculosisModel::find($id)->Patient->id;
        $this->tuberculosis->destroy($id);
        return redirect()->route('patient_profile',$patient_id)->with('status', 'TB Information successfully deleted.');
    }
}

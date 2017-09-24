<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Patient;
use App\VCT;
use App\ARV;
use Response;
use Auth;
use App\User;
use DB;
use App\Mortality;
use Hact\Report\Patient\PatientPrintRepository;

class ReportsPatientController extends Controller
{
    public function __construct(PatientPrintRepository $patients){

      $this->patients = $patients;
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
    public function patient()
    {
        $data['years'] = $this->patients->patient();
        return view('hact.reports.patient.patient', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function patient_print(Requests\ReportPatientRequest $request)
    {
      $data['patients'] = $this->patients->patient_print($request);
      $data['gender']   = $request->gender;
      if($request->has('excel'))
        {
            $patients         = $this->patients->patient_print($request);
            return $this->excel($patients);
        }
        else
        {
            return view('hact.reports.patient.patient_print', $data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function excel($patients)
    {
       $this->patients->excel($patients);
    }

    
    public function master_list(Request $request)
    {    
      $data['patient_number'] = 1;
      $data['patients'] = $this->patients->master_list($request);
      if($request->has('excel'))
        {
            $this->master_list_excel($data['patients'], $data['patient_number']);
        }
        else
        {
          return view('hact.reports.patient.patient_master_list',$data);
        } 
    }

    public function master_list_excel($patients, $patient_number)
    {
        $this->patients->master_list_excel($patients, $patient_number);
    }
     public function registry_results()
    {
        return view('hact.reports.patient.registry_results');  
    }
    public function registry_index(Requests\DateRangeRequest $request)
    { 
        $data['patients'] = $this->patients->registry_index($request);
        $data['from'] = $request->from;
        $data['to'] = $request->to;
          if($request->has('excel'))
            {
                $this->registry_excel($data['patients'], $data['from'], $data['to']);
            }
            else{
                return view('hact.reports.patient.patient_registry',$data);
            }
    }
    public function registry_excel($patients, $from, $to)
    {
        $this->patients->registry_excel($patients, $from, $to);
    }
}

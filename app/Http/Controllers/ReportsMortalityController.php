<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mortality;
use App\Patient;
use App\VCT;
use Auth;
use DB;
use Hact\Report\Mortality\ReportMortalityRepository;

class ReportsMortalityController extends Controller
{

  private $mortality;

  public function __construct(ReportMortalityRepository $mortality)
  {
    $this->mortality = $mortality;
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
    public function results()
    {

      $data = $this->mortality->results();
        $data['cause_type']         = old('cause_type');
        $data['cause_description']  = old('cause_description');
        $data['from']               = old('from');
        $data['to']                 = old('to');

      return view('hact.reports.mortality.results',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function results_print(Requests\ReportDeathListRequest $request)
    {
        $data = $this->mortality->results_print($request);
        if($request->has('excel'))
        {
           return $this->excel($data['patients'], $data['from'], $data['to'], $data['cause_type_format'], $data['cause_description']);
        }
      return view('hact.reports.mortality.results_print', $data);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function excel($patients, $from, $to, $cause_type_format, $cause_description)
    {
        return $this->mortality->excel_export($patients, $from, $to, $cause_type_format, $cause_description);
    }


    public function death()
    {
      return view('hact.reports.mortality.death');
    }
    public function death_print(Requests\ReportDeathListRequest $request)
    {
      $data = $this->mortality->death_print($request);    
      return view('hact.reports.mortality.death_print',$data);
        
    }
     public function death_excel($from, $to, $patients)
    {
        return print $this->mortality->export_excel($from,$to,$patients);     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
}

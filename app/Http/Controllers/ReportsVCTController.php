<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Patient;
use App\VCT;
use Hact\Report\VCT\VCTPrintRepository;
use Auth;
use DB;

class ReportsVCTController extends Controller
{
    public function __construct(VCTPrintRepository $vct){
        $this->vct = $vct;
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
    }
    /**

    **/
    public function current_year(Request $request)
    {
        $current_year = $this->vct->current_year($request);
        return $current_year->toJson();
    }
    /**

    **/
    public function current_record(Request $request)
    {
        $vct = $this->vct->current_record($request);
        return $vct->toJson();
    }
    /**

    **/
    public function getResults()
    {
        $data['years'] = $this->vct->getResults();
        return view('hact.reports.vct.results', $data);
    }

    public function getResultsView(Requests\ReportVCTResultsRequest $request)
    {
        $data['result']     = $this->getResultType($request->result);
        $data['from']       = $request->from_date;
        $data['to']         = $request->to_date;
        $result             = $this->vct->getResultsView($request);;
//        dd($result);
        $data['vct']        = $result;

        if($request->has('excel'))
        {
            $this->excel_results($data['result'], $data['vct']);
        }
        else
        {
            return view('hact.reports.vct.results_print', $data);
        }
    }
    /**

    **/
    public function getScheduled()
    {
        return view('hact.reports.vct.scheduled');
    }

    public function printScheduled(Requests\ReportVCTScheduledRequest $request)
    {
        $data['from']   = $request->from;
        $data['to']     = $request->to;
        $data['vct']    = $this->vct->printScheduled($request);
        if($request->has('excel')){
            $this->excel_scheduled($data['from'], $data['to'], $data['vct']);
        }
        return view('hact.reports.vct.scheduled_print', $data);
    }
    /**

    **/

    public function getResultType($value)
    {

        if(is_numeric($value) &&$value == 0)
        {
            return 'Non-Reactive';
        }
        elseif($value == 1)
        {
            return 'Negative';
        }
        elseif($value == 2)
        {
            return 'Postive';
        }
        elseif($value == 3)
        {
            return 'Indeterminate';
        }
        else
        {
            return 'All';
        }
    }

    public function excel_results($result, $vct)
    {
        $this->vct->excel_results($result, $vct);
    }

    public function excel_scheduled($from, $to, $vct)
    {
        $this->vct->excel_scheduled($from, $to, $vct);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Patient;
use App\TuberculosisModel;
use Auth;
use Hact\Report\Tuberculosis\TuberculosisPrintRepository;

class ReportsTuberculosisController extends Controller
{
    public function __construct(TuberculosisPrintRepository $tb)
    {
      $this->tb  = $tb;
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
    }
    public function getResults()
    {
        $data['result'] = old('result');
        $data['tx_outcome'] = old('tx_outcome');
        $data['from'] = old('from');
        $data['to'] = old('to');
        return view('hact.reports.tuberculosis.results', $data);
    }

    public function getResultsView(Requests\ReportTuberculosisResultsRequest $request)
    {
        $data['from']       = $request->from;
        $data['to']         = $request->to;
        if($request->tx_outcome == 0){
            $data['tx_outcome'] = 'All';
        }elseif($request->tx_outcome == 1){
            $data['tx_outcome'] = 'Cured';
        }elseif($request->tx_outcome == 2){
            $data['tx_outcome'] = 'Failed';
        }elseif($request->tx_outcome == 5){
            $data['tx_outcome'] = 'Ongoing';
        }elseif($request->tx_outcome == 3){
            $data['tx_outcome'] = 'Completed';
        }elseif($request->tx_outcome == 4){
            $data['tx_outcome'] = 'Other';
        }

        if($request->result == 2){
            $data['result'] = 'With Active TB';
        }else{
            $data['result'] = 'No Active TB';
        }

        // $tb    =   TuberculosisModel::where('tb_status', $result)
        //             ->where(function($query) use ($from, $to){
        //                 $query->where('updated_at', '>=', date('Y-m-d', strtotime($from)))->where('updated_at', '<=', date('Y-m-d', strtotime($to)));
        //             })
        //             ->orderBy('updated_at', 'ASC');

        $data['patient'] = $this->tb->getResultsView($request);

        if($request->has('excel'))
        {
            $this->excel($data['patient'], $data['result'], $data['tx_outcome'], $data['from'], $data['to']);
        }
        else
        {
          return view('hact.reports.tuberculosis.results_print', $data);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function excel($patient, $result, $tx_outcome, $from, $to)
    {
      $this->tb->excel($patient, $result, $tx_outcome, $from, $to);
    }
}

<?php

namespace App\Http\Controllers;

use Hact\Ob\ObGyneInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Patient;
use App\ObGyne;
use Auth;
use Hact\Report\Obgyne\ObgynePrintRepository;
class ReportsObgyneController extends Controller
{
    public function __construct(ObgynePrintRepository $obgyne){
      $this->obgyne = $obgyne;
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
    }
    public function getResults()
    {
        $data['result'] = old('result');
        $data['from_date'] = old('from_date');
        $data['to_date'] = old('to_date');
        return view('hact.reports.obgyne.results',$data);
    }

    public function getChildbirth()
    {
        $data['result'] = old('result');
        $data['from'] = old('from');
        $data['to'] = old('to');
        return view('hact.reports.obgyne.child_birth', $data);
    }

    public function getResultsView(Requests\ReportObgyneResultsRequest $request)
    {
      $data['obgyne'] = $this->obgyne->getResultsView($request);
      $data['result'] = $request->result;
      $data['from']   = $request->from_date;
      $data['to']     = $request->to_date;
       if($data['result'] == 0)
        {
          $data['result'] = "No";
        }
        else
        {
          $data['result'] = "Yes";
        }
      if($request->has('excel'))
        {
            $this->excel($data['obgyne'], $data['result'], $data['from'] , $data['to']);
        }
        else
        {
          return view('hact.reports.obgyne.results_print', $data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function excel($obgyne, $result, $from, $to)
    {
        $this->obgyne->excel($obgyne, $result, $from, $to);
    }

    public function getChildbirthView(Request $request)
    {
      $data['obgyne'] = $this->obgyne->getChildbirthView($request);
      $data['result'] = $request->result;
      $data['from']   = $request->from_date;
      $data['to']     = $request->to_date;
      if($data['result'] == 0)
        {
          $data['result'] = "No";
        }
        else
        {
          $data['result'] = "Yes";
        }
      if($request->has('excel'))
        {
            $this->getChildbirthExcel($data['obgyne'], $data['result'], $data['from'] , $data['to']);
        }
        else
        {
          return view('hact.reports.obgyne.child_birth_print', $data);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getChildbirthExcel($obgyne, $result, $from, $to)
    {
        $this->obgyne->getChildbirthExcel($obgyne, $result, $from, $to);
    }

    public function chart(Request $request){
      $results            = $this->obgyne->chart($request);
      return response()->json($results);
    }
}
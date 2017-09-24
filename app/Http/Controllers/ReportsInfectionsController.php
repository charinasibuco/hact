<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hact\Report\Infection\ReportInfectionRepository;
use App\Infections;
use App\Patient;
use App\VCT;
use Auth;
use DB;


class ReportsInfectionsController extends Controller
{
    private $infection; 

    public function __construct(ReportInfectionRepository $infection)
    {
        $this->infection = $infection;
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
    }
    public function results()
    {
        $data                           = $this->infection->results();
        $data['present_infections']     = [];
        $data['from']                   = '';
        $data['to']                   = '';
        return view('hact.reports.infections.present_infections.results', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function results_print(Requests\ReportClientRequest $request)
    {
        if($request->has('excel')){
            $this->infection->results_print($request);
        }else{
            $data                           = $this->infection->results_print($request);
            return view('hact.reports.infections.present_infections.results_print', $data);
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function excel($patients, $present_infections_format, $from, $to)
    {
        return $this->infection->excel($patients, $present_infections_format, $from, $to);
//        header("Content-Disposition: attachment; filename=\"$filename\"");
//        header("Content-Type: application/vnd.ms-excel");
//        return $excel;
//        $headers = [
//            'content-type' => 'attachment;',
//            'content-type' => 'application/vnd.ms-excel'
//        ];
//        return response()->download($excel, $filename, $headers)
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

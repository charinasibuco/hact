<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Infections;
use App\Patient;
use Auth;
use Hact\Report\InfectionClinicalStage\ReportInfectionClinicalStageRepository;


class ReportsInfectionsClinicalStageController extends Controller
{
    private $infection;

    /**
     * Inject dependencies.
     *
     * @param      ReportInfectionClinicalStageRepository  $infection  (description)
     */
    public function __construct(ReportInfectionClinicalStageRepository $infection)
    {
        $this->infection = $infection;
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
        $data['clinical_stage'] = '';
        $data['from']           = '';
        $data['to']             = '';
        return view('hact.reports.infections.infections_clinical_stage.results', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function results_print(Requests\ReportClientRequest $request)
    {
       $data = $this->infection->results_print($request);
        return view('hact.reports.infections.infections_clinical_stage.results_print', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function excel($patients, $clinical_stage_format, $from, $to)
    {
        return $this->infection->excel_export($patients, $clinical_stage_format, $from, $to);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hact\Report\Laboratory\ReportLaboratoryRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\LaboratoryTest;
use App\LaboratoryTestType;
use App\LaboratoryType;
use App\Patient;
use App\PatientDoctor;
use Auth;
use DB;

class ReportsLaboratoryController extends Controller
{

  private $laboratory;

  public function __construct(ReportLaboratoryRepository $laboratory)
  {
    $this->laboratory = $laboratory;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function results()
    {
        $data         = $this->laboratory->results();
        $data['labs'] = [];
        return view('hact.reports.laboratory.results',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function results_print(Requests\ReportLaboratoryRequest $request)
    {
      $data = $this->laboratory->results_print($request); 

        if($request->has('excel'))
        {
            return $this->excel($data['laboratories'], $data['search_patient'], $data['laboratory_types']);
        }
        return view('hact.reports.laboratory.results_print', $data);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function excel($laboratories, $search_patient, $laboratory_types)
    {
        return $this->laboratory->excel_export($laboratories, $search_patient, $laboratory_types);
       
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

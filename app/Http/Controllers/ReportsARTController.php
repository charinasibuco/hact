<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Prescription;
use App\MedicineModel;
use App\Mortality;
use App\Patient;
use App\ARVItems;
use App\VCT;
use Hact\Report\ART\ReportARTRepository;


class ReportsARTController extends Controller
{

  private $art;

  public function __construct(ReportARTRepository $art)
  {
    $this->art = $art;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function results()
    {
        $data['from'] = old('from');
        $data['to'] = old('to');
        return view('hact.reports.art.results',$data);
    }

    public function results_print(Requests\ReportClientRequest $request)
    {
      if($request->has('excel')){
        $this->art->print_results($request);
      }else{
        $data = $this->art->print_results($request);
        return view('hact.reports.art.results_print', $data);
      }

    }

    public function excel($age_range,$from,$to,$regimens,$plhiv_art_pregnant_count,$plhiv_art_count,$plhiv_art_start_count,$outcome)
    {
        return $this->art->excel_export($age_range,$from,$to,$regimens,$plhiv_art_pregnant_count,$plhiv_art_count,$plhiv_art_start_count,$outcome);
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

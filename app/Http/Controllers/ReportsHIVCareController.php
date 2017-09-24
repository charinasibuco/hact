<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\VCT;
use App\Infections;
use Auth;
use Hact\Report\HIVCare\ReportHIVRepository as ReportHIVRepository;

class ReportsHIVCareController extends Controller
{
    private $hiv;

    public function __construct(ReportHIVRepository $hiv)
    {
        $this->hiv = $hiv;
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
    public function results(){
        $data['from'] = old('from');
        $data['to'] = old('to');
        return view('hact.reports.infections.hiv_care.results', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function results_print(Requests\ReportClientRequest $request)
    {
        $data = $this->hiv->results_print($request);
        if($request->has('excel'))
        {
           return $this->excel($data['from'], $data['to'], $data['oi_count'], $data['candidiasis_count'], $data['syphilis_count'], $data['pcp_count'], $data['hepatitis_b_count'], $data['tb_count'], $data['cmv_count'], $data['herpes_simplex_count'], $data['kaposis_sarcoma_count'],$data['plhiv_count'], $data['plhiv_tb'], $data['plhiv_tb_ipt'], $data['plhiv_tb_tx'],$data['plhiv_infants_cotri'],$data['plhiv_cotri'],$data['plhiv_pmtct'],$data['plhiv_pregnant_art'],$data['plhiv_pregnant_arv'],$data['plhiv_nb_arv'], $data['plhiv_art'], $data['mac_count'], $data['anal_warts_count']);
        }
        return view('hact.reports.infections.hiv_care.results_print', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function excel($from, $to, $oi_count, $candidiasis_count, $syphilis_count, $pcp_count, $hepatitis_b_count, $tb_count, $cmv_count, $herpes_simplex_count, $kaposis_sarcoma_count,$plhiv_count, $plhiv_tb, $plhiv_tb_ipt, $plhiv_tb_tx,$plhiv_infants_cotri,$plhiv_cotri,$plhiv_pmtct,$plhiv_pregnant_art,$plhiv_pregnant_arv,$plhiv_nb_arv, $plhiv_art, $mac_count, $anal_warts_count)
    {
        return $this->hiv->excel_export($from, $to, $oi_count, $candidiasis_count, $syphilis_count, $pcp_count, $hepatitis_b_count, $tb_count, $cmv_count, $herpes_simplex_count, $kaposis_sarcoma_count,$plhiv_count, $plhiv_tb, $plhiv_tb_ipt, $plhiv_tb_tx,$plhiv_infants_cotri,$plhiv_cotri,$plhiv_pmtct,$plhiv_pregnant_art,$plhiv_pregnant_arv,$plhiv_nb_arv, $plhiv_art, $mac_count, $anal_warts_count);
    }

}

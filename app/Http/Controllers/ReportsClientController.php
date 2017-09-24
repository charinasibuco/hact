<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\VCT;
use App\VCTSuplementalChildren;
use App\ARV;
use Auth;

class ReportsClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function results()
    {

        if(Auth::user()->access != 1)
        {
            abort(403);
        }

        $data['from'] = old('from');
        $data['to'] = old('to');
        return view('hact.reports.client.results', $data);
    }

     public function results_print(Requests\ReportClientRequest $request)
    {
        $from = date('Y-m-d',strtotime($request->from));
        $to = date('Y-m-d',strtotime($request->to));

        function marp_refresh($from, $to)
        {
            return VCT::where(function($query) use($from, $to){
                            $query->where('vct_date','>=',$from)
                            ->where('vct_date','<=',$to);
                            })
                        ->where(function($query) use($from, $to){
                            $query->where('experience_7',1)
                                ->orWhere('experience_8',1)
                                ->orWhere('experience_1',1)
                                ->orWhere('experience_2',1)
                                ->orWhere(function ($query){
                                    $query->where('experience_6', 1);
                                    });
                        });
        }

        function hcw_oe_refresh($from, $to)
        {
            return VCT::where(function($query) use($from, $to){
                            $query->where('vct_date','>=',$from)
                            ->where('vct_date','<=',$to);
                            })
                            ->where(function($query) use($from, $to){
                            $query->where('experience_3',1)
                                ->orWhere('reason_4',1);
                            })
                            ->leftJoin('patient','patient.id','=','vct.patient_id');
        }

        function pregnant_refresh($from, $to)
        {
        return VCT::where(function($query) use($from, $to){
                        $query->where('vct_date','>=',$from)
                        ->where('vct_date','<=',$to);
                        })
                    ->where('reason_11',1)
                    ->leftJoin('patient','patient.id','=','vct.patient_id');
        }

        function mw_refresh($from,$to)
        {
            return VCT::leftJoin('patient','vct.patient_id','=','patient.id')
                        ->where(function($query) use($from, $to){
                            $query->where('vct_date','>=',$from)
                            ->where('vct_date','<=',$to);
                            })
                        ->where(function($query){
                            $query->where('patient.is_work_abroad_in_past_5years',1)
                                ->orWhere('reason_10', 1);
                        });
        }

        function children_refresh($from, $to)
        {
            return VCT::leftJoin('patient','vct.patient_id','=','patient.id')
                        ->where(function($query) use($from, $to){
                            $query->where('vct_date','>=',$from)
                            ->where('vct_date','<=',$to);
                            })
                        ->where('patient.birth_date','>',date('Y-m-d',strtotime('-18 Years')));
        }

        function others_refresh($from, $to)
        {
            return VCT::where(function($query) use($from, $to){
                            $query->where('vct_date','>=',$from)
                            ->where('vct_date','<=',$to);
                            })
                            ->where(function($query) use($from, $to){
                            $query->where('reason_5',1)
                                ->orWhere('reason_8',1)
                                ->orWhere('reason_9',1)
                                ->orWhere('reason_14',1)
                                ->orWhere(function($query) use($from, $to){
                                    $query->where('reason_1',0)
                                        ->where('reason_2',0)
                                        ->where('reason_3',0)
                                        ->where('reason_4',0)
                                        ->where('reason_5',0)
                                        ->where('reason_6',0)
                                        ->where('reason_7',0)
                                        ->where('reason_8',0)
                                        ->where('reason_9',0)
                                        ->where('reason_10',0)
                                        ->where('reason_11',0)
                                        ->where('reason_12',0)
                                        ->where('reason_13',0)
                                        ->where('reason_14',0)
                                        ->where('experience_1',0)
                                        ->where('experience_2',0)
                                        ->where('experience_3',0)
                                        ->where('experience_4',0)
                                        ->where('experience_5',0)
                                        ->where('experience_6',0)
                                        ->where('experience_7',0)
                                        ->where('experience_8',0);
                                })
                                ->orWhere('reason_other','!=',"");
                                
                            })
                            ->leftJoin('patient','patient.id','=','vct.patient_id');
        }

        $marp_query = marp_refresh($from,$to);
        $hcw_oe_query = hcw_oe_refresh($from,$to); 
        $pregnant_query = pregnant_refresh($from,$to);
        $mw_query = mw_refresh($from,$to);
        $children_query = children_refresh($from,$to);
        $others_query = others_refresh($from,$to);


        $marp = $marp_query->distinct()->count();
        $hcw_oe = $hcw_oe_query->distinct()->count();
        $pregnant = $pregnant_query->distinct()->count();
        $mw = $mw_query->distinct()->count();
        $children = $children_query->distinct()->count();
        $others = $others_query->distinct()->count();

        $marp_query = marp_refresh($from,$to);
        $hcw_oe_query = hcw_oe_refresh($from,$to); 
        $pregnant_query = pregnant_refresh($from,$to);
        $mw_query = mw_refresh($from,$to);
        $children_query = children_refresh($from,$to);
        $others_query = others_refresh($from,$to);

        $marp_positive = $marp_query->where('result', 2)->select('patient.*')->distinct()->count();
        $hcw_oe_positive = $hcw_oe_query->where('result', 2)->select('patient.*')->distinct()->count();
        $pregnant_positive = $pregnant_query->where('result', 2)->select('patient.*')->distinct()->count();
        $mw_positive = $mw_query->where('result', 2)->select('patient.*')->distinct()->count();
        $children_positive = $children_query->where('result', 2)->select('patient.*')->distinct()->count();
        $others_positive = $others_query->where('result', 2)->select('patient.*')->distinct()->count();

        $marp_negative = $marp - $marp_positive;
        $hcw_oe_negative = $hcw_oe - $hcw_oe_positive;
        $pregnant_negative = $pregnant - $pregnant_positive;
        $mw_negative = $mw - $mw_positive;
        $children_negative = $children - $children_positive;
        $others_negative = $others - $others_positive;

        /*$marp_query = marp_refresh($from,$to);
        $hcw_oe_query = hcw_oe_refresh($from,$to); 
        $pregnant_query = pregnant_refresh($from,$to);
        $mw_query = mw_refresh($from,$to);
        $children_query = children_refresh($from,$to);
        $others_query = others_refresh($from,$to);*/

        // $marp_negative = $marp_query->where(function($query){
        //                     $query->where('result', 0)
        //                         ->orWhere('result', 1)
        //                         ->orWhere('result', 3);
        //                     })->distinct()->count();
        // $hcw_oe_negative = $hcw_oe_query->where(function($query){
        //                     $query->where('result', 0)
        //                         ->orWhere('result', 1)
        //                         ->orWhere('result', 3);
        //                     })->distinct()->count();
        // $pregnant_negative = $pregnant_query->where(function($query){
        //                     $query->where('result', 0)
        //                         ->orWhere('result', 1)
        //                         ->orWhere('result', 3);
        //                     })->distinct()->count();
        // $mw_negative = $mw_query->where(function($query){
        //                     $query->where('result', 0)
        //                         ->orWhere('result', 1)
        //                         ->orWhere('result', 3);
        //                     })->distinct()->count();
        // $children_negative = $children_query->where(function($query){
        //                     $query->where('result', 0)
        //                         ->orWhere('result', 1)
        //                         ->orWhere('result', 3);
        //                     })->distinct()->count();
                            
        // $others_negative = $others_query->where(function($query){
        //                     $query->where('result', 0)
        //                         ->orWhere('result', 1)
        //                         ->orWhere('result', 3);
        //                     })->distinct()->count();

       /* $marp_negative = marp_refresh($from,$to)->where('result','!=', 2)->select('patient.*')->distinct()->count();
        $hcw_oe_negative = hcw_oe_refresh($from,$to)->where('result','!=', 2)->select('patient.*')->distinct()->count();
        $pregnant_negative = pregnant_refresh($from,$to)->where('result', 2)->select('patient.*')->distinct()->count();
        $mw_negative = mw_refresh($from,$to)->where('result','!=', 2)->select('patient.*')->distinct()->count();
        $children_negative = children_refresh($from,$to)->where('result','!=', 2)->select('patient.*')->distinct()->count();
        $others_negative = others_refresh($from,$to)->where('result','!=', 2)->select('patient.*')->distinct()->count();*/


 
        /*$marp_query = marp_refresh($from,$to);
        $hcw_oe_query = hcw_oe_refresh($from,$to); 
        $pregnant_query = pregnant_refresh($from,$to);
        $mw_query = mw_refresh($from,$to);
        $children_query = children_refresh($from,$to);
        $others_query = others_refresh($from,$to);*/

        $hcw_oe_pep = $hcw_oe_query->join('arv','vct.patient_id','=','arv.patient_id')->distinct()->count();
        $data = compact(
                'from','to','marp','hcw_oe','pregnant','mw','children',
                'marp_positive','hcw_oe_positive','pregnant_positive','mw_positive','children_positive',
                'marp_negative','hcw_oe_negative','pregnant_negative','mw_negative','children_negative',
                'hcw_oe_pep', 'others', 'others_positive', 'others_negative'
                      );
        if($request->has('excel'))   
        {
            $this->results_excel($from, $to, $marp, $marp_positive, $marp_negative, $mw, $mw_negative, 
                $mw_positive, $hcw_oe, $hcw_oe_positive, $hcw_oe_negative, $pregnant, $pregnant_negative,
                $pregnant_positive, $children, $children_positive, $children_negative, $others, $others_positive,
                $others_negative, $hcw_oe_pep);
        }  
        else
        {
        return view('hact.reports.client.results_print', $data);
        }
    }

    public function results_excel($from, $to, $marp, $marp_positive, $marp_negative, $mw, $mw_negative, 
                $mw_positive, $hcw_oe, $hcw_oe_positive, $hcw_oe_negative, $pregnant, $pregnant_negative,
                $pregnant_positive, $children, $children_positive, $children_negative, $others, $others_positive,
                $others_negative, $hcw_oe_pep){
        $excel  = "<table border=\"1\" >";
        $excel .= "<thead>";

        $excel .= "<tr>";
        $excel .= "<th colspan=\"5\">Corazon Locsin Montelibano Memorial Regional Hospital</th>";
        $excel .= "</tr>";

        $excel .= "<tr>";
        $excel .= "<th colspan=\"5\">HCT Monthly Report From ".$from." to ".$to."</th>";
        $excel .= "</tr>";

        $excel .= "<tr>";
        $excel .= "<th colspan=\"1\">Type of Clients</th>";
        $excel .= "<th colspan=\"1\">No. of Patients/Clients who underwent Pre-Test Counseling</th>";
        $excel .= "<th colspan=\"1\">No. of Patient/Clients Tested</th>";
        $excel .= "<th colspan=\"1\">No. of Patients/ Clients who received results and underwent Post-Test Counseling</th>";
        $excel .= "<th colspan=\"1\">No. of Patients/ Clients diagnosed with HIV</th>";
        $excel .= "</tr>";

        $excel .= "</thead>";

        $excel .= "<tbody>";

        $excel .= "<tr>";
        $excel .= "<td colspan=\"1\">MARP*(SW, Client of SW, MSM, IDU or combination of risks)</td>";
        $excel .= "<td colspan=\"1\">" . $marp . "</td>";
        $excel .= "<td colspan=\"1\">" . $marp . "</td>";
        $excel .= "<td colspan=\"1\">" . $marp_negative . "</td>";
        $excel .= "<td colspan=\"1\">" . $marp_positive . "</td>";
        $excel .= "</tr>";

        $excel .= "<tr>";
        $excel .= "<td colspan=\"1\">MW*</td>";
        $excel .= "<td colspan=\"1\">" . $mw . "</td>";
        $excel .= "<td colspan=\"1\">" . $mw . "</td>";
        $excel .= "<td colspan=\"1\">" . $mw_negative . "</td>";
        $excel .= "<td colspan=\"1\">" . $mw_positive . "</td>";
        $excel .= "</tr>";

        $excel .= "<tr>";
        $excel .= "<td colspan=\"1\">HCW with OE*</td>";
        $excel .= "<td colspan=\"1\">" . $hcw_oe . "</td>";
        $excel .= "<td colspan=\"1\">" . $hcw_oe . "</td>";
        $excel .= "<td colspan=\"1\">" . $hcw_oe_negative . "</td>";
        $excel .= "<td colspan=\"1\">" . $hcw_oe_positive . "</td>";
        $excel .= "</tr>";

        $excel .= "<tr>";
        $excel .= "<td colspan=\"1\">Pregnant</td>";
        $excel .= "<td colspan=\"1\">" . $pregnant . "</td>";
        $excel .= "<td colspan=\"1\">" . $pregnant . "</td>";
        $excel .= "<td colspan=\"1\">" . $pregnant_negative . "</td>";
        $excel .= "<td colspan=\"1\">" . $pregnant_positive . "</td>";
        $excel .= "</tr>";

        $excel .= "<tr>";
        $excel .= "<td colspan=\"1\">Children(below 18yo)</td>";
        $excel .= "<td colspan=\"1\">" . $children . "</td>";
        $excel .= "<td colspan=\"1\">" . $children . "</td>";
        $excel .= "<td colspan=\"1\">" . $children_negative . "</td>";
        $excel .= "<td colspan=\"1\">" . $children_positive . "</td>";
        $excel .= "</tr>";

        $excel .= "<tr>";
        $excel .= "<td colspan=\"1\">Others</td>";
        $excel .= "<td colspan=\"1\">" . $others . "</td>";
        $excel .= "<td colspan=\"1\">" . $others . "</td>";
        $excel .= "<td colspan=\"1\">" . $others_negative . "</td>";
        $excel .= "<td colspan=\"1\">" . $others_positive . "</td>";
        $excel .= "</tr>";

        $excel .= "<tr>";
        $excel .= "<td colspan=\"1\"></td>";
        $excel .= "<td colspan=\"1\"></td>";
        $excel .= "<td colspan=\"1\"></td>";
        $excel .= "<td colspan=\"1\"></td>";
        $excel .= "<td colspan=\"1\"></td>";
        $excel .= "</tr>";

        $excel .= "<tr>";
        $excel .= "<td colspan=\"1\">No. of HCW provided with PEP*</td>";
        $excel .= "<td colspan=\"1\">".$hcw_oe_pep."</td>";
        $excel .= "<td colspan=\"1\"></td>";
        $excel .= "<td colspan=\"1\"></td>";
        $excel .= "<td colspan=\"1\"></td>";
        $excel .= "</tr>";

        $excel .= "</tbody>";
        $excel .= "</table>";

        $filename = 'HCT Monthly Report From '.$from.' to '.$to.'.xls';

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        print $excel;

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

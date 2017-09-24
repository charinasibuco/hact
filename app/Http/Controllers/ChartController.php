<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Patient;
use App\VCT;
use App\Infections;
use App\Mortality;
use App\Laboratory;
use App\LaboratoryType;
use App\TuberculosisModel;

use \Carbon\Carbon;
use DB;

class ChartController extends Controller
{
    public function years($chart_type)
    {
        $i = 0;
        $data = [];
        $years = [];

        if($chart_type == 'patient_male_and_female')
        {
            $years = VCT::select(DB::raw('YEAR(vct_date) AS year_list'))->whereIn('result', [1, 2, 3])->groupBy('year_list')->orderBy('year_list', 'DECS')->get();
        }
        else if($chart_type == 'vct_result')
        {
            $years = VCT::select(DB::raw('YEAR(vct_date) AS year_list'))->whereIn('result', [1, 2, 3])->groupBy('year_list')->orderBy('year_list', 'DECS')->get();
        }
        else if($chart_type == 'infections_result')
        {
            $years = Infections::select(DB::raw('YEAR(result_date) AS year_list'))->groupBy('year_list')->orderBy('year_list', 'DESC')->get();
        }
        else if($chart_type == 'infections_hiv_stages_result')
        {
            $years = Infections::select(DB::raw('YEAR(result_date) AS year_list'))->groupBy('year_list')->orderBy('year_list', 'DESC')->get();
        }
        else if($chart_type == 'tuberculosis_result')
        {
            $years = TuberculosisModel::select(DB::raw('YEAR(date_started) AS year_list'))->groupBy('year_list')->orderBy('year_list', 'DESC')->get();
        }
        else if($chart_type == 'mortality_result')
        {
            $years = Mortality::select(DB::raw('YEAR(date_of_death) AS year_list'))->groupBy('year_list')->orderBy('year_list', 'DESC')->get();
        }
        
        foreach ($years as $row)
        {
            $data['years'][$i] = $row->year_list;
            $i++;
        }

        return response()->json($data);
    }

    /**
    Current year record
     **/
    /*public function current_year_record(Request $request)
    {
        $i      = 0;
        $data   = [];
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        $data['year'] = date('Y');
        $data['categories'] = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        foreach ($months as $month)
        {
            $from   = date('Y-m-d', strtotime(date($data['year'] . '-' . $month . '-1')));
            $to     = date('Y-m-t', strtotime(date($data['year'] . '-' . $month . '-d')));

            $female =   VCT::where('result', 1)
                        ->whereHas('Patient', function($query){
                            $query->where('gender', 0);
                        })
                        ->where(function($query) use ($from, $to){
                            $query->where('vct_date', '>=', $from)->where('vct_date', '<=', $to);
                        })->count();

            $male   =   VCT::where('result', 1)
                        ->whereHas('Patient', function($query){
                            $query->where('gender', 1);
                        })
                        ->where(function($query) use ($from, $to){
                            $query->where('vct_date', '>=', $from)->where('vct_date', '<=', $to);
                        })->count();

            #$data['male'][$i]   = rand(10, 50);
            #$data['female'][$i] = rand(10, 50);
            $data['male'][$i]   = $male;
            $data['female'][$i] = $male;

            $i++;
        }

        return response()->json($data);
    }*/

    /**
    HIV Record Summary
     **/
    public function current_year_record($year = null)
    {
        if(is_null($year))
        {
            return $this->current_year_record_summary();
        }
        else
        {
            return $this->current_year_record_yearly($year);
        }
    }

    public function current_year_record_yearly($year)
    {
        $i      = 0;
        $data   = [];
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $data['year'] = trim($year);
        $data['categories'] = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        foreach ($months as $month)
        {
            #$yearly_record[$i]    = $row->vct_year;
            #$reactive[$i]         = VCT::whereIn('result', [1,2,3])->where(DB::raw('YEAR(vct_date)'), $row->vct_year)->count();
            #$nonreactive[$i]      = VCT::where('result', 0)->where(DB::raw('YEAR(vct_date)'), $row->vct_year)->count();
            #$data['female'][$i] = VCT::where(DB::raw('YEAR(vct_date)'), $year)->where(DB::raw('MONTH(vct_date)'), $month)->whereIn('result', [1,2,3])->count();
            #$data['male'][$i]   = VCT::where(DB::raw('YEAR(vct_date)'), $year)->where(DB::raw('MONTH(vct_date)'), $month)->where('result', 0)->count();
            
            $data['female'][$i] =   VCT::where(DB::raw('YEAR(vct_date)'), $year)
                                    ->where(DB::raw('MONTH(vct_date)'), $month)
                                    ->whereIn('result', [1,2,3])
                                    ->whereHas('Patient', function($query){
                                        $query->where('gender', 0);
                                    })
                                    ->where(DB::raw('YEAR(vct_date)'), $year)
                                    ->count();

            $data['male'][$i]   =   VCT::where(DB::raw('YEAR(vct_date)'), $year)
                                    ->where(DB::raw('MONTH(vct_date)'), $month)
                                    ->whereIn('result', [1,2,3])
                                    ->whereHas('Patient', function($query){
                                        $query->where('gender', 1);
                                    })
                                    ->where(DB::raw('YEAR(vct_date)'), $year)
                                    ->count();
            $i++;
        }

        return response()->json($data);
    }

    public function current_year_record_summary()
    {
        $i             = 0;
        $nr            = 0;
        $data          = [];
        $male          = [];
        $female        = [];
        $yearly_record = [];

        $start_year  = VCT::where('result', 1)->orderBy('vct_date', 'ASC')->first();
        $last_year   = VCT::where('result', 1)->orderBy('vct_date', 'DESC')->first();
        $year_list   = VCT::select(DB::raw('YEAR(vct_date) AS vct_year'))->whereIn('result', [1,2,3])->groupBy(DB::raw('YEAR(vct_date)'))->orderBy('vct_date', 'ASC')->get();
        
        foreach ($year_list as $row)
        {
            $yearly_record[$i]      =   $row->vct_year;

            $female[$i]             =   VCT::whereIn('result', [1,2,3])
                                        ->whereHas('Patient', function($query){
                                            $query->where('gender', 0);
                                        })
                                        ->where(DB::raw('YEAR(vct_date)'), $row->vct_year)
                                        ->count();

            $male[$i]               =   VCT::whereIn('result', [1,2,3])
                                        ->whereHas('Patient', function($query){
                                            $query->where('gender', 1);
                                        })
                                        ->where(DB::raw('YEAR(vct_date)'), $row->vct_year)
                                        ->count();
            $i++;
        } 

        $data['start_year']     = ($start_year) ? $start_year->vct_date_year : '';
        $data['last_year']      = ($last_year) ? $last_year->vct_date_year : '';
        $data['female']         = $female;
        $data['male']           = $male;
        $data['yearly_record']  = $yearly_record;

        #dd($data);
        return response()->json($data);
    }

    /**
    HIV Record Summary
     **/
    public function hiv_record_summary($year = null)
    {

        if(is_null($year))
        {

            return $this->hiv_record_summary_all();
        }
        else
        {
            return $this->hiv_record_summary_yearly($year);
        }
    }

    public function hiv_record_summary_all()
    {
        $i             = 0;
        $nr            = 0;
        $data          = [];
        $reactive      = [];
        $nonreactive   = [];
        $yearly_record = [];

        $start_year  = VCT::where('result', 1)->orderBy('vct_date', 'ASC')->first();
        $last_year   = VCT::where('result', 1)->orderBy('vct_date', 'DESC')->first();
        $year_list   = VCT::select(DB::raw('YEAR(vct_date) AS vct_year'))->groupBy(DB::raw('YEAR(vct_date)'))->orderBy('vct_date', 'ASC')->get();
        
        foreach ($year_list as $row)
        {
            $yearly_record[$i]    = $row->vct_year;
            $reactive[$i]         = VCT::whereIn('result', [1,2,3])->where(DB::raw('YEAR(vct_date)'), $row->vct_year)->count();
            $nonreactive[$i]      = VCT::where('result', 0)->where(DB::raw('YEAR(vct_date)'), $row->vct_year)->count();
            $i++;
        } 
        
        #echo $start_year . ' - ' . $last_year;
        #dd($yearly_record);

        $data['start_year']     = ($start_year) ? $start_year->vct_date_year : '';
        $data['last_year']      = ($last_year) ? $last_year->vct_date_year : '';
        $data['reactive']       = $reactive;
        $data['nonreactive']    = $nonreactive;
        $data['yearly_record']  = $yearly_record;

        #dd($data);
        return response()->json($data);
        //return $data;
    }

    public function hiv_record_summary_yearly($year)
    {
        $i      = 0;
        $data   = [];
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $data['year'] = trim($year);
        $data['categories'] = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data['reactive'] = [];
        $data['nonreactive'] = [];

        foreach ($months as $month)
        {
            #$yearly_record[$i]    = $row->vct_year;
            #$reactive[$i]         = VCT::whereIn('result', [1,2,3])->where(DB::raw('YEAR(vct_date)'), $row->vct_year)->count();
            #$nonreactive[$i]      = VCT::where('result', 0)->where(DB::raw('YEAR(vct_date)'), $row->vct_year)->count();
            $data['reactive'][$i]    = VCT::where(DB::raw('YEAR(vct_date)'), $year)->where(DB::raw('MONTH(vct_date)'), $month)->whereIn('result', [1,2,3])->count();
            $data['nonreactive'][$i] = VCT::where(DB::raw('YEAR(vct_date)'), $year)->where(DB::raw('MONTH(vct_date)'), $month)->where('result', 0)->count();
            $i++;
        }

        return response()->json($data);
    }

    /**
    
     **/

    public function chart_mortality()
    {
        $i      = 0;
        $data   = [];
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $data['year'] = date('Y');
        $data['categories'] = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];


        foreach ($months as $month)
        {
            $from   = date('Y-m-d', strtotime(date($data['year'] . '-' . $month . '-1')));
            $to     = date('Y-m-t', strtotime(date($data['year'] . '-' . $month . '-d')));

            $mortality =   Mortality::where(function($query) use ($from, $to){
                            $query->where('date_of_death', '>=', $from)->where('date_of_death', '<=', $to);
                        })->count();
            #$data['male'][$i]   = rand(10, 50);
            #$data['female'][$i] = rand(10, 50);
            $data['mortality'][$i]   = $mortality;

            $i++;
        }

        #echo $start_year . ' - ' . $last_year;
        #dd($yearly_record);
        #dd($data);
        return response()->json($data);
    }

    /**
    
     **/

    public function chart_present_infections($year = null)
    {
        if(is_null($year))
        {
            return $this->chart_present_infections_summary();
        }
        else
        {
            return $this->chart_present_infections_yearly($year);
        }
    }

    public function chart_present_infections_yearly($year)
    {
        $i      = 0;
        $data   = [];
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $data['year'] = $year;
        $data['categories'] = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $data['hepatitis_b']     = [];
        $data['hepatitis_c']     = [];
        $data['pneumocystis_pneumonia']     = [];
        $data['orpharyngeal_candidiasis']   = [];
        $data['syphilis']       = [];
        $data['stis']           = [];
        $data['others']         = [];

        foreach ($months as $month)
        {
            $data['hepatitis_b'][$i]                =  Infections::where(DB::raw('YEAR(result_date)'), $year)->where(DB::raw('MONTH(result_date)'), $month)->where('hepatitis_b', 1)->count();
            $data['hepatitis_c'][$i]                =  Infections::where(DB::raw('YEAR(result_date)'), $year)->where(DB::raw('MONTH(result_date)'), $month)->where('hepatitis_c', 1)->count();
            $data['pneumocystis_pneumonia'][$i]     =  Infections::where(DB::raw('YEAR(result_date)'), $year)->where(DB::raw('MONTH(result_date)'), $month)->where('pneumocystis_pneumonia', 1)->count();
            $data['orpharyngeal_candidiasis'][$i]   =  Infections::where(DB::raw('YEAR(result_date)'), $year)->where(DB::raw('MONTH(result_date)'), $month)->where('orpharyngeal_candidiasis', 1)->count();
            $data['syphilis'][$i]                   =  Infections::where(DB::raw('YEAR(result_date)'), $year)->where(DB::raw('MONTH(result_date)'), $month)->where('syphilis', 1)->count();
            $data['stis'][$i]                       =  Infections::where(DB::raw('YEAR(result_date)'), $year)->where(DB::raw('MONTH(result_date)'), $month)->where('stis', '<>', '')->count();
            $data['others'][$i]                     =  Infections::where(DB::raw('YEAR(result_date)'), $year)->where(DB::raw('MONTH(result_date)'), $month)->where('others', '<>', '')->count();

            $i++;
        }

        return response()->json($data);
    }

    public function chart_present_infections_summary()
    {
        $i  = 0;
        $data = [];
        $data['yearly_record']  = [];
        $data['categories']     = [];

        $data['hepatitis_b']     = [];
        $data['hepatitis_c']     = [];
        $data['pneumocystis_pneumonia']     = [];
        $data['orpharyngeal_candidiasis']   = [];
        $data['syphilis']       = [];
        $data['stis']           = [];
        $data['others']         = [];

        $start_year  = Infections::where('result_date', 1)->orderBy('result_date', 'ASC')->first();
        $last_year   = Infections::where('result_date', 1)->orderBy('result_date', 'DESC')->first();
        $year_list   = Infections::select(DB::raw('YEAR(result_date) AS result_year'))->groupBy('result_year')->orderBy('result_date', 'ASC')->get();
        
        foreach ($year_list as $row)
        {
            $data['hepatitis_b'][$i]                =  Infections::where(DB::raw('YEAR(result_date)'), $row->result_year)->where('hepatitis_b', 1)->count();
            $data['hepatitis_c'][$i]                =  Infections::where(DB::raw('YEAR(result_date)'), $row->result_year)->where('hepatitis_c', 1)->count();
            $data['pneumocystis_pneumonia'][$i]     =  Infections::where(DB::raw('YEAR(result_date)'), $row->result_year)->where('pneumocystis_pneumonia', 1)->count();
            $data['orpharyngeal_candidiasis'][$i]   =  Infections::where(DB::raw('YEAR(result_date)'), $row->result_year)->where('orpharyngeal_candidiasis', 1)->count();
            $data['syphilis'][$i]                   =  Infections::where(DB::raw('YEAR(result_date)'), $row->result_year)->where('syphilis', 1)->count();
            $data['stis'][$i]                       =  Infections::where(DB::raw('YEAR(result_date)'), $row->result_year)->where('stis', '<>', '')->count();
            $data['others'][$i]                     =  Infections::where(DB::raw('YEAR(result_date)'), $row->result_year)->where('others', '<>', '')->count();

            $i++;
        }

        $data['start_year'] = ($start_year) ? $start_year->result_date : '';
        $data['last_year']  = ($start_year) ? $last_year->result_date : '';

        return response()->json($data);
    }

    /**
    
     **/
    public function hiv_stages()
    {
        $i = 0;
        $data = [];

        $start_year = VCT::where('result', 1)->orderBy('vct_date', 'ASC')->first();
        $last_year  = VCT::where('result', 1)->orderBy('vct_date', 'DESC')->first();
        $categories = VCT::select(DB::raw('YEAR(vct_date) AS vct_year'))->where('result', 1)->groupBy(DB::raw('YEAR(vct_date)'))->orderBy('vct_date', 'ASC')->get();
        
        foreach ($categories as $row)
        {
            $category[$i]       = $row->vct_year;
            $yearly_record[$i]  = VCT::where('result', 1)->where(DB::raw('YEAR(vct_date)'), $row->vct_year)->count();
        }

        $data['start_year'] = ($start_year) ? $start_year->vct_date : '';
        $data['last_year']  = ($last_year) ? $last_year->vct_date : '';
        $data['stage_1']    = 1;
        $data['stage_2']    = 4;
        $data['stage_3']    = 8;
        $data['stage_4']    = 9;

        return response()->json($data);
    }

    public function chart_clinical_stages($year = null)
    {
        if(is_null($year))
        {
            return $this->chart_clinical_stages_summary();
        }
        else
        {
            return $this->chart_clinical_stages_yearly($year);
        }
    }
    
    public function chart_clinical_stages_yearly($year)
    {
        $i      = 0;
        $data   = [];
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $data['year'] = trim($year);
        $data['categories'] = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        foreach ($months as $month)
        {
            $data['clinical_stage_1'][$i] = Infections::where('clinical_stage', 1)
                                            ->where(DB::raw('YEAR(result_date)'), $year)
                                            ->where(DB::raw('MONTH(result_date)'), $month)
                                            ->count();

            $data['clinical_stage_2'][$i] = Infections::where('clinical_stage', 2)
                                            ->where(DB::raw('YEAR(result_date)'), $year)
                                            ->where(DB::raw('MONTH(result_date)'), $month)
                                            ->count();

            $data['clinical_stage_3'][$i] = Infections::where('clinical_stage', 3)
                                            ->where(DB::raw('YEAR(result_date)'), $year)
                                            ->where(DB::raw('MONTH(result_date)'), $month)
                                            ->count();

            $data['clinical_stage_4'][$i] = Infections::where('clinical_stage', 4)
                                            ->where(DB::raw('YEAR(result_date)'), $year)
                                            ->where(DB::raw('MONTH(result_date)'), $month)
                                            ->count();

            $data['none'][$i] = Infections::where(DB::raw('YEAR(result_date)'), $year)
                                ->where(DB::raw('MONTH(result_date)'), $month)
                                ->where(function($query){
                                    $query->where('clinical_stage', '')->orWhere('clinical_stage', 0);
                                })->count();

            $i++;
        }

        return response()->json($data);
    }
    
    public function chart_clinical_stages_summary()
    {
        $i = 0;
        $data = [];

        $start_year = Infections::select(DB::raw('YEAR(result_date) AS result_year'))->orderBy('result_year', 'ASC')->first();
        $last_year  = Infections::select(DB::raw('YEAR(result_date) AS result_year'))->orderBy('result_year', 'DESC')->first();
        $categories = Infections::select(DB::raw('YEAR(result_date) AS result_year'))->groupBy('result_year')->orderBy('result_year', 'ASC')->get();
        
        foreach ($categories as $row)
        {
            $data['categories'][$i]           = $row->result_year;
            $data['clinical_stage_1'][$i]   =   Infections::where('clinical_stage', 1)
                                                ->where(DB::raw('YEAR(result_date)'), $row->result_year)->count();
            $data['clinical_stage_2'][$i]   =   Infections::where('clinical_stage', 2)
                                                ->where(DB::raw('YEAR(result_date)'), $row->result_year)->count();
            $data['clinical_stage_3'][$i]   =   Infections::where('clinical_stage', 3)
                                                ->where(DB::raw('YEAR(result_date)'), $row->result_year)->count();
            $data['clinical_stage_4'][$i]   =   Infections::where('clinical_stage', 4)
                                                ->where(DB::raw('YEAR(result_date)'), $row->result_year)->count();
            $data['none'][$i]               =   Infections::where(DB::raw('YEAR(result_date)'), $row->result_year)
                                                ->where(function($query){
                                                    $query->where('clinical_stage', '')->orWhere('clinical_stage', 0);
                                                })
                                                ->count();
            $i++;
        }

        $data['start_year'] = ($start_year) ? $start_year->result_year : '';
        $data['last_year']  = ($start_year) ? $last_year->result_year : '';

        return response()->json($data);
    }

    public function chart_laboratory()
    {
        $i      = 0;
        $data = [];
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $data['year'] = date('Y');
        $data['categories'] = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];


        foreach ($months as $month)
        {
            $from   = date('Y-m-d', strtotime(date($data['year'] . '-' . $month . '-1')));
            $to     = date('Y-m-t', strtotime(date($data['year'] . '-' . $month . '-d')));

            for( $x = 1; $x <= 7; $x++ )
            {
                $data[$x][$i] = Laboratory::where('laboratory_type_id','=',$x)
                                ->where(function($query) use ($from, $to){
                                    $query->where('result_date', '>=', $from)->where('result_date', '<=', $to);
                                })->count();
            }

            $i++;
        }
        return response()->json($data);
    }

    public function chart_tuberculosis($year = null)
    {
        if(is_null($year))
        {
            return $this->chart_chart_tuberculosis_summary();
        }
        else
        {
            return $this->chart_chart_tuberculosis_yearly($year);
        }
    }

    /**
    
     **/
    public function chart_chart_tuberculosis_summary()
    {
        $i      = 0;
        $data   = [];
        $data['title']                  = 'Tuberculosis Cases';
        $data['categories']             = [];
        $data['records']['active']      = [];
        $data['records']['no_active']   = [];

        $start_year  = TuberculosisModel::where('date_started', 1)->orderBy('date_started', 'ASC')->first();
        $last_year   = TuberculosisModel::where('date_started', 1)->orderBy('date_started', 'DESC')->first();
        $year_list   = TuberculosisModel::select(DB::raw('YEAR(date_started) AS result_year'))->groupBy('result_year')->orderBy('result_year', 'ASC')->get();
        
        foreach ($year_list as $row)
        {
            $data['categories'][$i]             = $row->result_year;
            $data['records']['active'][$i]      =  TuberculosisModel::where(DB::raw('YEAR(date_started)'), $row->result_year)->where('tb_status', 1)->count();
            $data['records']['no_active'][$i]   =  TuberculosisModel::where(DB::raw('YEAR(date_started)'), $row->result_year)->where('tb_status', 0)->count();

            $i++;
        }

        $data['start_year'] = ($start_year) ? $start_year->date_started : '';
        $data['last_year']  = ($start_year) ? $last_year->date_started : '';

        return response()->json($data);
    }

    public function chart_chart_tuberculosis_yearly($year)
    {
        $i                              = 0;
        $data                           = [];
        $months                         = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $data['year']                   = trim($year);
        $data['title']                  = 'Tuberculosis Cases';
        $data['categories']             = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data['records']['active']      = [];
        $data['records']['no_active']   = [];

        foreach ($months as $month)
        {
            $data['records']['active'][$i]      =  TuberculosisModel::where(DB::raw('MONTH(date_started)'), $month)->where('tb_status', 1)->count();
            $data['records']['no_active'][$i]   =  TuberculosisModel::where(DB::raw('MONTH(date_started)'), $month)->where('tb_status', 0)->count();

            $i++;
        }

        return response()->json($data);
    }

    /**
    
     **/
    public function chart_mortality_result($year = null)
    {
        if(is_null($year))
        {
            return $this->chart_mortality_summary();
        }
        else
        {
            return $this->chart_mortality_yearly($year);
        }
    }

    public function chart_mortality_summary()
    {
        $i      = 0;
        $data   = [];
        $data['title']      = 'Mortality Cases';
        $data['categories'] = [];
        $data['records']    = [];

        $start_year  = Mortality::where('date_of_death', 1)->orderBy('date_of_death', 'ASC')->first();
        $last_year   = Mortality::where('date_of_death', 1)->orderBy('date_of_death', 'DESC')->first();
        $year_list   = Mortality::select(DB::raw('YEAR(date_of_death) AS result_year'))->groupBy('result_year')->orderBy('result_year', 'ASC')->get();
        
        foreach ($year_list as $row)
        {
            $data['categories'][$i]   = $row->result_year;
            $data['records'][$i]      =  Mortality::where(DB::raw('YEAR(date_of_death)'), $row->result_year)->count();

            $i++;
        }

        $data['start_year'] = ($start_year) ? $start_year->date_of_death : '';
        $data['last_year']  = ($start_year) ? $last_year->date_of_death : '';

        return response()->json($data);
    }

    public function chart_mortality_yearly($year)
    {
        $i                              = 0;
        $data                           = [];
        $months                         = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $data['year']                   = trim($year);
        $data['title']                  = 'Mortality Cases';
        $data['categories']             = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data['records']                = [];

        foreach ($months as $month)
        {
            $data['records'][$i]      =  Mortality::where(DB::raw('MONTH(date_of_death)'), $month)->count();

            $i++;
        }

        return response()->json($data);
    }
}

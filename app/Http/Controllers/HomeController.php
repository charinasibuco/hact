<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Patient;
use App\VCT;
use App\Mortality;
use App\Laboratory;
use App\ObGyne;
use App\Checkup;
use DB;
use Carbon\Carbon;
use Hact\Medicine\MedicineInterface;
use Auth;
use App\MedicineModel;
use App\CheckupLaboratoryRequest;
use Hact\Medicine\MedicineRepository;
use Hact\Medicine\MedicineInventoryRepository;
use Hact\Medicine\MedicineHistoryRepository;

class HomeController extends Controller
{
     public function __construct(MedicineRepository $medicine, MedicineInventoryRepository $medicine_inventory, MedicineHistoryRepository $medicine_history){
        $this->medicine           = $medicine;
        $this->medicine_inventory = $medicine_inventory;
        $this->medicine_history   = $medicine_history;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $doctor     = Auth::user()->id;

        //  VCT Follow up
        $query_vct_follow_up    = Patient::leftJoin('mortality','mortality.patient_id','=','patient.id')
                                ->where('date_of_death','=',NULL)
                                ->leftJoin('vct','vct.patient_id','=','patient.id')
                                ->where('result','!=', 2)
                                ->select('patient.*')
                                ->orderBy('vct_date', 'ASC');

                               /* whereIn('id', function($query){
                                  $query->select('patient_id')->from('vct')->where('result','!=', 2)->orderBy('vct_date', 'ASC');
                                });*/

        if(Auth::user()->access == 2)
        {
            $vct_follow_up  = $query_vct_follow_up->whereIn('patient.id', function($query) use ($doctor){
                                $query->select('patient_id')->from('patient_doctor')->where('user_id', $doctor)->where('active', 1);
                            });
        }

        $vct_follow_up = $query_vct_follow_up->get();

        //  Mortality
        $query_mortality= Mortality::where(function($query){
                            $query->where('date_of_death', '>=', date('Y-m-01'))->where('date_of_death', '<=', date('Y-m-t'));
                        });

        if(Auth::user()->access == 2)
        {
            $mortality  = $query_mortality->whereIn('id', function($query) use ($doctor){
                                $query->select('patient_id')->from('patient_doctor')->where('user_id', $doctor)->where('active', 1);
                            });
        }

        $mortality = $query_mortality->orderBy('date_of_death', 'ASC')->get();

        //  Ob Gyne
        $query_ob   = ObGyne::where('currently_pregnant', 1)
                        ->where(function($query){
                            $query->where('if_delivered_date', '>=', date('Y-m-01'))->where('if_delivered_date', '<=', date('Y-m-t'));
                        });

        if(Auth::user()->access == 2)
        {
            $ob = $query_ob->whereIn('id', function($query) use ($doctor){
                                $query->select('patient_id')->from('patient_doctor')->where('user_id', $doctor)->where('active', 1);
                            });
        }

        $ob = $query_ob->groupBy('patient_id')->get();

        $query_checkup = Checkup::where(DB::raw('MONTH(follow_up_date)'), date('m'))->where('follow_up_date', '>=', date('Y-m-d'));

        $checkup_request = Checkup::all();
        $laboratory_request = Laboratory::where('result_date','>=',date('Y-m-d'))
                                        ->leftJoin('laboratory_type','laboratory_type.id','=','laboratory.laboratory_type_id')
                                        ->get();

        if(Auth::user()->access == 2)
        {
            $checkup = $query_checkup->whereIn('id', function($query) use ($doctor){
                                $query->select('patient_id')->from('patient_doctor')->where('user_id', $doctor)->where('active', 1);
                            });
        }

        $checkup = $query_checkup->get();
    

        $laboratory = Laboratory::all();

        $medicines = MedicineModel::get();

        $instock_medicine           = 0;
        $critical_stock_medicine    = 0;
        $warning_stock_medicine     = 0;
        $out_of_stock               = 0;
        foreach($medicines as $medicine){
            if($medicine->current_stock > 100){
                $instock_medicine = number_format($instock_medicine + $medicine->current_stock);
            }elseif($medicine->current_stock <= 100 && $medicine->current_stock > 20){
                $warning_stock_medicine = number_format($warning_stock_medicine + 1);
            }elseif($medicine->current_stock <= 20 && $medicine->current_stock != 0){
                $critical_stock_medicine = number_format($critical_stock_medicine + 1);
            }elseif($medicine->current_stock == 0){
                $out_of_stock = number_format($out_of_stock + 1);
            }

        }
                     //dd($medicines);

        if(Auth::user()->access == 1)
        {

            $data = compact('vct_follow_up', 'mortality', 'ob', 'medicines', 'instock_medicine', 'warning_stock_medicine', 'critical_stock_medicine', 'out_of_stock', 'checkup','checkup_request','laboratory_request','laboratory');

            return view('hact.home', $data);
        }
        else
        {
            $data = compact('vct_follow_up', 'mortality', 'ob', 'checkup','checkup_request','laboratory_request');

            return view('hact.home_doctor', $data);
        }
    }

    public function getMedicineRestockingHistory(Request $request)
    {
        $data['histories']      = $this->medicine_history->getMedicineHistory($request);
        $data['sort']           = 'desc';
        return view('hact.reports.medicine.history', $data);
    }

    public function landing_page()
    {
        return view('hact.landing_page');
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

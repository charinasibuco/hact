<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Hact\Medicine\MedicineInterface;
use Hact\Medicine\MedicineRepository;
use Hact\Report\ReportRepository as Report;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Prescription;
use App\MedicineModel;
use App\ARVItems;
use DB;
use App\Patient;
use App\ARV;
use App\MedicineInventory;
use Auth;
use Hact\Medicine\MedicineInventoryRepository;

class ReportsController extends Controller
{
    private $prescription;
    private $report;

    public function __construct(MedicineInventoryRepository $medicine_inventory,Prescription $prescription,Report $report){
      $this->medicine_inventory = $medicine_inventory;
      $this->prescription = $prescription;
      $this->report = $report;
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function illnesses_show()
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
        return view('hact.reports.illnesses');
    }

    public function people()
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
        $action = route('people_show');

        $data = compact('action');

        return view('hact.reports.people', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function people_show()
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
        return view('hact.reports.people');
    }

    public function clients()
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
        $action = route('clients_show');

        $data = compact('action');

        return view('hact.reports.client', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clients_show()
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
        return view('hact.reports.client');
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
    public function mortality_summary()
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
        $action = route('people_show');

        $data = compact('action');

        return view('hact.reports.mortality', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mortality_reports_show()
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function infection_dispense()
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
        return view('hact.reports.medicine.infection_dispense');
    }

    public function infection_dispense_print(Requests\ReprotsMedicineDispenseInfectionRequest $request)
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
          $data = $this->report->infection_dispense_print($request);
          return view('hact.reports.medicine.infection_dispense_print', $data);
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function patient_prescribe()
    {
        return view('hact.reports.arv.patient_prescribe');
    }

    public function patient_prescribe_print(Requests\ReprotsMedicineDispensePatientRequest $request)
    {
        $data = $this->report->patient_prescribe_print($request);
        return view('hact.reports.arv.patient_prescribe_print', $data);
        
    }

    public function patient_prescribe_excel($patient_name, $arv_items)
    {
       return $this->report->patient_prescribe_excel($patient_name,$arv_items);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function patient_dispense()
    {
        return view('hact.reports.medicine.patient_dispense');
    }

    public function patient_dispense_print(Requests\ReprotsMedicineDispensePatientRequest $request)
    {
        $data = $this->report->patient_dispense_print($request);
        return view('hact.reports.medicine.patient_dispense_print', $data);
        
    }

    public function patient_dispense_excel($patient_name, $prescription)
    {
       return $this->report->patient_dispense_excel($patient_name,$prescription);
    }

    /**
     * Show Low stock of medicines
     * @param Request $request
     * @param MedicineInterface $medicine
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLowStockMedicines(Request $request, MedicineRepository $medicine){

        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
    
        $data['medicines'] = MedicineModel::get();
        #$data['medicines']          = $medicine->getLowStockMedicines($request);
        $data['sort']               = 'desc';

        return view('hact.reports.medicine.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function excelLowStockMedicines(Request $request, MedicineRepository $medicine)
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
   
      return $this->report->excelLowStockMedicines($request,$medicine->all());

    }

    /**
     * Show patients to deliver in specific date
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getDeliveryPatient(Request $request){

    }

    /**
     * Show medicine restocking histories
     * @param Request $request
     * @param MedicineInterface $medicine
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMedicineRestockingHistory(Request $request){

        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
        $data['histories'] = $this->medicine_inventory->getMedicineInventory($request);
        $data['sort']           = 'desc';
        
       return view('hact.reports.medicine.history', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function excelMedicineRestockingHistory(Request $request)
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
        return $this->report->excelMedicineRestockingHistory($request);      
    }

    /**
     * Show expired medicines
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function indexExpiredMedicine(Request $request){
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
        $data['from'] = old('from');
        $data['to'] = old('to');
        return view('hact.reports.medicine.expired_medicine', $data);
    }

    /**
     * Show expired medicines
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getExpiredMedicine(Requests\DateRangeRequest $request){
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
      
      $data = $this->report->getExpiredMedicines($request);
      return view('hact.reports.medicine.results_print', $data);
      

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function excelExpiredMedicine($medicines, $from, $to)
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
      return $this->report->excelExpiredMedicine($medicines,$from,$to);
    }

    public function patient_alive()
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
      return view('hact.reports.arv.patient_alive');
    }

    public function patient_alive_print(Requests\ReportARVPatientsRequest $request)
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
      $data  =  $this->report->patient_alive_print($request);
      return view('hact.reports.arv.patient_alive_print',$data);
    }

    public function patient_alive_excel($patient_alive, $from, $to, $patients)
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
       return $this->report->patient_alive_excel($patient_alive,$from,$to,$patients);
    }

   /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function medicine_history_dispense()
    {
        return view('hact.reports.medicine.medicine_dispense');
    }

    public function medicine_history_dispense_print(Requests\ReportsMedicineHistoryDispenseRequest $request)
    {
        if($request->has('excel')){
            $this->report->medicine_history_dispense_print($request);
        }else{
            $data = $this->report->medicine_history_dispense_print($request);
            return view('hact.reports.medicine.medicine_dispense_print', $data);
        }

        
    }

    public function medicine_history_dispense_excel($search_item, $prescription, $from, $to)
    {
       return $this->report->medicine_history_dispense_excel($search_item,$prescription,$from,$to);
    }

    public function patient_stop_taking_arv()
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
      $search_item = old('search_item');
      $medicine_id = old('medicine_id');
      $data        = compact('search_item', 'medicine_id');
      return view('hact.reports.arv.patient_stop_taking_arv', $data);
    }
    
    public function patient_stop_taking_arv_print(Requests\ReportPatientStopTakingARVRequest $request)
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
      $data = $this->report->patient_stop_taking_arv_print($request);
      return view('hact.reports.arv.patient_stop_taking_arv_print', $data);
      
    }

    public function patient_stop_taking_arv_excel($from, $to, $patients)
    {
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
      $this->report->patient_stop_taking_arv_excel($from,$to,$patients);
    }
}

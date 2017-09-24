<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ARV;
use App\ARVItems;
use App\Prescription;
use App\MedicineModel;
use App\Patient;
use App\VCT;
use App\MedicineInventory;
use DB;

use Hact\Log\ActivityLogRepository as ActivityLog;
use Auth;

class PrescriptionController extends Controller
{

    private $log;

    public function __construct(ActivityLog $log)
    {
        $this->log = $log;
    }


    /**

    **/
    public function index(Request $request)
    {
        $access     = Auth::user()->access;
        $doctor     = Auth::user()->id;
        $paginate   = 50;
        $search     = '';
        $order_by   = $this->order_by($request);
        $sort       = $this->sort($request);

        $query = Patient::whereIn('id', function($query){
                    $query->select('patient_id')->from('vct')->where('result', 2);
                });

        if($access == 2)
        {
            $patients = $query->whereIn('id', function($query) use ($doctor){
                            $query->select('patient_id')->from('patient_doctor')->where('user_id', $doctor)->where('active', 1);
                        });
        }

        if($request->has('search'))
        {
            $search = trim($request->input('search'));

            $patients = $query->where(function($query) use ($search) {
                            $query->where('ui_code', 'LIKE', '%' . $search . '%')
                            ->orWhere('code_name', 'LIKE', '%' . $search . '%')
                            ->orWhere('saccl_code', 'LIKE', '%' . $search . '%');
                        });
        }

        $patients = $query->orderBy($order_by, $sort)->paginate($paginate);

        $code_name_sort     = $this->link_sort('code_name_code', $search, $sort, $request);
        $birth_date_sort    = $this->link_sort('birth_date', $search, $sort, $request);
        $gender_sort        = $this->link_sort('gender', $search, $sort, $request);
        $saccl_code_sort    = $this->link_sort('saccl_code', $search, $sort, $request);
        $ui_code_sort       = $this->link_sort('ui_code', $search, $sort, $request);

        $pagination         = ['search' => $search, 'order_by' => $order_by, 'sort' => $sort];

        $data = compact(
                'patients', 'search',
                'ui_code_sort', 'code_name_sort', 'saccl_code_sort', 'birth_date_sort','gender_sort',
                'pagination'
            );

        return view('hact.prescription.index', $data);
    }

    public function order_by($request)
    {
        if($request->has('order_by'))
        {
            $order_by = trim($request->order_by);

            if($order_by == 'ui_code')
            {
                return 'ui_code';
            }
            elseif($order_by == 'saccl_code')
            {
                return 'saccl_code';
            }
            elseif($order_by == 'code_name')
            {
                return 'code_name';
            }
            elseif($order_by == 'birth_date')
            {
                return 'birth_date';
            }
            elseif($order_by == 'gender')
            {
                return 'gender';
            }
            else
            {
                return 'code_name';
            }
        }
        else
        {
            return 'code_name';
        }
    }

    public function sort($request)
    {

        if($request->has('sort'))
        {
            $sort = $request->input('sort');

            if($sort == 'ASC')
            {
                return 'ASC';
            }
            elseif($sort == 'DESC')
            {
                return 'DESC';
            }
        }
        else
        {
            return 'ASC';
        }
    }

    public function link_sort($order_by, $search, $sort, $request)
    {
        $sort  = ($sort == 'DESC')? 'ASC' : 'DESC';

        if($request->has('page'))
        {
            return route('prescription', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);
        }
        else
        {
            return route('prescription', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
    }

    /**

    **/
    public function create($arv_id)
    {
        $data = [];
        $data['action']         = route('prescription_store', $arv_id);
        $data['arv']            = ARV::where('id', $arv_id)->first();
        $data['items']  = ARVItems::where('arv_id', $arv_id)->where('specified_medicine', '')->get();
        $data['patient_id']     = $data['arv']->patient_id;
        $data['search_vct']     = $data['arv']->Patient->code_name;
        $data['pills_dispense'] = old('pills_dispense');

        $data['date_dispense']  = old('date_dispense');

        $data['pills_missed_in_30_days'] = old('pills_missed_in_30_days');
        $data['pills_left'] = old('pills_left');

        $data['medicine_inventory_id'] = old('medicine_inventory_id');
        return view('hact.prescription.form', $data);
    }

    /**

    **/
    public function store(Requests\PrescriptionRequest $request, $arv_id)
    {
        #dd($request->all());
        $id = explode('_', $request->medicine_inventory_id);
        #dd($id);

        $input = $request->only(['patient_id', 'pills_dispense', 'date_dispense', 'pills_missed_in_30_days', 'pills_left']);
        
        $input['arv_item_id']           = $id[0];
        $input['medicine_inventory_id'] = $id[1];
        $input['user_id']               = Auth::user()->id;

        Prescription::create( $input );

        $patient = Patient::where('id', $request->patient_id)->first();

        $this->log->store([
                'page'      => 'Prescription',
                'message'   => $patient->code_name . ' has been created!',
                'user_id'   => Auth::user()->id
            ],$request);

        return redirect()->route('prescription_create', $arv_id)->with('status', 'Doctor Prescription successfully dispense!');
    }

    /**

    **/
    public function history(Request $request, $id)
    {

        if($request->session()->has('prescription'))
        {
            $request->session()->forget('prescription');
        }

        $paginate = 50;

        $patient = Patient::where('id', $id)->first();
        $arv     = ARV::where('patient_id', $id)->orderBy('created_at', 'DESC')->paginate($paginate);

        $data = compact('patient', 'arv', 'id');

        return view('hact.prescription.history', $data);
    }

    /**

    **/
    public function details(Request $request, $arv_id)
    {
        if($request->session()->has('prescription'))
        {
            $request->session()->forget('prescription');
        }

        $paginate = 50;

        $patient        = Patient::whereIn('id', function($query) use ($arv_id){
                            $query->select('patient_id')->from('arv')->where('id', $arv_id);
                         })->first();

        $prescription   = Prescription::where('patient_id', $patient->id)->paginate($paginate);
        #$items   = ARVItems::where('arv_id', $arv_id)->pagiante($pagiante);
        #$arv     = ARV::where('id', $arv_id)->orderBy('created_at', 'DESC')->paginate($paginate);

        $data = compact('patient', 'arv_id', 'patient', 'prescription');

        return view('hact.prescription.details', $data);
    }

    /**

    **/
    public function edit($arv_id)
    {
        $action         = route('prescription_update', $arv_id);
        $arv            = ARV::where('id', $arv_id)->first();
        $prescription   = Prescription::where( 'arv_id', $arv_id )->first();

        $patient_id     = $arv->patient_id;
        $search_vct     = $arv->Patient->code_name;

        $medicine_id    = $arv->medicine_id;
        $search_item    = $arv->Medicine->name;

        $pills_dispense = $prescription->pills_dispense;
        $date_dispense  = $prescription->date_dispense_format1;

        $pills_missed_in_30_days = $prescription->pills_missed_in_30_days;
        $pills_left = $prescription->pills_left;

        $data = compact('action',
                    'search_vct', 'patient_id',
                    'search_item', 'medicine_id',
                    'pills_dispense', 'date_dispense',
                    'pills_missed_in_30_days','pills_left'
                );

        return view('hact.prescription.form', $data);
    }

    /**

    **/
    public function update(Requests\PrescriptionRequest $request, $arv_id)
    {
        $input = $request->only(['arv_id', 'pills_dispense', 'date_dispense','pills_missed_in_30_days','pills_left']);
        $input['date_dispense'] = date('Y-m-d', strtotime($request->date_dispense));
        $input['arv_id']    = $arv_id;

        Prescription::where('arv_id', $arv_id)->update( $input );

        $patient = Patient::where('id', $request->patient_id)->first();
        $this->log->store([
                'page' => 'Prescription',
                'message' => $patient->code_name . ' has been update!',
                'user_id' => Auth::user()->id
            ],$request);

        return redirect()->route('prescription_edit', [$arv_id])->with('status', 'Doctor Prescription successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search     = '%' . trim($request->input('search')) . '%';

        $medicines  =   MedicineModel::where('name', 'LIKE', $search)
                        ->orderBy('name', 'ASC')
                        ->take(10)
                        ->lists('name', 'id');
        #dd($medicines);
        return response()->json($medicines);
        #return response()->toJson($medicines);
    }

    /**
    Called Functions
    **/
}

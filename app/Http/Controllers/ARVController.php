<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\ARV;
use App\ARVItems;
use App\Patient;
use Hact\Log\ActivityLogRepository as ActivityLog;
use App\Infections;
use Hact\ARV\ARVRepository;
use Hact\Patient\PatientRepository;

use Session;

class ARVController extends Controller
{

    private $log;

    /**
     * Current class contructor
     *
     * @param      ActivityLog  $log    (description)
     */
    function __construct(ActivityLog $log, ARVRepository $arv, PatientRepository $patient){

        $this->log = $log;
        $this->arv = $arv;
        $this->patient = $patient;

    }
    /**
     * Show the main page       
     *
     * @param      Request  $request  (description)
     */
    public function index(Request $request)
    {
        /*$data['search']             = trim($request->input('search'));
        $order_by                   = $this->order_by($request);
        $sort                       = ($request->input('sort') == 'asc') ? 'desc':'asc';

        $data['code_name_sort']     = $this->link_sort('code_name_code', $data['search'], $sort, $request);
        $data['birth_date_sort']    = $this->link_sort('birth_date', $data['search'], $sort, $request);
        $data['gender_sort']        = $this->link_sort('gender', $data['search'], $sort, $request);
        $data['saccl_code_sort']    = $this->link_sort('saccl_code', $data['search'], $sort, $request);
        $data['ui_code_sort']       = $this->link_sort('ui_code', $data['search'], $sort, $request);

        $data['pagination']         = ['search' => $data['search'], 'order_by' => $order_by, 'sort' => $sort];
        
        $data['patients']                   = $this->arv->getARVPatient($request);*/
        $data['search']     = trim($request->input('search'));
        $order_by           = $this->order_by($request);
        $sort               = ($request->input('sort') == 'asc') ? 'desc':'asc';

        $data['patients']   = $this->patient->getPatients($request);
        $data['pagination'] = ['search' => $data['search'], 'order_by' => $order_by, 'sort' => $sort];
        $data['code_name_sort']     = $this->link_sort('code_name', $data['search'], $sort, $request);
        $data['birth_date_sort']    = $this->link_sort('birth_date', $data['search'], $sort, $request);
        $data['gender_sort']        = $this->link_sort('gender', $data['search'], $sort, $request);
        $data['saccl_code_sort']    = $this->link_sort('saccl_code', $data['search'], $sort, $request);
        $data['ui_code_sort']       = $this->link_sort('ui_code', $data['search'], $sort, $request);

        return view('hact.arv.index', $data);
    }


    /**
     * Get all infections by id
     *
     * @param      int  $id     
     *
     * @return     array
     */
    public function infections($id)
    {
        return $this->arv->infections($id);
    }
 
    public function create(Request $request, $id = null)
    {
        $data       = $this->arv->create($id);
        $data['id'] = $id;
        return view('hact.arv.form', $data);
    }
  
    public function store_session(Requests\ARVRequest $request)
    {
        $infection               = $request->infection;
        $search_item             = $request->search_item;
        $medicine_id             = $request->medicine_id;
        $specified_medicine      = $request->specified_medicine;
        $pills_per_day           = $request->pills_per_day;
        $pills_missed_in_30_days = $request->pills_missed_in_30_days;
        $pills_left              = $request->pills_left;
        $date_discontinued       = $request->date_discontinued;
        $reason                  = $request->reason;
        $specify                 = $request->specify;

        $list = [
            'infection'               => $infection,
            'search_item'             => $search_item,
            'medicine_id'             => $medicine_id,
            'specified_medicine'      => $specified_medicine,
            'pills_per_day'           => $pills_per_day,
            'pills_missed_in_30_days' => $pills_missed_in_30_days,
            'pills_left'              => $pills_left,
            'date_discontinued'       => $date_discontinued,
            'reason'                  => $reason,
            'specify'                 => $specify
        ];

        if($request->session()->has('infections'))
        {
            $request->session()->push('prescription.infections', $list);
        }
        else
        {
            $request->session()->push('prescription.infections', $list);
        }

        return redirect()->route('arv_create', [$request->patient_id])->with('status', 'ARV successfully added!');
    }
  
    public function destroy_session(Request $request, $id, $infection = null)
    {
        foreach($request->session()->get('prescription.infections') as $key => $value)
        {
            // if($infection == $value['infection'])
            // {
                $request->session()->forget('prescription.infections.' . $key);
                break;
            // }
        }

        return redirect()->route('arv_create', $id)->with('status', 'ARV successfully removed!');
    }
 
    public function clear_session(Request $request, $id)
    {
        $request->session()->forget('prescription.infections');

        return redirect()->route('arv_create', $id);
    }
 
    public function store(Request $request, $id)
    {
        $arv = ARV::create( [
                'patient_id' => $id,
                'user_id'    => Auth::user()->id
            ] );

        foreach($request->session()->get('prescription.infections') as $key => $value)
        {
            $date_discontinued = ($value['date_discontinued'] == '')? NULL : date('Y-m-d', strtotime($value['date_discontinued']));

            ARVItems::create( [
                    'arv_id'                    => $arv->id, 
                    'infection'                 => $value['infection'], 
                    'medicine_id'               => ($value['specified_medicine'] == '')? $value['medicine_id'] : 1, 
                    'specified_medicine'        => $value['specified_medicine'],
                    'pills_per_day'             => $value['pills_per_day'], 
                    'pills_missed_in_30_days'   => $value['pills_missed_in_30_days'], 
                    'pills_left'                => $value['pills_left'], 
                    'date_discontinued'         => $date_discontinued, 
                    'reason'                    => $value['reason'], 
                    'specify'                   => $value['specify']
                ] );
        }

        #dd($request->session()->get('prescription.infections'));
        $request->session()->forget('prescription.infections');

        $patient = Patient::where('id', $id)->first();

        $this->log->store([
                'page' => 'ARV',
                'message' => $patient->code_name . ' has been created!',
                'user_id' => Auth::user()->id
            ],$request);

        return redirect()->route('arv_create', [$id])->with('status', 'ARV successfully added!');
    }
 
    public function records($id)
    {
        $paginate = 50;
        
        $patient = Patient::where('id', $id)->first();
        $arv     = ARV::where('patient_id', $id)->orderBy('created_at', 'DESC')->paginate($paginate);

        $data = compact('patient', 'arv');

        return view('hact.arv.records', $data);
    }
 
    public function edit(Request $request, $id)
    {
        #$request->session()->forget('prescription');
        #dd(Session::get('prescription.infections'));
        $action     = route('arv_update', $id);

        $arv        = ARV::where('id', $id)->first();
        $infections = $this->infections($arv->patient_id);
        $arv_items  = ARVItems::where('arv_id', $id)->get();

        // Old Inputs
        $patient_id = $arv->patient_id;
        $search_vct = $arv->Patient->code_name;

        $search_item        = old('search_item');
        $medicine_id        = old('medicine_id');

        $pills_per_day      = old('pills_per_day');
        $pills_missed_in_30_days = old('pills_missed_in_30_days');
        $pills_left         = old('pills_left');

        $date_discontinued  = old('date_discontinued');
        $reason             = old('reason');
        $specify            = old('specify');

        $data = compact('action', 'id', 'arv_items', 'infections',
                    'search_vct', 'patient_id',
                    'search_item', 'medicine_id',
                    'pills_per_day', 'pills_missed_in_30_days', 'pills_left', 
                    'date_discontinued', 'reason', 'specify'
                );

        return view('hact.arv.edit', $data);
    }
 
    public function update(Request $request, $id)
    {
        $input = $request->only([
            
                'infection', 'medicine_id', 
                'pills_per_day', 'pills_missed_in_30_days', 'pills_left', 
                'date_discontinued', 'reason', 'specify'
            ]);
        $input['date_discontinued'] = ($request->date_discontinued == '')? NULL : date('Y-m-d', ($request->date_discontinued));
        $input['arv_id'] = $id;

        ARVItems::create( $input );

        $patient = Patient::where('id', $request->patient_id)->first();
        $this->log->store([
                'page' => 'ARV',
                'message' => $patient->code_name . ' has been updated!',
                'user_id' => Auth::user()->id
            ],$request);

        return redirect()->route('arv_edit', [$id])->with('status', 'ARV successfully updated!');
    }
 
    public function destroy($arv_id, $id)
    {
        ARVItems::where('id', $id)->delete();

        return redirect()->route('arv_edit', $arv_id)->with('status', 'ARV successfully removed!');
    }

    /**
    **Called Functions
    **/
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
            return route('arv', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);
        }
        else
        {
            return route('arv', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
    }
}
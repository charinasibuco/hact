<?php

namespace App\Http\Controllers;

use Hact\Checkup\Cart\MedBoxCart;
use Hact\Checkup\CheckupRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Checkup;
use App\Infections;
use App\Laboratory;
use App\LaboratoryType;
use App\LaboratoryTest;

use App\Symptoms;
use App\Patient;
use App\ARV;
use App\ARVItems;
use App\CheckupLaboratoryRequest;
use App\CheckupLaboratory;
use App\CheckupReferrals;
use App\CheckupARV;
use App\MedicineModel;
use Hact\Log\ActivityLogRepository as ActivityLog;
use App\PatientDoctor;
use App\User;
use App\CheckupNeuroExam;
use DB;
use Auth;
use Validator;
use Session;

class CheckupController extends Controller
{
    protected $checkup;

    private $log;

    public $ajax_message = '';
    public $ajax_results = [];

    public function __construct(ActivityLog $log, CheckupRepository $checkup)
    {
        $this->log      = $log;
        $this->checkup  = $checkup;
        $this->checkup->setListener($this);
    }

    public function permission($id, $method)
    {
        $patient = Patient::join('patient_doctor','patient.id','=','patient_doctor.patient_id')
            ->where('user_id', Auth::user()->id);
            if($method=='edit' && $this->checkup->find($id))
            {
                $patient = $patient->where('patient_id',$this->checkup->find($id)->patient_id);
            }
            else
            {
                $patient = $patient->where('patient_id',$id);
            }
        $patient = $patient->first();
        if(Auth::user()->access != 1 && is_null($patient))
        {
            abort(403);
        }
    }






    public function index(Request $request)
    {
        if(Auth::user()->access != 1)
        {
            abort(403);
        }

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

        return view('hact.checkup.index', $data);
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
            return route('checkup', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);
        }
        else
        {
            return route('checkup', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $error = null)
    {
       /* $patient = Patient::join('patient_doctor','patient.id','=','patient_doctor.patient_id')
            ->where('user_id', Auth::user()->id)
            ->where('patient_id',$id)
            ->first();
        if(Auth::user()->access != 1 && is_null($patient))
        {
            abort(403);
        }*/
        $this->permission($id, 'create');

        if($error == null){
            session::set('MEDBOX', new MedBoxCart());
        }
        $data           = $this->checkup->create($id);
        return view('hact.checkup.form', $data);
    }
    /**

    **/
    public function store(Requests\CheckupRequest $request)
    {
        $input = $request->all();
        return $this->checkup->store($input, $request);
    }

    /**

    **/
    public function records($id)
    {
        $data = $this->checkup->getCheckups($id);
        return view('hact.checkup.records', $data);
    }

    /**

    **/
    public function show($id)
    {
        $data       = $this->checkup->show($id);
        return view('hact.checkup.show', $data);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function immunizationGuideLines(){
        $data   = [];
        return view('hact.checkup.guidelines', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @param null $error
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id, $error = null)
    {
        $this->permission($id,'edit');
        if($error == null){
            session::set('MEDBOX',new MedBoxCart());
        }

        $data = $this->checkup->edit($id);
//        return $data;
        return view('hact.checkup.form', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $input          = $request->all();
        return $this->checkup->update($request, $id, $input);

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function history($id){
        $data           = $this->checkup->checkupHistory($id);
        return view('hact.checkup.checkup-history', $data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function history_small($id){
        $data           = $this->checkup->checkupHistorySmall($id);
        return view('hact.checkup.checkup-history-small', $data);
    }

    /**
     * @param Request $request
     * @return null
     */
    public function store_session(Request $request)
    {
        return $this->checkup->storeSession($request);
    }

    /**
     * @param Request $request
     * @return null
     */
    public function update_session(Request $request){
        return $this->checkup->updateSession($request);
    }

    /**
     * @param Request $request
     * @param $key_id
     * @return string
     */
    public function destroy_session(Request $request, $key_id)
    {
        return $this->checkup->destroySession($key_id);
    }

    /**
     * @return mixed
     */
    public function list_session()
    {
        return $this->checkup->getArvItems();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getArvRegimen(Request $request){
        return $this->checkup->getPrescription($request);
    }

    /**

    **/
    public function oi_medicine()
    {
        return $this->checkup->getOiMedicineItems();
    }

    /**

    **/
    public function other_medicine(Request $request)
    {
        return $this->checkup->getOtherMedicineItems();
    }

    public function setAjaxMessage($message){
        $this->ajax_message = $message;
    }

    public function setAjaxResults($arr = []){
        $this->ajax_results = $arr;
    }

    public function createPassed($id){
        return redirect()->route('patient_profile', $id)->with('status', 'Patient Consultation successfully added!');
    }

    public function createFail($validator, $patient_id){
        return redirect()->route('checkup_create_error', [$patient_id, 'error'])->withErrors($validator)->withInput();
    }

    public function updateFail($validator, $patient_id){
        return redirect()->route('checkup_edit', [$patient_id, 'error'])->withErrors($validator)->withInput();
    }

    public function updatePassed($id){
        return redirect()->route('checkup_edit', $id)->with('status', 'Patient Consultation successfully updated!');
    }

    public function ajaxPassed(){
        return response()->json(['status' => 1, 'message' => $this->ajax_message]);
    }

    public function ajaxFail(){
        return response()->json(['status' => 0, 'message' => $this->ajax_message]);
    }

    public function ajaxResults(){
        return response()->json($this->ajax_results);
    }

    public function destroy($id)
    {
        $patient_id = $this->checkup->find($id)->Patient->id;
        $this->checkup->destroy($id);
        return redirect()->route('patient_profile',$patient_id)->with('status', 'Consultation record successfully deleted.');
    }
}

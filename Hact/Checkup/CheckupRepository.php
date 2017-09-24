<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/12/2016
 * Time: 12:09 PM
 */

namespace Hact\Checkup;


use App\ActivityLog;
use App\ARV;
use App\ARVItems;
use App\CheckupARV;
use App\CheckupLaboratory;
use App\CheckupInfections;
use App\CheckupLaboratoryRequest;
use App\CheckupNeuroExam;
use App\CheckupReferrals;
use App\ClinicalStaging;
use App\Infections;
use App\InfectionsClinicalStage;
use App\Laboratory;
use App\LaboratoryTest;
use App\MedicineModel;
use App\Patient;
use App\PatientDoctor;
use App\Symptoms;
use Carbon\Carbon;
use Hact\Checkup\Cart\ArvItem;
use Hact\Checkup\Cart\MedBoxCart;
use Hact\Checkup\Cart\OiItem;
use Hact\Checkup\Cart\OtherItem;
use Hact\Repository;
use Hact\Infections\InfectionsRepository as InfectionsRepo;
use Hact\Log\ActivityLogRepository as LogRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;

class CheckupRepository extends Repository
{
    const LIMIT = 50;
    protected $user;
    protected $listener;

    /**
     * Arv rules validation
     * @var array
     */
    protected $arv_rules = [
        'medicine_id'               => 'required_if:specified_medicine,|exists:medicines,id',
        'specified_medicine'        => 'required_if:medicine_id,',
        'pills_per_day'             => 'required',
        'date_started'              => 'required|date',
        'prescription_specify'      => 'required_if:reason,6,7',
    ];

    /**
     * OI medicine rules validation
     * @var array
     */
    protected $oi_others_rules = [
        'specified_medicine'        => 'required_if:medicine_id,',
        'suggested_dosage'          => 'required',
        'pills_per_day'             => 'required',
        'date_started'              => 'required|date',
    ];

    protected $rule = [
        'patient_id'                => 'required|exists:patient,id',
        //'checkup_date'              => 'required',
        //'follow_up_date'            => 'required',

        //'weight'                    => 'required|max:255',
        //'height'                    => 'required|max:255',

        //'blood_pressure'            => 'required|max:255',
        //'temperature'               => 'required|max:255',
        //'pulse_rate'                => 'required|max:255',
        //'respiration_rate'          => 'required|max:255',
        //'subjective'                => 'required'
    ];

    /**
     * ARV messages for validation
     * @var array
     */
    protected $arv_messages = [
        'specified_medicine'                => 'Specified Medicine is required',
        'pills_per_day.required'            => 'No. of pills per day is required',
        'date_started.required'             => 'Date Started is required',
        'required'                          => ':attribute is required',
        'numeric'                           => ':attribute required numeric',
        'date'                              => ':attribute shoud be in a date format'
    ];

    /**
     * OI and Other Medicine messages for validation
     * @var array
     */
    protected $oi_others_messages = [
        'specified_medicine'                => 'Specified Medicine is required',
        'pills_per_day.required'            => 'No. of pills per day is required',
        'date_started.required'             => 'Date Started is required',
        'required'                          => ':attribute is required',
        'numeric'                           => ':attribute required numeric',
        'date'                              => ':attribute shoud be in a date format'
    ];

    public function model()
    {
        $this->user = Auth::user();
        return 'App\Checkup';
    }

    public function infections()
    {
        $infections = new InfectionsRepo(new Patient,new Infections,new LogRepo(new ActivityLog));
        return $infections;
    }

    public function setListener($listener){
        $this->listener = $listener;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        return $this->model->find($id);
    }

    public function getCheckups($id){
        $patient        = Patient::where('id', $id)->first();
        $clinical_stage = '';

        $checkups       = $this->model->where('patient_id', $id)->orderBy('checkup_date', 'DESC')->paginate(50);
        $infection      = Infections::select('clinical_stage')->where('patient_id', $id)->get();
        foreach ($infection as $row)
        {
            $clinical_stage = $row->clinical_stage;
        }

        $doctors         = PatientDoctor::select('user_id')->where('patient_id', $id)->get();

        foreach ($doctors as $doctor)
        {
            $doctor_id = $doctor->user_id;
        }

        if(isset($doctor_id))
        {
            $patient_doctor = User::where('id', $doctor_id)->get();
            foreach ($patient_doctor as $user)
            {
                $incharge = $user->name;
            }
        }

        return compact('patient', 'checkups', 'id', 'clinical_stage', 'incharge');
    }

    public function create($id)
    {
        // TODO: Implement create() method.
        $data['page']                                       = 'Create';
        $data['action']                                     = route('checkup_store');
        $patient                                            = Patient::find($id);
        $data['patient']                                    = $patient;
        $data['infection']                                  = $this->infection_create($id);
        $data['search_vct']                                 = $patient->code_name;
        $data['patient_id']                                 = $id;
        $data['age']                                        = $patient->age;
        $data['gender']                                     = $patient->gender_format;
        $data['saccl_code']                                 = $patient->saccl_code;
        $data['checkup_date']                               = old('checkup_date');
        $data['follow_up_date']                             = old('follow_up_date');
        $data['resident_in_charge']                         = $this->user->name;
        $data['session_checker']                            = old('session_checker');
        $data['patient_type']                               = old('patient_type');
        $data['patient_complaints']                         = old('patient_complaints');

        /**
         * getting laboratory list for immunollogic profile
         */
        $data['cd4'] = $patient->Laboratory->where('laboratory_type_id',1);
        $data['viral_load'] = $patient->Laboratory->where('laboratory_type_id',2);

        $data['laboratory']['last_cd4_count'] = old("laboratory['last_cd4_count']");
        $data['laboratory']['viral_load'] = old("laboratory['viral_load']");
        /**
         * getting the values from the infection repository
         */
        foreach($this->infections()->create($id) as $key => $value)
        {
            if($key != 'action'){
                $data[$key] = $value?$value:old($key);
            }
        }

        //laboratory requests
        $data['laboratory_tests']                           = LaboratoryTest::get();
        #$data['my_laboratory']                              = Laboratory::select('laboratory_type_id', 'other')->where('patient_id', $id)->get();

        //assessment
        $data['infection_id']                               = old('infection_id');
        $arv                                                = ARV::where('patient_id', $id)->orderBy('id', 'DESC')->first();
        $data['arv_id']                                     = ($arv)? $arv->id : '';

        //General Summary
        $data['weight']                                     = old('weight');
        $data['height']                                     = old('height');
        $data['bmi']                                        = old('bmi');

        //tb screening
        $data['cough']                                      = old('cough');
        $data['fever']                                      = old('fever');
        $data['night_sweat']                                = old('sweat');
        $data['weight_loss']                                = old('weight_loss');

        //vital signs
        $data['blood_pressure']                             = old('blood_pressure');
        $data['temperature']                                = old('temperature');
        $data['pulse_rate']                                 = old('pulse_rate');
        $data['respiration_rate']                           = old('respiration_rate');

        //textareas
        $data['subjective']                                 = old('subjective');
        //$data['objective']                                 = old('objective');

        $data['surgeon']                                    = old('surgeon');
        $data['ob_gyne']                                    = old('ob_gyne');
        $data['ophthamology']                               = old('ophthamology');
        $data['dentis']                                     = old('dentis');
        $data['psychiatrist']                               = old('psychiatrist');
        $data['tb_dots']                                    = old('tb_dots');
        $data['others_referral']                              = old('others_referral');
        $data['others_status']                              = old('others_status');
        $data['reason']                                     = old('reason');

        $data['remarks']                                    = old('remarks');
        $data['lab']                                        = old('lab');
        $data['lab_other_specify']                          = old('lab_other_specify');

        $infection                                          = Infections::select('clinical_stage')->where('patient_id', $id)
//            ->orderBy('id', 'desc')
                ->where('order_number', '<', $data['next_order_number'])
            ->orderBy('id', 'desc')
            ->first();
        $data['previous_stage']                             = '';
        if($infection && !is_null($infection)){
            $data['previous_stage']     = $infection->clinical_stage;
        }
        /**
         * Neuro Exam variable
         */
        $data['neuro_exam'] = old('neuro_exam');

        /**
         * Physical Exam variable
         */
        $data['physical_exam'] = old('physical_exam');
        $data['histories']                                  = $this->model->where('patient_id', $id)->orderBy('checkup_date', 'DESC')->paginate(50);
        return $data;
    }

    public function store($input, $request)
    {
        // TODO: Implement store() method.
        $rule           = $this->rule;
        $validator      = Validator::make($input, $rule);

        if ($validator->fails()) {
            return $this->listener->createFail($validator, $request->patient_id);
        }

        $checkup['patient_id']                              = $request->patient_id;
        $checkup['checkup_date']                            = Carbon::parse($request->checkup_date)->format('Y-m-d');
        $checkup['follow_up_date']                          = Carbon::parse($request->follow_up_date)->format('Y-m-d');
        $checkup['weight']                                  = $request->weight;
        $checkup['height']                                  = $request->height;
        $checkup['blood_pressure']                          = $request->blood_pressure;
        $checkup['temperature']                             = $request->temperature;
        $checkup['pulse_rate']                              = $request->pulse_rate;
        $checkup['respiration_rate']                        = $request->respiration_rate;
        $checkup['bmi']                                     = ($checkup['height']>0)?round($checkup['weight'] / ($checkup['height']  *  $checkup['height'] )):0;
        $checkup['user_id']                                 = $this->user->id;
        $checkup['cough']                                   = ($request->has('cough'))? $request->cough : 0;
        $checkup['fever']                                   = ($request->has('fever'))? $request->fever : 0;
        $checkup['night_sweat']                             = ($request->has('night_sweat'))? $request->night_sweat : 0;
        $checkup['weight_loss']                             = ($request->has('weight_loss'))? $request->weight_loss : 0;
        $checkup['patient_type']                            = $request->patient_type;
        $checkup['patient_complaints']                      = $request->patient_complaints;
        $checkup['remarks']                                 = $request->remarks;
        $checkup['subjective']                              = $request->subjective;
        $check_up                                           = $this->model->create($checkup);


        /**
         * store infections details
         */
//        $this->infections()->storeInfections($input, $request,$request->patient_id);
        $infections_save = new Infections;
        $infections_save->patient_id = $request->patient_id;
//        $infections->order_number = $request->order_number;
        $infections_save->order_number = 0;
        $infections_save->clinical_stage = $request->clinical_stage;
        $infections_save->result_date = $request->result_date;
        $infections_save->user_id = Auth::user()->id;
        $infections_save->order_number = (Infections::where('patient_id', $request->patient_id)->max('order_number')) + 1;

        $infections_save->stis = $request->stis;
        $infections_save->others = $request->others;
        $infections_save->hepatitis_b = $request->hepatitis_b;
        $infections_save->hepatitis_c = $request->hepatitis_c;
        $infections_save->pneumocystis_pneumonia = $request->pneumocystis_pneumonia;
        $infections_save->orpharyngeal_candidiasis = $request->orpharyngeal_candidiasis;
        $infections_save->syphilis = $request->syphilis;

        $infections_save->save();


        $checkup_infection              = new CheckupInfections;
        $checkup_infection->checkup_id  = $check_up->id;
        $checkup_infection->infection_id= $infections_save->id;
        $checkup_infection->save();

        if(!is_null($request->infections))
        {
            //$row_num = 1;
            for($x=0;$x<=4; $x++)
            {
                if(isset($request->infections[$x]))
                {
                    foreach($request->infections[$x] as $column)
                    {
                        $cs_infections = new InfectionsClinicalStage;
                        $cs_infections->infections_id = $checkup_infection->id;
                        $cs_infections->stage = $x;
                        $cs_infections->infection = $column;
                        $cs_infections->save();
                    }
                }
            }
        }

        /**
         * Store Physical Exam
         */
        $physical_exam = $request->physical_exam;
        $physical_exam['checkup_id'] = $check_up->id;
        $this->model->storePhysicalExam($physical_exam);



        /**
         * Store Neuro Exam Save
         */
        $neuro_exam = $request->neuro_exam;
        $neuro_exam['checkup_id'] = $check_up->id;
        $this->model->storeNeuroExam($neuro_exam);

        /**
         * Store Lab Request
         */
        if(count($request->lab) > 0)
        {
            foreach ($request->lab as $key => $value)
            {
                #echo $request->lab_other_specify . ' = ' . $key . ' = ' . $value . '<br />';
                if($key == 0)
                {
                    CheckupLaboratoryRequest::create( [
                        'checkup_id'            => $check_up->id,
                        'laboratory_test_id'    => 1,
                        'other_specify'         => $request->lab_other_specify
                    ] );
                }
                else
                {
                    CheckupLaboratoryRequest::create( [
                        'checkup_id'            => $check_up->id,
                        'laboratory_test_id'    => $key,
                        'other_specify'         => ""
                    ] );
                }
            }
        }

        /**
         * Store Referrals
         */
        $referrals['checkup_id']    = $check_up->id;
        $referrals['surgeon']       = ($request->has('surgeon'))? $request->surgeon : 0;
        $referrals['ob_gyne']       = ($request->has('ob_gyne'))? $request->ob_gyne : 0;
        $referrals['ophthamology']  = ($request->has('ophthamology'))? $request->ophthamology : 0;
        $referrals['dentis']        = ($request->has('dentis'))? $request->dentis : 0;
        $referrals['psychiatrist']  = ($request->has('psychiatrist'))? $request->psychiatrist : 0;
        $referrals['others_status'] = ($request->has('others_status'))? $request->others_status : 0;
        $referrals['others']         = $request->others;
        $referrals['reason']        = $request->reason;
        CheckupReferrals::create( $referrals );

        /**
         * Store Immunologic Profile
         */

        if($request->last_cd4_count)
        {
            CheckupLaboratory::create(["checkup_id" => $check_up->id, "laboratory_id" => $request->last_cd4_count]);
        }

        if($request->viral_load)
        {
            CheckupLaboratory::create(["checkup_id" => $check_up->id, "laboratory_id" => $request->viral_load]);
        }


        //saving prescription items
        $box        = Session::get('MEDBOX');
        $arv_list   = [];
        if(count($box->getItems()) > 0){
            $arv = ARV::create( [
                'patient_id' => $request->patient_id,
                'user_id'    => $this->user->id
            ] );
            $errors = 0;
            foreach($box->getItems() as $item){
                $date_started       = ($item->getDateStarted() == '')? NULL : date('Y-m-d', strtotime($item->getDateStarted()));

                if($item->getType() == 'arv'){
                    $date_discontinued  = ($item->getDateDiscontinue() == '')? NULL : date('Y-m-d', strtotime($item->getDateDiscontinue()));
                    $arvitem                        = new ARVItems;
                    $arvitem->arv_id                = $arv->id;
                    $arvitem->infection             = $item->getInfectionId();
                    $arvitem->medicine_id           = $item->getMedicineId();
//                    $arvitem->specified_medicine    = $item->getSpecifiedMedicine();
                    $arvitem->pills_per_day         = $item->getQTY();
                    $arvitem->date_started          = $date_started;
                    $arvitem->date_discontinued     = $date_discontinued;
                    $arvitem->reason                = $item->getReason();
                    $arvitem->specify               = $item->getPrescriptionSpecify();
                    $arvitem->prescription_type     = 'arv';

                    $result     = $arvitem->save();
                    if(!$result){
                        $error++;
                    }
                }elseif($item->getType() == 'oi'){
                    $arvitem                        = new ARVItems;
                    $arvitem->arv_id                = $arv->id;
                    $arvitem->specified_medicine    = $item->getName();
                    $arvitem->pills_per_day         = $item->getQTY();
                    $arvitem->date_started          = $date_started;
                    $arvitem->suggested_dosage      = $item->getSuggestedDosage();
                    $arvitem->prescription_type     = 'oi';

                    $result     = $arvitem->save();
                    if(!$result){
                        $error++;
                    }
                }elseif($item->getType() == 'others'){
                    $arvitem                        = new ARVItems;
                    $arvitem->arv_id                = $arv->id;
                    $arvitem->specified_medicine    = $item->getName();
                    $arvitem->pills_per_day         = $item->getQTY();
                    $arvitem->date_started          = $date_started;
                    $arvitem->suggested_dosage      = $item->getSuggestedDosage();
                    $arvitem->prescription_type     = 'others';
                    $result                         = $arvitem->save();

                    if(!$result){
                        $error++;
                    }
                }

            }

            $arv_items = ARVItems::insert($arv_list);

            session::set('MEDBOX', new MedBoxCart());

            $checkup_arv = CheckupARV::create( [
                'checkup_id'    => $check_up->id,
                'arv_id'        => $arv->id
            ] );
        }

        $patient = Patient::find($request->patient_id);

        ActivityLog::create([
            'page' => 'Checkup',
            'message' => $patient->code_name . ' has been created!',
            'user_id' => Auth::user()->id
        ]);

        /**
         * Create a relationship object
         */
        CheckupInfections::create(['infection_id' => Infections::orderBy('created_at','desc')->first()->id,'checkup_id' => $check_up->id]);

        return $this->listener->createPassed($request->patient_id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function checkupHistory($id){
        $patient                    = Patient::find($id);
        $histories                  = $this->model->with(['CheckupInfections', 'NeuroExam', 'PhysicalExam'])->where('patient_id', $id)->orderBy('checkup_date', 'DESC')->paginate(self::LIMIT);
        $checkupArr                 = [];

        foreach($histories as $history){
//            $neuro_exam     = CheckupNeuroExam::where('checkup_id', $history->id)->first();
            $neuro_exam     = [];
            $physical_exam  = [];
            $clinical_stage = '';
            $lab_request    = CheckupLaboratoryRequest::where('checkup_id', $history->id)->get();
            $arv            = ARV::where('patient_id', $history->patient_id)->first();

            $arv_items      = is_object($arv)?ARVItems::where('arv_id', $arv->id)->get():[];
            $patient_id     = $history->patient_id;

            $infection      = Infections::select('clinical_stage')->where('patient_id', $history->patient_id)->get();
            $infection      = Infections::where('patient_id', $history->patient_id)->orderBy('result_date','desc')->first();
            $infections     = [];
            $infection_data = [];
            $referrals      = CheckupReferrals::where('checkup_id', $history->id)->first();

//            $infections         = Infections::where('patient_id', $id)->orderBy('result_date','desc')->first();
//            $infections_count       = Infections::where('patient_id', $id)->count();

            $infections_report = Infections::where('checkup_infections.checkup_id', $history->id)
                ->join('checkup_infections', 'checkup_infections.infection_id', '=', 'infections.id')
                ->select('infections.*')->first();

            $next_order_number = (Infections::where('patient_id', $id)->max('order_number')) + 1;

//        $order_number = $order_number;
//        $order_number = $infections_report->order_number;

            $order_number = is_object($infections_report) ? $infections_report->order_number : 0;

            $clinical_stage = is_object($infections_report) ? $infections_report->clinical_stage : '';

            $result_date = is_object($infections_report) ? $infections_report->result_date_format : '';

            $stis = is_object($infections_report) ? $infections_report->stis : '';

            $others = is_object($infections_report) ? $infections_report->others : '';

            $stis = is_object($infections_report) ? $infections_report->stis : '';

            $hepatitis_b = is_object($infections_report) ? $infections_report->hepatitis_b : '';
            $hepatitis_c = is_object($infections_report) ? $infections_report->hepatitis_c : '';
            $pneumocystis_pneumonia = is_object($infections_report) ? $infections_report->pneumocystis_pneumonia : '';
            $orpharyngeal_candidiasis = is_object($infections_report) ? $infections_report->orpharyngeal_candidiasis : '';
            $syphilis = is_object($infections_report) ? $infections_report->syphilis : '';

            $infections_collection = is_object($infections_report) ? $infections_report->infections_clinical_stage->all() : [];

//            $infections = old("infections");

            foreach($infections_collection as $row)
            {
//                $infection_data[$row->stage][$row->infection] = $row->infection;
                $infection_data[] = ['infection'=> $row->infection, 'stage' => $row->stage];

            }

            $pitems         = [];

            if(count($arv_items) > 0){
                foreach($arv_items as $item){
                     $x['item']         = $item;

                    if($item->prescription_type == 'arv'){
                        $medicine       = MedicineModel::find($item->medicine_id);
//                        $x['medicine_data'] = $medicine->item_code;
                        if($medicine){
                            $category       = explode('+', $medicine->item_code);
                            $med_data       = [];
                            foreach ($category as $key) {
                                $meds       = strtolower(trim($key));

                                $symptoms   = Symptoms::where('pill', $meds)->first();
                                $symptom    = 'N/A';
                                $monitoring = 'N/A';

                                if ($symptoms) {
                                    $symptom    = $symptoms->symptoms;
                                    $monitoring = $symptoms->monitoring;
                                }
                                $med_data[]     =['key' => $key, 'symptom' => $symptom, 'monitoring' => $monitoring];
                            }

                            $x['medicine_data']   = $med_data;
                        }
                    }

                    $pitems[]           = $x;
                }
            }
            $neuro_exam                 = null;
            if($history->NeuroExam) {
                $neuro_exam = $history->NeuroExam->editNeuroExam([]);
            }


            /**
             * View Physical Exam
             */
            $physical_exam              = null;
            if($history->PhysicalExam) {
                $physical_exam       = $history->PhysicalExam->editPhysicalExam([]);
            }

            $bmi            = ($history->height != 0) ? round($history->weight / ($history->height  *  $history->height )): '0';

            $checkupArr[]   = [
                'checkup'                   => $history,
                'bmi'                       => $bmi,
                'neuro_exam'                => $neuro_exam,
                'lab_request'               => $lab_request,
                'infections'                => $infection_data,
                'clinical_stage'            => $clinical_stage,
                'physical_exam'             => $physical_exam,
                'referrals'                 => $referrals,
                'arv_items'                 => $pitems,
                'hepatitis_b'               => $hepatitis_b,
                'hepatitis_c'               => $hepatitis_c,
                'pneumocystis_pneumonia'    => $pneumocystis_pneumonia,
                'orpharyngeal_candidiasis'  => $orpharyngeal_candidiasis,
                'syphilis'                  => $syphilis,

            ];
        }
        $data['laboratory_tests']   = LaboratoryTest::get();

        $data['histories']          = $checkupArr;
        $data['patient_id']         = $patient_id;
        $data['patient']            = $patient;
        return $data;
    }

    public function checkupHistorySmall($id){
        $data = [];
        $data['histories']  = $this->model->with(['CheckupInfections', 'NeuroExam', 'PhysicalExam'])->where('patient_id', $id)->orderBy('checkup_date', 'DESC')->paginate(self::LIMIT);
        $data['patient'] = Patient::find($id);
        return $data;
    }

    public function show($id){
        $checkup        = $this->model->find($id);
        $neuro_exam     = CheckupNeuroExam::where('checkup_id', $id)->first();
        $lab_request    = CheckupLaboratoryRequest::where('checkup_id', $id)->get();
        $arv            = ARV::where('patient_id', $checkup->patient_id)->first();

        $arv_items      = is_object($arv)?ARVItems::where('arv_id', $arv->id)->get():[];
        $patient_id     = $checkup->patient_id;

        $infection      = Infections::select('clinical_stage')->where('patient_id', $checkup->patient_id)->get();

        foreach ($infection as $row)
        {
            $clinical_stage = $row->clinical_stage;
        }

        return compact('checkup', 'clinical_stage', 'neuro_exam', 'lab_request', 'arv_items');
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
        $page           = 'Edit';
        $action         = route('checkup_update', $id);
        $checkup        = $this->model->with(['CheckupInfections'])->find($id);
        $patient        = Patient::find($checkup->patient_id);
        $laboratory     = CheckupLaboratoryRequest::select('laboratory_test_id AS laboratory_type_id', 'other_specify AS other')->where('checkup_id', $checkup->id)->get();
        $referrals      = CheckupReferrals::where('checkup_id', $checkup->id)->first();
        $neuro_exam     = CheckupNeuroExam::where('checkup_id', $id)->first();

        $search_vct         = $patient->code_name;
        $patient_id         = $patient->id;
        $age                = $patient->age;
        $gender             = $patient->gender_format;
        $saccl_code         = $patient->saccl_code;
        $checkup_date       = $checkup->checkup_date->format('m/d/Y');
        $follow_up_date     = $checkup->follow_up_date->format('m/d/Y');
        $patient_type       = $checkup->patient_type;
        $resident_in_charge = Auth::user()->name;

        //laboratory requests
        $laboratory_tests   = LaboratoryTest::get();
        //$patient_id         = $patient->id;

        $last_cd4   = Laboratory::where('patient_id', $patient_id)->where('laboratory_type_id', 1)->orderBy('result_date','desc')->first();

        $viral_load = Laboratory::where('patient_id', $patient_id)->where('laboratory_type_id', 2)->orderBy('result_date','desc')->first();

        //General Summary
        $weight             = $checkup->weight;
        $height             = $checkup->height;
        $bmi                = ($checkup->height != 0 )  ? $checkup->weight / ( $checkup->height * $checkup->height): '0';

        //tb screening
        $cough          = $checkup->cough;
        $fever          = $checkup->fever;
        $night_sweat    = $checkup->night_sweat;
        $weight_loss    = $checkup->weight_loss;

        //vital signs
        $blood_pressure     = $checkup->blood_pressure;
        $temperature        = $checkup->temperature;
        $pulse_rate         = $checkup->pulse_rate;
        $respiration_rate   = $checkup->respiration_rate;


        $subjective             = $checkup->subjective;
        $patient_complaints     = $checkup->patient_complaints;

        //Referrals
        $surgeon        = (!$referrals)? '' : $referrals->surgeon;
        $ob_gyne        = (!$referrals)? '' : $referrals->ob_gyne;
        $ophthamology   = (!$referrals)? '' : $referrals->ophthamology;
        $dentis         = (!$referrals)? '' : $referrals->dentis;
        $psychiatrist   = (!$referrals)? '' : $referrals->psychiatrist;
        $others_status   = (!$referrals)? '' : $referrals->others_status;
        $others_referral = (!$referrals)? '' : $referrals->others;
        $reason         = (!$referrals)? '' : $referrals->reason;

        $remarks = $checkup->remarks;
        $lab     = [];

        foreach ($laboratory as $row)
        {
            if($row->laboratory_type_id == 1 && $row->other != '')
            {
                $lab[0] = 1;
                $lab_other_specify = $row->other;
            }
            else
            {
                $lab[$row->laboratory_type_id] = $row->other;
            }
        }


        $infections     = $this->infection_create($id);
//        $infection_id   = ($infections)? $infections->id : '';

        $arv            = ARV::leftJoin('checkup_arv','checkup_arv.arv_id','=','arv.id')
            ->where('checkup_id',$id)
            ->select('arv.*')
            ->first();

        $arv_id             = ($arv)? $arv->id : '';
        $arv_items          = ARVItems::where('arv_id', $arv_id)->get();
        #dd(var_dump($arv_items));
        foreach ($arv_items as $row)
        {
            $box        = session('MEDBOX');
            if($row->prescription_type == 'oi'){
                $box->addItem(
                    $item = new OiItem(
                    //type, infection_id, medicine_id, name, qty (pills per day), reason, specify, dateStarted, dateDiscontinue
                        $row->specified_medicine,
                        $row->suggested_dosage,
                        $row->pills_per_day,
                        $row->date_started
                    )
                );
            }elseif($row->prescription_type == 'others'){
                $box->addItem(
                    $item = new OtherItem(
                    //type, infection_id, medicine_id, name, qty (pills per day), reason, specify, dateStarted, dateDiscontinue
                        $row->specified_medicine,
                        $row->suggested_dosage,
                        $row->pills_per_day,
                        $row->date_started
                    )
                );
            }else{
                #dd($row->Medicine->name);
                $box->addItem(
                    $item = new ArvItem(
                    //type, infection_id, medicine_id, name, qty (pills per day), reason, specify, dateStarted, dateDiscontinue
                        $row->infection,
                        $row->medicine_id,
                        $row->Medicine?$row->Medicine->name:"",
                        $row->pills_per_day,
                        $row->reason,
                        $row->specify,
                        $row->date_started,
                        $row->date_discontinued
                    )
                );

            }
        }

        //assessment
        $infections = Infections::where('patient_id', $patient->id)->orderBy('result_date','desc')->first();

        $infections_report = Infections::where('checkup_infections.checkup_id', $id)
            ->join('checkup_infections', 'checkup_infections.infection_id', '=', 'infections.id')
            ->select('infections.*')->first();

        $infection_id   = ($infections)? $infections->id : '';


        $clinical_stage = is_object($infections_report) ? $infections_report->clinical_stage : '';


        $others = is_object($infections_report) ? $infections_report->others : '';

        $stis = is_object($infections_report) ? $infections_report->stis : '';

        $hepatitis_b = is_object($infections_report) ? $infections_report->hepatitis_b : '';
        $hepatitis_c = is_object($infections_report) ? $infections_report->hepatitis_c : '';
        $pneumocystis_pneumonia = is_object($infections_report) ? $infections_report->pneumocystis_pneumonia : '';
        $orpharyngeal_candidiasis = is_object($infections_report) ? $infections_report->orpharyngeal_candidiasis : '';
        $syphilis = is_object($infections_report) ? $infections_report->syphilis : '';

        $infections_collection = is_object($infections_report) ? $infections_report->infections_clinical_stage->all() : [];


        $infections = [];
        foreach($infections_collection as $row)
        {
            $infections[$row->stage][$row->infection] = $row->infection;
        }

        $data =  compact(
            'action', 'page',
            'search_vct', 'patient_id', 'age', 'gender', 'saccl_code',
            'checkup_date', 'follow_up_date',
            'weight', 'height', 'bmi',
            'cough', 'fever', 'night_sweat', 'weight_loss',
            'last_cd4', 'viral_load', 'infections', 'infections_data', 'infection',
            'blood_pressure', 'temperature', 'pulse_rate', 'respiration_rate',
            'subjective', 'patient_type','patient_complaints',

            'surgeon', 'ob_gyne', 'ophthamology', 'dentis', 'psychiatrist', 'reason',
            'others_status', 'others_referral',
            'resident_in_charge', 'laboratory_tests', #'my_laboratory',
            'remarks', 'infection_id', 'arv', 'arv_id', 'lab', 'lab_other_specify', 'clinical_stage',
            'stis', 'others', 'hepatitis_b', 'hepatitis_c', 'syphilis', 'pneumocystis_pneumonia', 'orpharyngeal_candidiasis'
        );

        $infection                                          = Infections::select('clinical_stage','id')->where('patient_id', $id)->where('id', '!=', $infection_id)->orderBy('id', 'desc')->first();
        $data['previous_stage']                             = '';
        if($infection && $infection->clinical_stage != 0){
            $data['previous_stage']                         = $infection->clinical_stage;
        }


        /**
         * getting the infection data related to the checkup object
         */
//        return $checkup->CheckupInfections;
//        return $checkup->CheckupInfections;
//        return $checkup->CheckupInfections->infection_id;
//        if($checkup->CheckupInfections){
//            $checkup_infections = Infections::find($checkup->CheckupInfections->infection_id);
//            foreach($this->infections()->editInfection($checkup_infections->patient_id,$infections->order_number) as $key => $value){
//                if($key != 'action'){
//                    $data[$key] = is_null(old($key))?$value:old($key);
//                }
//            }
//        }



        /**
         * Editing Neuro Exam
         */
        $data['neuro_exam'] = $checkup->NeuroExam?$checkup->NeuroExam->editNeuroExam(old('neuro_exam')):old('neuro_exam');


        /**
         * Editing Physical Exam
         */
        $data['physical_exam'] = $checkup->PhysicalExam?$checkup->PhysicalExam->editPhysicalExam(old('physical_exam')):old('physical_exam');

        /**
         * Editing Immunologic Profile
         */
        $data['cd4'] = $patient->Laboratory->where('laboratory_type_id',1);
        $data['viral_load'] = $patient->Laboratory->where('laboratory_type_id',2);

        if($checkup->CheckupLaboratory->count() > 0)
        {
            foreach($checkup->CheckupLaboratory as $row)
            {
                if($row->Laboratory)
                {
                    if($row->Laboratory->laboratory_type_id == 1)
                    {
                        $data['laboratory']['last_cd4_count'] = $row->laboratory_id;
                    }
                    elseif($row->Laboratory->laboratory_type_id == 2)
                    {
                        $data['laboratory']['viral_load'] = $row->laboratory_id;
                    };
                }

            }

                /**
                 * if no lab has found
                 */
            if(!isset($data['laboratory']['last_cd4_count']))
            {
                $data['laboratory']['last_cd4_count'] = old("laboratory['last_cd4_count']");
            }
            if(!isset($data['laboratory']['viral_load']))
            {
                $data['laboratory']['viral_load'] = old("laboratory['viral_load']");
            }
        }
        else
        {
            $data['laboratory']['last_cd4_count'] = old("laboratory['last_cd4_count']");
            $data['laboratory']['viral_load'] = old("laboratory['viral_load']");
        }


        $data['histories']    = $this->model->where('patient_id', $id)->orderBy('checkup_date', 'DESC')->paginate(50);
        return $data;
    }

    public function update($request, $id, $input)
    {
        // TODO: Implement update() method.
        //        return $input;
        $validator      = Validator::make($input, $this->rule);
        if ($validator->fails()) {
            return $this->listener->updateFail($validator, $id);
        }

        $checkup =  $request->only([
            'patient_id', 'weight', 'height',
            'blood_pressure', 'temperature', 'pulse_rate', 'respiration_rate', 'subjective',
            'cough', 'fever', 'night_sweat', 'weight_loss', 'remarks'
        ]);
        $input  = $request->all();
        $rule   = [
           /* 'patient_id'                => 'required|exists:patient,id',
            'checkup_date'              => 'required',
            'follow_up_date'            => 'required',

            'weight'                    => 'required|max:255',
            'height'                    => 'required|max:255',

            'blood_pressure'            => 'required|max:255',
            'temperature'               => 'required|max:255',
            'pulse_rate'                => 'required|max:255',
            'respiration_rate'          => 'required|max:255',*/

        ];
        $validator      = Validator::make($input, $rule);

        if ($validator->fails()) {
            return redirect()->route('checkup_edit_error', [$id, 'error'])->withErrors($validator)->withInput();
        }

        $referrals = [];

        $checkup['checkup_date']                = date('Y-m-d', strtotime($request->checkup_date));
        $checkup['follow_up_date']              = date('Y-m-d', strtotime($request->follow_up_date));
        $checkup['weight']                      = $request->weight;
        $checkup['height']                      = $request->height;
        $checkup['bmi']                         = ($checkup['height']>0)?round($checkup['weight'] / ($checkup['height']  *  $checkup['height'] )):0;
        $checkup['user_id']                     = $this->user->id;
        $checkup['cough']                       = ($request->has('cough'))? $request->cough : 0;
        $checkup['fever']                       = ($request->has('fever'))? $request->fever : 0;
        $checkup['night_sweat']                 = ($request->has('night_sweat'))? $request->night_sweat : 0;
        $checkup['weight_loss']                 = ($request->has('weight_loss'))? $request->weight_loss : 0;
        $checkup['blood_pressure']              = $request->blood_pressure;
        $checkup['temperature']                 = $request->temperature;
        $checkup['pulse_rate']                  = $request->pulse_rate;
        $checkup['respiration_rate']            = $request->respiration_rate;
        $checkup['patient_type']                = $request->patient_type;
        $checkup['patient_complaints']          = $request->patient_complaints;
        $check_up = $this->model->where('id', $id)->update( $checkup );


        /**
         * Updating the infection data of the checkup object
         */
        $infections_report = Infections::where('checkup_infections.checkup_id', $id)
            ->join('checkup_infections', 'checkup_infections.infection_id', '=', 'infections.id')
            ->select('infections.*')->first();
//        $infections_report = Infections::where('patient_id', $id)
//            ->where('order_number', $order_number)
//            ->first();
//        return $infections_report->rid;
        if($infections_report){
            $infections_report->patient_id = $id;
            $infections_report->order_number = $request->order_number;
            $infections_report->clinical_stage = $request->clinical_stage;
            $infections_report->result_date = $request->result_date;
            $infections_report->user_id = Auth::user()->id;
            $infections_report->stis = $request->stis;
            $infections_report->others = $request->others;
            $infections_report->hepatitis_b = $request->hepatitis_b;
            $infections_report->hepatitis_c = $request->hepatitis_c;
            $infections_report->pneumocystis_pneumonia = $request->pneumocystis_pneumonia;
            $infections_report->orpharyngeal_candidiasis = $request->orpharyngeal_candidiasis;
            $infections_report->syphilis = $request->syphilis;

            $infections_report->save();
            $infection_report_id = $infections_report->id;
//            return $infections_report->id;
            InfectionsClinicalStage::where('infections_id', $infections_report->id)->delete();
        }else{
            $infections_save = new Infections;
            $infections_save->patient_id = $request->patient_id;
//        $infections->order_number = $request->order_number;
            $infections_save->order_number = 0;
            $infections_save->clinical_stage = $request->clinical_stage;
            $infections_save->result_date = $request->result_date;
            $infections_save->user_id = Auth::user()->id;
            $infections_save->order_number = (Infections::where('patient_id', $request->patient_id)->max('order_number')) + 1;

            $infections_save->stis = $request->stis;
            $infections_save->others = $request->others;
            $infections_save->hepatitis_b = $request->hepatitis_b;
            $infections_save->hepatitis_c = $request->hepatitis_c;
            $infections_save->pneumocystis_pneumonia = $request->pneumocystis_pneumonia;
            $infections_save->orpharyngeal_candidiasis = $request->orpharyngeal_candidiasis;
            $infections_save->syphilis = $request->syphilis;

            $infections_save->save();
            $infection_report_id = $infections_save->id;

            $checkup_infection              = new CheckupInfections;
            $checkup_infection->checkup_id  = $id;
            $checkup_infection->infection_id= $infections_save->id;
            $checkup_infection->save();
        }

        for($x=0;$x<=4; $x++)
        {
            if(isset($request->infections[$x])) {
                foreach ($request->infections[$x] as $column) {
                    if ($infections_report) {
                        $check_object = $infections_report->infections_clinical_stage
                            ->where('stage', $x)
                            ->where('infection', $column)
                            ->first();
                        if ($check_object) {
                            $check_object->stage = $x;
                            $check_object->infection = $column;
                            $check_object->save();
                        } else {
//                            $infections_report->infections_clinical_stage->create(['stage'=> $x,'infection' => $column, 'infections_id' => $infection_report_id ]);
                            $infectionstage = new InfectionsClinicalStage;
                            $infectionstage->stage = $x;
                            $infectionstage->infection = $column;
                            $infectionstage->infections_id = $infection_report_id;
                            $infectionstage->save();
                        }
                    }

                }
            }
        }
        $checkup2 = $this->model->find($id);
////        return $request->patient_id;
//        if($checkup2->CheckupInfections){
//            $infections = Infections::where('id', $checkup2->CheckupInfections->infection_id)->first();
//            $this->infections()->update($request, $infections->patient_id, $infections->order_number);
//        }else{
//            $this->infections()->storeInfections($input, $request,$request->patient_id);
//
//        }


        /**
         * Updating Neuro Exam
         */
        if($checkup2->NeuroExam) {
            $checkup2->NeuroExam->updateNeuroExam($request->neuro_exam);
        } else {
            $neuro_exam = $request->neuro_exam;
            $neuro_exam['checkup_id'] = $id;
            $this->model->storeNeuroExam($neuro_exam);
        }


        /**
         * Updating Physical Exam
         */
        if($checkup2->PhysicalExam){
            $checkup2->PhysicalExam->updatePhysicalExam($request->physical_exam);
        }else{
            $physical_exam = $request->physical_exam;
            $physical_exam['checkup_id'] = $id;
            $this->model->storePhysicalExam($physical_exam);
        }

        CheckupLaboratoryRequest::where('checkup_id', $id)->forceDelete();

        if(count($request->lab) > 0)
        {
            foreach ($request->lab as $key => $value)
            {
                #echo $request->lab_other_specify . ' = ' . $key . ' = ' . $value . '<br />';
                if($key == 0)
                {
                    CheckupLaboratoryRequest::create( [
                        'checkup_id'            => $id,
                        'laboratory_test_id'    => 1,
                        'other_specify'         => $request->lab_other_specify
                    ] );
                }
                else
                {
                    CheckupLaboratoryRequest::create( [
                        'checkup_id'            => $id,
                        'laboratory_test_id'    => $key,
                        'other_specify'         => ""
                    ] );
                }
            }
        }

        $referrals['surgeon']       = ($request->has('surgeon'))? $request->surgeon : 0;
        $referrals['ob_gyne']       = ($request->has('ob_gyne'))? $request->ob_gyne : 0;
        $referrals['ophthamology']  = ($request->has('ophthamology'))? $request->ophthamology : 0;
        $referrals['dentis']        = ($request->has('dentis'))? $request->dentis : 0;
        $referrals['psychiatrist']  = ($request->has('psychiatrist'))? $request->psychiatrist : 0;
        $referrals['others_status']  = ($request->has('others_status'))? $request->others_status : 0;
        $referrals['others']         = $request->others;
        $referrals['reason']        = $request->reason;

        CheckupReferrals::where('checkup_id', $id)->update( $referrals );
        $find_arv = ARV::where('patient_id', $request->patient_id)
                        ->leftJoin('checkup_arv','checkup_arv.arv_id','=','arv.id')
                        ->where('checkup_id', $id)
                        ->where('user_id', Auth::user()->id)
                        ->select('arv.*')
                        ->first();


        /**
         * Updating Immunologic Profile
         */
        $checkup_laboratory = $this->model->find($id)->CheckupLaboratory;
        /*if(count($checkup_laboratory) > 0)
        {*/
        $cd4_count = 0;
        $viral_load_count = 0;
        if($checkup_laboratory->count() > 0)
        {
            foreach($checkup_laboratory as $row)
            {
                if($row->Laboratory->laboratory_type_id == 1 && $request->last_cd4_count)
                {
                    $row->update(['laboratory_id' => $request->last_cd4_count]);
                    $cd4_count = 1;
                }
                elseif($row->Laboratory->laboratory_type_id == 2 && $request->viral_load)
                {
                    $row->update(['laboratory_id' => $request->viral_load]);
                    $viral_load_count = 1;
                };
            }
        }


        if($cd4_count == 0 && $request->last_cd4_count)
        {
            CheckupLaboratory::create(['checkup_id' => $id, 'laboratory_id' => $request->last_cd4_count]);
        }

        if($viral_load_count == 0 && $request->viral_load)
        {
            CheckupLaboratory::create(['checkup_id' => $id, 'laboratory_id' => $request->viral_load]);
        }

        if($find_arv){
            $arv_id = $find_arv->id;
        }else{
            $arv        = ARV::create( [
                'patient_id' => $request->patient_id,
                'user_id'    => Auth::user()->id
            ] );
            $arv_id     = $arv->id;

            CheckupARV::create( [
                'checkup_id'    => $id,
                'arv_id'        => $arv->id
            ] );
        }



        //----------
        $box        = session('MEDBOX');

        if(count($box->getItems()) > 0){

            $arv = CheckupARV::where('checkup_id', $id)->first();

            $x = ARVItems::where('arv_id', $arv_id)->delete();
            foreach($box->getItems() as $item){
                $date_started       = ($item->getDateStarted() == '')? NULL : date('Y-m-d', strtotime($item->getDateStarted()));

                if($item->getType() == 'arv'){
                    $date_discontinued  = ($item->getDateDiscontinue() == '')? NULL : date('Y-m-d', strtotime($item->getDateDiscontinue()));
                    $arvitem                        = new ARVItems;
                    $arvitem->arv_id                = $arv->arv_id;
                    $arvitem->infection             = $item->getInfectionId();
                    $arvitem->medicine_id           = $item->getMedicineId();
                    $arvitem->pills_per_day         = $item->getQTY();
                    $arvitem->date_started          = $date_started;
                    $arvitem->date_discontinued     = $date_discontinued;
                    $arvitem->reason                = $item->getReason();
//                    $arvitem->specify               = $item->getPrescriptionSpecify();
                    $arvitem->prescription_type     = 'arv';

                    $result     = $arvitem->save();
                    if(!$result){
                        $error++;
                    }
                }elseif($item->getType() == 'oi'){
                    $arvitem                        = new ARVItems;
                    $arvitem->arv_id                = $arv->arv_id;
                    $arvitem->specified_medicine    = $item->getName();
                    $arvitem->pills_per_day         = $item->getQTY();
                    $arvitem->date_started          = $date_started;
                    $arvitem->suggested_dosage      = $item->getSuggestedDosage();
                    $arvitem->prescription_type     = 'oi';

                    $result     = $arvitem->save();
                    if(!$result){
                        $error++;
                    }
                }elseif($item->getType() == 'others'){
                    $arvitem                        = new ARVItems;
                    $arvitem->arv_id                = $arv->arv_id;
                    $arvitem->specified_medicine    = $item->getName();
                    $arvitem->pills_per_day         = $item->getQTY();
                    $arvitem->date_started          = $date_started;
                    $arvitem->suggested_dosage      = $item->getSuggestedDosage();
                    $arvitem->prescription_type     = 'others';
                    $result                         = $arvitem->save();

                    if(!$result){
                        $error++;
                    }
                }

            }
            session('MEDBOX', new MedBoxCart());


        }


        $patient = Patient::where('id', $request->patient_id)->first();
        ActivityLog::create([
            'page' => 'Consultation',
            'message' => $patient->code_name . ' Consultation Record has been created!',
            'user_id' => $this->user->id
        ]);

        return $this->listener->updatePassed($id);
    }


    public function destroy($id)
    {
        // TODO: Implement destroy() method.
        DB::statement("SET foreign_key_checks = 0");
        $checkup = $this->model->find($id);
        $patient_name = $checkup->Patient->code_name;
        /**
         * deleting Infections and components
         */
        if($checkup->CheckupInfections)
        {
            if($checkup->CheckupInfections->Infections)
            {
                if($checkup->CheckupInfections->Infections->infections_clinical_stage->count() > 0)
                {
                    foreach($checkup->CheckupInfections->Infections->infections_clinical_stage as $row)
                    {
                        $row->delete();
                    }
                }
                $checkup->CheckupInfections->Infections->delete();
            }
            $checkup->CheckupInfections->delete();
        }

        /**
         * deleting Physical and Neuro Exam
         */
        if($checkup->PhysicalExam)
        {
            $checkup->PhysicalExam->delete();
        }

        if($checkup->NeuroExam)
        {
            $checkup->NeuroExam->delete();
        }

        /**
         * deleting Prescription
         */
        if($checkup->CheckupARV)
        {
            if($checkup->CheckupARV->ARV)
            {
                if($checkup->CheckupARV->ARV->ARVItems->count() > 0)
                {
                    foreach($checkup->CheckupARV->ARV->ARVItems as $row)
                    {
                        if($row->Prescription)
                        {
                            $row->Prescription->delete();
                        }
                        $row->delete();
                    }
                }

                $checkup->CheckupARV->ARV->delete();
            }

            $checkup->CheckupARV->delete();
        }

        /**
         * deleting Laboratory Requests and Referrals
         */
        if($checkup->LaboratoryRequests->count() > 0)
        {
            foreach($checkup->LaboratoryRequests as $row)
            {
                $row->delete();
            }
        }

        if($checkup->Referrals)
        {
            $checkup->Referrals->delete();
        }



        $checkup->delete();

        ActivityLog::create([
            'page' => 'Consultation',
            'message' => $patient_name . 'Consultation Record has been deleted!',
            'user_id' => Auth::user()->id
        ]);
        DB::statement("SET foreign_key_checks = 1");
    }

    public function search($string)
    {
        // TODO: Implement search() method.
    }

    /**
     * Initialize session cart
     */
    public function setSession(){
        session('MEDBOX', new MedBoxCart());
    }

    /**
     * @return mixed
     */
    public function getArvItems(){
        $box    = session('MEDBOX');
        $data   = [];

        if(count($box->getItems()) == 0){
            $this->listener->setAjaxMessage('There are no records found!');
            return $this->listener->ajaxFail();
        }

        foreach($box->getItems('arv') as $item){
            $infection      = $item->getInfectionId() != '' ? ucwords(str_replace('_', ' ', $item->getInfectionId())) : '';
            $dataStarted    = $item->getDateStarted();
            $medicine       = MedicineModel::find($item->getMedicineId());
            $category       = explode('+', $medicine->item_code);
            $med_data       = [];
            foreach ($category as $key) {
                $meds       = strtolower(trim($key));

                $symptoms   = Symptoms::where('pill', $meds)->first();
                $symptom    = 'N/A';
                $monitoring = 'N/A';

                if ($symptoms) {
                    $symptom    = $symptoms->symptoms;
                    $monitoring = $symptoms->monitoring;
                }
                $med_data[]     =['key' => $key, 'symptom' => $symptom, 'monitoring' => $monitoring];
            }
            $data[]         = [
                'key'               => $item->getID(),
                'name'              => $item->getName(),
                'qty'               => $item->getQTY(),
                'infection'         => $infection,
                'medicine_id'       => $item->getMedicineId(),
                'medicine_data'     => $med_data,
                'date_started'      => $item->getDateStarted(),
                'date_discontinue'  => $item->getDateDiscontinue()
            ];
        }

        $this->listener->setAjaxResults(['status' => 1, 'results' => $data]);
        return $this->listener->ajaxResults();
    }

    /**
     * @return mixed
     */
    public function getOiMedicineItems(){
        $data   = [];

        $box    = session('MEDBOX');
        if(count($box->getItems()) == 0){
            $this->listener->setAjaxMessage('There are no records found!');
            return $this->listener->ajaxFail();
        }

        foreach($box->getItems('oi') as $item){
            $data[] = [
                'key'       => $item->getID(),
                'name'      => $item->getName(),
                'qty'       => $item->getQTY(),
                'dosage'    => $item->getSuggestedDosage()
            ];
        }

        $this->listener->SetAjaxResults(['status' => 1, 'results' => $data]);
        return $this->listener->ajaxResults();
    }

    /**
     * @return mixed
     */
    public function getOtherMedicineItems(){
        $data   = [];

        $box    = session('MEDBOX');
        if(count($box->getItems()) == 0){
            $this->listener->setAjaxMessage('There are no records found!');
            return $this->listener->ajaxFail();
        }

        foreach($box->getItems('others') as $item){
//        foreach($box->getItems() as $item){
            $data[] = [
                'type'      => $item->getType(),
                'key'       => $item->getID(),
                'name'      => $item->getName(),
                'qty'       => $item->getQTY(),
                'dosage'    => $item->getSuggestedDosage()
            ];
        }

//        return $box->getItems();
        $this->listener->SetAjaxResults(['status' => 1, 'results' => $data]);
        return $this->listener->ajaxResults();
    }

    /**
     * Get Prescription item from the session cart
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPrescription($request){
        $return     = [];
        $box        = session('MEDBOX');
        $result     = $box->findItem($request->input('key'));
        if($result == null){
            $return = ['status' => 0];
        }
        if($result->getType() == 'arv'){
            $return['infection']            = $result->getInfectionId();
            $return['search_medicine']      = $result->getName();
            $return['medicine_id']          = $result->getMedicineId();
            $return['med_type']             = $result->getType();
            $return['qty']                  = $result->getQTY();
            $return['date_started']         = date('F d, Y', strtotime($result->getDateStarted()));
            $return['date_discontinued']    = date('F d, Y', strtotime($result->getDateDiscontinue()));
            $return['reason']               = $result->getReason();
//            $return['specify']              = $result->getPrescriptionSpecify();

        }elseif($result->getType() == 'oi'){
            $return['specified_medicine']   = $result->getName();
            $return['suggested_dosage']     = $result->getSuggestedDosage();
            $return['qty']                  = $result->getQTY();
            $return['med_type']             = $result->getType();
            $return['date_started']         = date('F d, Y', strtotime($result->getDateStarted()));
        }elseif($result->getType() == 'others'){
            $return['specified_medicine']   = $result->getName();
            $return['suggested_dosage']     = $result->getSuggestedDosage();
            $return['qty']                  = $result->getQTY();
            $return['med_type']             = $result->getType();
            $return['date_started']         = date('F d, Y', strtotime($result->getDateStarted()));
        }

        $this->listener->ajax_results = ['status' => 1, 'results' => $return];

        return $this->listener->ajaxResults();
    }

    /**
     * Storing new session item from the session cart
     * @param $request
     * @return null
     */
    public function storeSession($request)
    {

        if($request->ajax()){
//            $input  = $request->except(['search_vct', 'search_medicine', 'search_item_url', 'token', '_']);
            $input      = $request->all();

            if($request->med_type == 'arv'){
                $rules      = $this->arv_rules;
                $messages   = $this->arv_messages;
            }elseif($request->med_type == 'oi' || $request->med_type == 'others') {
                $rules = $this->oi_others_rules;
                $messages = $this->oi_others_messages;
            }

            $validator      = Validator::make($input, $rules, $messages);
            $messages       = $validator->errors();

            if($validator->fails()){
                if($messages->has('medicine_id')){
                    $this->listener->ajax_message = $messages->first('medicine_id', ':message');
                }

                if($messages->has('specified_medicine')){
                    $this->listener->ajax_message = $messages->first('specified_medicine', ':message');
                }

                if($messages->has('date_started')){
                    $this->listener->ajax_message = $messages->first('date_started', ':message');
                }

                if($messages->has('pills_per_day')){
                    $this->listener->ajax_message = $messages->first('pills_per_day', ':message');
                }

                return $this->listener->ajaxFail();
            }

            $box    = session('MEDBOX');

            if($request->med_type == 'arv'){
                $box->addItem(
                    new ArvItem(
                    //type, infection_id, medicine_id, name, qty (pills per day), reason, specify, dateStarted, dateDiscontinue
                        $request->infection_id,
                        $request->medicine_id,
                        $request->search_medicine,
                        $request->pills_per_day,
                        $request->prescription_reason,
                        $request->prescription_specify,
                        $request->date_started,
                        $request->date_discontinued
                    )
                );
            }elseif($request->med_type == 'oi'){
                $box->addItem(
                    new OiItem(
                    //name, qty (pills per day), suggested dosage, dateStarted
                        $request->specified_medicine,
                        $request->suggested_dosage,
                        $request->pills_per_day,
                        $request->date_started
                    )
                );
            }elseif($request->med_type == 'others'){
                $box->addItem(
                    new OtherItem(
                    //name, qty (pills per day), dateStarted
                        $request->specified_medicine,
                        $request->suggested_dosage,
                        $request->pills_per_day,
                        $request->date_started
                    )
                );

            }
//             return $box->getItems();
            $this->listener->ajax_message = 'Prescription Successfully added!';
            return $this->listener->ajaxPassed();
        }

        return null;
    }

    /**
     * Updating session item from the cart
     * @param $request
     * @return null
     */
    public function updateSession($request){
        if($request->ajax()) {
            $input      = $request->all();

            if($request->med_type == 'arv'){
                $rules      = $this->arv_rules;
                $messages   = $this->arv_messages;
            }elseif($request->med_type == 'oi' || $request->med_type == 'others') {
                $rules = $this->oi_others_rules;
                $messages = $this->oi_others_messages;
            }

            $validator      = Validator::make($input, $rules, $messages);
            $messages       = $validator->errors();

            if($validator->fails()){
                if($messages->has('medicine_id')){
                    $this->listener->ajax_message = $messages->first('medicine_id', ':message');
                }

                if($messages->has('specified_medicine')){
                    $this->listener->ajax_message = $messages->first('specified_medicine', ':message');
                }

                if($messages->has('date_started')){
                    $this->listener->ajax_message = $messages->first('date_started', ':message');
                }

                if($messages->has('pills_per_day')){
                    $this->listener->ajax_message = $messages->first('pills_per_day', ':message');
                }

                return $this->listener->ajaxFail();
            }

            $box    = session('MEDBOX');

            if($request->med_type == 'arv') {
                $updateItem = new ArvItem(
                    $request->infection,
                    $request->medicine_id,
                    $request->search_medicine,
                    $request->pills_per_day,
                    $request->prescription_reason,
                    $request->prescription_specify,
                    $request->date_started,
                    $request->date_discontinued
                );
            }elseif($request->med_type == 'oi'){
                $updateItem = new OiItem(
                //name, qty (pills per day), suggested dosage, dateStarted
                    $request->specified_medicine,
                    $request->suggested_dosage,
                    $request->pills_per_day,
                    $request->date_started
                );
            }elseif($request->med_type == 'others'){
                $updateItem = new OtherItem(
                //name, qty (pills per day), dateStarted
                    $request->specified_medicine,
                    $request->suggested_dosage,
                    $request->pills_per_day,
                    $request->date_started
                );
            }

            $box->updateItem($request->key, $updateItem);
            $this->listener->ajax_message = 'Prescription Successfully updated!';
            return $this->listener->ajaxPassed();
        }

        return null;
    }

    /**
     * Removing item from the session cart
     * @param $key
     * @return mixed
     */
    public function destroySession($key){
        $box        = session::get('MEDBOX');
        $result     = $box->removeItem($key_id);

        if($result == true){
            $this->listener->ajax_message = 'Prescription Successfully deleted!';
            return $this->listener->ajaxPassed();
        }

        $this->listener->ajax_message = 'Unable to deleted prescription!';
        return $this->listener->ajaxPassed();
    }

    public function infection_create($id)
    {
        $infection  = [];
        $patient    = Patient::find( $id);

        if($patient){
            $patient_id = $patient->id;
            $row        = Infections::where('patient_id', $patient_id)->orderBy('result_date', 'DESC')->first();

            if($row)
            {
                if(!is_null($row->hepatitis_b))
                {
                    $infection['hepatitis_b'] = 'Hepatitis B';
                }

                if(!is_null($row->hepatitis_c))
                {
                    $infection['hepatitis_c'] = 'Hepatitis C';
                }

                if(!is_null($row->pneumocystis_pneumonia))
                {
                    $infection['pneumocystis_pneumonia'] = 'Pneumocystis Pneumonia';
                }

                if(!is_null($row->orpharyngeal_candidiasis))
                {
                    $infection['orpharyngeal_candidiasis'] = 'Orpharyngeal Candidiasis';
                }

                if(!is_null($row->syphilis))
                {
                    $infection['syphilis'] = 'Syphilis';
                }

                if(!is_null($row->stis))
                {
                    $infection['stis'] = 'STI`s ( ' . $row->stis . ' )';
                }

                if(!is_null($row->others))
                {
                    $infection['others'] = 'Others ( ' . $row->others . ' )';
                }
            }


        }

        return $infection;

    }
}
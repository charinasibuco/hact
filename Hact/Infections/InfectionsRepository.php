<?php
namespace Hact\Infections;

use App\Patient;
use Hact\Repository;
use Hact\Log\ActivityLogRepository as ActivityLog;
use App\Infections;
use App\ClinicalStaging;
use App\InfectionsClinicalStage;
use Illuminate\Support\Facades\Validator;
use Auth;   

class InfectionsRepository extends Repository{
	const LIMIT 	= 50;

	protected $user;
    private $patient;
    private $infection;
    private $log;

    public function __construct(Patient $patient,Infections $infection,ActivityLog $log)
    {
        $this->patient = $patient;
        $this->infection = $infection;
        $this->log = $log;
    }

	public function model()
	{
		$this->user = Auth::user();
		return 'App\Infections';
	}

	public function getPatientOnInfections($request = null)
	{
		$access     = Auth::user()->access;
        $doctor     = Auth::user()->id;
		$search 	= trim($request->input('search'));

        $query = $this->patient->whereIn('id', function($query){
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
            $patients = $query->where(function($query) use ($search) {
                            $query->where('ui_code', 'LIKE', '%' . $search . '%')
                            ->orWhere('code_name', 'LIKE', '%' . $search . '%')
                            ->orWhere('saccl_code', 'LIKE', '%' . $search . '%');
                        });
        }

        if($request->input('order_by') && $request->input('sort')){
            return $query->orderBy($request->input('order_by'), $request->input('sort'))->paginate(self::LIMIT);
        }

        return $query->orderBy('code_name', 'asc')->paginate(self::LIMIT);
	}
    
	public function find($id){
		return $this->infection->where('patient_id', $id)->first();                               
	}

    public function create($id){
       $action_name = 'Create';
        $patient_id = $id;
        $patient_infections = $this->infection->where('patient_id', $id)
                                        ->orderBy('order_number','desc')
                                        ->get();
        $action = route('infections_store', $id);
        $search_patient = $this->patient->where('id', $id)
                                ->first()
                                ->code_name;
        $page = $search_patient;
        $clinical_staging = ClinicalStaging::all();
        $infections = old("infections");
        $result_date = old("result_date");
        $order_number = old('order_number');
        //dd($patient_infections);

        if(is_object($patient_infections->first()))
        {
            $max = $patient_infections->max('order_number');

            $infections_report = $this->infection->where('patient_id', $id)
                                    ->where('order_number', $max)
                                    ->first();

            $next_order_number = ( $this->infection->where('patient_id', $id)->max('order_number')) + 1;

            $clinical_stage = $infections_report->clinical_stage;

            $stis = $infections_report->stis;

            $others = $infections_report->others;

            $stis = $infections_report->stis;
            $others = $infections_report->others;
            $hepatitis_b = $infections_report->hepatitis_b;
            $hepatitis_c = $infections_report->hepatitis_c;
            $pneumocystis_pneumonia = $infections_report->pneumocystis_pneumonia;
            $orpharyngeal_candidiasis = $infections_report->orpharyngeal_candidiasis;
            $syphilis = $infections_report->syphilis;

            $infections_collection = $infections_report->infections_clinical_stage->all();

            foreach($infections_collection as $row)
            {
                $infections[$row->stage][$row->infection] = $row->infection;
            }

        }
        else
        {

            $next_order_number = ( $this->infection->where('patient_id', $id)->max('order_number')) + 1;

            $clinical_stage = old("clinical_stage");

            $stis = old("stis");
            $others = old("others");
            $hepatitis_b = old("hepatitis_b");
            $hepatitis_c = old("hepatitis_c");
            $pneumocystis_pneumonia = old('pneumocystis_pneumonia');
            $orpharyngeal_candidiasis = old('orpharyngeal_candidiasis');
            $syphilis = old('syphilis');

        }
       $data = compact(

            'action', 'action_name', 'page', 'patient_id', 'order_number', 'next_order_number', 'clinical_staging',

            'search_patient', 'clinical_stage', 'infections', 'patient_infections', 'result_date',

            'stis', 'others', 'hepatitis_b', 'hepatitis_c', 'syphilis',

            'pneumocystis_pneumonia', 'orpharyngeal_candidiasis'

            );
        return $data;
    }
    public function store($input, $request){
        //
    }
    public function storeInfections($input, $request, $id){
    	$infections = new $this->infection;
        $infections->patient_id = $id;
        $infections->clinical_stage = $request->clinical_stage;
        $infections->result_date = $request->result_date;
        $infections->user_id = Auth::user()->id;
        $infections->order_number = ( $this->infection->where('patient_id', $id)->max('order_number')) + 1;

        $infections->stis = $request->stis;
        $infections->others = $request->others;
        $infections->hepatitis_b = $request->hepatitis_b;
        $infections->hepatitis_c = $request->hepatitis_c;
        $infections->pneumocystis_pneumonia = $request->pneumocystis_pneumonia;
        $infections->orpharyngeal_candidiasis = $request->orpharyngeal_candidiasis;
        $infections->syphilis = $request->syphilis;

        $infections->save();

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
                        $cs_infections->infections_id = $infections->id;
                        $cs_infections->stage = $x;
                        $cs_infections->infection = $column;
                        $cs_infections->save();
                    }
                }
            }
        }
       if($infections->save())
       {
       	$patient = $this->patient->where('id', $id)->first();
        $this->log->create([
                'page' => 'Infections',
                'message' => $patient->code_name . ' has been created!',
                'user_id' => Auth::user()->id
            ],$request);
        return redirect()->route('infections_create', $id)->with('status', 'Infections report successfully created.');
       }
        return ['status' => false, 'results' => 'Unable to Add'];
    }
    public function edit($id)
    {
    	//
    }

    public function editInfection($id, $order_number){
    	$patient_infections = $this->infection->where('patient_id', $id)
                                        ->orderBy('order_number','desc')
                                        ->get();

        $infections_report = $this->infection->where('patient_id', $id)
                                ->where('order_number', $order_number)
                                ->first();

        $action = route('infections_update', [$id, $order_number]);
        $search_patient = $this->patient->where('id', $id)
                                    ->first()
                                    ->code_name;

        $clinical_staging = ClinicalStaging::all();

        $next_order_number = ( $this->infection->where('patient_id', $id)->max('order_number')) + 1;

        $order_number = $order_number;

        $page = $search_patient;

        $action_name = 'Edit';

        $patient_id = $id;

        $order_number = $infections_report->order_number;

        $clinical_stage = $infections_report->clinical_stage;

        $result_date = $infections_report->result_date_format;

        $stis = $infections_report->stis;

        $others = $infections_report->others;

        $stis = $infections_report->stis;
        $others = $infections_report->others;
        $hepatitis_b = $infections_report->hepatitis_b;
        $hepatitis_c = $infections_report->hepatitis_c;
        $pneumocystis_pneumonia = $infections_report->pneumocystis_pneumonia;
        $orpharyngeal_candidiasis = $infections_report->orpharyngeal_candidiasis;
        $syphilis = $infections_report->syphilis;

        $infections_collection = $infections_report->infections_clinical_stage->all();

        $infections = old("infections");

        foreach($infections_collection as $row)
        {
            $infections[$row->stage][$row->infection] = $row->infection;
        }

       $data = compact(

            'action', 'action_name', 'page', 'patient_id', 'order_number', 'next_order_number', 'clinical_staging',

            'search_patient', 'clinical_stage', 'infections', 'patient_infections', 'result_date',

            'stis', 'others', 'hepatitis_b', 'hepatitis_c', 'syphilis',

            'pneumocystis_pneumonia', 'orpharyngeal_candidiasis'

            );
        
        return $data;
    }
    public function update($request, $id, $order_number)
    {
        $query = $this->infection->select('order_number')->where('patient_id', $id)->first();
        $order_number = $query->order_number;
        $infections_report =  $this->infection->where('patient_id', $id)
                                ->where('order_number', $order_number)
                                ->first();
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

        InfectionsClinicalStage::where('infections_id', $infections_report->id)->delete();


        for($x=0;$x<=4; $x++)
        {
            if(isset($request->infections[$x]))
            {
                foreach($request->infections[$x] as $column)
                {
                    $check_object = $infections_report->infections_clinical_stage
                                        ->where('stage',$x)
                                        ->where('infection', $column)
                                        ->first();

                    if(is_object($check_object))
                    {
                        $cs_infections = $check_object;
                    }
                    else
                    {
                       $cs_infections = new InfectionsClinicalStage;
                    }

                    $cs_infections->infections_id = $infections_report->id;
                    $cs_infections->stage = $x;
                    $cs_infections->infection = $column;
                    $cs_infections->save();
                }
            }
        }


        if($infections_report->save())
        {
            $patient = $this->patient->where('id', $id)->first();
            $this->log->create([
                    'page' => 'Infections',
                    'message' => $patient->code_name . ' has been update!',
                    'user_id' => Auth::user()->id
                ],$request);
            return ['status' => true, 'results' => 'Infections report successfully updated'];
            #return $patient_infections;
        }
        return ['status' => false, 'results' => 'Unable to Add'];
    }
   

    public function destroy($id){
    	//
    }

    public function search($string){
    	$search = '%' . trim($request->input('search')) . '%';

        $patients = $this->patient->whereIn('id', function($query){
                            $query->select('patient_id')->from('vct')->where('result', 2);
                        })
                    ->where('code_name', 'LIKE', $search)
                    ->take(30)
                    ->lists('code_name', 'id');

    }

    public function show($id){
    	$data['infections_report'] = $this->infection->where('patient_id', $id)->orderBy('order_number','desc')->get();

        $data['search_patient'] = $this->patient->where('id', $id)
                                    ->first()
                                    ->code_name;

        $data['patient_id'] = $id;
        $data['page'] = $data['search_patient'];
        return $data;
    }
}
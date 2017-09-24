<?php
namespace Hact\Patient;

use Hact\Repository;
use App\Patient;
use App\ActivityLog;
use DB;
use Illuminate\Support\Facades\Validator;
use Auth;	

class PatientRepository extends Repository{
	const LIMIT 	= 50;

	protected $user;

	public function model()
	{
        $this->user =  Auth::user();
		return 'App\Patient';
	}

	public function getPatients($request = null)
	{
		$access     = Auth::user()->access;
        $doctor     = Auth::user()->id;
        $search     = trim($request->input('search'));
        $order_by   = $this->order_by($request);
        $sort       = ($request->input('sort') == 'asc') ? 'desc':'asc';

        $patients = $this->model->select('*');
        if($access == 2)
        {
             $patients->whereIn('id', function($query) use ($doctor){
                $query->select('patient_id')->from('patient_doctor')->where('user_id', $doctor)->where('active', 1);
            })
                ->select('patient.*');

        }

		if($request->has('search')){
            $patients->where('ui_code', 'LIKE', '%' . $search . '%')
                            ->orWhere('code_name', 'LIKE', '%' . $search . '%')
                            ->orWhere('saccl_code', 'LIKE', '%' . $search . '%')
                           	->orderBy('ui_code', $request->input('sort'));

		}

		if($request->input('order_by') && $request->input('sort')){
            $patients->orderBy($request->input('order_by'), $request->input('sort'));
        }else{
            $patients->orderBy('code_name', 'asc');
        }

        return $patients->paginate(self::LIMIT);
	}

	public function find($id){
        return $this->model->find($id);
    }

    public function validation_ajax($request){
        $input = $request->input;
        $field = $request->field;
        $patients = $this->model->where($field,$input)->get();
        if($patients->count() > 0)
        {
            return "1";
        }else{
            return "0";
        }

    }

    public function record($request){
        return $this->model->where('id', $request->id)->first();
    }
    public function create($id)
    {   
        $data['action'] = route('patient_store');
        $data['page'] = 'New';

        $data['phil_health_number'] = old('phil_health_number');
        $data['enrolment_date'] = old('enrolment_date');
        $data['nationality']    = old('nationality');
        $data['birth_date']     = old('birth_date');
        $data['age']            = old('age');
        $data['dependents']     = old('dependents');

        $data['gender']         = old('gender');
        $data['civil_status']   = old('civil_status');
        $data['is_living_with_partner'] = old('is_living_with_partner');
        $data['is_presently_pregnant']  = old('is_presently_pregnant');

        $data['code_name'] = old('code_name');

        $data['ui_code1'] = old('ui_code1');
        $data['ui_code2'] = old('ui_code2');
        $data['ui_code3'] = old('ui_code3');

        $data['permanent_address']  = old('permanent_address');
        $data['current_city']       = old('current_city');
        $data['current_province']   = old('current_province');

        $data['birth_place_city']       = old('birth_place_city');
        $data['birth_place_province']   = old('birth_place_province');

        $data['contact_number'] = old('contact_number');
        $data['email']          = old('email');

        $data['highest_educational_attainment'] = old('highest_educational_attainment');

        $data['is_working']         = old('is_working');
        $data['current_occupation'] = old('current_occupation');
        $data['previous_occupation']= old('previous_occupation');

        $data['is_work_abroad_in_past_5years'] = old('is_work_abroad_in_past_5years');
        $data['last_contract']      = old('last_contract');
        $data['is_based']           = old('is_based');
        $data['last_work_country']  = old('last_work_country');
     
        return $data;
    }

    public function store($input, $request){

        $input = $request->except(['age','ui_code1','ui_code2','ui_code3','_token']);
        $this->model->create($input);
        return ['status' => true, 'results'=> 'Success'];
    }

    public function edit($id){
        $data['action'] = route('patient_update', $id);
        $data['page']= 'Edit';
        $patient   = $this->model->find($id);
        $data['phil_health_number'] = $patient->phil_health_number;
        $data['enrolment_date'] = $patient->enrolment_date;
        $data['code_name'] = $patient->code_name;

        $data['nationality'] = $patient->nationality;
        $data['birth_date'] = $patient->birth_date_format;
        $data['dependents'] = $patient->dependents;

        $data['gender'] = $patient->gender;
        $data['civil_status']   = $patient->civil_status;
        $data['is_living_with_partner'] = $patient->is_living_with_partner;
        $data['is_presently_pregnant']  = $patient->is_presently_pregnant;
        

        $data['ui_code'] = explode('-',$patient->ui_code);
        $data['ui_code1'] = $data['ui_code'][0];
        $data['ui_code2'] = $data['ui_code'][1];
        $data['ui_code3'] = $data['ui_code'][2];

        

        $data['age'] = $patient->age;
        $data['permanent_address']      = $patient->permanent_address;
        $data['current_city']           = $patient->current_city;
        $data['current_province']       = $patient->current_province;

        $data['birth_place_city']       = $patient->birth_place_city;
        $data['birth_place_province']   = $patient->birth_place_province;

        $data['contact_number'] = $patient->contact_number;
        $data['email']          = $patient->email;

        $data['highest_educational_attainment'] = $patient->highest_educational_attainment;

        $data['is_working']         = $patient->is_working;
        $data['current_occupation'] = $patient->current_occupation;
        $data['previous_occupation']= $patient->previous_occupation;

        $data['is_work_abroad_in_past_5years'] = $patient->is_work_abroad_in_past_5years;
        $data['last_contract']      = $patient->last_contract_format;
        $data['last_work_country']  = $patient->last_work_country;
        $data['is_based']           = $patient->is_based;

        return $data;
    }

    public function update($id, $input, $request){
        $input = $request->except(['age','ui_code1','ui_code2','ui_code3','_token']);
        $this->model->find($id)->update($input);
        return ['status' => true, 'results'=> 'Success'];
    }

    public function destroy($id){
        $patient = $this->model->find($id);
        DB::statement("SET foreign_key_checks = 0");
        /**
         * deleting VCT
         */
        foreach($patient->VCT as $vct)
        {
            $vct = $this->model->find($id);

            if($vct->VCTSuplementalChildren)
            {
                $vct->VCTSuplementalChildren->delete();
            }
            if($vct->VCTSuplementalMother)
            {
                $vct->VCTSuplementalMother->delete();
            }
            $vct->delete();
        }

        /*foreach($patient->PatientDoctor as $row)
        {
            $row->delete();
        }*/

        foreach($patient->ObGyne as $row)
        {
            $row->delete();
        }

        foreach($patient->MedicalAbstract as $row)
        {
            $row->delete();
        }

        if($patient->Mortality){ $patient->Mortality->delete();}

        if($patient->ConfirmatoryDate){$patient->ConfirmatoryDate->delete();}

        if($patient->PatientTransfer){$patient->PatientTransfer->delete();}


        foreach($patient->Checkup as $checkup)
        {
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

            if($checkup->CheckupLaboratory->count() > 0)
            {
                foreach($checkup->CheckupLaboratory as $row)
                {
                    $row->delete();
                }

            }

            $checkup->delete();
        }

        if($patient->Laboratory->count() > 0)
        {
            foreach($patient->Laboratory as $row)
            {
                $row->delete();
            }
        }

        if($patient->Tuberculosis->count() > 0)
        {
            foreach ($patient->Tuberculosis as $row) {
                $row->delete();
            }
        }

        $patient_name = $patient->code_name;
        $patient->forceDelete();

        DB::statement("SET foreign_key_checks = 1");

        ActivityLog::create([
            'page' => 'Patient',
            'message' => $patient_name . ' has been deleted!',
            'user_id' => Auth::user()->id
        ]);
    }

    public function search($request){
        $search = isset($request->patient_search)?$request->patient_search:$request->search_vct;
        $patients = Patient::where('code_name', 'LIKE', trim($search));
        if(Auth::user()->access == 2)
        {
            $patients = $patients->join('patient_doctor','patient_doctor.patient_id','=','patient.id')
                ->where('patient_doctor.user_id',Auth::user()->id);
        }
        $patients = $patients->select('patient.*')->lists('code_name', 'id');
        return $patients;
    }

    public function order_by($request)
    {
        if($request->has('order_by'))
        {
            $order_by = $request->order_by;
            return $order_by;
        }
        else{
            return 'code_name';
        }
    }

    public function link_sort($order_by, $search, $sort, $request)
    {
        $sort     = ($request->input('sort') == 'asc') ? 'desc':'asc';

        if($request->has('page'))
        {
            return route('patient', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);
        }
        else
        {
            return route('patient', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
    }
    public function getPatientName(){
        return $this->model->select('code_name');
    }

}
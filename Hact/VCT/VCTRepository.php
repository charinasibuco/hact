<?php
namespace Hact\VCT;

use Hact\Repository;
use App\VCT;
use App\Patient;
use App\ActivityLog;
use App\VCTSuplementalChildren;
use App\VCTSuplementalMother;
use App\VCTSuplementalMotherChildrens;
use App\ConfirmatoryDate;
use Illuminate\Support\Facades\Validator;
use App\User;
use DB;
use App\PatientDoctor;
use Auth;

class VCTRepository extends Repository{

	const LIMIT 	= 50;

	protected $user;

	public function model()
	{
		$this->user = Auth::user();
		return 'App\VCT';
	}

	public function getPatientsOnVCT($request = null)
	{
		$access     = Auth::user()->access;
        $doctor     = Auth::user()->id;
		$search 	= trim($request->input('search'));
		$query 		= Patient::whereIn('id', function($query){
	        		$query->select('patient_id')->from('vct');
	        		});

		if($request->has('search')){
			return $query->where('code_name', 'LIKE', '%' . $search . '%')
                            ->orWhere('saccl_code', 'LIKE', '%' . $search . '%')
                           	->orderBy('code_name', $request->input('sort'))
                        	->paginate(self::LIMIT);
		}

		if($access == 2)
        {
            $patients = Patient::whereIn('id', function($query) use ($doctor){
                            $query->select('patient_id')->from('patient_doctor')->where('user_id', $doctor)->where('active', 1);
                        });
        }

        if($request->input('order_by') && $request->input('sort')){
            return $query->orderBy($request->input('order_by'), $request->input('sort'))->paginate(self::LIMIT);
        }

        return $query->orderBy('code_name', 'asc')->paginate(self::LIMIT);
	}
	public function find($id){
		return $this->model->find($id);
	}

    public function create($id){
    	$data['id']  = $id;
    	$data['action'] = route('vct_store');
        $data['page'] = 'New';
    	$data['search_patient'] = old('search_patient');
        $data['patient_id']     = old('patient_id');
        $data['gender']         = old('gender');
        $data['age']            = old('age');
        $data['is_pregnant']    = old('is_pregnant');

       if(!is_null($id))
        {
            $patient = Patient::where('id', $id)->first();

            $data['search_patient']= $patient->code_name;
            $data['patient_id']    = $patient->id;
            $data['gender']         = $patient->gender;
            $data['age']            = \Carbon\Carbon::parse($patient->birth_date)->age;
            $data['is_pregnant']    = $patient->is_presently_pregnant;
        }

        $data['vct_date'] = old('vct_date');

        $data['reason_1'] = old('reason_1');
        $data['reason_2'] = old('reason_2');
        $data['reason_3'] = old('reason_3');
        $data['reason_4'] = old('reason_4');
        $data['reason_5'] = old('reason_5');
        $data['reason_6'] = old('reason_6');
        $data['reason_7'] = old('reason_7');
        $data['reason_8'] = old('reason_8');
        $data['reason_9'] = old('reason_9');
        $data['reason_10'] = old('reason_10');
        $data['reason_11'] = old('reason_11');
        $data['reason_12'] = old('reason_12');
        $data['reason_13'] = old('reason_13');
        $data['reason_14'] = old('reason_14');
        $data['reason_15'] = old('reason_15');
        $data['reason_other'] = old('reason_other');

        $data['is_your_mother_infected_with_hiv'] = old('is_your_mother_infected_with_hiv');
        $data['experience1'] = old('experience1');
        $data['experience2'] = old('experience2');
        $data['experience3'] = old('experience3');
        $data['experience4'] = old('experience4');
        $data['experience5'] = old('experience5');
        $data['experience6'] = old('experience6');
        $data['experience7'] = old('experience7');
        $data['experience8'] = old('experience8');

        $data['experience_1_if_yes_what_year'] = old('experience_1_if_yes_what_year');
        $data['experience_2_if_yes_what_year'] = old('experience_2_if_yes_what_year');
        $data['experience_3_if_yes_what_year'] = old('experience_3_if_yes_what_year');
        $data['experience_4_if_yes_what_year'] = old('experience_4_if_yes_what_year');
        $data['experience_5_if_yes_what_year'] = old('experience_5_if_yes_what_year');
        $data['experience_6_if_yes_what_year'] = old('experience_6_if_yes_what_year');
        $data['experience_7_if_yes_what_year'] = old('experience_7_if_yes_what_year');
        $data['experience_8_if_yes_what_year'] = old('experience_8_if_yes_what_year');

        $data['number_of_female']       = old('number_of_female');
        $data['last_year_sex_female']   = old('last_year_sex_female');

        $data['number_of_male']     = old('number_of_male');
        $data['last_year_sex_male'] = old('last_year_sex_male');

        $data['been_tested_for_hiv_before']         = old('been_tested_for_hiv_before');
        $data['been_tested_for_hiv_before_month']   = old('been_tested_for_hiv_before_month');
        $data['been_tested_for_hiv_before_year']    = old('been_tested_for_hiv_before_year');

        $data['which_testing_facility']             = old('which_testing_facility');
        $data['which_testing_facility_city']        = old('which_testing_facility_city');

        // if pregnant
        $data['children_alive']                 = old('children_alive');
        $data['last_period']                    = old('last_period');
        $data['months_pregnant']                = old('months_pregnant');
        $data['weeks_pregnant']                 = old('weeks_pregnant');
        $data['delivery_date']                  = old('delivery_date');
        $data['where_prenatal_care_no']         = old('where_prenatal_care_no');
        $data['where_prenatal_care']            = old('where_prenatal_care');
        $data['plan_to_deliver_baby']           = old('plan_to_deliver_baby');
        $data['plan_to_deliver_baby_specify']   = old('plan_to_deliver_baby_specify');
        $data['partner_hiv_tested']             = old('partner_hiv_tested');
        $data['mother_child']                   = old('child');

        $data['partner_hiv_tested_when']        = old('partner_hiv_tested_when');
        $data['partner_hiv_tested_facility']    = old('partner_hiv_tested_facility');
        $data['partner_hiv_tested_result']      = old('partner_hiv_tested_result');
        $data['partner_taking_arv']             = old('partner_taking_arv');
        $data['partner_taking_arv_stopped_reason']  = old('partner_taking_arv_stopped_reason');

        // if age 18 below
        $data['mother_hiv_status']              = old('mother_hiv_status');
        $data['hiv_diagnosis']                  = old('hiv_diagnosis');
        $data['mother_saccl']                   = old('mother_saccl');
        $data['mother_arv_pregnancy']           = old('mother_arv_pregnancy');
        $data['mother_arv_pregnancy_reason']    = old('mother_arv_pregnancy_reason');
        $data['she_breastfeed_baby']            = old('she_breastfeed_baby');
        $data['is_mother_alive_or_dead']        = old('is_mother_alive_or_dead');
        $data['is_mother_alive_or_dead_when']   = old('is_mother_alive_or_dead_when');
        return $data;
    }

    public function store($input, $request){
    	$row = new VCT;
        $row->user_id       = Auth::user()->id;
        $row->patient_id    = $request->patient_id;
        $row->vct_date      = $request->vct_date;

        $row->reason_1      = $request->reason_1;
        $row->reason_2      = $request->reason_2;
        $row->reason_3      = $request->reason_3;
        $row->reason_4      = $request->reason_4;
        $row->reason_5      = $request->reason_5;
        $row->reason_6      = $request->reason_6;
        $row->reason_7      = $request->reason_7;
        $row->reason_8      = $request->reason_8;
        $row->reason_9      = $request->reason_9;
        $row->reason_10     = $request->reason_10;
        $row->reason_11     = $request->reason_11;
        $row->reason_12     = $request->reason_12;
        $row->reason_13     = $request->reason_13;
        $row->reason_14     = $request->reason_14;
        $row->reason_other  = $request->reason_other;

        $row->is_your_mother_infected_with_hiv = $request->is_your_mother_infected_with_hiv;
        $row->experience_1   = $request->experience1;
        $row->experience_2   = $request->experience2;
        $row->experience_3   = $request->experience3;
        $row->experience_4   = $request->experience4;
        $row->experience_5   = $request->experience5;
        $row->experience_6   = $request->experience6;
        $row->experience_7   = $request->experience7;
        $row->experience_8   = $request->experience8;

        $row->experience_1_if_yes_what_year = $request->experience_1_if_yes_what_year;
        $row->experience_2_if_yes_what_year = $request->experience_2_if_yes_what_year;
        $row->experience_3_if_yes_what_year = $request->experience_3_if_yes_what_year;
        $row->experience_4_if_yes_what_year = $request->experience_4_if_yes_what_year;
        $row->experience_5_if_yes_what_year = $request->experience_5_if_yes_what_year;
        $row->experience_6_if_yes_what_year = $request->experience_6_if_yes_what_year;
        $row->experience_7_if_yes_what_year = $request->experience_7_if_yes_what_year;
        $row->experience_8_if_yes_what_year = $request->experience_8_if_yes_what_year;

        $row->number_of_female      = $request->number_of_female;
        $row->last_year_sex_female  = $request->last_year_sex_female;

        $row->number_of_male        = $request->number_of_male;
        $row->last_year_sex_male    = $request->last_year_sex_male;

        $row->been_tested_for_hiv_before         = $request->been_tested_for_hiv_before;
        $row->been_tested_for_hiv_before_month   = $request->been_tested_for_hiv_before_month;
        $row->been_tested_for_hiv_before_year    = $request->been_tested_for_hiv_before_year;

        $row->which_testing_facility             = $request->which_testing_facility;
        $row->which_testing_facility_city        = $request->which_testing_facility_city;

        $row->save();

        // if pregnant
        if($request->is_pregnant == 1)
        {
            $mother = new VCTSuplementalMother;

            $mother->user_id                     = Auth::user()->id;
            $mother->vct_id                      = $row->id;

            $mother->alive_children_count        = $request->children_alive;
            $mother->last_menstrual_period       = $request->last_period;
            $mother->months_pregnant             = $request->months_pregnant;
            $mother->weeks_pregnant              = $request->weeks_pregnant;
            $mother->delivery_date               = $request->delivery_date;
            $mother->has_parental_care           = $request->where_prenatal_care;
            $mother->plan_to_deliver_baby        = $request->plan_to_deliver_baby;
            $mother->plan_to_deliver_baby_specify= $request->plan_to_deliver_baby_specify;
            $mother->partner_hiv_tested          = $request->partner_hiv_tested;
            $mother->if_yes_when                 = $request->partner_hiv_tested_when;
            $mother->if_yes_facility             = $request->partner_hiv_tested_facility;
            $mother->if_yes_result               = $request->partner_hiv_tested_result;
            $mother->partner_taking_arv          = $request->partner_taking_arv;
            $mother->if_stopped_reason           = $request->partner_taking_arv_stopped_reason;

            $mother->save();

            if (count($request->child) >= 1) 
            {
                foreach ($request->child as $key => $value)
                {
                    $mother_child = new VCTSuplementalMotherChildrens;

                    $mother_child->user_id      = Auth::user()->id;
                    $mother_child->mother_id    = $mother->id;

                    $mother_child->status       = $value['status'];
                    $mother_child->place_tested = $value['place_tested'];
                    $mother_child->date_tested  = $value['date_tested'];

                    $mother_child->save();
                }
            }
        }

        if($request->is_your_mother_infected_with_hiv == 1)
        {
            $child = new VCTSuplementalChildren;

            $child->user_id                   = Auth::user()->id;
            $child->vct_id                    = $row->id;

            $child->mother_hiv_status         = $request->mother_hiv_status;
            $child->hiv_diagnosis_date        = $request->hiv_diagnosis;
            $child->mother_saccl              = $request->mother_saccl;
            $child->did_breastfeed_baby       = (isset($request->she_breastfeed_baby)? $request->she_breastfeed_baby : '');
            $child->mother_dead_or_alive      = (isset($request->is_mother_alive_or_dead)? $request->is_mother_alive_or_dead : '' );
            $child->mother_dead_or_alive_when = $request->is_mother_alive_or_dead_when;

            $child->mother_took_arv_medication_during_pregnancy               = (isset($request->mother_arv_pregnancy)? $request->mother_arv_pregnancy: '');
            $child->mother_took_arv_medication_during_pregnancy_reason_if_no  = $request->mother_arv_pregnancy_reason;

            $child->save();
        }
        if($row->save())
        {

			$patient = Patient::where('id', $request->patient_id)->first();
	        ActivityLog::create([
	                'page' => 'VCT', 
	                'message' => $patient->code_name . ' has been created!', 
	                'user_id' => Auth::user()->id
	            ]);
	        return ['status' => true, 'results'=> 'Success'];
        		
        	
        }
        return ['status' => false, 'results' => 'Unable to Add'];


    }
     public function edit($id){
     	$data['action'] = route('vct_update', $id);
        $data['page']   = 'New';

        $vct            = VCT::where('id', $id)->first();
        $patient        = Patient::where('id', $vct->patient_id)->first();

        // Variables
        $data['search_patient'] = $patient->code_name;
        $data['patient_id']     = $vct->patient_id;
        $data['gender']         = $patient->gender;
        $data['age']            = \Carbon\Carbon::parse( $patient->birth_date )->age;
        $data['is_pregnant']    = $patient->is_presently_pregnant;

        $data['vct_date'] = $vct->vct_date;
        $data['reason_1'] = $vct->reason_1;
        $data['reason_2'] = $vct->reason_2;
        $data['reason_3'] = $vct->reason_3;
        $data['reason_4'] = $vct->reason_4;
        $data['reason_5'] = $vct->reason_5;
        $data['reason_6'] = $vct->reason_6;
        $data['reason_7'] = $vct->reason_7;
        $data['reason_8'] = $vct->reason_8;
        $data['reason_9'] = $vct->reason_9;
        $data['reason_10'] = $vct->reason_10;
        $data['reason_11'] = $vct->reason_11;
        $data['reason_12'] = $vct->reason_12;
        $data['reason_13'] = $vct->reason_13;
        $data['reason_14'] = $vct->reason_14;
        $data['reason_15'] = $vct->reason_15;
        $data['reason_other'] = $vct->reason_other;

        $data['is_your_mother_infected_with_hiv'] = (is_null(old("is_your_mother_infected_with_hiv")))? $vct->is_your_mother_infected_with_hiv: old("is_your_mother_infected_with_hiv");
        $data['experience1'] = $vct->experience_1;
        $data['experience2'] = $vct->experience_2;
        $data['experience3'] = $vct->experience_3;
        $data['experience4'] = $vct->experience_4;
        $data['experience5'] = $vct->experience_5;
        $data['experience6'] = $vct->experience_6;
        $data['experience7'] = $vct->experience_7;
        $data['experience8'] = $vct->experience_8;

        $data['experience_1_if_yes_what_year'] = $vct->experience_1_if_yes_what_year;
        $data['experience_2_if_yes_what_year'] = $vct->experience_2_if_yes_what_year;
        $data['experience_3_if_yes_what_year'] = $vct->experience_3_if_yes_what_year;
        $data['experience_4_if_yes_what_year'] = $vct->experience_4_if_yes_what_year;
        $data['experience_5_if_yes_what_year'] = $vct->experience_5_if_yes_what_year;
        $data['experience_6_if_yes_what_year'] = $vct->experience_6_if_yes_what_year;
        $data['experience_7_if_yes_what_year'] = $vct->experience_7_if_yes_what_year;
        $data['experience_8_if_yes_what_year'] = $vct->experience_8_if_yes_what_year;

        $data['number_of_female']       = $vct->number_of_female;
        $data['last_year_sex_female']   = $vct->last_year_sex_female;

        $data['number_of_male']         = $vct->number_of_male;
        $data['last_year_sex_male']     = $vct->last_year_sex_male;

        $data['been_tested_for_hiv_before']         = $vct->been_tested_for_hiv_before;
        $data['been_tested_for_hiv_before_month']   = $vct->been_tested_for_hiv_before_month;
        $data['been_tested_for_hiv_before_year']    = $vct->been_tested_for_hiv_before_year;

        $data['which_testing_facility']             = $vct->which_testing_facility;
        $data['which_testing_facility_city']        = $vct->which_testing_facility_city;

        // if pregnant
        if($data['is_pregnant']  == 1 && VCTSuplementalMother::where('vct_id', $id)->count() != 0)
        {

            $mother                            		= VCTSuplementalMother::where('vct_id', $vct->id)->first();
            $data['children_alive']                     = $mother->alive_children_count;
            $data['last_period']                        = $mother->last_menstrual_period_format;
            $data['months_pregnant']                    = $mother->months_pregnant;
            $data['weeks_pregnant']                     = $mother->weeks_pregnant;
            $data['delivery_date']                      = $mother->delivery_date_format;
            $data['where_prenatal_care_no']             = ($mother->has_parental_care == '')? 1 : '';
            $data['where_prenatal_care']                = $mother->has_parental_care;
            $data['plan_to_deliver_baby']               = $mother->plan_to_deliver_baby;
            $data['plan_to_deliver_baby_specify']       = $mother->plan_to_deliver_baby_specify;
            $data['child']                              = [];

            $data['partner_hiv_tested']                 = $mother->partner_hiv_tested;
            $data['partner_hiv_tested_when']            = $mother->if_yes_when_format;
            $data['partner_hiv_tested_facility']        = $mother->if_yes_facility;
            $data['partner_hiv_tested_result']          = $mother->if_yes_result;
            $data['partner_taking_arv']                 = $mother->partner_taking_arv;
            $data['partner_taking_arv_stopped_reason']  = $mother->if_stopped_reason;

            if($mother->alive_children_count != 0 || $mother->alive_children_count != '')
            {
                $data['mother_child'] = VCTSuplementalMotherChildrens::where('mother_id', $mother->id)->get();
                $i = 1;

                foreach ($data['mother_child']  as $value)
                {
                    $data['child[$i]']= [
                        'hiv_status'    => $value->status,
                        'place_tested'  => $value->place_tested,
                        'date_tested'   => $value->date_tested_format
                    ];

                    $i++;
                }
            }
        }
        else
        {
            $data['children_alive']                 = old('children_alive');
            $data['last_period']                    = old('last_period');
            $data['months_pregnant']                = old('months_pregnant');
            $data['weeks_pregnant']                 = old('weeks_pregnant');
            $data['delivery_date']                  = old('delivery_date');
            $data['where_prenatal_care_no']         = old('where_prenatal_care_no');
            $data['where_prenatal_care']            = old('where_prenatal_care');
            $data['plan_to_deliver_baby']           = old('plan_to_deliver_baby');
            $data['plan_to_deliver_baby_specify']   = old('plan_to_deliver_baby_specify');
            $data['partner_hiv_tested']             = old('partner_hiv_tested');
            $data['child']                          = old('child');

            $data['partner_hiv_tested_when']        = old('partner_hiv_tested_when');
            $data['partner_hiv_tested_facility']    = old('partner_hiv_tested_facility');
            $data['partner_hiv_tested_result']      = old('partner_hiv_tested_result');
            $data['partner_taking_arv']             = old('partner_taking_arv');
            $data['partner_taking_arv_stopped_reason']  = old('partner_taking_arv_stopped_reason');
        }
        

        // if age 18 below
        if($data['is_your_mother_infected_with_hiv'] == 1 && VCTSuplementalChildren::where('vct_id', $id)->count() != 0)
        {
            $child                          = VCTSuplementalChildren::where('vct_id', $vct->id)->first();
            $data['mother_hiv_status']              = $child->mother_hiv_status;
            $data['hiv_diagnosis']                  = $child->hiv_diagnosis_date_format;
            $data['mother_saccl']                   = $child->mother_saccl;
            $data['mother_arv_pregnancy']           = $child->mother_took_arv_medication_during_pregnancy;
            $data['mother_arv_pregnancy_reason']    = is_null(old('mother_arv_pregnancy_reason'))?$child->mother_took_arv_medication_during_pregnancy_reason_if_no:old('mother_arv_pregnancy_reason');

            $data['she_breastfeed_baby']            = $child->did_breastfeed_baby;
            $data['is_mother_alive_or_dead']        = $child->mother_dead_or_alive;
            $data['is_mother_alive_or_dead_when']   = $child->mother_dead_or_alive_when;
        }
        else
        {
            $data['mother_hiv_status']              = old('mother_hiv_status');
            $data['hiv_diagnosis']                  = old('hiv_diagnosis');
            $data['mother_saccl']                   = old('mother_saccl');
            $data['mother_arv_pregnancy']           = old('mother_arv_pregnancy');
            $data['mother_arv_pregnancy_reason']    = old('mother_arv_pregnancy_reason');
            $data['she_breastfeed_baby']            = old('she_breastfeed_baby');
            $data['is_mother_alive_or_dead']        = old('is_mother_alive_or_dead');
            $data['is_mother_alive_or_dead_when']   = old('is_mother_alive_or_dead_when');
        }
        return $data;
     }
    public function update($id, $request, $input){
    	// dd($request);
    	$vct = $this->model->find($id);
        $vct->patient_id    = $input['patient_id'];
        $vct->vct_date      = $input['vct_date'];

        $vct->reason_1      = $input['reason_1'];
        $vct->reason_2      = $input['reason_2'];
        $vct->reason_3      = $input['reason_3'];
        $vct->reason_4      = $input['reason_4'];
        $vct->reason_5      = $input['reason_5'];
        $vct->reason_6      = $input['reason_6'];
        $vct->reason_7      = $input['reason_7'];
        $vct->reason_8      = $input['reason_8'];
        $vct->reason_9      = $input['reason_9'];
        $vct->reason_10     = $input['reason_10'];
        $vct->reason_11     = $input['reason_11'];
        $vct->reason_12     = $input['reason_12'];
        $vct->reason_13     = $input['reason_13'];
        $vct->reason_14     = $input['reason_14'];
        $vct->reason_other  = $input['reason_other'];

        $vct->is_your_mother_infected_with_hiv = $input['is_your_mother_infected_with_hiv'];
        $vct->experience_1   = $input['experience1'];
        $vct->experience_2   = $input['experience2'];
        $vct->experience_3   = $input['experience3'];
        $vct->experience_4   = $input['experience4'];
        $vct->experience_5   = $input['experience5'];
        $vct->experience_6   = $input['experience6'];
        $vct->experience_7   = $input['experience7'];
        $vct->experience_8   = $input['experience8'];
        $vct->experience_1_if_yes_what_year = $input['experience_1_if_yes_what_year'];
        $vct->experience_2_if_yes_what_year = $input['experience_2_if_yes_what_year'];
        $vct->experience_3_if_yes_what_year = $input['experience_3_if_yes_what_year'];
        $vct->experience_4_if_yes_what_year = $input['experience_4_if_yes_what_year'];
        $vct->experience_5_if_yes_what_year = $input['experience_5_if_yes_what_year'];
        $vct->experience_6_if_yes_what_year = $input['experience_6_if_yes_what_year'];
        $vct->experience_7_if_yes_what_year = $input['experience_7_if_yes_what_year'];
        $vct->experience_8_if_yes_what_year = $input['experience_8_if_yes_what_year'];

        $vct->number_of_female      = $input['number_of_female'];
        $vct->last_year_sex_female  = $input['last_year_sex_female'];

        $vct->number_of_male        = $input['number_of_male'];
        $vct->last_year_sex_male    = $input['last_year_sex_male'];

        $vct->been_tested_for_hiv_before         = $input['been_tested_for_hiv_before'];
        $vct->been_tested_for_hiv_before_month   = $input['been_tested_for_hiv_before_month'];
        $vct->been_tested_for_hiv_before_year    = $input['been_tested_for_hiv_before_year'];
        $vct->which_testing_facility             = $input['which_testing_facility'];
        $vct->which_testing_facility_city        = $input['which_testing_facility_city'];
        $vct->save();


        // if pregnant
         if($request['is_pregnant'] == 1)
        {
            $mother = VCTSuplementalMother::where('vct_id', $vct->id)->first();

            if($mother)
            {
                $row1 = VCTSuplementalMother::find($mother->id);
            }
            else
            {
                $row1 = new VCTSuplementalMother;
                $row1->vct_id                  = $vct->id;
                $row1->user_id                 = Auth::user()->id;
            }

            $row1->alive_children_count        = $input['children_alive'];
            $row1->last_menstrual_period       = $input['last_period'];
            $row1->months_pregnant             = $input['months_pregnant'];
            $row1->weeks_pregnant              = $input['weeks_pregnant'];
            $row1->delivery_date               = $input['delivery_date'];
            $row1->has_parental_care           = $input['where_prenatal_care'];
            $row1->plan_to_deliver_baby        = $input['plan_to_deliver_baby'];
            $row1->plan_to_deliver_baby_specify= $input['plan_to_deliver_baby_specify'];
            $row1->partner_hiv_tested          = $input['partner_hiv_tested'];
            $row1->if_yes_when                 = $input['partner_hiv_tested_when'];
            $row1->if_yes_facility             = $input['partner_hiv_tested_facility'];
            $row1->if_yes_result               = $input['partner_hiv_tested_result'];
            $row1->partner_taking_arv          = $input['partner_taking_arv'];
            $row1->if_stopped_reason           = $input['partner_taking_arv_stopped_reason'];
            $row1->save();

            // Delete all records
            VCTSuplementalMotherChildrens::where('mother_id', $row1->id)->delete();
            // Create new records

            if (isset($request['child']) && count($request['child']) >= 1)
            {
                foreach ($request['child'] as $key => $value)
                {
                    $mother_child = new VCTSuplementalMotherChildrens;
                    $mother_child->user_id      = Auth::user()->id;
                    $mother_child->mother_id    = $mother->id;
                    $mother_child->status       = $value['status'];
                    $mother_child->place_tested = $value['place_tested'];
                    $mother_child->date_tested  = $value['date_tested'];
                    $mother_child->save();
                }
            }
        }

        // if age below 18
        if($request['is_your_mother_infected_with_hiv'] == 1)
        {
            $row2 = VCTSuplementalChildren::where('vct_id', $vct->id)->first();

            if($row2)
            {
                $child = VCTSuplementalChildren::find($row2->id);
            }
            else
            {
                $child = new VCTSuplementalChildren;
                $child->vct_id = $vct->id;
                $child->user_id = Auth::user()->id;

            }

            $child->mother_hiv_status         = $input['mother_hiv_status'];
            $child->hiv_diagnosis_date        = $input['hiv_diagnosis'];
            $child->mother_saccl              = $input['mother_saccl'];
            $child->did_breastfeed_baby       = $input['she_breastfeed_baby'];
            $child->mother_dead_or_alive      = $input['is_mother_alive_or_dead'];
            $child->mother_dead_or_alive_when = $input['is_mother_alive_or_dead_when'];
            $child->mother_took_arv_medication_during_pregnancy               = $input['mother_arv_pregnancy'];
            $child->mother_took_arv_medication_during_pregnancy_reason_if_no  = $input['mother_arv_pregnancy_reason'];
            $child->save();
        }
        ActivityLog::create([
                'page' => 'VCT', 
                'message' => $request['search_patient'] . ' has been updated!', 
                'user_id' => Auth::user()->id
            ]);
		return ['status' => true, 'results'=> 'Success'];
    }

    public function destroy($id)
    {
        DB::statement("SET foreign_key_checks = 0");
        $vct = $this->model->find($id);
        $patient_name = $vct->Patient->code_name;

        if($vct->VCTSuplementalChildren)
        {
            $vct->VCTSuplementalChildren->delete();
        }
        if($vct->VCTSuplementalMother)
        {
            $vct->VCTSuplementalMother->delete();
        }

        $vct->delete();


        ActivityLog::create([
            'page' => 'VCT',
            'message' => $patient_name . ' VCT Record has been deleted!',
            'user_id' => Auth::user()->id
        ]);
        DB::statement("SET foreign_key_checks = 1");
    }

    public function search($string){
    	$search = '%' . trim($string->input('search')) . '%';

        $data['patients'] = Patient::whereIn('id', function($query){
                        $query->select('patient_id')->from('vct')->where('result', 2);
                    });
                    if(Auth::user()->access == 2)
                    {
                        $data['patients']->join('patient_doctor','patient_doctor.patient_id','=','patient.id')
                            ->where('patient_doctor.user_id',Auth::user()->id);
                    }
                    $data['patients']->where('code_name', 'LIKE', $search)
                    ->take(30)
                    ->lists('code_name', 'id');
        return $data;
    }
    public function result($request){
    	$vct_input      = $request->only(['result']);
        $patient_input  = $request->only(['saccl_code']);
        $confirmatory_date  = $request->confirmatory_date;

        VCT::where('id', $request->vct_id)->update($vct_input);
        Patient::where('id', VCT::find($request->vct_id)->patient_id)->update($patient_input);

        $date_exist = ConfirmatoryDate::where('patient_id', $request->patient_id)->first();

        if(is_object($date_exist))
        {
            if($request->result != 2)
            {
                $date_exist->delete();
            }
            else
            {
                $date_exist->confirmatory_date = $confirmatory_date;
                $date_exist->save();
            }
        }
        elseif($request->confirmatory_date)
        {
            $new_con_date = new ConfirmatoryDate;
            $new_con_date->patient_id = $this->model->find($request->vct_id)->Patient->id;
            $new_con_date->confirmatory_date = $confirmatory_date;
            $new_con_date->save();
        }
    }

    public function doctor($request, $id)
    {
    	$data['action']     = route('vct_assign_doctor', $id);
        $data['doctors']    = User::where('access', 2)->get();
        $data['patient']    = Patient::where('id', $id)->first();
        $data['my_doctors'] = PatientDoctor::where('patient_id', $id)->get();

        return $data;
    }

    public function assign_doctor($request, $id)
    {
    	$input  = $request->only( ['user_id', 'active'] );
        $input['patient_id'] = $id;

        PatientDoctor::create( $input );
    }

    public function disable_doctor($id, $patient_id)
    {
    	PatientDoctor::where('id', $id)->update( ['active' => 0] );
    }

    public function enable_doctor($id, $patient_id)
    {
    	PatientDoctor::where('id', $id)->update( ['active' => 1] );
    }


}
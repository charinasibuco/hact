<?php
namespace Hact\Mortality;

use Hact\Repository;
use Auth;
use App\Patient;
use DB;


class MortalityRepository extends Repository{
	const LIMIT = 50;

	public function model()
	{
		$this->user = Auth::user();
		return 'App\Mortality';
	}

	public function getPatientOnMortality($request = null){
		$access     = Auth::user()->access;
        $doctor     = Auth::user()->id;

        $query = Patient::whereIn('id', function($query){
                    $query->select('patient_id')->from('mortality')->whereRaw('mortality.patient_id = patient.id');
                });

        if($access == 2)
        {
            $query = $query->whereIn('patient.id', function($query) use ($doctor){
                            $query->select('patient_id')->from('patient_doctor')->where('user_id', $doctor)->where('active', 1);
                        });
        }

        if($request->has('search'))
        {
            $search = trim($request->input('search'));

            $query =  $query->where(function($query) use ($search) {
                            $query->where('ui_code', 'LIKE', '%' . $search . '%')
                            ->orWhere('code_name', 'LIKE', '%' . $search . '%')
                            ->orWhere('saccl_code', 'LIKE', '%' . $search . '%');
                        });
        }
        if($request->input('order_by') && $request->input('sort')){
        	return $query->orderBy($request->input('order_by'), $request->input('sort'))->paginate(self::LIMIT);
        }
        else
        {
            return $query->orderBy('code_name', 'asc')->paginate(self::LIMIT);
        }

	}
	public function find($id){
		return $this->model->where('patient_id', $id)->first();
	}

    public function create($id=null){
    	$data['page'] 					= "Create";
        $data['action'] 				= $id?route('mortality_store', $id):route('mortality_store');
        $data['search_vct'] 		    = !is_null(old('search_vct'))?old('search_vct'):($id?Patient::where('id',$id)->first()->code_name:old('search_vct'));
        $data['action_name'] 			= 'Create';
        $data['patient_id']     		= !is_null(old('patient_id'))?old('patient_id'):($id?$id:old('patient_id'));
        $data['date_of_death'] 			= old('date_of_death');
        $data['is_hiv_related'] 		= old('is_hiv_related');
        $data['immediate_cause'] 		= old('immediate_cause');
        $data['immediate_icd10_code'] 	= old('immediate_icd10_code');
        $data['antecedent_cause'] 		= old('antecedent_cause');
        $data['antecedent_icd10_code'] 	= old('antecedent_icd10_code');
        $data['underlying_cause'] 		= old('underlying_cause');
        $data['underlying_icd10_code'] 	= old('underlying_icd10_code');
        $data['tuberculosis'] 			= old('tuberculosis');
        $data['pneumocystis_pneumonia'] = old('pneumocystis_pneumonia');
        $data['cryptococcal_meningitis']= old('cryptococcal_meningitis');
        $data['cytomegalovirus'] 		= old('cytomegalovirus');
        $data['candidiasis'] 			= old('candidiasis');
        $data['last_arv_regimen'] 		= old('last_arv_regimen');
        $data['other'] 					= old('other');
        $data['cd4_count'] 				= old('cd4_count');
        $data['last_cd4_count'] 		= old('last_cd4_count');
        $data['have_taken_arv'] 		= old('have_taken_arv');
        $data['death_certificate']      = old('death_certificate');
        return $data;
    }

    public function store($input, $request){
    	$input = $request->except('search_patient','other_check');

        $input['user_id'] = Auth::user()->id;
        $input['date_of_death'] = ($request->date_of_death != "") ? date('Y-m-d', strtotime($input['date_of_death'])):NULL;
        $input['last_cd4_count'] = ($request->last_cd4_count != "") ? date('Y-m-d', strtotime($input['last_cd4_count'])):NULL;

        $max = DB::table('mortality')->max('id');
        $count = $max+1;

        if(isset($input['death_certificate']))
        {
            $extension = $input['death_certificate']->getClientOriginalExtension();
            $path = 'images/mortality/';
            $input['death_certificate']->move($path,$count.'.'.$extension);
            $input['death_certificate'] = $path.$count.'.'.$extension;
        }


        $this->model->create($input);

    }

    public function edit($id){
    	$mortality 						= $this->model->where('patient_id', $id)->first();
        $data['action_name'] 			= 'Edit';
        $data['action'] 				= route('mortality_update', $id);
        $data['patient_id']  			= $id;
        $data['page'] 					= "Edit";
        $data['search_patient']         = '';
        $data['search_vct'] 			= $mortality->patient->code_name;
        $data['date_of_death'] 			= $mortality->date_of_death->format('m/d/Y');
        $data['is_hiv_related'] 		= $mortality->is_hiv_related;
        $data['immediate_cause'] 		= $mortality->immediate_cause;
        $data['immediate_icd10_code'] 	= $mortality->immediate_icd10_code;
        $data['underlying_cause'] 		= $mortality->underlying_cause;
        $data['underlying_icd10_code'] 	= $mortality->underlying_icd10_code;
        $data['antecedent_cause'] 		= $mortality->antecedent_cause;
        $data['antecedent_icd10_code'] 	= $mortality->antecedent_icd10_code;
        $data['tuberculosis'] 			= $mortality->tuberculosis;
        $data['pneumocystis_pneumonia'] = $mortality->pneumocystis_pneumonia;
        $data['cryptococcal_meningitis']= $mortality->cryptococcal_meningitis;
        $data['cytomegalovirus'] 		= $mortality->cytomegalovirus;
        $data['candidiasis'] 			= $mortality->candidiasis;
        $data['other'] 					= $mortality->other;
        $data['cd4_count'] 				= $mortality->cd4_count;
        $data['last_cd4_count'] 		= $mortality->last_cd4_count_format;
        $data['have_taken_arv'] 		= $mortality->have_taken_arv;
        $data['last_arv_regimen'] 		= $mortality->last_arv_regimen;
        $data['death_certificate']      = $mortality->death_certificate;

        return $data;
    }

    public function update($request, $id, $input){
    	$input = $request->except(['search_vct','search_vct_url','patient_record_url','_token','other_check', 'ui_code']);
        $input['user_id'] = Auth::user()->id;
        $input['date_of_death'] = ($request->date_of_death != "") ? date('Y-m-d', strtotime($input['date_of_death'])):NULL;
        $input['last_cd4_count'] = ($request->last_cd4_count != "") ? date('Y-m-d', strtotime($input['last_cd4_count'])):NULL;
        if(!array_key_exists( 'tuberculosis' , $input))
        {
             $input['tuberculosis'] = NULL;
        }
        if(!array_key_exists( 'pneumocystis_pneumonia' , $input))
        {
             $input['pneumocystis_pneumonia'] = NULL;
        }
        if(!array_key_exists( 'cryptococcal_meningitis' , $input))
        {
             $input['cryptococcal_meningitis'] = NULL;
        }
        if(!array_key_exists( 'cytomegalovirus' , $input))
        {
             $input['cytomegalovirus'] = NULL;
        }
        if(!array_key_exists( 'candidiasis' , $input))
        {
             $input['candidiasis'] = NULL;
        }


        if(isset($input['death_certificate']))
        {
            $max = DB::table('mortality')->max('id');
            $count = $max+1;
            $extension = $input['death_certificate']->getClientOriginalExtension();
            $path = 'images/mortality/';
            $input['death_certificate']->move($path,$count.'.'.$extension);
            $input['death_certificate'] = $path.$count.'.'.$extension;
            $this->model->where('created_at', $this->model->where('patient_id', $id)->first()->created_at)
                ->update(['death_certificate' => $input['death_certificate']]);
        }

        $this->model->where('patient_id',$id)->first()->update($input);
    }

    public function destroy($id){
    	$this->model->where('patient_id',$id)->delete();
    }

    public function show($id){
    	$data['patient'] = Patient::where('id', $id)->first();
        $data['mortality'] = $this->model->where('patient_id', $id)->first();

        return $data;
    }

    public function search($request){
    	$search = '%' . trim($request->input('search')) . '%';

        $patients = Patient::leftJoin('mortality','patient.id','=','mortality.patient_id');
            if(Auth::user()->access == 2)
            {
                $patients = $patients->join('patient_doctor','patient_doctor.patient_id','=','patient.id')
                    ->where('patient_doctor.user_id',Auth::user()->id);
            }
        $patients = $patients->where('date_of_death','=',NULL)
            ->where('code_name', 'LIKE', $search)
            ->select('patient.*')
            ->take(30)
            ->lists('code_name', 'id');
        return $patients;
    }
}
<?php
namespace Hact\Tuberculosis;

use Hact\Repository;
use Auth;
use App\Patient;
use App\ActivityLog;

class TuberculosisRepository extends Repository{

	const LIMIT = 50;

	public function model()
	{
		$this->user = Auth::user();
		return 'App\TuberculosisModel';
	}

	public function getPatientOnTuberculosis($request = null){
		$access     = Auth::user()->access;
        $doctor     = Auth::user()->id;

        $query = Patient::whereIn('id', function($query){
                    $query->select('patient_id')->from('vct')->where('result', 2);
                });
        if($access == 2)
        {
            return $query->whereIn('id', function($query) use ($doctor){
                            $query->select('patient_id')->from('patient_doctor')->where('user_id', $doctor)->where('active', 1);
                        });
        }
        if($request->has('search'))
        {
            $search = trim($request->input('search'));

            return $query->where(function($query) use ($search) {
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
		return $this->model->where('patient_id', $id)->first();  
	}

    public function create($id){
    	$tb = $this->model->where('patient_id',$id)->orderBy('id', 'DESC')->first();
      	$data['action']                 = route('tuberculosis_store');
      	$data['action_name']            = 'Create';


      if($tb)
      {
        $data['patient_id']             = $tb->patient_id;
        $data['patient_tb']             = $this->model->where('patient_id', $tb->patient_id)->orderBy('order_number','desc')->get();
        $data['next_order_number']      = ($this->model->where('patient_id', $tb->patient_id)->max('order_number')) + 1;
        $data['search_patient']         = Patient::where('id', $tb->patient_id)->first()->code_name;
        $data['presence']               = $tb->presence;
        $data['tb_status']              = $tb->tb_status;
        $tb_status              		= $tb->tb_status;
        $data['on_ipt']                 = $tb->on_ipt;
        $data['ipt_outcome']            = $tb->ipt_outcome;
        $data['ipt_outcome_other']      = $tb->ipt_outcome_other;
        $data['site']                   = $tb->site;
        $data['site_extrapulmonary']    = $tb->site_extrapulmonary;
        $data['drug_resistance']        = $tb->drug_resistance;
        $data['drug_resistance_other']  = $tb->drug_resistance_other;
        $data['current_tb_regimen']     = $tb->current_tb_regimen ;
        $data['tx_outcome']             = $tb->tx_outcome;
        $data['tx_outcome_other']       = $tb->tx_outcome_other;
        $data['date_started']           = $tb->date_started_format;

        $data['tx_date_outcome']        = $tb->tx_date_outcome_format;
        $data['tx_facility']            = $tb->tx_facility;
      }
      else
      {
      	$tb_status              		= 0;
        $data['patient_id']             = $id;
        $data['patient_tb']             = $this->model->where('patient_id', $id)->orderBy('order_number','desc')->get();
        $data['next_order_number']      = ($this->model->where('patient_id', $id)->max('order_number')) + 1;
        $data['search_patient']         = Patient::where('id', $id)->first()->code_name;

        $data['order_number']           = old('order_number');

        $data['presence']               = old('presence');
        $data['tb_status']              = old('tb_status');

        $data['date_started']           = old('date_started');

        $data['on_ipt']                 = old('on_ipt');
        $data['ipt_outcome']            = old('ipt_outcome');
        $data['ipt_outcome_other']      = old('ipt_outcome_other');

        $data['site']                   = old('site');
        $data['site_extrapulmonary']    = old('site_extrapulmonary');
        $data['drug_resistance']        = old('drug_resistance');
        $data['drug_resistance_other']  = old('drug_resistance_other');
        $data['current_tb_regimen']     = old('current_tb_regimen');
        $data['tx_outcome']             = old('tx_outcome');
        $data['tx_outcome_other']       = old('tx_outcome_other');
        $data['tx_date_outcome']        = old('tx_date_outcome');
        $data['tx_facility']            = old('tx_facility');

      }
      return $data;
    }

    public function store($input, $request){
        $input = $request->all();
        $input['user_id'] = 1;
        $this->model->create($input);
    }

    public function show($id){
    	$data['tuberculosis'] = $this->model->where('patient_id', $id)->orderBy('date_started','desc')->get();
      	$data['search_patient'] = Patient::where('id', $id)->first()->code_name;

      	$data['patient_id'] = $id;
      	$data['page'] = $data['search_patient'];

      	return $data;
    }
    public function edit($id){
    	$tb = $this->model->find($id);

		$data['action']                 = route('tuberculosis_update', $tb->id);
		$data['action_name']            = 'Edit';
		$data['patient_id']             = $tb->patient_id;
		$data['patient_tb']             = $this->model->where('patient_id', $tb->patient_id)->orderBy('order_number','desc')->get();
		$data['next_order_number']      = $tb->order_number;
		$data['search_patient']         = Patient::where('id', $tb->patient_id)->first()->code_name;
		$data['presence']               = $tb->presence;
		$data['tb_status']              = $tb->tb_status;
		$data['on_ipt']                 = $tb->on_ipt;
		$data['ipt_outcome']            = $tb->ipt_outcome;
		$data['ipt_outcome_other']      = $tb->ipt_outcome_other;
		$data['site']                   = $tb->site;
		$data['site_extrapulmonary']    = $tb->site_extrapulmonary;
		$data['drug_resistance']        = $tb->drug_resistance;
		$data['drug_resistance_other']  = $tb->drug_resistance_other;
		$data['current_tb_regimen']     = $tb->current_tb_regimen ;
		$data['tx_outcome']             = $tb->tx_outcome;
		$data['tx_facility']            = $tb->tx_facility;
		$data['tx_date_outcome']        = $tb->tx_date_outcome_format;
		$data['tx_outcome_other']       = $tb->tx_outcome_other;
		$data['date_started']           = $tb->date_started_format;

      	return $data;
    }

    public function update($request, $id, $input){
        $input = $request->except('search_patient','search_patient_url','_token');
        $input['user_id'] = Auth::id();
        $this->model->find($id)->update($input);
    }

    public function destroy($id){
        $tb = $this->model->find($id);
        $patient_name = $tb->Patient->code_name;
        $tb->delete();

        ActivityLog::create([
            'page' => 'Tuberculosis',
            'message' => $patient_name . 'TB Record has been deleted!',
            'user_id' => Auth::user()->id
        ]);
    }

    public function search($string){

    }
}
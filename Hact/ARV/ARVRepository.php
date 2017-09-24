<?php 
namespace Hact\ARV;

use Hact\Repository;
use Auth;
use App\Patient;
use App\Infections;

class ARVRepository extends Repository{
	const LIMIT = 50;
	public function model(){
		$this->user = Auth::user();
		return 'App\ARV';
	}

	public function getARVPatient($request = null){
		if($request->session()->has('prescription'))
        {
            $request->session()->forget('prescription');
        }
        $doctor     = Auth::user()->id;
        $access     = Auth::user()->access;

        $query = Patient::whereNotIn('id', function($query){
                    $query->select('patient_id')->from('mortality');
                })
                ->whereIn('id', function($query){
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

        if($request->input('order_by') && $request->input('sort')){
        	return $query->orderBy($request->input('order_by'), $request->input('sort'))->paginate(self::LIMIT);
        }
        return $query->orderBy('code_name', 'asc')->paginate(self::LIMIT);
	}
	public function find($id){
		
	}

    public function create($id){
    	$data['action']     = route('arv_store_session');
        $data['infections'] = $this->infections($id);

        $patient    = Patient::where( 'id', $id )->first();

        $data['patient_id'] = $patient->id;
        $data['search_vct'] = $patient->code_name;

        $data['search_item']        = old('search_item');
        $data['medicine_id']        = old('medicine_id');
        $data['specified_medicine'] = old('specified_medicine');

        $data['pills_per_day']      = old('pills_per_day');
        $data['pills_missed_in_30_days'] = old('pills_missed_in_30_days');
        $data['pills_left']         = old('pills_left');

        $data['date_discontinued']  = old('date_discontinued');
        $data['reason']             = old('reason');
        $data['specify']            = old('specify');

        return $data;
    }

    public function storeARV($input, $request, $id){
        $this->model->create([
            'patient_id' => $id,
            'user_id'    => Auth::user()->id
            ]);
    }
    public function store($input, $request){
        //
    }
    public function edit($id){
    	
    }

    public function update($request, $id, $input){
    	
    }

    public function destroy($id){
    	
    }

    public function search($string){
    	
    }

    public function infections($id){
        $infections = [];
        $row        = Infections::where('patient_id', $id)->orderBy('result_date', 'DESC')->first();
        #$items      = ARVItems::where()->get();
        #dd($row);
        if($row)
        {
            if(!is_null($row->hepatitis_b))
            {
                $infections['hepatitis_b'] = 'Hepatitis B';
            }

            if(!is_null($row->hepatitis_c))
            {
                $infections['hepatitis_c'] = 'Hepatitis C';
            }

            if(!is_null($row->pneumocystis_pneumonia))
            {
                $infections['pneumocystis_pneumonia'] = 'Pneumocystis Pneumonia';
            }

            if(!is_null($row->orpharyngeal_candidiasis))
            {
                $infections['orpharyngeal_candidiasis'] = 'Orpharyngeal Candidiasis';
            }

            if(!is_null($row->syphilis))
            {
                $infections['syphilis'] = 'Syphilis';
            }

            if(!is_null($row->stis))
            {
                $infections['stis'] = 'STI`s ( ' . $row->stis . ' )';
            }

            if(!is_null($row->others))
            {
                $infections['others'] = 'Others ( ' . $row->others . ' )';
            }
        }
    return $infections;
    }
}
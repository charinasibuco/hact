<?php 

namespace Hact\Laboratory;

use App\Laboratory;
use Hact\Repository;
use App\LaboratoryTest;
use App\LaboratoryType;
use Hact\Log\ActivityLogRepository;
use Auth;

class LaboratoryRepository extends Repository {

	private $laboratory;
	private $labtype;
	private $labtest;
	private $log;

	/**
	 * Inject dependencies
	 *
	 * @param      Laboratory        $laboratory  (description)
	 * @param      LaboratoryType    $labtype     (description)
	 * @param      LaboratoryTestas  $labtest     (description)
	 */
	public function __construct(Laboratory $laboratory,
								LaboratoryType $labtype,LaboratoryTest $labtest,ActivityLogRepository $log)
	{
		$this->laboratory = $laboratory;
		$this->labtype = $labtype;
		$this->labtest = $labtest;
		$this->log = $log;
	}

	public function model()
	{
		
	}

	/**
	 * Get laboratories
	 *
	 * @return     array
	 */
	public function getLaboratories($test_id,$patient_id)
	{
		return $this->laboratory
				->leftJoin('laboratory_type','laboratory.laboratory_type_id','=','laboratory_type.id')
				->select('laboratory.*','laboratory_type.laboratory_test_id')
                ->where('laboratory_test_id',$test_id)  
                ->where('patient_id', $patient_id)->orderBy('result_date','asc')->get();    
	}

	/**
	 * Grab the first laboratory
	 *
	 * @return     array
	 */
	public function getFirstLaboratory($test_id)
	{
		return $this->laboratory
				->leftJoin('laboratory_type','laboratory.laboratory_type_id','=','laboratory_type.id')
				->select('laboratory.*','laboratory_type.laboratory_test_id')
                ->where('laboratory_test_id',$test_id)  
                ->orderBy('result_date', 'ASC')->first();
	}

	/**
	 * Grab the last laboratory on the storage
	 *
	 * @return     array
	 */
	public function getLastLaboratory($test_id)
	{
		return $this->laboratory
				->leftJoin('laboratory_type','laboratory.laboratory_type_id','=','laboratory_type.id')
				->select('laboratory.*','laboratory_type.laboratory_test_id')
                ->where('laboratory_test_id',$test_id)  ->orderBy('result_date', 'DESC')->first();
	}

	/**
	 * Show all laboratories 
	 *
	 * @return     arrray
	 */
	public function showLaboratories($id)
	{
		$labs = $this->laboratory
				->leftJoin('laboratory_type','laboratory.laboratory_type_id','=','laboratory_type.id')
				->select('laboratory.*','laboratory_type.laboratory_test_id')
                ->where('patient_id', $id)->orderBy('result_date','desc')->get();
		return $labs;
	}


	/**
	 * Grab other type of laboratories
	 *
	 * @return     array
	 */
	public function getOtherLaboratories()
	{
		return $this->laboratory->where('other','!=','')->select('other')->distinct()->get();
	}


	/**
	 * Find record by column
	 *
	 * @param      string   $column        
	 * @param      string   $value         
	 * @param      string   $order_column  
	 * @param      string   $order         
	 * @param      boolean  $order_by      arrange using order_by function or not
	 *
	 * @return     <type>
	 */
	public function findByColumn($column,$value,$order_column,$order,$order_by = false)	
	{
		if( $order_by ){

			return $this->laboratory->where($column, $value)
					->orderBy($order_column, $order)->first();
		}else {

			return $this->laboratory->where($column, $value)->first();
		}
					
	}

	/**
	 * Grab the patient's laboratory
	 *
	 * @return     array
	 */
	public function getPatientLaboratory($id,$other)
	{
		return $this->laboratory
				->where('patient_id', $id)
                ->where('other', $other)
                ->orderBy('result_date','ASC')
                ->get();
	}




	public function create($id)
	{
		# code...
	}

	public function edit($id)
	{
		$data = [];
		$data['laboratory']         = $this->laboratory->where('created_at',$this->laboratory->find($id)->created_at)->get();
		$data['laboratory_tests']   = $this->labtest->orderBy('group','asc')->get();
        $data['laboratory_types']   = $this->labtype->all();

        $data['labs'] = [];

		$old_labs = old('labs');
		foreach($data['laboratory_types'] as $row){
			foreach($data['laboratory'] as $row2){
				if($row2->laboratory_type_id == $row->id){
					$data['labs'][$row->id] = $row2->result;
				}
			}
			if(isset($old_labs[$row->id])){
				$data['labs'][$row->id] = $old_labs[$row->id];
			}
			if(!isset($data['labs'][$row->id])){
				$data['labs'][$row->id] = "";
			}
		}

		if($data['laboratory']->first()->other != ""){
			$data['labs']['other'] =  $data['laboratory']->first()->result;
			$data['other'] = $data['laboratory']->first()->other;
		}

        $data['action_name'] = "Edit";

        $data['action'] = route('laboratory_update', $id);

        $data['page']=  $data['laboratory']->first()->patient->code_name;

        $data['patient_id']         = $data['laboratory']->first()->patient->id;

        $data['search_patient']     = $data['laboratory']->first()->patient->code_name;

        $data['laboratory_type_id'] = $data['laboratory']->first()->laboratory_type_id;

        //$result_edit = $laboratory->result;
		$data['laboratory_test_description'] = is_object($data['laboratory']->first()->LaboratoryType)?$data['laboratory']->first()->LaboratoryType->LaboratoryTest->description:"Other";
		$data['laboratory_test_id'] = is_object($data['laboratory']->first()->LaboratoryType)?$data['laboratory']->first()->LaboratoryType->laboratory_test_id:16;


        $data['result_date'] = $data['laboratory']->first()->result_date_format;

        $data['image'] = $data['laboratory']->first()->image;

		$data['action_name'] = "Edit";
        return $data;
	}

	/**
	 * Create a new record in the storage.
	 * @param  array $data 
	 * @param  mixed $request 
	 * @return Response       
	 */	
	public function store($data,$request)
	{
		return $this->laboratory->create($data);
	}

	/**
	 * Find user by id.
	 * @param  int $id 
	 * @return mixed     
	 */
	public function find($id)
	{
       return $this->laboratory->where('id', $id)->first();
	}

	/**
	 * Update user credentials.
	 * @param  int $id   
	 * @param  array $data 
	 * @return mixed       
	 */
	public function update($request,$id,$data)
	{
		$laboratories = $this->laboratory->where('created_at',$this->laboratory->find($id)->created_at)->get();
		$labs = $data['labs'];
		unset($data['labs']);
		foreach($labs as $key => $result) {
			if ($result != "") {
				if($key !='other'){
					$lab = $laboratories->where('laboratory_type_id',$key)->first();
					/**
					 *  added condition for a very rare condition that lab is null
					 */
					if(is_null($lab)){
						foreach($laboratories as $row){
							if($row->laboratory_type_id == $key){
								$lab = $row;
							}
						}
					}
					$input['laboratory_type_id'] = $key;

				}else{
					$lab = $laboratories->first();
				}
				$data['result'] = $result;
				$this->laboratory->where('id', $lab->id)->update($data);
			}
		}


        $this->laboratory->where('created_at',
                            $this->laboratory->where('id', $id)
                                ->first()->created_at)
                                ->update(['result_date' => $data['result_date']
            ]);

      	return;


	}

	/**
	 * Remove user from the storage.
	 * @param  int $id 
	 * @return mixed     
	 */
	public function destroy($id)
	{
		$laboratory_first = $this->laboratory->find($id);
		
		if ( $laboratory_first == null ){

			return "DATA NOT FOUND ON THE SERVER.";exit();
		}	
        $laboratory = $this->laboratory
        			->where('created_at', $laboratory_first->created_at)
        			->where('image', $laboratory_first->image)->get();

        $patient = $laboratory->first()->patient;
        $this->log->store([
                'page' => 'Laboratory',
                'message' => $patient->code_name . ' has been deleted!',
                'user_id' => Auth::user()->id
            ],null);

        foreach($laboratory as $row)
        {
            $row->delete();
        }   

        return $patient;
	}

	public function search($string)
	{
		# code...
	}
}
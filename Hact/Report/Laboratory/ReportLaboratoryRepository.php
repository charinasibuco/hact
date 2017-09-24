<?php

namespace Hact\Report\Laboratory;

use Hact\RepositoryInterface;
use Hact\Repository;
use App\LaboratoryTest;
use DB;
use App\Laboratory;
use Auth;

class ReportLaboratoryRepository extends Repository  {

	private $lab_test;
	private $laboratory;

	 /**
	  * Inject dependencies.
	  *
	  * @param      Patient  $patient  (description)
	  */
	 function __construct(Laboratory $laboratory,LaboratoryTest $lab_test){

		$this->laboratory = $laboratory;
		$this->lab_test = $lab_test;
	}

	public function model()
    {
        //return 'App\User';
    }

	public function create($id)
	{
		# code...
	}


	public function edit($value)
	{
		# code...
	}


	public function search($string)
	{
		# code...
	}

	/**
	 * Create a new user in the storage.
	 * @param  array $data 
	 * @param  mixed $request 
	 * @return Response       
	 */	
	public function store($data,$request)
	{
		
	}

	/**
	 * Find user by id.
	 * @param  int $id 
	 * @return mixed     
	 */
	public function find($id)
	{
       // return $this->user->where('id', $id)->first();
	}

	/**
	 * Update user credentials.
	 * @param  int $id   
	 * @param  array $data 
	 * @return mixed       
	 */
	public function update($request,$id,$data)
	{
		// return $this->user->where('id', $id)->update($data);

	}

	/**
	 * Remove user from the storage.
	 * @param  int $id 
	 * @return mixed     
	 */
	public function destroy($id)
	{
	
	}

	public function results()
	{
		$tests = $this->lab_test->all();
	        return compact('tests');
	}

    public function results_print($request)
    {
        $doctor = Auth::user()->id;
        $access = Auth::user()->access;
        //$result = $this->getResultType($request->result);
        $patient_id = $request->patient_id;
        $search_patient = $request->search_patient;
        //$query_tests = DB::table('laboratory_test');
        $query_types = DB::table('laboratory_type')
                            ->leftJoin('laboratory_test','laboratory_type.laboratory_test_id','=','laboratory_test.id')
                            ->select('laboratory_type.*','laboratory_test.description as test_description','laboratory_test.group as test_group');
        if(is_null($request->labs))               
        {
            return redirect()->route('laboratory_results');
        }

        foreach($request->labs as $lab)
        {
            $query_types->orWhere('laboratory_test_id', $lab);
        }

        $laboratory_types = $query_types->orderBy('test_group','asc')->get();

        $other_laboratories = $this->laboratory->where('other','!=','')->select('other')->distinct()->get();

        $other_count = 16;
        foreach($other_laboratories as $other)
        {
            array_push($laboratory_types, ['id' => $other_count, 'description' => $other->other]);
            //$laboratory_types[] = ['id' => $other_count, 'description' => $other];
            $other_count++;
        }

        $query = $this->laboratory->where('patient_id', $patient_id)->orderBy('result_date','desc')->get();

        $laboratories = [];
        foreach($laboratory_types as $key => $type)
        {
            if(is_object($type))
            {   
                if($query->where('laboratory_type_id', $type->id)->isEmpty())
                {
                    unset($laboratory_types[$key]);
                }
                else
                {
                    foreach($query as $row)
                    {
                        if($row->laboratory_type_id == $type->id)
                        {
                            $laboratories[$type->id][] = $row; 
                        } 
                    }
                }
            }
            else
            {

                foreach($query as $row)
                {
                    if($row->other == $type['description'])
                    {
                        $laboratories[$type['id']][] = $row; 
                    } 
                }
            }  
        }
        
      
        return  compact('laboratories', 'search_patient', 'laboratory_types');
    }
	public function excel_export($laboratories, $search_patient, $laboratory_types)
	{
		$excel  = "<table border=\"1\">";
        $excel .= "<thead>";
        $excel .= "<tr><th colspan=\"2\">Patient:</th><th>".$search_patient."</th>";
        $excel .= "<tr>";
        foreach($laboratory_types as $row)
        {
            $excel .=  "<th colspan=\"4\">".(is_object($row) ? $row->description : $row['description'])."</th>";
        }
        $excel .= "</tr><tr>";
        foreach($laboratory_types as $row)
        {
            $excel .=  "<th colspan=2>Result</th>";
            $excel .=  "<th colspan=2>Result Date</th>";
        }
        $excel .= "</tr></thead><tbody>";
        $lab_count=0;
 
            $blank_check = count($laboratories);
            foreach($laboratories as $column)
            {
                if(!isset($column[$lab_count]))
                {
                    $blank_check--;
                }
            }
            
            if($blank_check != 0)
            {
                $excel .= "<tr>";
                    foreach($laboratories as $column)
                    {
                        if(isset($column[$lab_count]))
                        {
                             $excel  .= "<td colspan=2>".$column[$lab_count]->result."</td>";
                             $excel  .= "<td colspan=2>".$column[$lab_count]->result_date_format."</td>";
                        }
                        else
                        {
                            $excel  .= "<td colspan=2></td>";
                            $excel  .= "<td colspan=2></td>";
                        }
                    }
                $excel .= "</tr>";
            }

        $lab_count++; 
        $excel .= "</tbody>";
        $excel .= "</table>";

        $filename = 'Laboratory_'.$search_patient.'.xls';

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        print $excel;

	}

	

	

}
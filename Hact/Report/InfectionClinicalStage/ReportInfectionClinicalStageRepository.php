<?php

namespace Hact\Report\InfectionClinicalStage;

use Hact\RepositoryInterface;
use Hact\Repository;
use App\Patient;
use Auth;

class ReportInfectionClinicalStageRepository extends Repository  {

	private $patient;

	 /**
	  * Inject dependencies.
	  *
	  * @param      Patient  $patient  (description)
	  */
	 function __construct(Patient $patient){

		$this->patient = $patient;
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

	public function results_print($request)
	{
		$doctor = Auth::user()->id;
        $access = Auth::user()->access;
        //$result = $this->getResultType($request->result);
        $clinical_stage = $request->clinical_stage;
        $from = $request->from;
        $to = $request->to;

        $query = $this->patient->whereIn('id', function($query) use ($clinical_stage, $from, $to){
                    $query->select('patient_id')->from('infections')->whereRaw('infections.patient_id = patient.id')
                            ->where('clinical_stage', '=', $clinical_stage)
                            ->where('result_date', '>=', date('Y-m-d', strtotime($from)))
                            ->where('result_date', '<=', date('Y-m-d', strtotime($to)));
                });


        if($access == 2)
        {
            $patients = $query->whereIn('patient_id', function($query) use ($doctor){
                $query->select('patient_id')->from('patient_doctor')->where('user_id', $doctor)->where('active', 1);
            });
        }

        $patients = $query->get();

        if($clinical_stage == 0 || $clinical_stage == "")
        {
            $clinical_stage_format = "None";
        }
        else
        {
            $clinical_stage_format = "Clinical Stage #".$clinical_stage;
        }

        if($request->has('excel'))
        {
            $this->excel_export($patients, $clinical_stage_format, $from, $to);
        }
        
        $data = compact('patients','clinical_stage_format','from','to');
        return $data;

	}

	/**
	 * Export to xls format.
	 *
	 * @param      <type>  $patients               (description)
	 * @param      string  $clinical_stage_format  (description)
	 * @param      string  $from                   (description)
	 * @param      string  $to                     (description)
	 *
	 * @return     <type>
	 */
	public function excel_export($patients, $clinical_stage_format, $from, $to)
	{
	  $excel  = "<table border=\"1\">";
      $excel .= "<thead>";

      $excel .= "<tr><th colspan=\"5\">Report for Clinical Stage Infections as of ".$from." to ".$to." </th></tr>";
      $excel .= "<tr>";

      $excel .= "<th colspan=\"2\">WHO Classification: </th><th colspan=\"3\">" . $clinical_stage_format . " </th>";
      $excel .= "</tr>";

       $excel .= "<tr>";
        $excel .= "<th width='20%'>Code Name</th>";
        $excel .= "<th width='15%'>Age</th>";
        $excel .= "<th width='15%'>Sex</th>";
        $excel .= "<th width='25%'>SACCL</th>";
        $excel .= "<th width='25%'>UIC</th>";
        $excel .= "</tr>";

        $excel .= "</thead>";

        $excel .= "<tbody>";

        foreach ($patients as $row)
        {
            $excel .= "<tr>";
            $excel .= "<td>" . $row->code_name . "</td>";
            $excel .= "<td>" . $row->age . "</td>";
            $excel .= "<td>" . $row->gender_format . "</td>";
            $excel .= "<td>" . $row->saccl_code . "</td>";
            $excel .= "<td>" . $row->ui_code . "</td>";
            $excel .= "</tr>";
        }

        $excel .= "</tbody>";
      $excel .= "</table>";

      $filename = 'Clinical_Stage_Infections_'.date('Ymd', strtotime($from)).'_'.date('Ymd', strtotime($to)).'.xls';

      header("Content-Disposition: attachment; filename=\"$filename\"");
      header("Content-Type: application/vnd.ms-excel");
      return print $excel;
	}

	

}
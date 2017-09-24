<?php

namespace Hact\Report\Mortality;

use Hact\RepositoryInterface;
use Hact\Repository;
use App\Mortality;
use App\VCT;
use App\Patient;
use DB;
use Auth;


class ReportMortalityRepository extends Repository  {

	private $mortality;
	private $vct;
	private $patient;

	 /**
	  * Inject dependencies.
	  *
	  * @param      Mortality  $mortality  (description)
	  * @param      VCT        $vct        (description)
	  * @param      Patient    $patient    (description)
	  */
	 function __construct(Mortality $mortality, VCT $vct,Patient $patient){

		$this->mortality = $mortality;
		$this->vct = $vct;
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

	public function results()
	{
		$immediate_cause = $this->mortality->all()->unique('immediate_cause');
      	$antecedent_cause = $this->mortality->all()->unique('antecedent_cause');
      	$underlying_cause = $this->mortality->all()->unique('underlying_cause');
      	$years = $this->vct->select(DB::raw('YEAR(vct_date) AS vct_year'))->where('result', 1)->groupBy('vct_year')->orderBy('vct_year', 'DEC')->lists('vct_year', 'vct_year');
      	$data = compact('immediate_cause','antecedent_cause','underlying_cause', 'years');
      	return $data;
	}

	public function results_print($request)
	{
		  $access     = Auth::user()->access;
        $doctor     = Auth::user()->id;
        $cause_type = $request->cause_type;
        if(is_null($request->cause_type))
        {
          return redirect()->route('mortality_results');
        }
        if($cause_type == "immediate_cause")
        {
          $cause_type_format = "Immediate Cause";
        }
        elseif ($cause_type == "antecedent_cause")
        {
          $cause_type_format = "Antecedent Cause";
        }
        else
        {
          $cause_type_format = "Underlying Cause";
        }

        $cause_description = $request->cause_description;
        $from = $request->from;
        $to = $request->to;
        $query = $this->patient->whereIn('id', function($query) use ($from, $to, $cause_type, $cause_description){
                    $query->select('patient_id')->from('mortality')->whereRaw('mortality.patient_id = patient.id')
                            ->where($cause_type, '=', $cause_description)
                            ->where('date_of_death', '>=', date('Y-m-d', strtotime($from)))
                            ->where('date_of_death', '<=', date('Y-m-d', strtotime($to)));
                });


        if($access == 2)
        {
            $patients = $query->whereIn('patient_id', function($query) use ($doctor){
                            $query->select('patient_id')->from('patient_doctor')->where('user_id', $doctor)->where('active', 1);
                        });
        }

        $patients = $query->get();
        
        return compact('patients','from', 'to','cause_type_format','cause_description');
	}

	public function excel_export($patients, $from, $to, $cause_type_format, $cause_description)
	{
		 $excel  = "<table border=\"1\">";
      $excel .= "<thead>";
      $excel .= "<tr><th colspan=\"5\">Mortality Cases Report</th></tr>";
      $excel .= "<tr><th colspan=\"3\">Options:</th><th colspan=\"2\">Date:</th></tr>";
      $excel .= "<tr><th colspan=\"3\">".$cause_type_format.": ".$cause_description." </th><th>from: ".$from."</th><th>to: ".$to." </th></tr>";

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

      $filename = 'Mortality_Case_'.date('Ymd', strtotime($from)).'_'.date('Ymd', strtotime($to)).'.xls';

      header("Content-Disposition: attachment; filename=\"$filename\"");
      header("Content-Type: application/vnd.ms-excel");
      print $excel;
	}


	public function death_print($request)
	{
		$from = $request->from;
		$to   = $request->to;
		$query = $this->patient->whereIn('id', function($query) use ($from , $to){
		$query->select('patient_id')
				->from('mortality')
				->where('date_of_death', '>=', date('Y-m-d', strtotime($from)))->where('date_of_death', '<=', date('Y-m-d', strtotime($to)));
		});
		$patients = $query->get();

		if($request->has('excel'))
		{
			return $this->death_excel($from, $to, $patients);
		}

		return compact('from', 'to','patients');
	}



}
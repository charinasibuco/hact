<?php

namespace Hact\Report\Infection;

use Hact\RepositoryInterface;
use Hact\Repository;
use App\Infections;
use App\Patient;
use DB;
use Auth;

class ReportInfectionRepository extends Repository  {

	private $patient;
	private $infection;

	 function __construct(Patient $patient,Infections $infection){

		$this->patient = $patient;
		$this->infection = $infection;
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
		$years = Infections::select(DB::raw('YEAR(result_date) AS result_year'))->groupBy('result_year')->orderBy('result_year', 'DEC')->lists('result_year', 'result_year');
        $data = compact('years');
        return $data;

	}

	public function results_print($request)
	{
		$doctor = Auth::user()->id;
        $access = Auth::user()->access;
        //$result = $this->getResultType($request->result);
        $present_infections = $request->present_infections;
        //dd($present_infections);
        $from = $request->from;
        $to = $request->to;


        $query = Patient::whereIn('id', function($query) use ($present_infections, $from, $to){
                    $query->select('patient_id')->from('infections')->whereRaw('infections.patient_id = patient.id')
                            ->where('result_date', '>=', date('Y-m-d', strtotime($from)))
                            ->where('result_date', '<=', date('Y-m-d', strtotime($to)));
                            if(isset($present_infections))
                            {

                                $row_num = 1;
                                foreach($present_infections as $row)
                                {
                                    if($row_num == 1)
                                    {
                                        $query->where($row,'!=','');
                                    }
                                    else
                                    {
                                        $query->orWhere($row,'!=','');
                                    }

                                    $row_num++;
                                }
                            }
                    });

        if($access == 2)
        {
            $patients = $query->whereIn('patient_id', function($query) use ($doctor){
                $query->select('patient_id')->from('patient_doctor')->where('user_id', $doctor)->where('active', 1);
            });
        }

        $patients = $query->get();

        $present_infections_format = [];

        if(isset($present_infections))
        {
            foreach($present_infections as $row)
            {
                if($row=='hepatitis_b')
                {
                    $present_infections_format[] = 'Hepatitis B';
                }
                if($row=='hepatitis_c')
                {
                    $present_infections_format[] = 'Hepatitis C';
                }
                 if($row=='pneumocystis_pneumonia')
                {
                    $present_infections_format[] = 'Pneumocystis Pneumonia';
                }
                 if($row=='orpharyngeal_candidiasis')
                {
                    $present_infections_format[] = 'Orpharyngeal Candidiasis';
                }
                 if($row=='syphilis')
                {
                    $present_infections_format[] = 'Syphilis';
                }
                 if($row=='stis')
                {
                    $present_infections_format[] = 'STIs';
                }
                 if($row=='others')
                {
                    $present_infections_format[] = 'Others';
                }
            }
        }

        if($request->has('excel'))
        {
            return $this->excel($patients, $present_infections_format, $from, $to);
        }
       
        return $data = compact('patients','present_infections_format','from','to');
	}

	public function excel($patients, $present_infections_format, $from, $to)
	{
	  $excel  = "<table border=\"1\">";
      $excel .= "<thead>";

      $excel .= "<tr><th colspan=\"5\">Report for Present Infections as of ".$from." to ".$to." </th></tr>";
      $excel .= "<tr>";
      if(count($present_infections_format)==0)
      {
        $infections = "All";
      }
      else
      {
        $infections = "";
        foreach ($present_infections_format as $row) {
          $infections .= $row."<br>";
        }
      }
      $excel .= "<th colspan=\"2\">Present Infections: </th><th colspan=\"3\">" . $infections . " </th>";
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

      $filename = 'Present_Infections_'.date('Ymd', strtotime($from)).'_'.date('Ymd', strtotime($to)).'.xls';
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        print $excel;


	}

	

}
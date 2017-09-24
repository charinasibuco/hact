<?php
namespace Hact\Report\VCT;

use Hact\Repository;
use Auth;
use App\Patient;
use App\ActivityLog;
use DB;

class VCTPrintRepository extends Repository
{
	public function model(){
		return 'App\VCT';
	}

	public function current_year($request){
		 $current_year   = $this->model->where('result', 1)
                             ->where( 'vct_date', 'LIKE', '%' . date('Y') . '%' )
                             ->orderBy('vct_date', 'ASC')
                             ->get();
        return $current_year;
	}
	public function current_record($request){
		$vct 	= $this->model->where('result', 1)
            	->orderBy('vct_date', 'ASC')
            	->get();
        return $vct; 
	}

	public function getResults(){
		$years = $this->model->select(DB::raw('YEAR(vct_date) AS vct_year'))->where('result', 1)->groupBy('vct_year')->orderBy('vct_year', 'DEC')->lists('vct_year', 'vct_year');
		return $years;
	}

	public function getResultsView($request){
		$access     = Auth::user()->access;
        $doctor     = Auth::user()->id;
        #$result     = $this->getResultType($request->result);
        $from       = $request->from_date;
        $to         = $request->to_date;

        $query  =   $this->model->where(function($query) use ($from, $to){
                        $query->where('vct_date', '>=', date('Y-m-d', strtotime($from)))->where('vct_date', '<=', date('Y-m-d', strtotime($to)));
                    });

        if($request->result == '')
        {
            $query = $query->whereIn('result', [0,1,2,3]);
        }
        else
        {
            $query = $query->where('result',$request->result);
        }

        if($access == 2)
        {
            $vct = $query->whereIn('patient_id', function($query) use ($doctor){
                            $query->select('patient_id')->from('patient_doctor')->where('user_id', $doctor);
                        });
        }

        $vct = $query->orderBy('vct_date', 'ASC')->get();

        return $vct;
      
	}
	public function printScheduled($request){
		$access     = Auth::user()->access;
        $doctor     = Auth::user()->id;
        $from   = $request->from;
        $to     = $request->to;

        $query  = $this->model->distinct('patient_id')->where('result','!=', 2);

        if($access == 2)
        {
            $vct = $query->whereIn('patient_id', function($query) use ($doctor){
                            $query->select('patient_id')->from('patient_doctor')->where('user_id', $doctor);
                        });
        }

        $vct    = $query->orderBy('vct_date', 'ASC')->get();

        return $vct;
	}
	public function excel_scheduled($from, $to, $vct){
		$excel  = "<table border=\"1\">";
        $excel .= "<thead>";

        $excel .= "<tr>";
        $excel .= "<th>Code Name</th>";
        $excel .= "<th>Age</th>";
        $excel .= "<th>Sex</th>";
        $excel .= "<th>SACCL</th>";
        $excel .= "<th>UIC</th>";
        $excel .= "<th>Last VCT</th>";
        $excel .= "<th>Next VCT</th>";
        $excel .= "</tr>";

        $excel .= "</thead>";

        $excel .= "<tbody>";
        foreach ($vct as $row)
        {
            if($row->total_vct_record == 1)
            {
                $next_vct = date('Y-m-d', strtotime("+90 days", strtotime($row->last_vct_record->vct_date)));

                if($next_vct >= date('Y-m-01', strtotime($from)) && $next_vct <= date('Y-m-t', strtotime($to)))
                {
                    $excel .= "<tr>";
                    $excel .= "<td>" . $row->Patient->code_name . "</td>";
                    $excel .= "<td>" . $row->Patient->age . "</td>";
                    $excel .= "<td>" . $row->Patient->gender_format . "</td>";
                    $excel .= "<td>" . $row->Patient->saccl_code . "</td>";
                    $excel .= "<td>" . $row->Patient->ui_code . "</td>";
                    $excel .= "<td>" . $row->last_vct_record->vct_date . "</td>";
                    $excel .= "<td>" . $next_vct . "</td>";
                    $excel .= "</tr>";
                }
            }
            else
            {
                $next_vct = date('Y-m-d', strtotime("+180 days", strtotime($row->last_vct_record->vct_date)));

                if($next_vct >= date('Y-m-01', strtotime($from)) && $next_vct <= date('Y-m-t', strtotime($to)))
                {
                    $excel .= "<tr>";
                    $excel .= "<td>" . $row->Patient->ui_code . "</td>";
                    $excel .= "<td>" . $row->Patient->code_name . "</td>";
                    $excel .= "<td>" . $row->Patient->nationality . "</td>";
                    $excel .= "<td>" . $row->Patient->gender_format . "</td>";
                    $excel .= "<td>" . $row->last_vct_record->vct_date . "</td>";
                    $excel .= "<td>" . $next_vct . "</td>";
                    $excel .= "</tr>";
                }
            }
        }

        $excel .= "</tbody>";
        $excel .= "</table>";

        $filename = 'patient.xls';

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        print $excel;

	}
	public function excel_results($result, $vct){
		$excel  = "<table border=\"1\" >";
        $excel .= "<thead>";

        $excel .= "<tr>";
        $excel .= "<th colspan=\"5\">VCT Results for " . $result . " Patients</th>";
        $excel .= "</tr>";
        $excel .= "<tr>";
        $excel .= "<th width='20%'>Code Name</th>";
        $excel .= "<th width='10%'>Age</th>";
        $excel .= "<th width='10%'>Sex</th>";
        $excel .= "<th width='15%'>SACCL</th>";
        $excel .= "<th width='25%'>UIC</th>";
        $excel .= "<th width='20%'>VCT Date</th>";
        $excel .= "</tr>";

        $excel .= "</thead>";

        $excel .= "<tbody>";

        foreach ($vct as $row)
        {
            $excel .= "<tr>";
            $excel .= "<td>" . $row->Patient->code_name . "</td>";
            $excel .= "<td>" . $row->Patient->age . "</td>";
            $excel .= "<td>" . $row->Patient->gender_format . "</td>";
            $excel .= "<td>" . $row->Patient->saccl_code . "</td>";
            $excel .= "<td>" . $row->Patient->ui_code . "</td>";
            $excel .= "<td>" . $row->vct_date . "</td>";
            $excel .= "</tr>";
        }

        $excel .= "</tbody>";
        $excel .= "</table>";

        $filename = $result.'_VCTResults.xls';

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        print $excel;
	}
	public function find($id){

	}

    public function create($id){

    }

    public function store($input, $request){

    }

    public function edit($id){

    }

    public function update($request, $id, $input){

    }

    public function destroy($id){

    }

    public function search($string){

    }
}
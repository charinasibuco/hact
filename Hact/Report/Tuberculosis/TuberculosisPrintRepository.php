<?php 
namespace Hact\Report\Tuberculosis;

use Hact\Repository;
use Auth;
use App\TuberculosisModel;
use DB;
use App\Patient;

class TuberculosisPrintRepository extends Repository{

	public function model(){
		return 'App\Patient';
	}

	public function getResultsView($request){
		$result     = $request->result;
        $tx_outcome = $request->tx_outcome;
        $from       = $request->from;
        $to         = $request->to;

        if($tx_outcome == 0)
        {
          $query = Patient::whereIn('id', function($query) use ($result, $tx_outcome, $from, $to){
                    $query->select('patient_id')->from('tb_information')->whereRaw('tb_information.patient_id = patient.id')
                            ->where('tb_status', $result)
                            ->where('date_started', '>=', date('Y-m-d', strtotime($from)))
                            ->where('date_started', '<=', date('Y-m-d', strtotime($to)));
                            });
        }
        else
        {
          $query = Patient::whereIn('id', function($query) use ($result, $tx_outcome, $from, $to){
                    $query->select('patient_id')->from('tb_information')->whereRaw('tb_information.patient_id = patient.id')
                            ->where('tb_status', $result)
                            ->where('tx_outcome', $tx_outcome)
                            ->where('date_started', '>=', date('Y-m-d', strtotime($from)))
                            ->where('date_started', '<=', date('Y-m-d', strtotime($to)));
                    
                            });
        }

        return $query->get();
	}
	public function excel($patient, $result, $tx_outcome, $from, $to){
		$excel  = "<table border=\"1\">";
	      $excel .= "<thead>";

	      $excel .= "<tr><th colspan=\"7\">Tuberculosis Report as of ".$from." to ".$to." </th></tr>";

	      $excel .= "<tr><th colspan=\"3\">Tuberculosis Status: </th><th colspan=\"4\">" . $result . " </th></tr>";

	      if($result == "With Active TB")
	      {
	        $excel .= "<tr><th colspan=\"3\">Tx Outcome: </th><th colspan=\"4\">" . $tx_outcome . " </th></tr>";
	      }

	      $excel .= "<tr>";
	        $excel .= "<th width='15%'>Code Name</th>";
	        $excel .= "<th width='10%'>Age</th>";
	        $excel .= "<th width='15%'>Sex</th>";
	        $excel .= "<th width='15%'>SACCL</th>";
	        $excel .= "<th width='15%'>UIC</th>";
	        $excel .= "<th width='15%'>Date Started</th>";
	        $excel .= "<th width='15%'>Tx Outcome Date</th>";
	        $excel .= "</tr>";

	        $excel .= "</thead>";

	        $excel .= "<tbody>";

	        foreach ($patient as $row)
	        {
	            $excel .= "<tr>";
	            $excel .= "<td>" . $row->code_name . "</td>";
	            $excel .= "<td>" . $row->age . "</td>";
	            $excel .= "<td>" . $row->gender_format . "</td>";
	            $excel .= "<td>" . $row->saccl_code . "</td>";
	            $excel .= "<td>" . $row->ui_code . "</td>";
	            $excel .= "<td>" . $row->Tuberculosis->first()->date_started . "</td>";
	            $excel .= "<td>" . $row->Tuberculosis->reverse()->first()->tx_date_outcome. "</td>";
	            $excel .= "</tr>";
	        }

	        $excel .= "</tbody>";
	      $excel .= "</table>";

	      $filename = 'Tuberculosis_Report_'.date('Y-m-d', strtotime($from)).'_'.date('Y-m-d', strtotime($to)).'.xls';

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
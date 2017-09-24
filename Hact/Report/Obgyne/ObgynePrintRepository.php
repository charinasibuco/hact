<?php
namespace Hact\Report\Obgyne;

use Hact\Repository;
use Auth;
use App\VCT;
use DB;
use App\ObGyne;
use Carbon\Carbon;

class ObgynePrintRepository extends Repository
{
	public function model(){
		$this->user =  Auth::user();
		return 'App\ObGyne';
	}
	public function getResultsView($request){
		$result = $request->result;
        $from   = $request->from_date;
        $to     = $request->to_date;

        $obgyne    =  $this->model->where('currently_pregnant', $result)
                    ->leftJoin('patient','patient.id','=','ob.patient_id')
                    ->where('patient.gender','=','0')
                    ->select('ob.*')
                    ->where(function($query) use ($from, $to){
                        $query->where('ob.updated_at', '>=', date('Y-m-d', strtotime($from)))->where('ob.updated_at', '<=', date('Y-m-d', strtotime($to)));
                    })
                    ->orderBy('ob.updated_at', 'ASC')
                    ->get();

       return $obgyne;
        
	}
    public function excel($obgyne, $result, $from, $to){
        $excel  = "<table border=\"1\">";
      $excel .= "<thead>";

      $excel .= "<tr><th colspan=\"5\">OBGyne Summary Report as of ".$from." to ".$to." </th></tr>";
      $excel .= "<tr>";

      $excel .= "<th colspan=\"2\">Currently Pregnant: </th><th colspan=\"3\">" . $result . " </th>";
      $excel .= "</tr>";

      $excel .= "<tr>";
      $excel .= "<th>UI Code</th>";
      $excel .= "<th>SACCL</th>";
      $excel .= "<th>Code Name</th>";
      $excel .= "<th>Nationality</th>";
      $excel .= "<th>Gender</th>";
      $excel .= "</tr>";

      $excel .= "</thead>";

      $excel .= "<tbody>";
      foreach ($obgyne as $row)
      {
          $excel .= "<tr>";
          $excel .= "<td>" . (($row->Patient) ? $row->Patient->ui_code : '') . "</td>";
          $excel .= "<td>" . (($row->Patient) ? $row->Patient->saccl_code : '' ) . "</td>";
          $excel .= "<td>" . (($row->Patient) ? $row->Patient->code_name : '' ). "</td>";
          $excel .= "<td>" . (($row->Patient) ? $row->Patient->nationality : '' ). "</td>";
          $excel .= "<td>" . (($row->Patient) ? $row->Patient->gender_format :''). "</td>";
          $excel .= "</tr>";
      }

      $excel .= "</tbody>";
      $excel .= "</table>";

      $filename = 'OBGyne_Summary_'.date('Y-m-d', strtotime($from)).'_'.date('Y-m-d', strtotime($to)).'.xls';

      header("Content-Disposition: attachment; filename=\"$filename\"");
      header("Content-Type: application/vnd.ms-excel");
      print $excel;
    }

    public function getChildbirthView($request){
        $result = 1;
        $from   = $request->from_date;
        $to     = $request->to_date;

        $obgyne    =  $this->model->where('currently_pregnant', $result)
                    ->where('if_delivered_date', '>=', date('Y-m-d', strtotime($from)))
                    ->where('if_delivered_date', '<=', date('Y-m-d', strtotime($to)))
                    ->orderBy('if_delivered_date', 'ASC')
                    ->get();
      return $obgyne;
    }
    public function getChildbirthExcel($obgyne, $result, $from, $to){
      $excel  = "<table border=\"1\">";
      $excel .= "<thead>";

      $excel .= "<tr><th colspan=\"5\">OBGyne Childbirth Report as of ".$from." to ".$to." </th></tr>";

      $excel .= "<tr>";
      $excel .= "<th>UI Code</th>";
      $excel .= "<th>SACCL</th>";
      $excel .= "<th>Code Name</th>";
      $excel .= "<th>Nationality</th>";
      $excel .= "<th>Gender</th>";
      $excel .= "</tr>";

      $excel .= "</thead>";

      $excel .= "<tbody>";
      foreach ($obgyne as $row)
      {
          $excel .= "<tr>";
          $excel .= "<td>" . $row->Patient->ui_code . "</td>";
          $excel .= "<td>" . $row->Patient->saccl_code . "</td>";
          $excel .= "<td>" . $row->Patient->code_name . "</td>";
          $excel .= "<td>" . $row->Patient->nationality . "</td>";
          $excel .= "<td>" . $row->Patient->gender_format . "</td>";
          $excel .= "</tr>";
      }

      $excel .= "</tbody>";
      $excel .= "</table>";

      $filename = 'OBGyne_Childbirth_Report_'.date('Y-m-d', strtotime($from)).'_'.date('Y-m-d', strtotime($to)).'.xls';

      header("Content-Disposition: attachment; filename=\"$filename\"");
      header("Content-Type: application/vnd.ms-excel");
      print $excel;
    }
    public function chart($request){
        $i                  = 0;
        $data               = [];
        $months             = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $date               = Carbon::now();
        $data['year']       = $date->year;
        $data['categories'] = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $range              = [];
        foreach ($months as $month)
        {
            $from           = Carbon::createFromTimestamp(strtotime(date($data['year'] . '-' . $month . '-1')))->format('Y-m-d');
            $to             = Carbon::createFromTimestamp(strtotime(date($data['year'] . '-' . $month . '-d')))->format('Y-m-t');
            $range          = ['from' => $from, 'to' => $to];

            $pregnant       = ObGyne::where(function($query) use($from, $to){

                $query->where('if_delivered_date','>=', $from)->where('if_delivered_date','<=',$to);
            })
                ->where('currently_pregnant', '=', 1)
                ->count();


            $non_pregnant   = ObGyne::where(function($query) use($from, $to){

                $query->where('if_delivered_date','>=', $from)->where('if_delivered_date','<=',$to);
            })
                ->where('currently_pregnant', '=', 0)
                ->count();
            $data['pregnant'][$i]       = $pregnant;
            $data['nonpregnant'][$i]    = $non_pregnant;
            $data['range'][$i]          = $range;
            $i++;
        }

        return $data;
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
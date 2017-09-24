<?php 
namespace Hact\Report\Patient;

use Carbon\Carbon;
use Hact\Repository;
use Auth;
use App\VCT;
use DB;
use App\Patient;
use App\ARV;
use App\Mortality;

class PatientPrintRepository extends Repository{

	public function model(){
		$this->user =  Auth::user();
		return 'App\Patient';
	}

	public function patient(){
		$years = VCT::select(DB::raw('YEAR(vct_date) AS vct_year'))->where('result', 1)->groupBy('vct_year')->orderBy('vct_year', 'DEC')->lists('vct_year', 'vct_year');
		return $years;
	}

	public function patient_print($request){
		$access     = Auth::user()->access;
        $doctor     = Auth::user()->id;
        $gender     = $request->gender;


        $query = $this->model->whereIn('id', function($query){
                    $query->select('patient_id')->from('vct');
                });

        if($access == 2)
        {
            $patients = $query->whereIn('id', function($query) use ($doctor){
                            $query->select('patient_id')->from('patient_doctor')->where('user_id', $doctor)->where('active', 1);
                        });
        }

        if($gender == 2)
        {
            $patients = $query->get();
        }
        else
        {
            $patients = $query->where('gender', $gender)->get();
        }
        return $patients;
	}
	public function excel($patients)
	{
		$excel  = "<table border=\"1\">";
        $excel .= "<thead>";
        $excel .= "<tr>";
        $excel .= "<th>UI Code</th>";
        $excel .= "<th>SACCL</th>";
        $excel .= "<th>Code Name</th>";
        $excel .= "<th>Nationality</th>";
        $excel .= "<th>Gender</th>";
        $excel .= "</tr>";
        $excel .= "</thead>";

        $excel .= "<tbody>";
        foreach ($patients as $row)
        {
            $excel .= "<tr>";
            $excel .= "<td>" . $row->ui_code . "</td>";
            $excel .= "<td>" . $row->saccl_code . "</td>";
            $excel .= "<td>" . $row->code_name . "</td>";
            $excel .= "<td>" . $row->nationality . "</td>";
            $excel .= "<td>" . $row->gender_format . "</td>";
            $excel .= "</tr>";
        }

        $excel .= "</tbody>";
        $excel .= "</table>";

        $filename = 'Patients.xls';

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        print $excel;

	}
	public function master_list($request){
		$patients = $this->model->join('vct','vct.patient_id','=','patient.id')
                              ->where('vct.result',2)->select('patient.*')->get();
        $patient_number = 1;

        foreach($patients as $row)
        {
          $row->outcome = (is_object($row->Mortality) ? 'Death':(is_object($row->ARV->first()) ? 'Alive on ARV':'Alive, not on ARV'));
        }
        return $patients;
	}
	public function master_list_excel($patients, $patient_number){
		$excel  = "<table border=\"1\">";
        $excel .= "<thead><tr>";
        $excel .= "<th></th>";
        $excel .= "<th>Code Name</th>";
        $excel .= "<th>SACCL Code</th>";
        $excel .= "<th>UI Code</th>";
        $excel .= "<th>Date of Birth</th>";
        $excel .= "<th>Sex</th>";
        $excel .= "<th>Age</th>";
        $excel .= "<th>PhilHealth Number</th>";
        $excel .= "<th>Attending Physician</th>";
        $excel .= "<th>Address</th>";
        $excel .= "<th>Date of Initial Contact</th>";
        $excel .= "<th>Date of Western BLOT</th>";
        $excel .= "<th>Date of Enrolment</th>";
        $excel .= "<th>ARV Regimen</th>";
        $excel .= "<th>ARV Start Date</th>";
        $excel .= "<th>ARV Stop Date</th>";
        $excel .= "<th>Reason for Discontinuing ARV</th>";
        $excel .= "<th>Outcome</th>";
        $excel .= "<th>Date of Last Follow-up</th>";
        $excel .= "<th>Date of Next Pick Up</th>";
        $excel .= "</tr></thead>";
        $excel .= "<tbody>";
        foreach($patients as $row)
        {
          if($row->is_mortality == 0)
          {
            $excel .= "<tr>";
          }
          else
          {
            $excel .= "<tr style='background-color:#de770f'>";
          }
          $excel .= "<td>".$patient_number."</td>";
          $excel .= "<td>".$row->code_name."</td>";
          $excel .= "<td>".$row->saccl_code."</td>";
          $excel .= "<td>".$row->ui_code."</td>";
          $excel .= "<td>".$row->birth_date->format('m/d/Y')."</td>";
          $excel .= "<td>".(($row->gender == 1)?'Male':'Female')."</td>";
          $excel .= "<td>".$row->age."</td>";
          $excel .= "<td>".$row->phil_health_number."</td>";
          $excel .= "<td>".$row->VCT->first()->last_assigned_doctor_name or '-'."</td>";
          $excel .= "<td>".$row->permanent_address."</td>";              
          $initial_contact = ($row->VCT->where('result',2)->first()) ? Carbon::parse($row->VCT->where('result',2)->first()->vct_date)->format('m/d/Y'):'-';
          $excel .= "<td>".$initial_contact."</td>";
          $western_blot = (isset($row->ConfirmatoryDate)? Carbon::parse($row->ConfirmatoryDate->confirmatory_date)->format('m/d/Y') : '-') ;
          $excel .= "<td>".$western_blot."</td>";
          $enrolment = isset($row->VCT->where('result',2)->reverse()->first()->vct_date) ? Carbon::parse($row->VCT->where('result',2)->reverse()->first()->vct_date)->format('m/d/Y') : '-';
          $excel .= "<td>".$enrolment."</td>";
          $excel .= "<td>";
          if($row->ARV->first() != null)
          {
            $excel .= "<ul>";
                foreach($row->ARV->reverse()->first()->ARVItems as $arv)
                  {
                    $excel .= "<li>".(($arv->Medicine) ? $arv->Medicine->name : '-')."</li>";
                  }
            $excel .= "</ul>";
          }
          else
          {
            $excel .= '-';
          }
          $excel .= "</td>";
          $excel .= "<td>";
          if(is_object($row->ARV->first()))
          {
            $excel .= "<ul>";
                foreach($row->ARV->reverse()->first()->ARVItems as $arv)
                  {
                    $excel .= "<li>".$arv->date_started->format('m/d/Y')."</li>";
                  }
            $excel .= "</ul>";
          }
          else
          {
            $excel .= '-';
          }
          $excel .= "</td>";
          $excel .= "<td>";
          if(is_object($row->ARV->first()))
          {
            $excel .= "<ul>";
                foreach($row->ARV->reverse()->first()->ARVItems as $arv)
                  {
                    $excel .= "<li>".(($arv->date_discontinued != null) ? Carbon::parse($arv->date_discontinued)->format('m /d/Y') : '')."</li>";
                  }
            $excel .= "</ul>";
          }
          else
          {
            $excel .= '-';
          }
          $excel .= "</td>";
          $excel .= "<td>";
          if(is_object($row->ARV->first()))
          {
            $excel .= "<ul>";
                foreach($row->ARV->reverse()->first()->ARVItems as $arv)
                  {
                    $excel .= "<li>".$arv->reason."</li>";
                  }
            $excel .= "</ul>";
          }
          else
          {
            $excel .= '-';
          }
          $excel .= "</td>";

          $excel .= "<td>".$row->outcome."</td>";
          $excel .= "<td>".(isset($row->Checkup)?$row->Checkup->reverse()->first()->follow_up_date:'-')."</td>";
          $excel .= "<td>".(isset($row->VCT->first()->total_vct_record) ? date('Y-m-d', strtotime(($row->VCT->first()->total_vct_record == 1) ? "+90 days": "+180 days", strtotime($row->VCT->first()->last_vct_record->vct_date))) : '')."</td>";
          $excel .= "</tr>";
        
        $patient_number++;
        }
        $excel .= "</tbody>";
        $excel .= "</table>";

        $filename = 'patients_master_list.xls';

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        print $excel;
	}

  public function registry_index($request){
      $from = $request->from;
      $to = $request->to;     

      $patients = Patient::join('vct','patient.id','=','vct.patient_id')
                          ->where(function($query) use ($from,$to){
                            $query->where('vct.vct_date','>=',date('Y-m-d',strtotime($from)))
                            ->where('vct.vct_date','<=',date('Y-m-d',strtotime($to)));
                          })
                          ->select('patient.*')
                          ->orderBy('code_name','ASC')
                          ->get();
                  
      foreach( $patients as $row)
      {
        $hiv_risk = [];
        $risk_sw = VCT::join('patient','vct.patient_id','=','patient.id')
                        ->where('vct.patient_id','=',$row->id)
                        ->where('vct.experience_8',1)
                        ->first();
        
        if(is_object($risk_sw))
        {
          array_push($hiv_risk, "SW");
        }

        $risk_msm = VCT::join('patient','vct.patient_id','=','patient.id')
                              ->where('vct.patient_id','=',$row->id) 
                              ->where('patient.gender',1)
                              ->where('vct.experience_6', 1)
                              ->first();

        if(is_object($risk_msm))
        {
          array_push($hiv_risk, "MSM");
        }

        $risk_idu = VCT::join('patient','vct.patient_id','=','patient.id')
                              ->where('vct.patient_id','=',$row->id) 
                              ->where(function($query){
                                  $query->where('reason_3',1)
                                    ->orWhere('experience_2',1);
                                })
                              ->first();

        if(is_object($risk_idu))
        {
          array_push($hiv_risk, "IDU");
        }

        $risk_oe = VCT::join('patient','vct.patient_id','=','patient.id')
                              ->where('vct.patient_id','=',$row->id) 
                              ->where('experience_3',1)
                              ->first();

        if(is_object($risk_oe))
        {
          array_push($hiv_risk, "OE");
        }

        $row->hiv_risk = $hiv_risk;

        $patient_id = $row->id; 
        $row->arv  = ARV::where('patient_id','=', $patient_id)->get();

      }
      // //dd($patients);
      // if($request->has('excel'))
      //   {
      //       $this->registry_excel($patients, $from, $to);
      //   }
      //   else
      //   {
      //    $data = compact('patients');
      //   return view('hact.reports.patient.patient_registry',$data);
      //   }
      return $patients;
  }
  public function registry_excel($patients, $from, $to){
        $excel  = "<table border=\"1\">";
        $excel .= "<thead colspan='13'><tr><td colspan='13'><center>HIV Care Monthly Report</center></td></tr>";
        $excel .= "<tr><td colspan='13'><center>CORAZON LOCSIN MONTELIBANO MEMORIAL REGIONAL HOSPITAL</center></td></tr>";
        $excel .= "<tr><td colspan='13'><center>".$from." - ".$to."</center></td></tr>";

        foreach($patients as $row)
        {
          $death = Mortality::find($row->id);

          if(is_null($death))
          {
              $today = date("Y-m-d");
          }
          else
          {
              $today = $death->date_of_death;
          }

//            $bdate = $row->birth_date->format()

//          $age   = floor($today - $row->birth_date /(365.25 * 24 * 60 * 60 * 1000)-$row->birth_date);
        }
        $excel .= "<tbody>";

        $excel .= "<tr>";
        $excel .= "<th>Date Consult</th>";
        $excel .= "<th>Code Name</th>";
        $excel .= "<th>Age</th>";
        $excel .= "<th>Sex</th>";
        $excel .= "<th>Code(UIC)</th>";
        $excel .= "<th>Date of Birth</th>";
        $excel .= "<th>Address</th>";
        $excel .= "<th>HIV Risks (SW, Client of SW, MSM, IDU,OE)</th>";
        $excel .= "<th>Tested for HIV</th>";
        $excel .= "<th>Positive for HIV</th>";
        $excel .= "<th>Provided Post-test Counseling and HIV Result </th>";
        $excel .= "<th>Provided PEP</th>";
        $excel .= "<th>Date of Follow-up</th>";
        $excel .= "</tr>";
        foreach($patients as $row)
        {
          $excel .= "<tr>";
          $excel .= "<td>".(isset($row->VCT->first()->vct_date)?$row->VCT->first()->vct_date: 'None')."</td>";
          $excel .= "<td>".$row->code_name."</td>";
          $excel .= "<td>".$row->age."</td>";
          $excel .= "<td>".(($row->gender == 1)?'Male':'Female')."</td>";
          $excel .= "<td>".$row->ui_code."</td>";
          $excel .= "<td>".$row->birth_date."</td>";
          $excel .= "<td>".$row->current_city."</td>";
          $excel .= "<td>";
          foreach($row->hiv_risk as $risk)
          {
            $excel .= $risk.", ";
          }
          $excel .= "</td>";
          $excel .= "<td>".(isset($row->VCT->first()->result) ? (($row->VCT->first()->result != '' || $row->VCT->first()->result >= 0) ?  'Yes':'No') : 'No')."</td>";
          $excel .= "<td>".(isset($row->VCT->first()->result) ? (($row->VCT->first()->result == 2) ?  'Yes':'No') : 'No') ."</td>";
          $excel .= "<td>".(isset($row->VCT->first()->result) ? (($row->VCT->first()->result != '' || $row->VCT->first()->result >= 0) ?  'Yes':'No') : 'No')."</td>";
          $excel .= "<td>".(isset($row->arv->first()->patient_id) ? (($row->arv->first()->patient_id) ? 'Yes': 'No') : 'No')."</td>";
          if($row->VCT->where('result', 2)->count() < 1)
          {         
            $excel .= "<td>".(isset($row->VCT->first()->total_vct_record) ? date('Y-m-d', strtotime(($row->VCT->first()->total_vct_record == 1) ? "+90 days": "+180 days", strtotime($row->VCT->first()->last_vct_record->vct_date))) : '') ."</td>";
          }
          else
          {
            $excel .= "<td></td>";
          }
        }

        $filename = 'patients_registry '.date('Y-m-d',strtotime($from)).' to '.date('Y-m-d',strtotime($to)).'.xls';

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
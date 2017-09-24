<?php

namespace Hact\Report\ART;

use Hact\Repository;
use App\Patient;
use App\MedicineModel;
use App\ARVItems;

class ReportARTRepository extends Repository  {

	private $patient;
	private $medicine;
	private $arv;

	 /**
	  * Injecting necessary dependencies
	  *
	  * @param      Patient        $patient   (description)
	  * @param      MedicineModel  $medicine  (description)
	  * @param      ARVItems       $arv       (description)
	  */
	 function __construct(Patient $patient,MedicineModel $medicine,ARVItems $arv){

		$this->patient = $patient;
		$this->medicine = $medicine;
		$this->arv = $arv;
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
		// return $this->user->create($data);
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
		// $user = $this->user->find($id);
        // return $user->delete();
	}

	public function print_results($request)
	{
		$from = $request->from;
        $to = $request->to;
        $plhiv_art = $this->patient->join('vct','vct.patient_id','=','patient.id')
                            ->join('arv','arv.patient_id','=','patient.id')
                            ->join('arv_items','arv.id','=','arv_items.arv_id')
                            ->join('medicines','arv_items.medicine_id','=','medicines.id')
                            ->where('vct.result', 2)
                            ->where(function($query) use ($from, $to)
                            {
                                $query->where('arv_items.date_discontinued','>',date('Y-m-d',strtotime($from)))
                                        ->orWhere('arv_items.date_discontinued',null);
                            })
                            ->select('patient.*')
                            ->distinct()
                            ->get();

        $plhiv_art_count = $this->patient->join('vct','vct.patient_id','=','patient.id')
                            ->join('arv','arv.patient_id','=','patient.id')
                            ->join('arv_items','arv.id','=','arv_items.arv_id')
                            ->join('medicines','arv_items.medicine_id','=','medicines.id')
                            ->where('vct.result', 2)
                            ->where(function($query) use ($from, $to)
                            {
                                $query->where('arv_items.date_discontinued','>',date('Y-m-d',strtotime($from)))
                                        ->orWhere('arv_items.date_discontinued',null);
                            })
                            ->select('patient.*')
                            ->distinct()
                            ->count();

        $plhiv_art_pregnant_count = $this->patient->where('is_presently_pregnant', 1)
                            ->join('vct','vct.patient_id','=','patient.id')
                            ->join('arv','arv.patient_id','=','patient.id')
                            ->join('arv_items','arv.id','=','arv_items.arv_id')
                            ->join('medicines','arv_items.medicine_id','=','medicines.id')
                            ->where('vct.result', 2)
                            ->where(function($query) use ($from, $to)
                            {
                                $query->where('arv_items.date_discontinued','>',date('Y-m-d',strtotime($from)))
                                        ->orWhere('arv_items.date_discontinued',null);
                            })
                            ->select('patient.*')
                            ->distinct()
                            ->count();

        $plhiv_art_start_count = $this->patient->join('vct','vct.patient_id','=','patient.id')
                            ->join('arv','arv.patient_id','=','patient.id')
                            ->join('arv_items','arv.id','=','arv_items.arv_id')
                            ->join('medicines','arv_items.medicine_id','=','medicines.id')
                            ->where('vct.result', 2)
                            ->whereBetween('arv_items.date_started',[date('Y-m-d',strtotime($from)),date('Y-m-d',strtotime($from))])
                            ->select('patient.*')
                            ->distinct()
                            ->count();

        $age_range = [];
        $age_range['1'] = 0;
        $age_range['1-14'] = 0;
        $age_range['15-17'] = 0;
        $age_range['18'] = 0;
        foreach($plhiv_art as $row)
        {
            if($row->age < 1){ $age_range['1']++; }
            if($row->age >= 1 && $row->age <= 14){ $age_range['1-14']++; }
            if($row->age >= 15 && $row->age <= 17){ $age_range['15-17']++; }
            if($row->age >= 18){ $age_range['18']++; }
        }

        $regimens = $this->medicine->where('classification', 1)->get();
        foreach($regimens as $row)
        {
            $row->count = $this->arv->where(function($query) use ($from, $to)
                            {
                                $query->where('date_discontinued','>',date('Y-m-d',strtotime($from)))
                                        ->orWhere('date_discontinued',null);
                            })
                                ->where('medicine_id', $row->id)
                                ->count();
        }

        $outcome = [];
        $outcome['died'] = $this->patient->join('mortality','patient.id','=','mortality.patient_id')
                                            ->where('date_of_death','>=',date('Y-m-d',strtotime($from)))
                                            ->where('date_of_death','<=',date('Y-m-d',strtotime($to)))
                                            ->count();

        $outcome['missing'] = $this->patient->join('checkup','checkup.patient_id','=','checkup.id')
                                            ->where('follow_up_date','>=',date('Y-m-d',strtotime($from)))
                                            ->where('follow_up_date','<=',date('Y-m-d',strtotime($to)))
                                            ->whereNotBetween('checkup_date',[date('Y-m-d',strtotime($from)),date('Y-m-d',strtotime($to))])
                                            ->select('patient.*')
                                            ->distinct()
                                            ->count();

        $outcome['transferred_in'] = $this->patient->where('enrolment_date','>=',date('Y-m-d',strtotime($from)))
                                                ->where('enrolment_date','<=',date('Y-m-d',strtotime($to)))
                                                //->join('vct','vct.patient_id','=','patient.id')
                                                ->leftJoin('patient_transfer','patient_transfer.patient_id','=','patient.id')
                                                ->where('transfer','=',1)
                                                ->select('patient.*')
                                                ->distinct()
                                                ->count();
                                                
        $outcome['transferred_out'] = $this->patient->join('patient_transfer','patient_transfer.patient_id','=','patient.id')
                                                ->where('transfer','=',2)
                                                ->where('transfer_date','>=',date('Y-m-d',strtotime($from)))
                                                ->where('transfer_date','<=',date('Y-m-d',strtotime($to)))
                                                ->select('patient.*')
                                                ->distinct()
                                                ->count();

        $outcome['stopped_taking_arv'] = $this->patient->join('arv','arv.patient_id','=','patient.id')
                                                    ->join('arv_items','arv_items.arv_id','=','arv.id')
                                                    ->where('date_discontinued','>=',date('Y-m-d',strtotime($from)))
                                                    ->where('date_discontinued','<=',date('Y-m-d',strtotime($to)))
                                                    ->select('patient.*')
                                                    ->distinct()
                                                    ->count();

        $outcome['alive_on_arv'] = $this->patient->join('vct','vct.patient_id','=','patient.id')
                                            ->join('arv','arv.patient_id','=','patient.id')
                                            ->join('arv_items','arv.id','=','arv_items.arv_id')
                                            ->join('medicines','arv_items.medicine_id','=','medicines.id')
                                            ->where('vct.result', 2)
                                            ->where(function($query) use ($from, $to)
                                            {
                                                $query->where('arv_items.date_discontinued','>',date('Y-m-d',strtotime($from)))
                                                        ->orWhere('arv_items.date_discontinued',null);
                                            })
                                            ->select('patient.*')
                                            ->distinct()
                                            ->count();

        $outcome['alive_not_on_arv'] = $this->patient->join('vct','vct.patient_id','=','patient.id')
                                            ->leftJoin('arv','arv.patient_id','=','patient.id')
                                            ->where('vct.result', 2)
                                            ->where('arv.id',null)
                                            ->select('patient.*')
                                            ->distinct()
                                            ->count();

        //dd($outcome['alive_not_on_arv']);
        if($request->has('excel'))
        {
            return $this->excel_export($age_range,$from,$to,$regimens,$plhiv_art_pregnant_count,$plhiv_art_count,$plhiv_art_start_count,$outcome);
        }
      
        $data = compact('age_range','from','to','regimens','plhiv_art_pregnant_count','plhiv_art_count','plhiv_art_start_count','outcome');

       	return $data;

	}

	public function excel_export($age_range,$from,$to,$regimens,$plhiv_art_pregnant_count,$plhiv_art_count,$plhiv_art_start_count,$outcome)
	{
		$excel  = "<table border=\"1\" >";
      $excel .= "<thead>";

      $excel .= "<tr>";
      $excel .= "<td colspan ='3'> Monthly ART Registry Report </td>";
      $excel .= "</tr><tr>";
      $excel .= "<td colspan ='3'> CORAZON LOCSIN MONTELIBANO MEMORIAL REGIONAL HOSPITAL </td>";
      $excel .= "</tr><tr>";
      $excel .= "<td colspan ='3'> ".$from.' - '.$to." HOSPITAL </td>";
      $excel .= "</tr><tr>";
      $excel .= "<td colspan ='3'></td>";
      $excel .= "</tr><tr></thead>";
      $excel .= "<tbody>";

      $excel .= "<tr><td colspan='2'>Total No. of PLHIV on ART during reporting period</td>";
      $excel .= "<td colspan='1'>".$plhiv_art_count."</td></tr>";

      $excel .= "<tr><td colspan='1'></td>";
      $excel .= "<td colspan='1'>1 yo.</td>";
      $excel .= "<td colspan='1'>".$age_range['1']."</td></tr>";

      $excel .= "<tr><td colspan='1'></td>";
      $excel .= "<td colspan='1'>1-14 yo.</td>";
      $excel .= "<td colspan='1'>".$age_range['1-14']."</td></tr>";

      $excel .= "<tr><td colspan='1'></td>";
      $excel .= "<td colspan='1'>15-17 yo.</td>";
      $excel .= "<td colspan='1'>".$age_range['15-17']."</td></tr>";

      $excel .= "<tr><td colspan='1'></td>";
      $excel .= "<td colspan='1'>18 yo.</td>";
      $excel .= "<td colspan='1'>".$age_range['18']."</td></tr>";

      $excel .= "<tr><td colspan='2'>No. of PLHIV started on ART during reporting period</td>";
      $excel .= "<td colspan='1'>".$plhiv_art_start_count."</td></tr>";

      $excel .= "<tr><td colspan='2'>No. of new pregnant PLHIV on ART during reporting period</td>";
      $excel .= "<td colspan='1'>".$plhiv_art_pregnant_count."</td></tr>";

      $excel .= "<tr><td colspan='3'No. of PLHIV started on ART based on the following regimen</td></tr>"; 
      foreach($regimens as $row)
      {
        $excel .="<tr><td colspan='1'></td><td colspan='1'>".$row->name."</td><td colspan='1'>".$row->count."</td></tr>";
      }

      $excel .= "<tr><td colspan='1'>Outcome:</td><td colspan='2'></td></tr>";

      $excel .= "<tr><td colspan='1'></td><td colspan='1'>Died</td><td colspan='1'>".$outcome['died']."</td></tr>";
      $excel .= "<tr><td colspan='1'></td><td colspan='1'>Missing</td><td colspan='1'>".$outcome['missing']."</td></tr>";
      $excel .= "<tr><td colspan='1'></td><td colspan='1'>Transferred in</td><td colspan='1'>".$outcome['transferred_in']."</td></tr>";
      $excel .= "<tr><td colspan='1'></td><td colspan='1'>Transferred out</td><td colspan='1'>".$outcome['transferred_out']."</td></tr>";
      $excel .= "<tr><td colspan='1'></td><td colspan='1'>Stopped taking ARV</td><td colspan='1'>".$outcome['stopped_taking_arv']."</td></tr>";
      $excel .= "<tr><td colspan='1'></td><td colspan='1'>Alive on ARV</td><td colspan='1'>".$outcome['alive_on_arv']."</td></tr>";
      $excel .= "<tr><td colspan='1'></td><td colspan='1'>Alive not on ARV</td><td colspan='1'>".$outcome['alive_not_on_arv']."</td></tr>";

      $excel .= "</tbody></table>";

      $filename = 'montthly_art_report_'.date('Y-m-d',strtotime($from)).'-'.date('Y-m-d',strtotime($to)).'.xls';

      header("Content-Disposition: attachment; filename=\"$filename\"");
      header("Content-Type: application/vnd.ms-excel");
      return print $excel;
	}


}
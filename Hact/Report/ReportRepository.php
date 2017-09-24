<?php

namespace Hact\Report;

use App\MedicineInventory;
use Hact\medicine\MedicineInventoryRepository;
use App\ARVItems;
use Hact\Repository;
use App\Prescription;
use DB;

class ReportRepository extends Repository  {

	private $prescription;

	 function __construct(Prescription $prescription){

		$this->prescription = $prescription;
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
	
	}

	/**
	 * Export to excel format.
	 *
	 * @param      mixed  $request  instance of 	Requests\ReprotsMedicineDispenseInfectionRequest
	 *
	 * @return     array
	 */
	public function infection_dispense_print($request)
	{
		$infection    = $request->infection;
        $infection_format    = $this->infection_values($request->infection);
        $patient_id   = $request->patient_id;

        $from         = $request->from;
        $to           = $request->to;

        $date_from    = date('Y-m-d', strtotime($request->from));
        $date_to      = date('Y-m-d', strtotime($request->to));

        $prescription = $this->prescription
        				->whereIn('arv_item_id', function($query) use ($infection){
                          $query->select('id')->from('arv_items')->where('infection', $infection);
                        })
                        ->where('date_dispense', '>=', $date_from)
                        ->where('date_dispense', '<=', $date_to)
                        ->get();

 
        if($request->has('excel'))
        {
          return $this->infection_dispense_excel($infection_format, $prescription);
        }else{
		   		$data = compact('infection_format', 'patient_id', 'from', 'to', 'prescription');

	        	return $data;
        }
       
     
	}

	public function getExpiredMedicines($request)
	{
		$from       = $request->from;
        $to         = $request->to;
        $dateFrom   = date('Y-m-d', strtotime($from));
        $dateTo     = date('Y-m-d', strtotime($to));

        $medicines   = MedicineInventory::where(function($query) use ($dateFrom, $dateTo){
                        $query->where('expiry_date', '>=', $dateFrom)->where('expiry_date', '<=', $dateTo);
                      })
                      ->orderBy('expiry_date', 'ASC')->get();
       
        $sort        = 'desc';

        if($request->has('excel'))
        {
            $this->excelExpiredMedicine($medicines, $from, $to);
        }
     
        return compact('medicines','sort','from','to');
	}

	public function excelExpiredMedicine($medicines,$from,$to)
	{
		$excel  = "<table border=\"1\">";
		$excel .= "<thead>";

		$excel .= "<tr><th colspan=\"6\">Expired Medicines as of ".$from." to ".$to." </th></tr>";

		$excel .= "<tr>";
		$excel .= "<th>DRUG DESCRIPTION &amp; FORMULATION</th>";
		$excel .= "<th>ITEM CODE</th>";
		$excel .= "<th>TABS per BOTTLE</th>";
		$excel .= "<th>EXPIRY DATE</th>";
		$excel .= "<th>LOT #</th>";
		$excel .= "<th>BOTTLE</th>";
		$excel .= "</tr>";

		$excel .= "</thead>";

		$excel .= "<tbody>";
		foreach ($medicines as $row)
		{
		$excel .= "<tr>";
		$excel .= "<td>" . $row->name . "</td>";
		$excel .= "<td>" . $row->item_code . "</td>";
		$excel .= "<td class=\"text-center\">" . $row->tabs_per_bottle . "</td>";
		$excel .= "<td>" . $row->expiry_date->format('M j Y') . "</td>";
		$excel .= "<td>" . $row->lot_number . "</td>";
		$excel .= "<td class=\"text-center\">" . $row->quantity . "</td>";
		$excel .= "</tr>";
		}

		$excel .= "</tbody>";
		$excel .= "</table>";

		$filename = 'Expired_Medicines_'.date('Ymd', strtotime($from)).'_'.date('Ymd', strtotime($to)).'.xls';

		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");
		return print $excel;
	}

	public function patient_alive_excel($patient_alive,$from,$to,$patients)
	{
		 $excel  = "<table border=\"1\" >";
        $excel .= "<thead>";

        $excel .= "<tr>";
        $excel .= "<th colspan=\"10\">Corazon Locsin Montelibano Memorial Regional Hospital</th>";
        $excel .= "</tr>";

        $excel .= "<tr>";
        $excel .= "<th colspan=\"10\"> Patients Alive ".$patient_alive."</th>";
        $excel .= "</tr>";

        $excel .= "<tr>";
        $excel .= "<th colspan=\"2\">UI Code</th>";
        $excel .= "<th colspan=\"2\">SACCL</th>";
        $excel .= "<th colspan=\"2\">Code Name</th>";
        $excel .= "<th colspan=\"2\">Nationality</th>";
        $excel .= "<th colspan=\"2\">Gender</th>";
        $excel .= "</tr>";

        $excel .= "</thead>";

        $excel .= "<tbody>";
        foreach ($patients as $row)
        {
            $excel .= "<tr>";
            $excel .= "<td colspan=\"2\">" . $row->ui_code . "</td>";
            $excel .= "<td colspan=\"2\">" . $row->saccl_code . "</td>";
            $excel .= "<td colspan=\"2\">" . $row->code_name . "</td>";
            $excel .= "<td colspan=\"2\">" . $row->nationality . "</td>";
            $excel .= "<td colspan=\"2\">" . $row->gender_format . "</td>";
            $excel .= "</tr>";
        }
        $excel .= "</tbody>";
        $excel .= "</table>";

        $filename = 'Patient Alive '.$patient_alive.' From '.$from.' to '.$to.'.xls';

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        return print $excel;
	}


	public function patient_alive_print($request)
	{
	  $patient_alive = $request->patient_alive;
      $from          = $request->from;
      $to            = $request->to;  

      if($patient_alive == 2)
      {
        $patient_alive = 'On ARV';
        $query = Patient::whereNotIn('id', function($query){
                    $query->select('patient_id')->from('mortality');
                })
                ->whereIn('id', function($query) use ($from, $to){
                    $query->select('patient_id')->from('vct')->where('result', 2)
                    ->where('vct_date', '>=', date('Y-m-d', strtotime($from)))->where('vct_date', '<=', date('Y-m-d', strtotime($to)));
                });
      }
      else
      {
        $patient_alive = 'Not yet On ARV';
        $query = Patient::whereNotIn('id', function($query){
                    $query->select('patient_id')->from('mortality');
                })
                ->whereIn('id', function($query) use ($from, $to){
                    $query->select('patient_id')->from('vct')->where('result', 1)
                    ->where('vct_date', '>=', date('Y-m-d', strtotime($from)))->where('vct_date', '<=', date('Y-m-d', strtotime($to)));
                });
      }
      $patients = $query->get();
      if($request->has('excel'))
        {
          return $this->patient_alive_excel($patient_alive, $from, $to, $patients);
        }
       
        return compact('patient_alive', 'from', 'to','patients');
	}

	public function medicine_history_dispense_print($request)
	{
			$search_item  = $request->search_item;
        $medicine_id  = $request->medicine_id;

        $from         = $request->from;
        $to           = $request->to;

        $date_from    = date('Y-m-d', strtotime($request->from));
        $date_to      = date('Y-m-d', strtotime($request->to));

        $prescription = Prescription::whereIn('medicine_inventory_id', function($query) use ($medicine_id){
                          $query->select('id')->from('medicine_inventory')->where('medicine_id', $medicine_id);
                        })
                        ->where(function($query) use ($date_from, $date_to){
                          $query->where('date_dispense', '>=', $date_from)->where('date_dispense', '<=', $date_to);
                        })
                        ->orderBy('date_dispense', 'DESC')
                        ->get();

        if($request->has('excel'))
        {
          $this->medicine_history_dispense_excel($search_item, $prescription, $from, $to);
        }
       
          return  compact('search_item', 'medicine_id', 'from', 'to', 'prescription');

	}

    public function medicine_history_dispense_excel($search_item, $prescription, $from, $to)
    {
        $excel  = "<table border=\"1\" >";
        $excel .= "<thead>";

        $excel .= "<tr>";
        $excel .= "<th colspan=\"4\">" . $search_item . " report based on dispense medicine</th>";
        $excel .= "</tr>";
        $excel .= "<tr>";
        $excel .= "<th colspan=\"4\"> $from - $to</th>";
        $excel .= "</tr>";

        $excel .= "<tr>";
        $excel .= "<th>Medicines</th>";
        $excel .= "<th>No. of Pills</th>";
        $excel .= "<th>Date Dispense</th>";
        $excel .= "<th>Issued By</th>";
        $excel .= "</tr>";

        $excel .= "</thead>";

        $excel .= "<tbody>";

        foreach ($prescription as $row)
        {
            $excel .= "<tr>";
            $excel .= "<td>";

            if($row->ARVItems->specified_medicine == '')
            {
                $excel .= "" . $row->ARVItems->Medicine->name;
            }
            else
            {
                $excel .= "" . $row->ARVItems->specified_medicine;
            }

            $excel .= "</td>";
            $excel .= "<td>" . $row->pills_dispense . "</td>";
            $excel .= "<td>" . $row->date_dispense_format2 . "</td>";
            $excel .= "<td>" . $row->User->name . "</td>";
            $excel .= "</tr>";
        }

        $excel .= "</tbody>";
        $excel .= "</table>";

        $filename = $search_item . '_VCTResults.xls';

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        print $excel;
    }

	public function FunctionName($request)
	{
		 $excel  = "<table border=\"1\" >";
        $excel .= "<thead>";

        $excel .= "<tr>";
        $excel .= "<th colspan=\"4\">" . $search_item . " report based on dispense medicine</th>";
        $excel .= "</tr>";
        $excel .= "<tr>";
        $excel .= "<th colspan=\"4\"> $from - $to</th>";
        $excel .= "</tr>";

        $excel .= "<tr>";
        $excel .= "<th>Medicines</th>";
        $excel .= "<th>No. of Pills</th>";
        $excel .= "<th>Date Dispense</th>";
        $excel .= "<th>Issued By</th>";
        $excel .= "</tr>";

        $excel .= "</thead>";

        $excel .= "<tbody>";

        foreach ($prescription as $row)
        {
            $excel .= "<tr>";
            $excel .= "<td>"; 

            if($row->ARVItems->specified_medicine == '')
            {
              $excel .= "" . $row->ARVItems->Medicine->name; 
            }
            else
            {
              $excel .= "" . $row->ARVItems->specified_medicine; 
            }

            $excel .= "</td>";
            $excel .= "<td>" . $row->pills_dispense . "</td>";
            $excel .= "<td>" . $row->date_dispense_format2 . "</td>";
            $excel .= "<td>" . $row->User->name . "</td>";
            $excel .= "</tr>";
        }

        $excel .= "</tbody>";
        $excel .= "</table>";

        $filename = $search_item . '_VCTResults.xls';

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        return print $excel;
	}

	public function patient_stop_taking_arv_print($request)
	{
		 $search_item = $request->search_item;
      $medicine_id = $request->medicine_id;
      $from = $request->from;
      $to   = $request->to;

      $query = ARV::whereIn('id', function($query) use ($from, $to, $medicine_id){
              $query->select('arv_id')->from('arv_items')
              ->where('date_discontinued', '>=', date('Y-m-d', strtotime($from)))
              ->where('date_discontinued', '<=', date('Y-m-d', strtotime($to)))
              ->where('medicine_id',$medicine_id);
            })->get();

      foreach ($query as $key) {
            $patient_id =  $key->patient_id;
            $patients = Patient::where('id',$patient_id)->get();
          }
      if($request->has('excel'))
      {
        $this->patient_stop_taking_arv_excel($from, $to, $patients);
      }
     
       return  compact('from', 'to','patients','search_item', 'medicine_id');
	}

	public function patient_stop_taking_arv_excel($from,$to,$patients)
	{
		 $excel  = "<table border=\"1\" >";
      $excel .= "<thead>";

      $excel .= "<tr>";
      $excel .= "<th colspan=\"10\">Corazon Locsin Montelibano Memorial Regional Hospital</th>";
      $excel .= "</tr>";

      $excel .= "<tr>";
      $excel .= "<th colspan=\"10\"> Patient Who Stop Taking ARV From ".$from." to ".$to."</th>";
      $excel .= "</tr>";

      $excel .= "<tr>";
      $excel .= "<th colspan=\"2\">UI Code</th>";
      $excel .= "<th colspan=\"2\">SACCL</th>";
      $excel .= "<th colspan=\"2\">Code Name</th>";
      $excel .= "<th colspan=\"2\">Nationality</th>";
      $excel .= "<th colspan=\"2\">Gender</th>";
      $excel .= "</tr>";

      $excel .= "</thead>";

      $excel .= "<tbody>";
      foreach ($patients as $row)
        {
          $excel .= "<tr>";
          $excel .= "<td colspan=\"2\">" . $row->ui_code . "</td>";
          $excel .= "<td colspan=\"2\">" . $row->saccl_code . "</td>";
          $excel .= "<td colspan=\"2\">" . $row->code_name . "</td>";
          $excel .= "<td colspan=\"2\">" . $row->nationality . "</td>";
          $excel .= "<td colspan=\"2\">" . $row->gender_format . "</td>";
          $excel .= "</tr>";
        }
      $excel .= "</tbody>";
      $excel .= "</table>";

      $filename = 'Patient Who Stop Taking ARV From '.$from.' to '.$to.'.xls';

      header("Content-Disposition: attachment; filename=\"$filename\"");
      header("Content-Type: application/vnd.ms-excel");
      return print $excel;
	}

	/**
	 * Dispense an excel output.
	 *
	 * @param      string  $infection     
	 * @param      <type>  $prescription  (description)
	 */
	public function infection_dispense_excel($infection, $prescription)
    {
        $excel  = "<table border=\"1\" >";
        $excel .= "<thead>";

        $excel .= "<tr>";
        $excel .= "<th colspan=\"4\">" . $infection . " report based on dispense medicine</th>";
        $excel .= "</tr>";

        $excel .= "<tr>";
        $excel .= "<th>Medicines</th>";
        $excel .= "<th>No. of Pills</th>";
        $excel .= "<th>Date Dispense</th>";
        $excel .= "<th>Issued By</th>";
        $excel .= "</tr>";

        $excel .= "</thead>";

        $excel .= "<tbody>";

        foreach ($prescription as $row)
        {
            $excel .= "<tr>";
            $excel .= "<td>"; 

            if($row->ARVItems->specified_medicine == '')
            {
              $excel .= "" . $row->ARVItems->Medicine->name; 
            }
            else
            {
              $excel .= "" . $row->ARVItems->specified_medicine; 
            }

            $excel .= "</td>";
            $excel .= "<td>" . $row->pills_dispense . "</td>";
            $excel .= "<td>" . $row->date_dispense_format2 . "</td>";
            $excel .= "<td>" . $row->User->name . "</td>";
            $excel .= "</tr>";
        }

        $excel .= "</tbody>";
        $excel .= "</table>";

        $filename = $infection . '_VCTResults.xls';

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        return print $excel;
    }

    public function patient_prescribe_print($request)
    {
    	$patient_name = $request->search_vct;
        $patient_id   = $request->patient_id;

        $from         = $request->from;
        $to           = $request->to;

        $date_from    = date('Y-m-d', strtotime($request->from));
        $date_to      = date('Y-m-d', strtotime($request->to));

        #$patient      = App\Patient::where('id', $id)->first();
        $arv_items = ARVitems::whereIn('arv_id', function($query) use ($patient_id, $date_from, $date_to){
                          $query->select('id')->from('arv')
                                ->where('patient_id', $patient_id)
                                ->where(DB::raw('DATE(created_at)'), '>=', $date_from)
                                ->where(DB::raw('DATE(created_at)'), '<=', $date_to);
                        })
                        ->get();

        if($request->has('excel'))
        {
          $this->patient_prescribe_excel($patient_name, $arv_items);
        }
        return  compact('patient_name', 'patient_id', 'from', 'to', 'arv_items');
    }

    public function patient_prescribe_excel($patient_name,$arv_items)
    {
    	 $excel  = "<table border=\"1\" >";
        $excel .= "<thead>";

        $excel .= "<tr>";
        $excel .= "<th colspan=\"5\">" . $patient_name . " report based on dispense medicine</th>";
        $excel .= "</tr>";

        $excel .= "<tr>";
        $excel .= "<th>Infections</th>";
        $excel .= "<th>Medicines</th>";
        $excel .= "<th>Pills/Day</th>";
        $excel .= "<th>Pills miss in 30 days</th>";
        $excel .= "<th>Pills Left</th>";
        $excel .= "</tr>";

        $excel .= "</thead>";

        $excel .= "<tbody>";

        foreach ($arv_items as $row)
        {
            $excel .= "<tr>";
            $excel .= "<td>" . $row->infection_format . "</td>";
            $excel .= "<td>"; 

            if($row->specified_medicine == '')
            {
              $excel .= "" . $row->Medicine->name; 
            }
            else
            {
              $excel .= "" . $row->specified_medicine; 
            }

            $excel .= "</td>";
            $excel .= "<td>" . $row->pills_per_day . "</td>";
            $excel .= "<td>" . $row->pills_missed_in_30_days . "</td>";
            $excel .= "<td>" . $row->pills_left . "</td>";
            $excel .= "</tr>";
        }

        $excel .= "</tbody>";
        $excel .= "</table>";

        $filename = $patient_name . '_VCTResults.xls';

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        return print $excel;
    }

    public function patient_dispense_print($request)
    {
    	$patient_name = $request->search_patient;
        $patient_id   = $request->patient_id;

        $from         = $request->from;
        $to           = $request->to;

        $date_from    = date('Y-m-d', strtotime($request->from));
        $date_to      = date('Y-m-d', strtotime($request->to));

        $prescription = Prescription::whereIn('arv_item_id', function($query) use ($patient_id){

                          $query->select('arv_items.id')->from('arv_items')->leftJoin('arv', 'arv_items.arv_id', '=', 'arv.id')->where('patient_id', $patient_id);
                        })
                        ->where('date_dispense', '>=', $date_from)
                        ->where('date_dispense', '<=', $date_to)
                        ->get();

        if($request->has('excel'))
        {
          $this->patient_dispense_excel($patient_name, $prescription);
        }
       
          $data = compact('patient_name', 'patient_id', 'from', 'to', 'prescription');

         return $data;

    }

    public function patient_dispense_excel($patient_name,$prescription)
    {
    	 $excel  = "<table border=\"1\" >";
        $excel .= "<thead>";

        $excel .= "<tr>";
        $excel .= "<th colspan=\"5\">" . $patient_name . " report based on dispense medicine</th>";
        $excel .= "</tr>";

        $excel .= "<tr>";
        $excel .= "<th>Infections</th>";
        $excel .= "<th>Medicines</th>";
        $excel .= "<th>No. of Pills</th>";
        $excel .= "<th>Date Dispense</th>";
        $excel .= "<th>Issued By</th>";
        $excel .= "</tr>";

        $excel .= "</thead>";

        $excel .= "<tbody>";

        foreach ($prescription as $row)
        {
            $excel .= "<tr>";
            $excel .= "<td>" . $row->ARVItems->infection_format . "</td>";
            $excel .= "<td>"; 

            if($row->ARVItems->specified_medicine == '')
            {
              $excel .= "" . $row->ARVItems->Medicine->name; 
            }
            else
            {
              $excel .= "" . $row->ARVItems->specified_medicine; 
            }

            $excel .= "</td>";
            $excel .= "<td>" . $row->pills_dispense . "</td>";
            $excel .= "<td>" . $row->date_dispense_format2 . "</td>";
            $excel .= "<td>" . $row->User->name . "</td>";
            $excel .= "</tr>";
        }

        $excel .= "</tbody>";
        $excel .= "</table>";

        $filename = $patient_name . '_VCTResults.xls';

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        return print $excel;
    }

    public function excelLowStockMedicines($request,$medicines)
    {

      $excel  = "<table border=\"1\">";
      $excel .= "<thead>";

      $excel .= "<tr><th colspan=\"6\">Low Stock Medicines</th></tr>";

      $excel .= "<tr>";
      $excel .= "<th>DRUG DESCRIPTION &amp; FORMULATION</th>";
      $excel .= "<th>ITEM CODE</th>";
      $excel .= "<th>BALANCE</th>";
      $excel .= "</tr>";

      $excel .= "</thead>";

      $excel .= "<tbody>";
      foreach ($medicines as $row)
      {
        $total_qty = $row->quantity - $row->deduct_qty;

        if($row->current_stock <= 100)
        {
            if($row->current_stock <= 20)
            {
                $excel .= "<tr style=\"bacground-color: red;\">";
            }
            else
            {
                $excel .= "<tr style=\"bacground-color: #ffa500;\">";
            }

            $excel .= "<td>" . $row->name . "</td>";
            $excel .= "<td>" . $row->item_code . "</td>";
            $excel .= "<td>" . $row->current_stock . "</td>";
            $excel .= "</tr>";
        }
      }

      $excel .= "</tbody>";
      $excel .= "</table>";

      $filename = 'LowStock_Medicines.xls';

      header("Content-Disposition: attachment; filename=\"$filename\"");
      header("Content-Type: application/vnd.ms-excel");
      return print $excel;
    }

    public function excelMedicineRestockingHistory($request)
    {
     $medicines = MedicineInventory::orderBy('expiry_date', 'ASC')->get();

      $excel  = "<table border=\"1\">";
      $excel .= "<thead>";

      $excel .= "<tr><th colspan=\"6\">Medicine Re-stocking Report </th></tr>";

      $excel .= "<tr>";
      $excel .= "<th>Lot Number</th>";
      $excel .= "<th>Tabs/Bot.</th>";
      $excel .= "<th>Quantity</th>";
      $excel .= "<th>Balance</th>";
      $excel .= "<th>Expiry Date</th>";
      $excel .= "<th>Create At</th>";
      $excel .= "</tr>";

      $excel .= "</thead>";

      $excel .= "<tbody>";
      foreach ($medicines as $row)
      {
          $excel .= "<tr>";
          $excel .= "<td>" . $row->lot_number . "</td>";
          $excel .= "<td>" . $row->tabs_per_bottle . "</td>";
          $excel .= "<td>" . $row->quantity . "</td>";
          $excel .= "<td>" . $row->current_medicine_stock . "</td>";
          $excel .= "<td>" . $row->expiry_date . "</td>";
          $excel .= "<td>" . $row->created_at . "</td>";
          $excel .= "</tr>";
      }

      $excel .= "</tbody>";
      $excel .= "</table>";

      $filename = 'Medicine_ReStocking.xls';

      header("Content-Disposition: attachment; filename=\"$filename\"");
      header("Content-Type: application/vnd.ms-excel");
      return print $excel;
    }

     /**
      * Determine the type of infection
      *
      * @param      string  $value  
      *
      * @return     string
      */
     public function infection_values($value)
    {
        $infection = $value;

        if($infection == 'hepatitis_b')
        {
            return 'Hepatitis B';
        }
        elseif($infection == 'hepatitis_c')
        {
            return 'Hepatitis C';
        }
        elseif($infection == 'pneumocystis_pneumonia')
        {
            return 'Pneumocystis Pneumonia';
        }
        elseif($infection == 'orpharyngeal_candidiasis')
        {
            return 'Orpharyngeal Candidiasis';
        }
        elseif($infection == 'syphilis')
        {
            return 'Syphilis';
        }
        elseif($infection == 'stis')
        {
            #Infections::where('patient_id', $id)->orderBy('result_date', 'DESC')->first()
            #return 'STI`s ( ' . $row->stis . ' )';
            return 'STI`s';
        }
        elseif($infection == 'others')
        {
            #return 'Others ( ' . $row->others . ' )';
            return 'Others';
        }
    }







}
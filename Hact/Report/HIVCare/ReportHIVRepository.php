<?php

namespace Hact\Report\HIVCare;

use Hact\RepositoryInterface;
use Hact\Repository;
use App\Patient;
use App\Infections;
use App\VCT;

class ReportHIVRepository extends Repository  {

	private $patient;
	private $infection;
    private $vct;

	 /**
	  * Inject dependencies.
	  *
	  * @param      Patient         $patient       (description)
	  * @param      Infections  $infection  (description)
	  */
	 function __construct(VCT $vct, Patient $patient,Infections $infection){

		$this->patient = $patient;
		$this->infection = $infection;
        $this->vct = $vct;
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

	 /**
	  * Refresh philv's list
	  *
	  * @param      string  $from   
	  * @param      string  $to     
	  *
	  * @return     mixed
	  */
	private function philv_refresh($from,$to)
    {
        return $this->vct->where(function($query) use ($from, $to){
                                    $query->where('vct_date','>=',date('Y-m-d',strtotime($from)))
                                    ->where('vct_date','<=',date('Y-m-d',strtotime($to)));
                                })
                        ->where('result', 2);
    }

    /**
     * Refresh infections list
     *
     * @param      string  $from   
     * @param      string  $to     
     *
     * @return     mixed
     */
    private function infections_refresh($from,$to)
    {
        return $this->infection->where(function($query) use ($from, $to){
                                    $query->where('result_date','>=',date('Y-m-d',strtotime($from)))
                                    ->where('result_date','<=',date('Y-m-d',strtotime($to)));
                                });
    }

    /**
     * Print the results
     *
     * @param      mixed  $request  
     */
    public function results_print($request)
    {
    	$from = $request->from;
        $to = $request->to;
        $this->philv_refresh($from,$to);
        $this->infections_refresh($from,$to);
        
        $plhiv_count =  $this->philv_refresh($from, $to)->distinct()->count();
        $plhiv_tb =  $this->philv_refresh($from, $to)->join('tb_information','vct.patient_id','=','tb_information.patient_id')->distinct()->count();
        $plhiv_tb_ipt =  $this->philv_refresh($from, $to)->join('tb_information','vct.patient_id','=','tb_information.patient_id')
                                                ->where('on_ipt', 1)->distinct()->count();
        $plhiv_tb_tx =  $this->philv_refresh($from, $to)->join('tb_information','vct.patient_id','=','tb_information.patient_id')
                                                ->where(function($query){
                                                    $query->where('tx_outcome','!=','')
                                                        ->orWhere('tx_outcome_other','!=','');
                                                })
                                                ->distinct()->count();

        $infections =  $this->infections_refresh($from, $to)->get();
        $oi_count = 0;

        $cmv_count = 0;
        $mac_count =  $this->infections_refresh($from, $to)
                                ->where(function($query){
                                    $query->where('others','MAC')
                                        ->orWhere('others','mycobacterium avium-intracellulare');
                                })->distinct()->count();
        $anal_warts_count =  $this->infections_refresh($from, $to)->where('others','anal warts')->distinct()->count();
        $endocarditis_count =  $this->infections_refresh($from, $to)->where('others','endocarditis')->distinct()->count();
        $tb_count = 0;
        $herpes_simplex_count = 0;
        $kaposis_sarcoma_count = 0;

        $oi_count +=  $this->infections_refresh($from,$to)->where('hepatitis_b', 1)->count();
        $oi_count +=  $this->infections_refresh($from,$to)->where('hepatitis_c', 1)->count();
        $oi_count +=  $this->infections_refresh($from,$to)->where('pneumocystis_pneumonia', 1)->count();
        $oi_count +=  $this->infections_refresh($from,$to)->where('orpharyngeal_candidiasis', 1)->count();
        $oi_count +=  $this->infections_refresh($from,$to)->where('syphilis', 1)->count();
        $oi_count +=  $this->infections_refresh($from,$to)->where('stis','!=','')->count();
        $oi_count +=  $this->infections_refresh($from,$to)->where('others','!=','')->count();

        $candidiasis_count =  $this->infections_refresh($from,$to)->where('orpharyngeal_candidiasis', 1)->count();
        $pcp_count =  $this->infections_refresh($from,$to)->where('pneumocystis_pneumonia', 1)->count();
        $syphilis_count =  $this->infections_refresh($from,$to)->where('syphilis', 1)->count();
        $hepatitis_b_count =  $this->infections_refresh($from,$to)->where('hepatitis_b', 1)->count();

        foreach($infections as $row)
        {
            $tb_count += $row->infections_clinical_stage->where('stage', 3)->where('infection',6)->count();
            $tb_count += $row->infections_clinical_stage->where('stage', 4)->where('infection',6)->count();

            $cmv_count += $row->infections_clinical_stage->where('stage', 4)->where('infection',17)->count();
            $herpes_simplex_count += $row->infections_clinical_stage->where('stage', 4)->where('infection',4)->count();
            $kaposis_sarcoma_count += $row->infections_clinical_stage->where('stage', 4)->where('infection',7)->count();
        }


        $plhiv_pmtct =  $this->philv_refresh($from, $to)->join('vct_suplemental_children','vct_suplemental_children.vct_id','=','vct_id')->distinct()->count();
        $plhiv_pmtct +=  $this->philv_refresh($from, $to)->join('vct_suplemental_mother','vct_suplemental_mother.vct_id','=','vct_id')->distinct()->count();
        $plhiv_pregnant_art =  $this->philv_refresh($from, $to)->where('reason_11',1)->join('arv','arv.patient_id','=','vct.patient_id')->distinct()->count();
        $plhiv_pregnant_arv =  $this->philv_refresh($from, $to)->where('reason_11',1)->join('arv','arv.patient_id','=','vct.patient_id')->distinct()->count();
        $plhiv_nb_arv =  $this->philv_refresh($from, $to)->join('patient','vct.patient_id','=','patient.id')
                                            ->where(function($query) use ($from, $to){
                                                $query->where('patient.birth_date','>=',date('Y-m-d',strtotime($from)))
                                                ->where('patient.birth_date','<=',date('Y-m-d',strtotime($to)));
                                                })
                                            ->join('arv','arv.patient_id','=','vct.patient_id')
                                            ->distinct()->count();

        $plhiv_cotri = 0;
        $plhiv_all =  $this->philv_refresh($from, $to)->join('patient','vct.patient_id','=','patient.id')
                                            ->get();
       // dd($plhiv_all);
        foreach($plhiv_all as $row)
        {
            if($row->Patient->ARV)
            {
                if(@$row->Patient->ARV->ARVItems){
                    foreach($row->Patient->ARV->ARVItems as $row_2)
                    {
                        if($row_2->Medicine->name == 'Cotrimoxazole')
                        {
                            $plhiv_cotri++;
                        }
                    }
                }

            }
        }                                    

        
        $plhiv_infants_cotri = 0;
        $plhiv_infants =  $this->philv_refresh($from, $to)->join('patient','vct.patient_id','=','patient.id')
                                            ->where(function($query) use ($from, $to){
                                                $query->where('patient.birth_date','>=',date('Y-m-d',strtotime($from)))
                                                ->where('patient.birth_date','<=',date('Y-m-d',strtotime($to)));
                                                })
                                            ->get();
        foreach($plhiv_infants as $row)
        {
            if(isset($row->Patient->ARV))
            {
                if(@$row->Patient->ARV->ARVItems){
                    foreach($row->Patient->ARV->ARVItems as $row_2)
                    {
                        if($row_2->Medicine->name == 'Cotrimoxazole')
                        {
                            $plhiv_infants_cotri++;
                        }
                    }
                }

            }
        }

        $plhiv_art =  $this->philv_refresh($from, $to)->join('arv','arv.patient_id','=','vct.patient_id')->distinct()->count();
        
            return $data = compact('from','to','oi_count','candidiasis_count','syphilis_count','pcp_count','hepatitis_b_count','mac_count',
                        'tb_count','cmv_count','herpes_simplex_count','kaposis_sarcoma_count','anal_warts_count','endocarditis_count',
                        'plhiv_count','plhiv_tb','plhiv_tb_ipt','plhiv_tb_tx',
                        'plhiv_cotri','plhiv_pmtct','plhiv_pregnant_art','plhiv_pregnant_arv','plhiv_nb_arv','plhiv_infants_cotri','plhiv_art'
                        );
    }

    /**
     * Export to xls format.
     *
     * @param      string  $from                   (description)
     * @param      string  $to                     (description)
     * @param      string  $oi_count               (description)
     * @param      string  $candidiasis_count      (description)
     * @param      <type>  $syphilis_count         (description)
     * @param      string  $pcp_count              (description)
     * @param      <type>  $hepatitis_b_count      (description)
     * @param      <type>  $tb_count               (description)
     * @param      string  $cmv_count              (description)
     * @param      <type>  $herpes_simplex_count   (description)
     * @param      <type>  $kaposis_sarcoma_count  (description)
     * @param      string  $plhiv_count            (description)
     * @param      string  $plhiv_tb               (description)
     * @param      string  $plhiv_tb_ipt           (description)
     * @param      <type>  $plhiv_tb_tx            (description)
     * @param      <type>  $plhiv_infants_cotri    (description)
     * @param      <type>  $plhiv_cotri            (description)
     * @param      <type>  $plhiv_pmtct            (description)
     * @param      <type>  $plhiv_pregnant_art     (description)
     * @param      <type>  $plhiv_pregnant_arv     (description)
     * @param      <type>  $plhiv_nb_arv           (description)
     * @param      <type>  $plhiv_art              (description)
     * @param      string  $mac_count              (description)
     * @param      <type>  $anal_warts_count       (description)
     */
    public function excel_export($from, $to, $oi_count, $candidiasis_count, $syphilis_count, $pcp_count, $hepatitis_b_count, $tb_count, $cmv_count, $herpes_simplex_count, $kaposis_sarcoma_count,$plhiv_count, $plhiv_tb, $plhiv_tb_ipt, $plhiv_tb_tx,$plhiv_infants_cotri,$plhiv_cotri,$plhiv_pmtct,$plhiv_pregnant_art,$plhiv_pregnant_arv,$plhiv_nb_arv, $plhiv_art, $mac_count, $anal_warts_count)
    {
    	$excel = "<table width='100%' border=\"1\"><thead>";
        $excel .= "<tr><td colspan='5'><center>CORAZON LOCSIN MONTELIBANO MEMORIAL REGIONAL HOSPITAL</center></td></tr>";
        $excel .= "<tr><td colspan='5'><center>Reporting Period: ".$from." - ".$to."</center></td></tr>";
        $excel .= "<tr><td colspan='5'></td></tr></thead>"; 
        $excel .= "<tbody><tr><td colspan='3'>Total Number of PLHIV seen on initial/first contact during reporting period:</td><td colspan='1'>".$plhiv_count."</td><td colspan='1'></td>";
        $excel .= "<tr><td colspan='3'>No. of PLHIV screened for TB during reporting period</td><td colspan='1'>".$plhiv_tb."</td><td colspan='1'></td>";
        $excel .= "<tr><td colspan='3'>No. of PLHIV started om IPT during reporting period:</td><td colspan='1'>".$plhiv_tb_ipt."</td><td colspan='1'></td>";
        $excel .= "<tr><td colspan='3'>Total No. of Opportunistic Infections diagnosed:</td><td colspan='1'>".$oi_count."</td><td colspan='1'></td>";
        $excel .= "<tr><td colspan='1'></td><td colspan='2'> > Pneumocystis Carinii Pneumonia(PCP)</td><td colspan='1'>".$pcp_count."</td><td colspan='1'></td>";
        $excel .= "<tr><td colspan='1'></td><td colspan='2'> > Candidiasis</td><td colspan='1'>".$candidiasis_count."</td><td colspan='1'></td>";        
        $excel .= "<tr><td colspan='1'></td><td colspan='2'> > CMV</td><td colspan='1'>".$cmv_count."</td><td colspan='1'></td>";
        $excel .= "<tr><td colspan='1'></td><td colspan='2'> > MAC</td><td colspan='1'>".$mac_count."</td><td colspan='1'></td>";    
        $excel .= "<tr><td colspan='1'></td><td colspan='2'> > TB</td><td colspan='1'>".$tb_count."</td><td colspan='1'></td>";
        $excel .= "<tr><td colspan='1'></td><td colspan='2'> > Other Ois</td><td colspan='1'></td><td colspan='1'></td>";   
        $excel .= "<tr><td colspan='1'></td><td colspan='1'></td><td colspan='1'> > Syphilis</td><td colspan='1'>".$syphilis_count."</td><td colspan='1'></td>";  
        $excel .= "<tr><td colspan='1'></td><td colspan='1'></td><td colspan='1'> > Herpes Simplex</td><td colspan='1'>".$herpes_simplex_count."</td><td colspan='1'></td>";    
        $excel .= "<tr><td colspan='1'></td><td colspan='1'></td><td colspan='1'> > Anal Warts</td><td colspan='1'>".$anal_warts_count."</td><td colspan='1'></td>";  
        $excel .= "<tr><td colspan='1'></td><td colspan='1'></td><td colspan='1'> > Endocarditis</td><td colspan='1'></td><td colspan='1'></td>";  
        $excel .= "<tr><td colspan='1'></td><td colspan='1'></td><td colspan='1'> > Hepatitis B</td><td colspan='1'>".$hepatitis_b_count."</td><td colspan='1'></td>"; 
        $excel .= "<tr><td colspan='1'></td><td colspan='1'></td><td colspan='1'> > Kaposi's Sarcoma</td><td colspan='1'>".$kaposis_sarcoma_count."</td><td colspan='1'></td>"; 
        $excel .= "<tr><td colspan='3'> No. of PLHIV started on TB tx during reporting period:</td><td colspan='1'>".$plhiv_tb_tx."</td><td colspan='1'></td>";
        $excel .= "<tr><td colspan='3'> No. of PLHIV given/started Cotri prophylaxis during reporting period:</td><td colspan='1'>".$plhiv_cotri."</td><td colspan='1'></td>";
        $excel .= "<tr><td colspan='3'> No. of PLHIV provided PMTCT services during reporting period:</td><td colspan='1'>".$plhiv_pmtct."</td><td colspan='1'></td>";
        $excel .= "<tr><td colspan='1'></td><td colspan='2'> > No. of pregnant PLHIV assessed for ART eligibility</td><td colspan='1'>".$plhiv_pregnant_art."</td><td colspan='1'></td>";  
        $excel .= "<tr><td colspan='1'></td><td colspan='2'> > No. of pregnant PLHIV started on ARV prophylaxis</td><td colspan='1'>".$plhiv_pregnant_arv."</td><td colspan='1'></td>"; 
        $excel .= "<tr><td colspan='1'></td><td colspan='2'> > No. of NB on ARV prophylaxis</td><td colspan='1'>".$plhiv_nb_arv."</td><td colspan='1'></td>";
        $excel .= "<tr><td colspan='1'></td><td colspan='2'> > No. of infants of Cotri prophylaxis</td><td colspan='1'>".$plhiv_infants_cotri."</td><td colspan='1'></td>";  
        $excel .= "<tr><td colspan='3'> No. of PLHIV started on ART during reporting period:</td><td colspan='1'>".$plhiv_art."</td><td colspan='1'></td>";
        $excel .= "</tbody></table>";

        $filename = 'hiv_care_report_'.date('Ymd', strtotime($from)).'_'.date('Ymd', strtotime($to)).'.xls';
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        return print $excel;
    }

}
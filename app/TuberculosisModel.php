<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TuberculosisModel extends Model
{
     protected $table 	= 'tb_information';
     protected $fillable = array('patient_id','presence','tb_status','site',
                            'current_tb_regimen','on_ipt', 'ipt_outcome', 'ipt_outcome_other',
                            'drug_resistance','drug_resistance_other','tx_outcome','tx_outcome_other',
                            'user_id', 'order_number','site_extrapulmonary', 'date_started','tx_date_outcome',
                            'tx_facility');
     public $timestamps     = true;

     public function Patient(){
         return $this->hasOne('App\Patient', 'id', 'patient_id');
     }

    public function setDateStartedAttribute($value)
    {
        $this->attributes['date_started'] = date('Y-m-d', strtotime($value));
    }

    public function setTxDateOutcomeAttribute($value)
    {
        $this->attributes['tx_date_outcome'] = date('Y-m-d', strtotime($value));
    }

     public function getOrderNumberFormatAttribute()
     {
          if(is_null($this->order_number) || $this->order_number == '')
         {
             return null;
         }
         else
         {
             return 'Tuberculosis Report #' . $this->order_number;
         }
     }

     public function getDateStartedFormatAttribute()
     {
        return date('F d, Y', strtotime($this->date_started));
     }

     public function getTxDateOutcomeFormatAttribute()
     {
        return date('F d, Y', strtotime($this->tx_date_outcome));
     }

     public function getPresenceFormatAttribute()
     {
        switch ($this->presence) {
            case 2: 
                return "No"; 
                break;
            case 1: 
                return "Yes"; 
                break;
            default: 
                return "-"; 
                break;
        }
     }

    public function getTbStatusFormatAttribute()
    {
        switch ($this->tb_status) {
            case 1: 
                return "No Active TB"; 
                break;
            case 2: 
                return "With Active TB"; 
                break;
            default: 
                return "-"; 
                break;
        }
    }

    public function getSiteFormatAttribute()
    {
        switch ($this->site) {
            case 1: 
                return "Pulmonary"; 
                break;
            case 2: 
                return "Extrapulmonary -"; 
                break;
            default: 
                return "-"; 
                break;
        }
    }

    public function getDrugResistanceFormatAttribute()
    {
        switch ($this->drug_resistance) {
            case 1: 
                return "Susceptible"; 
                break;
            case 2: 
                return "XDR"; 
                break;
            case 3: 
                return "MDR/RR"; 
                break;
            case 4: 
                return "Other -"; 
                break;
            default: 
                return "-"; 
                break;
        }
    }

    public function getCurrentTbRegimenFormatAttribute()
    {
        switch ($this->current_tb_regimen) {
            case 1: 
                return "Category I"; 
                break;
            case 2: 
                return "Category Ia"; 
                break;
            case 3: 
                return "Category II"; 
                break;
            case 4: 
                return "Category IIa"; 
                break;
            case 5: 
                return "SRDR"; 
                break;
            case 6: 
                return "XDR-TB Regimen"; 
                break;
            default: 
                return "-"; 
                break;
        }
    }

    public function getTxOutcomeFormatAttribute()
    {
        switch ($this->tx_outcome) {
            case 1: 
                return "Cured"; 
                break;
            case 2: 
                return "Failed"; 
                break;
            case 3: 
                return "Completed"; 
                break;
            case 4: 
                return "Other -"; 
                break;
            case 5: 
                return "Ongoing"; 
                break;
            default: 
                return "-"; 
                break;
        }
    }

    public function getIptOutcomeFormatAttribute()
    {
        switch ($this->ipt_outcome) {
            case 1: 
                return "Completed"; 
                break;
            case 2: 
                return "Failed"; 
                break;
            case 3: 
                return "Other -"; 
                break;
            case 4: 
                return "Ongoing"; 
                break;
            default: 
                return "-"; 
                break;
        }
    }

    public function getTxFacilityFormatAttribute(){
        if($this->tx_facility)
        {
            return $this->tx_facility;
        }
        else
        {
            return "-";
        }
    }
}

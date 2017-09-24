<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VCTSuplementalChildren extends Model
{
    protected $table 	= 'vct_suplemental_children';
    public $timestamps  = false;

    protected $fillable = [
        'vct_id', 'mother_hiv_status', 'hiv_diagnosis_date', 'mother_saccl', 'month_pregnant', 'week_pregnant',
        'mother_took_arv_medication_during_pregnancy', 'mother_took_arv_medication_during_pregnancy_reason_if_no', 
        'did_breastfeed_baby', 'mother_dead_or_alive', 'mother_dead_or_alive_when', 'user_id', 'created_at'
    ];
    /**
    Relationships
    **/

    public function VCT()
    {
        return $this->hasOne('App\VCT', 'id', 'vct_id');
    }

    /**
    Setters to Insert
    **/
    public function setHivDiagnosisDateAttribute($value)
    {
        $this->attributes['hiv_diagnosis_date'] = date('Y-m-d', (strtotime($value)));
    }

    public function setMotherSacclAttribute($value)
    {
        $this->attributes['mother_saccl'] = (is_null($value) || $value == '')? '' : $value;
    }

    public function setMonthPregnantAttribute($value)
    {
        $this->attributes['month_pregnant'] = (is_null($value) || $value == '')? '' : $value;
    }

    public function setWeekPregnantAttribute($value)
    {
        $this->attributes['week_pregnant'] = (is_null($value) || $value == '')? '' : $value;
    }

    public function setMotherTookArvMedicationDuringPregnancyAttribute($value)
    {
        $this->attributes['mother_took_arv_medication_during_pregnancy'] = $value;
    }

    public function setMotherTookArvMedicationDuringPregnancyReasonIfNoAttribute($value)
    {
        $this->attributes['mother_took_arv_medication_during_pregnancy_reason_if_no'] = (is_null($value) || $value == '')? '' : $value;
    }

    public function setDidBreastfeedBabyAttribute($value)
    {
        $this->attributes['did_breastfeed_baby'] = $value;
    }

    public function setWhenIfAliveAttribute($value)
    {
        $this->attributes['when_if_alive'] = $value;
    }

    public function setMotherDeadOrAliveAttribute($value)
    {
        $this->attributes['mother_dead_or_alive'] = $value;
    }

    public function setMotherDeadOrAliveWhenAttribute($value)
    {
    	if(is_null($value) || $value == '')
    	{
            $value = null;
    	}
    	else
    	{
            $value = date('Y-m-d', strtotime($value));
    	}

        $this->attributes['mother_dead_or_alive_when'] = $value;
    }

    /**
    Setters to Insert
    **/
    public function getHivDiagnosisDateFormatAttribute()
    {
        if(is_null($this->hiv_diagnosis_date))
        {
            return '';
        }
        else
        {
            return date('F d, Y', (strtotime($this->hiv_diagnosis_date)));
        }
    }
}

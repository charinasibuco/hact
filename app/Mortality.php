<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Mortality extends Model
{
    protected $table 	= 'mortality';

    protected $fillable = [
    			'patient_id','user_id','date_of_death',
    			'is_hiv_related', 'immediate_cause','antecedent_cause','underlying_cause',
                'immediate_icd10_code','antecedent_icd10_code', 'underlying_icd10_code', 'tuberculosis',
    			'pneumocystis_pneumonia', 'cryptococcal_meningitis',
    			'cytomegalovirus', 'candidiasis', 'other', 'have_cd4_info',
    			'cd4_count', 'last_cd4_count', 'have_taken_arv','last_arv_regimen','death_certificate'
    			];

    public $timestamps 	= true;

    public function patient()
	{
	    return $this->belongsTo('App\Patient', 'patient_id', 'id');
	}

	public function getDateOfDeathFormatAttribute()
    {
        return date('F d, Y', strtotime($this->date_of_death));
    }

    public function getDateOfDeathAttribute(){
        return Carbon::parse($this->attributes['date_of_death']);
    }

    public function setDateOfDeathAttribute($value)
    {
        return $this->attributes['date_of_death'] = date('Y-m-d',strtotime($value));
    }

    public function getIsHivRelatedFormatAttribute($value)
    {
        if(is_null($this->is_hiv_related) || $this->is_hiv_related == '' || $this->is_hiv_related == 0)
        {
            return "No";
        }
        elseif($this->is_hiv_related == 1)
        {
            return "Yes";
        }
    }

    public function getHaveCd4InfoFormatAttribute($value)
    {
         if(is_null($this->have_cd4_info) || $this->have_cd4_info == '' || $this->have_cd4_info == 0)
        {
             return "No";
        }
        elseif($this->have_cd4_info == 1)
        {
            return "Yes";
        }
    }

    public function getLastArvRegimenFormatAttribute($value)
    {
         if($this->last_arv_regimen == 1)
         {
            return "First Line Regimen";
         }
         elseif($this->last_arv_regimen == 2)
         {
            return "Second Line Regimen";
         }
         else
         {
            return "Regimen information not available";
         }
    }

     public function getHaveTakenArvFormatAttribute($value)
    {
         if(is_null($this->have_taken_arv) || $this->have_taken_arv == '' || $this->have_taken_arv == 0)
        {
            return "No";
        }
        elseif($this->have_taken_arv == 1)
        {
            return "Yes";
        }

    }

    public function getLastCD4CountFormatAttribute($value)
    {
         if(is_null($this->last_cd4_count) || $this->last_cd4_count == '')
        {
            return null;
        }
        else
        {
            return date('F d, Y', strtotime($this->last_cd4_count));
        }
    }

}

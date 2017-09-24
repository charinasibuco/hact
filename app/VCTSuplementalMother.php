<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VCTSuplementalMother extends Model
{
    protected $table 	= 'vct_suplemental_mother';
    public $timestamps 	= false;

    protected $fillable = [
        'vct_id', 'alive_children_count', 'last_menstrual_period', 'months_pregnant', 'weeks_pregnant', 'delivery_date',
        'has_parental_care', 'plan_to_deliver_baby', 'plan_to_deliver_baby_specify', 'partner_hiv_tested', 'if_yes_when', 'if_yes_facility',
        'if_yes_result', 'partner_taking_arv', 'if_stopped_reason', 'user_id', 'created_at'
    ];
    /**
    Relationships
    **/

    public function VCT()
    {
        return $this->hasOne('App\VCT', 'id', 'vct_id');
    }

    public function Childrens()
    {
        return $this->belongsToMany('App\VCTSuplementalMotherChildrens', 'id', 'id');
    }

    /**
    Setters to Insert
    **/

    public function setAliveChildrenCountAttribute($value)
    {
        $this->attributes['alive_children_count'] = $value;
    }

    public function setLastMenstrualPeriodAttribute($value)
    {
        $this->attributes['last_menstrual_period'] = date('Y-m-d', strtotime($value));
    }

    public function setMonthsPregnantAttribute($value)
    {
        $this->attributes['months_pregnant'] = $value;
    }

    public function setWeeksPregnantAttribute($value)
    {
        $this->attributes['weeks_pregnant'] = $value;
    }

    public function setDeliveryDateAttribute($value)
    {
        $this->attributes['delivery_date'] = date('Y-m-d', strtotime($value));
    }

    public function setHasParentalCareAttribute($value)
    {
        $this->attributes['has_parental_care'] = (is_null($value) && $value == '')? '' : $value;
    }

    public function setPlanToDeliverBabyAttribute($value)
    {
        $this->attributes['plan_to_deliver_baby'] = $value;
    }

    public function setPlanToDeliverBabySpecifyAttribute($value)
    {
        $this->attributes['plan_to_deliver_baby_specify'] = $value;
    }

    public function setPartnerHivTestedAttribute($value)
    {
        $this->attributes['partner_hiv_tested'] = $value;
    }

    public function setIfYesWhenAttribute($value)
    {
    	if(is_null($value) || $value == '')
    	{
        	$value = null;
    	}
    	else
    	{
        	$value = date('Y-m-d', (strtotime($value)));
    	}

        $this->attributes['if_yes_when'] = $value;
    }

    public function setIfYesFacilityAttribute($value)
    {
        $this->attributes['if_yes_facility'] = (is_null($value) || $value == '')? '' : $value;
    }

    public function setIfYesResultAttribute($value)
    {
        $this->attributes['if_yes_result'] = $value;
    }

    public function setIfStoppedReasonAttribute($value)
    {
        $this->attributes['if_stopped_reason'] = $value;
    }

    /**
    Getters to Select
    **/

    public function getLastMenstrualPeriodFormatAttribute()
    {
        return date('F d, Y', strtotime($this->last_menstrual_period));
    }

    public function getDeliveryDateFormatAttribute()
    {
        return date('F d, Y', strtotime($this->delivery_date));
    }

    public function getIfYesWhenFormatAttribute()
    {
        return date('F d, Y', strtotime($this->if_yes_when));
    }
}

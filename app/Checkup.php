<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
{
    protected $table 	= 'checkup';

    protected $fillable = [
        'patient_id', 'checkup_date', 
        'weight', 'height', 'bmi',
        'blood_pressure', 'temperature', 'pulse_rate', 'respiration_rate',
        'subjective', //'objective',
        'cough', 'fever', 'night_sweat', 'weight_loss', 
        'laboratory_id', 'infection_id', 'arv_id',
        'patient_complaints',
        'remarks', 
        'follow_up_date', 'user_id', 
        'created_at', 'updated_at'
    ];

    public $timestamps 	= true;
    
    /**
    Relationships
    **/

    public function User()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function Patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id', 'id');
    }

/* public function CheckupLaboratoryRequest()
    {
        return $this->hasMany('App\CheckupLaboratoryRequest','checkup_id', 'id');
    }*/

    public function CheckupInfections()
    {
        return $this->hasOne('App\CheckupInfections', 'checkup_id', 'id');
    }

    public function CheckupLaboratory()
    {
        return $this->hasMany('App\CheckupLaboratory', 'checkup_id', 'id');
    }

    public function PhysicalExam()
    {
        return $this->hasOne('App\CheckupPhysicalExam', 'checkup_id', 'id');
    }

    public function NeuroExam()
    {
        return $this->hasOne('App\CheckupNeuroExam', 'checkup_id', 'id');
    }

    public function ARV()
    {
        return $this->hasOne('App\ARV', 'id', 'arv_id');
    }

    public function CheckupARV()
    {
        return $this->hasOne('App\CheckupARV', 'checkup_id', 'id');
    }

    public function LaboratoryRequests()
    {
        return $this->hasMany('App\CheckupLaboratoryRequest', 'checkup_id', 'id');
    }

    /*public function LaboratoryReferrals()
    {
        return $this->hasMany('App\CheckupLaboratoryRequest', 'checkup_id', 'id');
    }*/

    public function Referrals()
    {
        return $this->hasOne('App\CheckupReferrals', 'checkup_id', 'id');
    }

    /**
    Setters to Insert
    **/

    public function setCheckupDateAttribute($value)
    {
        $this->attributes['checkup_date'] = date('Y-m-d', strtotime($value));
    }

    /**
    Getters
    **/
    public function incharge(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function getCheckupDateAttribute()
    {
        return Carbon::parse($this->attributes['checkup_date']);
        //return date('F d, Y', strtotime($this->checkup_date));
    }

    public function getFollowUpDateAttribute()
    {
//        return date('F d, Y', strtotime($this->follow_up_date));
        return Carbon::parse($this->attributes['follow_up_date']);
    }

    public function getCheckupDateFormat1Attribute()
    {
        return date('Y-M-d', strtotime($this->checkup_date));
    }

    public function getCreatedAtFormatAttribute()
    {
        return date('Y-M-d H:i:s', strtotime($this->created_at));
    }

    public function getUpdatedAtFormatAttribute()
    {
        return date('Y-M-d H:i:s', strtotime($this->updated_at));
    }

    public function getCoughFormatAttribute()
    {
        if($this->cough == 1)
        {
            return "Affirmative";
        }
        else
        {
            return "Negative";
        }
    }
    public function getFeverFormatAttribute()
    {
        if($this->fever == 1)
        {
            return "Affirmative";
        }
        else
        {
            return "Negative";
        }
    }
    public function getWeightLossFormatAttribute()
    {
        if($this->weight_loss == 1)
        {
            return "Affirmative";
        }
        else
        {
            return "Negative";
        }
    }
    public function getNightSweatFormatAttribute()
    {
        if($this->night_sweat == 1)
        {
            return "Affirmative";
        }
        else
        {
            return "Negative";
        }
    }


    /** Neuro Exam Methods
     * @param $neuro_exam
     */
    public function storeNeuroExam($neuro_exam){
        $neuro_json = ['orientation','memory','vii','xi','xii','muscle_strength','sensory','reflexes','cerebellars','meningeals','funduscopy','2_3'];
        foreach($neuro_exam as $key => $value) {
        $neuro_exam[$key] = in_array($key, $neuro_json)?serialize($value):$value;
        }
        CheckupNeuroExam::create( $neuro_exam );
    }


    /** Physical Exam Methods
     * @param $physical_exam
     */
    public function storePhysicalExam($physical_exam){

        $physical_json = ['general_survey','skin','heent','chest_and_lungs','cardial','abdomen','extremities','lips_buccal_mucosa','sclerae','conjunctivae'];
        foreach($physical_exam as $key => $value) {
            $physical_exam[$key] = in_array($key, $physical_json)?serialize($value):$value;
        }
        CheckupPhysicalExam::create( $physical_exam );
    }

    public function getPrescriptionsAttribute(){
        $arv            = ARV::leftJoin('checkup_arv','checkup_arv.arv_id','=','arv.id')
                            ->where('checkup_id',$this->attributes['id'])
                            ->select('arv.*')
                            ->first();
        if($arv){
            $arv_id             = ($arv)? $arv->id : '';
            return ARVItems::where('arv_id', $arv_id)->get();
        }
        return null;
    }

}

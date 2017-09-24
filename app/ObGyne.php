<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class ObGyne extends Model
{
    protected $table = 'ob';

    protected $fillable = ['patient_id','currently_pregnant','currently_pregnant_if_yes_gestation_age','if_delivered_date','infant_type','pap_smear','user_id'];

    public function patient(){
        return $this->belongsTo('App\Patient', 'patient_id', 'id');
    }

    public function setIfDeliveredDateAttribute($value){
        if($value != ''){
            $this->attributes['if_delivered_date'] = Carbon::parse($value)->format('Y-m-d');
        }

    }

    public function getMaxDeliveredDateAttribute(){
        $result     = DB::table($this->table)
                    ->where('patient_id', $this->attributes['patient_id'])
                    ->select('if_delivered_date')
                    ->orderBy('if_delivered_date', 'desc')
                    ->first();
        return Carbon::parse($result->if_delivered_date);
    }

    public function getIfDeliveredDateAttribute(){
        return ($this->attributes['if_delivered_date'] != NULL) ? Carbon::parse($this->attributes['if_delivered_date']) : '';
    }

    public function getCurrentlyPregnantFormatAttribute(){
        return ($this->attributes['currently_pregnant'] == 1) ? 'Yes':'No';
    }


    public function getInfantTypeFormatAttribute(){
        if($this->attributes['infant_type'] == 0)
            return '';
        if($this->attributes['infant_type'] == 1)
            return 'Breastfeeding';
        if($this->attributes['infant_type'] == 2)
            return 'Formula Feeding';
        if($this->attributes['infant_type'] == 3)
            return 'Mixed Feeding';
    }
}

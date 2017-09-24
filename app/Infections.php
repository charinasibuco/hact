<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Infections extends Model
{
    protected $table 	= 'infections';

    public function infections_clinical_stage(){
        return $this->hasMany('App\InfectionsClinicalStage', 'infections_id', 'id');
    }

    public function CheckupInfections()
    {
        return $this->hasOne('App\CheckupInfections', 'infection_id', 'id');
    }

    public function patient(){
        return $this->belongsTo('App\Patient', 'patient_id', 'id');
    }

    public function getCreatedAtFormatAttribute($value)
    {
         if(is_null($this->created_at) || $this->created_at == '')
        {
            return null;
        }
        else
        {
            return date('F d, Y', strtotime($this->created_at));
        }
    }

    public function setResultDateAttribute($value)
    {
        return $this->attributes['result_date'] = date('Y-m-d',strtotime($value));
    }

    public function getResultDateAttribute(){
        return Carbon::parse($this->attributes['result_date']);
    }

    public function getResultDateFormatAttribute()
    {
        return $this->result_date = date('F d, Y',strtotime($this->result_date));
    }

    public function getOrderNumberFormatAttribute($value)
    {
         if(is_null($this->order_number) || $this->order_number == '')
        {
            return null;
        }
        else
        {
            return 'Infections Report #' . $this->order_number;
        }
    }

    public $timestamps 	= true;
}

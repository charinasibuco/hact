<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MedicalAbstract extends Model
{
    public $timestamps = false;
    protected $table = "medical_abstract";
    protected $fillable = ['patient_id','date','body'];

    public function Patient(){
        return $this->belongsTo('App\Patient','patient_id','id');
    }

    public function setDateAttribute($value){
        $this->attributes['date'] = date("Y-m-d", strtotime($value));
    }

    public function getDateAttribute(){
        return Carbon::parse($this->attributes['date']);
    }
}

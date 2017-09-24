<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfirmatoryDate extends Model
{
    protected $table 	= 'confirmatory_date';

    protected $fillable = [
        'patient_id','confirmatory_date'
    ];
	public $timestamps 	= false;

    public function Patient()
    {
        return $this->belongsTo('App\Patient', 'id','patient_id');
    }

    public function getConfirmatoryDateFormatAttribute()
    {
        return $this->confirmatory_date = date('F d, Y',strtotime($this->confirmatory_date));
    }

    public function setConfirmatoryDateAttribute($value)
    {
        return $this->attributes['confirmatory_date'] = date('Y-m-d',strtotime($value));
    }
}

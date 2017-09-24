<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientDoctor extends Model
{
    protected $table 	= 'patient_doctor';

    protected $fillable = ['patient_id', 'user_id', 'active', 'created_at', 'updated_at'];

    /**
    Relationships
    **/

    public function Patient()
    {
        return $this->hasMany('App\Patient', 'id', 'patient_id');
    }

    public function Doctor()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    /**
    Getters to Select
    **/

    public function getActiveFormatAttribute()
    {
        if($this->active == 1)
        {
            return 'Active';
        }
        else
        {
            return 'Inactive';
        }
    }
}

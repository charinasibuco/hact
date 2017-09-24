<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckupSymptoms extends Model
{
    protected $table = 'checkup_symptoms';

    public function symptoms()
    {
    	return $this->hasOne('App\Symptoms','symptoms_id','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfectionsClinicalStage extends Model
{
    protected $table 	= 'infections_clinical_stage';

    public $timestamps 	= true;

    public function infections(){
        return $this->belongsTo('App\Infections','infections_id', 'id');
    }

    public function getDetailsAttribute($value)
    {
    	$clinical_staging = ClinicalStaging::where('stage',$this->stage)
    											->where('infection_number', $this->infection)
    											->first();
    	return $clinical_staging;

    }
}

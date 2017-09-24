<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckupLaboratoryRequest extends Model
{
    protected $table 	= 'checkup_laboratory_request';

    protected $fillable = [
        'checkup_id', 'laboratory_test_id', 'other_specify','status','remarks'
    ];

    public $timestamps 	= false;

    public function LaboratoryTest()
    {
        return $this->hasOne('App\LaboratoryTest','id','laboratory_test_id');
    }

    public function Checkup()
    {
        return $this->belongsTo('App\Checkup', 'checkup_id','id');
    }

    /*public function LaboratoryType()
    {
        return $this->hasOne('App\LaboratoryType', 'id', 'laboratory_test_id');
    }*/

    public function setOtherSpecifyAttribute($value)
    {
    	if($value == '')
    	{
        	$this->attributes['other_specify'] = '';
    	}
    	else
    	{
        	$this->attributes['other_specify'] = $value;
    	}
    }
}

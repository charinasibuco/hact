<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientTransfer extends Model
{
    protected $table 	= 'patient_transfer';

    protected $fillable = [
        'patient_id','transfer'
    ];
	public $timestamps 	= false;

    public function Patient()
    {
        return $this->belongsTo('App\Patient', 'id','patient_id');
    }

    public function setTransferDateAttribute($value)
    {
        $this->attributes['transfer_date'] = date('Y-m-d', (strtotime($value)));
    }

    public function getTransferFormatAttribute()
    {
    	if($this->transfer == 1)
    	{
    		return "Transferred In";
    	}
    	elseif($this->transfer == 2)
    	{
    		return "Transferred Out";
    	}
    	else
    	{
    		return "";
    	}
    }
    public function getTransferFormat2Attribute()
    {
        if($this->transfer == 1)
        {
            return "Transferred In";
        }
        elseif($this->transfer == 2)
        {
            $transfer_date = date("F d, Y",strtotime($this->transfer_date));
            return "Transferred Out"." (".$transfer_date.")";
        }
        else
        {
            return "None";
        }
    }
}

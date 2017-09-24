<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Prescription extends Model
{
    protected $table 	= 'prescription';

    protected $fillable = [
    	'pills_dispense', 'date_dispense', 'user_id', 'created_at', 'updated_at', 
        'medicine_inventory_id', 'patient_id', 'arv_item_id', 'pills_missed_in_30_days', 'pills_left', 
    ];

    public $timestamps 	= true;

    /**
    Relationships
    **/

    public function Patient()
    {
        return $this->hasOne('App\Patient', 'id', 'patient_id');
    }

    public function Medicine()
    {
        return $this->hasOne('App\MedicineModel', 'id', 'medicine_id');
    }

    public function ARVItems()
    {
        return $this->hasOne('App\ARVItems', 'id', 'arv_item_id');
    }

    public function MedicineInventory()
    {
        return $this->hasOne('App\MedicineInventory', 'id', 'medicine_inventory_id');
    }

    public function User()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    /*public function MedicineInventory()
    {
        return $this->hasOne('App\MedicineInventory', 'id', 'user_id');
    }*/

    /**
    Setters to Insert
    **/

    public function setDateDispenseAttribute($value)
    {
        $this->attributes['date_dispense'] = date('Y-m-d', strtotime($value));
    }

    /**
    Getters to Insert
    **/

    public function getDateDispenseAttribute(){
        return Carbon::parse($this->attributes['date_dispense']);
    }
    public function getDateDispenseFormat1Attribute()
    {
        return date('F d, Y', strtotime($this->date_dispense));
    }

    public function getDateDispenseFormat2Attribute()
    {
        return date('Y-M-d', strtotime($this->date_dispense));
    }

    public function getCreatedAtFormatAttribute()
    {
        return date('Y-M-d H:i:s', strtotime($this->created_at));
    }
}

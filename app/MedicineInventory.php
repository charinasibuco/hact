<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MedicineInventory extends Model
{
    protected $table 	= 'medicine_inventory';

    protected $fillable = ['medicine_id', 'tabs_per_bottle', 'expiry_date', 'lot_number', 'quantity', 'created_at', 'updated_at'];

    public $timestamps 	= true;

    public function getCurrentMedicineStockAttribute()
    {
        $medicine_inventory_id = $this->id;

        $total_stock    = MedicineInventory::where('id', $medicine_inventory_id)->sum('quantity');
        $dispense       = Prescription::where('medicine_inventory_id', $medicine_inventory_id)->sum('pills_dispense');

        return $total_stock - $dispense;
    }

    public function MedicineModel()
    {
        return $this->hasOne('App\MedicineModel', 'id', 'medicine_id');
    }

    public function getExpiryDateAttribute(){
        return Carbon::parse($this->attributes['expiry_date']);
    }

    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at']);
    }

    public function setExpiryDateAttribute($value){
        $this->attributes['expiry_date'] = Carbon::parse($value)->format('Y-m-d');
    }
}

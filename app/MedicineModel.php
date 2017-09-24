<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use App\Prescription;
use App\MedicineInventory;

class MedicineModel extends Model
{
    protected $table = 'medicines';

    protected $fillable = ['name', 'classification', 'item_code', 'suggested_dosage'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function history(){
        return $this->hasMany('App\MedicineHistory', 'medicine_id', 'id');
    }

    public function Prescription(){
        return $this->belongsTo('App\Prescription', 'id', 'medicine_id');
    }

    public function ARV()
    {
        return $this->belongsTo('App\ARV', 'id', 'id');
    }

    public function MedicineInventory()
    {
        return $this->belongsTo('App\MedicineInventory', 'id', 'id');
    }

    /*public function getExpiryDateAttribute()
    {
        return Carbon::parse($this->attributes['expiry_date']);
    }*/

    /*public function getTotalTabsAttribute(){
        return $this->attributes['tabs_per_bottle'] * $this->attributes['quantity'];
    }*/

    /*public function getMedicineLabelAttribute(){
        //return $item_code . '' .  date('Y-m-d', strtotime($expiry_date));
        return $this->attributes['item_code'] . '' .  Carbon::parse($this->attributes['expiry_date'])->format('Y-m-d');
        #CONCAT(name, \' (\', , \' \', DATE_FORMAT(expiry_date, \'%b-%d-%Y\'), \')\' )
    }*/

    public function scopeSearchMedicineList($query, $search){
        $search = '%' . $search . '%';
        return $query->where('name', 'LIKE', $search);
    }

    public function getClassificationFormatAttribute()
    {
        if($this->classification == 1)
        {
            return "ARV";
        }
        elseif($this->classification == 2)
        {
            return "OI";
        }
    }

    public function getMedicineClassAttribute(){
        if($this->attributes['quantity'] <= 100 && $this->attributes['quantity'] >= 20) {
            return 'warning_medicine';
        }elseif($this->attributes['quantity'] <= 20) {
            return 'critical_medicine';
        }else {
            return '';
        }
    }

    public function getDeductQuantityAttribute()
    {
        $medicine_id = $this->id;

        return  Prescription::whereIn('arv_item_id', function($query) use ($medicine_id){
                    $query->select('id')->from('arv_items')->where('specified_medicine', '')->where('medicine_id', $medicine_id);
                })
                ->sum('pills_dispense');
    }

    public function getCurrentStockAttribute()
    {
        $medicine_id = $this->id;

        $total_stock    = MedicineInventory::where('medicine_id', $medicine_id)->sum('quantity');

        $dispense       = Prescription::whereIn('medicine_inventory_id', function($query) use ($medicine_id) {
                            $query->select('id')->from('medicine_inventory')->where('medicine_id', $medicine_id);
                          } )->sum('pills_dispense');
        #return $medicine_id;
        return $total_stock - $dispense;
    }

    public function getExpiryDateAttribute()
    {
        return Carbon::parse($this->attributes['expiry_date']);
    }
}

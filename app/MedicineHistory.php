<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MedicineHistory extends Model
{
    protected $table = 'medicine_histories';

    public $timestamps = false;

    public function medicine(){
        return $this->belongsTo('App\MedicineModel', 'medicine_id', 'id');
    }

    public function getLogDateAttribute(){
        return Carbon::parse($this->attributes['log_date']);
    }
}

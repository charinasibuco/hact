<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Laboratory extends Model
{
    protected $table    = 'laboratory';

    protected $fillable = ['patient_id','user_id','laboratory_type_id','result','result_date','other','image'];

    public $timestamps  = true;

    public function patient(){
        return $this->belongsTo('App\Patient','patient_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id', 'id');
    }

    public function LaboratoryType(){
        return $this->belongsTo('App\LaboratoryType','laboratory_type_id', 'id');
    }


    /**
     * some objects still use the lower case
     */
    public function laboratory_type(){
        return $this->belongsTo('App\LaboratoryType','laboratory_type_id', 'id');
    }

    public function setResultDateAttribute($value)
    {
        return $this->attributes['result_date'] = date('Y-m-d',strtotime($value));
    }

    public function getResultDateAttribute()
    {
        return Carbon::parse($this->attributes['result_date']);
    }

    public function getResultDateFormatAttribute()
    {
        return $this->result_date = date('F d, Y',strtotime($this->result_date));
    }

    public function orderInBatch($value){
        $order = $value=='first'?'asc':'desc';
        $batch = Laboratory::where('created_at',$this->created_at)->orderBy('laboratory_type_id',$order)->get();
        if($this == $batch->first()){
            return true;
        }else{
            return false;
        }
    }

    public function slugOther(){
        return str_replace(' ','_',$this->other);
    }

/*    public function LaboratoryTest()
    {
        return $this->hasOne('App\LaboratoryTest','laboratory_test_id', 'id');
    }*/

    /*public function setImageAttribute($value){
        $max = DB::table('laboratory')->max('id');
        $count = $max+1;
        if($value)
        {
                    $extension = $value->getClientOriginalExtension();
                     $path = 'images/laboratory/';
                     $value->move($path,$count.'.'.$extension);
            return $this->attributes['image'] = $path.$count.'.'.$extension;
        }
    }*/
}

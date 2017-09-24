<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\ARVItems;
use App\Prescription;

class ARV extends Model
{
    protected $table 	= 'arv';

    protected $fillable = [
        'patient_id', 'user_id', 'created_at', 'updated_at'
    ];

    public $timestamps 	= true;

    /**
    Relationships
    **/

    public function ARVItems()
    {
        return $this->hasMany('App\ARVItems','arv_id','id');
    }

    public function Patient()
    {
        return $this->hasOne('App\Patient', 'id', 'patient_id');
    }

    public function Checkup()
    {
        return $this->belongsTo('App\CheckupARV', 'id', 'arv_id');
    }

    public function User()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    /**
    Getters
    **/

    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at']);
    }

    public function getCreatedAtFormatAttribute()
    {
        return date('Y-M-d H:i:s', strtotime($this->created_at));
    }

    public function getUpdatedAtFormatAttribute()
    {
        return date('Y-M-d H:i:s', strtotime($this->updated_at));
    }

    /*public function getArvCountAttribute()
    {
        return 0;
        $arv_count = Prescription::where('arv_id', $this->id)->count();

        return $arv_count;
    }*/

    public function getArvCountAttribute()
    {
        $id = $this->id;

        return  Prescription::whereIn( 'arv_item_id', function($query) use ($id){
                    $query->select('id')->from('arv_items')->where('arv_id', $id);
                })->count();
    }

    public function getArvRecordAttribute()
    {
        return 0;
        return Prescription::where('arv_id', $this->id)->first();
    }

    public function getArvItemsAttribute()
    {
        return ArvItems::where('arv_id', $this->id)->get();
    }
}

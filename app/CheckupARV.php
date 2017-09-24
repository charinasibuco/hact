<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckupARV extends Model
{
    protected $table 	= 'checkup_arv';

    protected $fillable = [
        'checkup_id', 'arv_id'
    ];

    public function ARV()
    {
        return $this->hasOne('App\ARV', 'id', 'arv_id');
    }
    public function Checkup()
    {
        return $this->hasOne('App\Checkup', 'id', 'checkup_id');
    }


    public $timestamps 	= false;
}

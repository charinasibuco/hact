<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckupInfections extends Model
{
    protected $table 	= 'checkup_infections';

    protected $fillable = ['checkup_id','infection_id'];

    public $timestamps 	= false;

    public function Infections()
    {
        return $this->belongsTo('App\Infections','infection_id','id');
    }

    public function Checkup()
    {
        return $this->belongsTo('App\Checkup', 'checkup_id','id');
    }
}

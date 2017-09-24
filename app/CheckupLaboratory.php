<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckupLaboratory extends Model
{
    protected $table 	= 'checkup_laboratory';

    protected $fillable = ['checkup_id','laboratory_id'];

    public $timestamps 	= false;

    public function Laboratory()
    {
        return $this->hasOne('App\Laboratory','id','laboratory_id');
    }

    public function Checkup()
    {
        return $this->hasOne('App\Checkup', 'id','checkup_id');
    }
}

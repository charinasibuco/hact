<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class LaboratoryTest extends Model
{
    protected $table 	= 'laboratory_test';

    public $timestamps 	= false;

    protected $fillable = ['group','description'];

    public function LaboratoryType(){
        return $this->hasMany('App\LaboratoryType');
    }
}

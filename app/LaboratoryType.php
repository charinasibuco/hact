<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaboratoryType extends Model
{
    protected $table 	= 'laboratory_type';

    public $timestamps 	= false;

    protected $fillable = ['description'];

    public function LaboratoryTest()
    {
        return $this->belongsTo('App\LaboratoryTest','laboratory_test_id','id');
    }
}

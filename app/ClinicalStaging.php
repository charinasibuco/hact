<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicalStaging extends Model
{
    protected $table 	= 'clinical_staging';

    protected $fillable = ['stage', 'infection_number','infection_name'];

    public $timestamps 	= false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symptoms extends Model
{
    protected $table = 'symptoms';
    protected $fillable = ['pill','symptoms','monitoring'];
    public $timestamps = false;
}

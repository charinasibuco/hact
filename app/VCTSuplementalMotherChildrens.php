<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VCTSuplementalMotherChildrens extends Model
{
    protected $table 	= 'vct_suplemental_mother_childrens';
    public $timestamps 	= false;

    protected $fillable = [
        'mother_id', 'status', 'place_tested', 'date_tested', 'user_id', 'created_at'
    ];
    /**
    Relationships
    **/

    public function Mother()
    {
        return $this->hasMany('App\VCTSuplementalMother', 'id', 'mother_id');
    }

    /**
    Setters to Insert
    **/

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value;
    }

    public function setPlaceTestedAttribute($value)
    {
        $this->attributes['place_tested'] = $value;
    }

    public function setDateTestedAttribute($value)
    {
        $this->attributes['date_tested'] = ($this->attributes['status'] == 3) ? null : date('Y-m-d', (strtotime($value)));
    }

    /**
    Getters to Select
    **/

    public function getDateTestedFormatAttribute()
    {
        return date('F d, Y', strtotime($this->date_tested));
    }
}

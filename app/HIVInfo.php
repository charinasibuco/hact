<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HIVInfo extends Model
{
    protected $table = 'hiv_info'; 
    protected $fillable = [
        'type','description','user_id','file','image','display'
    ];

    public function User()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


}

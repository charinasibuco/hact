<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckupReferrals extends Model
{
    protected $table 	= 'checkup_referrals';

    protected $fillable = [
        'checkup_id', 'surgeon', 'ob_gyne', 'ophthamology', 'dentis', 'psychiatrist', 'others', 'others_status', 'reason'
    ];

    public function Checkup()
    {
        return $this->belongsTo('App\Checkup', 'checkup_id','id');
    }

    public $timestamps 	= false;
}

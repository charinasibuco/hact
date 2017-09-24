<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table 	= 'activity_log';

    protected $fillable = [
        'page', 'message', 'user_id', 'created_at'
    ];

    public $timestamps 	= false;

    /**
    Relationships
    **/

    public function User()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function getCreatedAtFormatAttribute()
    {
        return date('Y-M-d h:i:s a', strtotime($this->created_at));
    }

    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at']);
    }
}

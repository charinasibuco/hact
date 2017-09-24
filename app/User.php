<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password', 'contact_number', 'access', 'active', 'reset'];

    protected $hidden = ['password', 'remember_token'];

    public function getActiveFormatAttribute()
    {
        if($this->active == 1)
        {
            return 'Active';
        }
        else
        {
            return 'Inactive';
        }
    }

    public function getAccessNameAttribute()
    {
    	if($this->access == 1)
    	{
    		return 'Admin';
    	}
    	elseif($this->access == 2)
    	{
    		return 'Attending Physician';
    	}
        elseif($this->access == 3)
        {
            return 'Laboratory';
        }
    	else
    	{
    		return '';
    	}
    }

    public function VCT()
    {
        return $this->belongsTo('App\VCT', 'id', 'id');
    }

    public function PatientDoctor()
    {
        return $this->belongsTo('App\PatientDoctor', 'id', 'id');
    }

    public function Prescription()
    {
        return $this->belongsTo('App\Prescription', 'id', 'id');
    }

    public function Checkup()
    {
        return $this->belongsTo('App\Checkup', 'id', 'id');
    }

    public function ActivityLog()
    {
        return $this->belongsTo('App\ActivityLog', 'id', 'id');
    }

    public function ARV()
    {
        return $this->belongsTo('App\ARV', 'id', 'id');
    }
}

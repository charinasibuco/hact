<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class VCT extends Model
{
    protected $table 	= 'vct';

     protected $fillable = [
'user_id','vct_date','result','reason_1','reason_2','reason_3','reason_4','reason_5','reason_6',
'reason_7','reason_8','reason_9','reason_10','reason_11','reason_12','reason_13','reason_14','reason_other',
'experience1','experience2','experience3','experience4','experience5','experience6','experience7','experience8',
'is_your_mother_infected_with_hiv','experience_1_if_yes_what_year','experience_2_if_yes_what_year','experience_3_if_yes_what_year','experience_4_if_yes_what_year','experience_5_if_yes_what_year','experience_6_if_yes_what_year','experience_7_if_yes_what_year','experience_8_if_yes_what_year','number_of_female','last_year_sex_female','number_of_male',
'last_year_sex_male','been_tested_for_hiv_before','been_tested_for_hiv_before_month','been_tested_for_hiv_before_year',
'which_testing_facility','which_testing_facility_city','test_result'
     ];
    /**
    Relationships
    **/

    public function User()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function Patient()
    {
        return $this->hasOne('App\Patient', 'id', 'patient_id');
    }

    public function VCTSuplementalChildren()
    {
        return $this->belongsTo('App\VCTSuplementalChildren', 'id', 'id');
    }

    public function VCTSuplementalMother()
    {
        return $this->belongsTo('App\VCTSuplementalMother', 'id', 'id');
    }

    /**
    Setters to Insert
    **/

    public function setVctDateAttribute($value)
    {
        $this->attributes['vct_date'] = date('Y-m-d', (strtotime($value)));
    }

    // Reason

    public function setReason1Attribute($value)
    {
        $this->attributes['reason_1'] = (is_null($value))? 0 : 1;
    }

    public function setReason2Attribute($value)
    {
        $this->attributes['reason_2'] = (is_null($value))? 0 : 1;
    }

    public function setReason3Attribute($value)
    {
        $this->attributes['reason_3'] = (is_null($value))? 0 : 1;
    }

    public function setReason4Attribute($value)
    {
        $this->attributes['reason_4'] = (is_null($value))? 0 : 1;
    }

    public function setReason5Attribute($value)
    {
        $this->attributes['reason_5'] = (is_null($value))? 0 : 1;
    }

    public function setReason6Attribute($value)
    {
        $this->attributes['reason_6'] = (is_null($value))? 0 : 1;
    }

    public function setReason7Attribute($value)
    {
        $this->attributes['reason_7'] = (is_null($value))? 0 : 1;
    }

    public function setReason8Attribute($value)
    {
        $this->attributes['reason_8'] = (is_null($value))? 0 : 1;
    }

    public function setReason9Attribute($value)
    {
        $this->attributes['reason_9'] = (is_null($value))? 0 : 1;
    }

    public function setReason10Attribute($value)
    {
        $this->attributes['reason_10'] = (is_null($value))? 0 : 1;
    }

    public function setReason11Attribute($value)
    {
        $this->attributes['reason_11'] = (is_null($value))? 0 : 1;
    }

    public function setReason12Attribute($value)
    {
        $this->attributes['reason_12'] = (is_null($value))? 0 : 1;
    }

    public function setReason13Attribute($value)
    {
        $this->attributes['reason_13'] = (is_null($value))? 0 : 1;
    }

    public function setReason14Attribute($value)
    {
        $this->attributes['reason_14'] = (is_null($value))? 0 : 1;
    }

    // Experience

    public function setExperience1IfYesWhatYearAttribute($value)
    {
        $this->attributes['experience_1_if_yes_what_year'] = (is_null($value))? '' : $value;
    }

    public function setExperience2IfYesWhatYearAttribute($value)
    {
        $this->attributes['experience_2_if_yes_what_year'] = (is_null($value))? '' : $value;
    }

    public function setExperience3IfYesWhatYearAttribute($value)
    {
        $this->attributes['experience_3_if_yes_what_year'] = (is_null($value))? '' : $value;
    }

    public function setExperience4IfYesWhatYearAttribute($value)
    {
        $this->attributes['experience_4_if_yes_what_year'] = (is_null($value))? '' : $value;
    }

    public function setExperience5IfYesWhatYearAttribute($value)
    {
        $this->attributes['experience_5_if_yes_what_year'] = (is_null($value))? '' : $value;
    }

    public function setExperience6IfYesWhatYearAttribute($value)
    {
        $this->attributes['experience_6_if_yes_what_year'] = (is_null($value))? '' : $value;
    }

    public function setExperience7IfYesWhatYearAttribute($value)
    {
        $this->attributes['experience_7_if_yes_what_year'] = (is_null($value))? '' : $value;
    }

    public function setExperience8IfYesWhatYearAttribute($value)
    {
        $this->attributes['experience_8_if_yes_what_year'] = (is_null($value))? '' : $value;
    }

    /**
    Getters to Select
    **/
    public function getVctDateAttribute(){
        return Carbon::parse($this->attributes['vct_date']);
    }

    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at']);
    }

    public function getCreatedAtFormatAttribute()
    {
        return date('F d, Y H:i', strtotime($this->created_at));
    }

    public function getVctDateFormatAttribute()
    {
        return date('F d, Y', strtotime($this->vct_date));
    }

    public function getVctDateFormat2Attribute()
    {
        return date('Y-M-d', strtotime($this->vct_date));
    }

    public function getVctDateYearAttribute()
    {
        return date('Y', strtotime($this->vct_date));
    }

    public function getResultFormatAttribute()
    {
        $result = $this->result;

        if($result == 0)
        {
            return 'Non-Reactive';
        }
        elseif($result == 1)
        {
            return 'Negative';
        }
        elseif($result == 2)
        {
            return 'Postive';
        }
        elseif($result == 3)
        {
            return 'Indeterminate';
        }
    }

    public function getLastAssignedDoctorAttribute()
    {
        $doctor = PatientDoctor::where('active', 1)->where( 'patient_id', $this->patient_id )->orderBy( 'created_at', 'DESC' )->first();

        if(is_null($doctor))
        {
            return '';
        }
        else
        {
            return $doctor->user_id;
        }
    }

    public function getLastAssignedDoctorNameAttribute()
    {
        $doctor = PatientDoctor::where( 'patient_id', $this->patient_id )->orderBy( 'created_at', 'DESC' )->first();

        if(is_null($doctor))
        {
            return '-';
        }
        else
        {
            return $doctor->Doctor->name;
        }
    }

    public function getTotalVctRecordAttribute()
    {
        return VCT::where('patient_id', $this->patient_id)->count();
    }

    public function getLastVCTRecordAttribute()
    {
        $vct = VCT::where( 'patient_id', $this->patient_id )->orderBy( 'vct_date', 'DESC' )->first();
        
        return $vct;
    }

    /**
    Call Scopes
    **/

    public function scopeSearchPatientList($query, $search)
    {
        $search = '%' . $search . '%';
        return Patient::select('id')->where('code_name', 'LIKE', $search)
                    ->orWhere('ui_code', 'LIKE', $search)->first();
    }
}

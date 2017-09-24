<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Mortality;

class Patient extends Model
{
    protected $table 	= 'patient';
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'enrolment_date',
        'ui_code','code_name','saccl_code', 'gender','phil_health_number',
        'birth_date','gender', 'civil_status','dependents','nationality','permanent_address',
        'current_city','current_province','birth_place_city','birth_place_province','contact_number',
        'email','highest_educational_attainment','is_working','is_living_with_partner','is_presently_pregnant',
        'current_occupation','previous_occupation','is_work_abroad_in_past_5years','last_contract',
        'is_based','last_work_country'];
    public $timestamps 	= true;

    /**
    Relationships
    **/

    public function VCT()
    {
        return $this->hasMany('App\VCT');
    }

    public function PatientDoctor()
    {
        return $this->belongsToMany('App\PatientDoctor', 'patient_id', 'id');
    }

    public function ObGyne()
    {
        return $this->hasMany('App\ObGyne');
    }

    public function MedicalAbstract()
    {
        return $this->hasMany('App\MedicalAbstract', 'id', 'patient_id');
    }

    public function Mortality()
    {
        return $this->hasOne('App\Mortality',  'patient_id', 'id');
    }

    public function ConfirmatoryDate()
    {
        return $this->hasOne('App\ConfirmatoryDate', 'patient_id', 'id');
    }

    public function PatientTransfer()
    {
        return $this->hasOne('App\PatientTransfer', 'patient_id', 'id');
    }

    public function Checkup()
    {
        return $this->hasMany('App\Checkup', 'patient_id', 'id');
    }

    public function Laboratory()
    {
        return $this->hasMany('App\Laboratory', 'patient_id', 'id');
    }

    public function Infections()
    {
        return $this->hasMany('App\Infections', 'patient_id', 'id');
    }

    public function Prescription()
    {
        return $this->belongsTo('App\Prescription', 'id', 'id');
    }

    public function ARV()
    {
        return $this->hasMany('App\ARV', 'patient_id', 'id');
    }
    public function Tuberculosis()
    {
        return $this->hasMany('App\TuberculosisModel', 'patient_id', 'id');
    }

    /**
    Setters to Insert
    **/
    public function setUICodeAttribute($value)
    {
        $this->attributes['ui_code'] = strtoupper($value);
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = date('Y-m-d', strtotime($value));
    }

    public function setEnrolmentDateAttribute($value)
    {
        $this->attributes['enrolment_date'] = date('Y-m-d', strtotime($value));
    }

    public function setLastContractAttribute($value)
    {
        if(is_null($value) || $value == '')
        {
            $this->attributes['last_contract'] = null;
        }
        else
        {
            $this->attributes['last_contract'] = date('Y-m-d', strtotime($value));
        }
    }

    /**
    Getters to Select
    **/

    public function getEnrolmentDateAttribute()
    {
        return Carbon::parse($this->attributes['enrolment_date']);
    }

    public function getBirthDateAttribute(){
        return Carbon::parse($this->attributes['birth_date']);
    }

    public function getBirthDateFormatAttribute($value)
    {
         if(is_null($this->birth_date) || $this->birth_date == '')
        {
            return null;
        }
        else
        {
            return date('F d, Y', strtotime($this->birth_date));
        }
    }

    public function getGenderFormatAttribute()
    {
        if($this->gender == 1)
        {
            return 'Male';
        }
        else
        {
            return 'Female';
        }
    }

    public function getCivilStatusFormatAttribute()
    {
        if($this->civil_status == 1)
        {
            return 'Single';
        }
        elseif($this->civil_status == 2)
        {
            return 'Married';
        }
        elseif($this->civil_status == 3)
        {
            return 'Separated';
        }
        elseif($this->civil_status == 4)
        {
            return 'Widowed';
        }
    }

    public function getHighestEducationalAttainmentFormatAttribute()
    {
            // 0 = None, 1 = Elementary, 2 = High School, 3 = Vocational, 4 = Post-Graduate, 5 = College
        if($this->highest_educational_attainment == 1)
        {
            return 'Elementary';
        }
        elseif($this->highest_educational_attainment == 2)
        {
            return 'High School';
        }
        elseif($this->highest_educational_attainment == 3)
        {
            return 'Vocational';
        }
        elseif($this->highest_educational_attainment == 4)
        {
            return 'Post-Graduate';
        }
        elseif($this->highest_educational_attainment == 5)
        {
            return 'College';
        }
        else
        {
            return 'None';
        }
    }

    public function getIsLivingWithPartnerFormatAttribute()
    {
        if($this->is_living_with_partner == 1)
        {
            return 'Yes';
        }
        else
        {
            return 'No';
        }
    }

    //Pregnant format
    public function getIsPresentlyPregnantFormatAttribute()
    {
        if($this->is_presently_pregnant == 1)
        {
            return 'Yes';
        }
        else
        {
            return 'No';
        }
    }

    public function getIsWorkingFormatAttribute()
    {
        if($this->is_working == 1)
        {
            return 'Yes';
        }
        else
        {
            return 'No';
        }
    }

    public function getAgeAttribute()
    {
        $current_date       = \Carbon\Carbon::now();
        $birth_date         = \Carbon\Carbon::parse($this->birth_date);

        $mortality = Mortality::where('patient_id', $this->id)->first();

        if($mortality)
        {
            $death = \Carbon\Carbon::parse($mortality->date_of_death);

            return $birth_date->diffInYears($death);
        }
        else
        {

            return $current_date->diffInYears($birth_date);
        }

        /*$current_date   = date("Y-m-d"); 
        $birth_date     = $this->birth_date;
        $age   = floor($current_date - $birth_date /(365.25 * 24 * 60 * 60 * 1000)-$birth_date);
        return $age;*/
    }

    public function getIsWorkAbroadInPast5yearsFormatAttribute()
    {
        if($this->is_work_abroad_in_past_5years == 1)
        {
            return 'Yes';
        }
        else
        {
            return 'No';
        }
    }

    public function getIsBasedFormatAttribute()
    {
        if($this->is_based == 1)
        {
            return 'On a ship';
        }
        else
        {
            return 'Land';
        }
    }

    public function getVctTestedDataAttribute()
    {
        if($this->VCT()->count() > 1)
        {
            if($this->VCT()->been_tested_for_hiv_before == 1)
            {
                return "Yes";
            }
            else
            {
                return "No";
            }
        }
        else
        {
            return '-';
        }
    }

    public function getVctDataAttribute()
    {
        if($this->VCT()->count() > 1)
        {
            if($this->VCT()->been_tested_for_hiv_before == 1)
            {
                return "Yes";
            }
            else
            {
                return "No";
            }

        }
        else
        {
            return '-';
        }
    }

    /**
    Call Scopes
    **/

    public function scopeSearchPatientList($query, $search)
    {
        $search = '%' . $search . '%';

        return $query->where('saccl_code', 'LIKE', $search)
                    ->orWhere('code_name', 'LIKE', $search)
                    ->orWhere('ui_code', 'LIKE', $search);
    }

    /**
    Call Functions
    **/

    public function getSearchedFullNameAttribute()
    {
        return $this->code_name;
    }

    public function getLastContractAttribute(){
        if(is_null($this->attributes['last_contract']) || $this->attributes['last_contract'] == '')
        {
            return null;
        }
        else{
            return Carbon::parse($this->attributes['last_contract']);
        }
    }

    public function getLastContractFormatAttribute()
    {
        if(is_null($this->last_contract) || $this->last_contract == '')
        {
            return null;
        }
        else
        {
            return date('F d, Y', strtotime($this->last_contract));
        }
    }

    public function getEnrolmentDateFormatAttribute()
    {
        if(is_null($this->enrolment_date) || $this->enrolment_date == '')
        {
            return null;
        }
        else
        {
            return date('F d, Y', strtotime($this->enrolment_date));
        }
    }

    public function getTotalVctRecordAttribute()
    {
        return VCT::where('patient_id', $this->id)->count();
    }

    public function getLastVctRecordAttribute()
    {
        $vct = VCT::where('patient_id', $this->id )->orderBy( 'vct_date', 'DESC' )->first();
        
        return $vct;
    }

    public function getLastAssignedDoctorAttribute()
    {
        $doctor = PatientDoctor::where( 'patient_id', $this->id )->orderBy( 'created_at', 'DESC' )->first();

        if(is_null($doctor))
        {
            return '';
        }
        else
        {
            return $doctor->user_id;
        }
    }

    public function getArvCountAttribute(){
        $count = 0;

        if($this->Checkup->count() > 0){
            foreach($this->Checkup as $row){
                if(!is_null($row->CheckupARV)){
                    foreach($row->CheckupARV as $row2){
                        $count++;
                    }
                }
            }
        }

        return $count;
    }

    public function getMaxDeliveredDateAttribute(){
        return $this->attributes['max_delivered_date'] != NULL ? Carbon::parse($this->attributes['max_delivered_date']) : NULL;
    }

    public function getIsMortalityAttribute()
    {
        return Mortality::where('patient_id', $this->id)->count();
    }
}

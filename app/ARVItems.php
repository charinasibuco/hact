<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Prescription;
use App\MedicineModel;

class ARVItems extends Model
{
    protected $table 	= 'arv_items';

    protected $fillable = [
        'arv_id', 'infection', 'medicine_id', 'specified_medicine',
        'pills_per_day', 'date_started', 'date_discontinued', 'reason', 'specify'
    ];

    public $timestamps 	= false;

    /**
    Relationships
    **/
    
    public function ARV()
    {
        return $this->belongsTo('App\ARV', 'id', 'arv_id');
    }
    
    public function Medicine()
    {
        return $this->hasOne('App\MedicineModel', 'id', 'medicine_id');
    }
    
    public function Prescription()
    {
        return $this->hasOne('App\Prescription', 'id', 'arv_item_id');
    }

    public function MedicineInventory()
    {
        return $this->hasMany('App\MedicineInventory', 'medicine_id', 'medicine_id');
    }

    /**
    Getters
    **/
    public function getDateStartedAttribute(){
        return Carbon::parse($this->attributes['date_started']);
    }

    public function getDateDiscontinueAttribute(){
        if($this->attributes['date_discontinued'] != null) {
            return Carbon::parse($this->attributes['date_discontinued']);
        }

        return null;
    }

    public function getDateDiscontinuedFormat1Attribute()
    {
        return date('Y-M-d', strtotime($this->date_discontinued));
    }

    public function getDateDiscontinuedFormat2Attribute()
    {
        return date('F d, Y', strtotime($this->date_discontinued));
    }

    public function getDateStartedFormat1Attribute()
    {
        return date('Y-M-d', strtotime($this->date_started));
    }

    public function getDateStartedFormat2Attribute()
    {
        return date('F d, Y', strtotime($this->date_started));
    }

    public function getReasonFormatAttribute()
    {
        $value = $this->reason;

        if($value == 1)
        {
            return 'Treatment Failure';
        }
        elseif($value == 2)
        {
            return 'Clinical Progression/Hospitalization';
        }
        elseif($value == 3)
        {
            return 'Patient Decision/Request';
        }
        elseif($value == 4)
        {
            return 'Compliance Difficulties';
        }
        elseif($value == 5)
        {
            return 'Drug Interaction';
        }
        elseif($value == 6)
        {
            return 'Adverse Event (' . $this->specify . ')';
        }
        elseif($value == 7)
        {
            return 'Others (' . $this->specify . ')';
        }
        elseif($value == 8)
        {
            return 'Death';
        }
    }

    // 1 = Treatment Failure, 2 = Clinical Progression/Hospitalization, 3 = Patient Decision/Request
            // 4 = Compliance Difficulties, 5 = Drug Interaction, 6 = Adverse Event (Specify),
            // 7 = Others (Specify), 8 = Death

    public function getInfectionFormatAttribute()
    {
        $infection = $this->infection;

        if($infection == 'hepatitis_b')
        {
            return 'Hepatitis B';
        }
        elseif($infection == 'hepatitis_c')
        {
            return 'Hepatitis C';
        }
        elseif($infection == 'pneumocystis_pneumonia')
        {
            return 'Pneumocystis Pneumonia';
        }
        elseif($infection == 'orpharyngeal_candidiasis')
        {
            return 'Orpharyngeal Candidiasis';
        }
        elseif($infection == 'syphilis')
        {
            return 'Syphilis';
        }
        elseif($infection == 'stis')
        {
            #Infections::where('patient_id', $id)->orderBy('result_date', 'DESC')->first()
            #return 'STI`s ( ' . $row->stis . ' )';
            return 'STI`s';
        }
        elseif($infection == 'others')
        {
            #return 'Others ( ' . $row->others . ' )';
            return 'Others';
        }
    }

    public function getArvItemCountAttribute()
    {
        return Prescription::where( 'arv_item_id', $this->id )->count();
    }

    public function getMedicineDataAttribute(){
        $item = $this;
        $med_data       = [];
        if($item->prescription_type == 'arv'){
            $medicine       = MedicineModel::find($item->medicine_id);
//                        $x['medicine_data'] = $medicine->item_code;
            if($medicine){
                $category       = explode('+', $medicine->item_code);
                foreach ($category as $key) {
                    $meds       = strtolower(trim($key));

                    $symptoms   = Symptoms::where('pill', $meds)->first();
                    $symptom    = 'N/A';
                    $monitoring = 'N/A';

                    if ($symptoms) {
                        $symptom    = $symptoms->symptoms;
                        $monitoring = $symptoms->monitoring;
                    }
                    $med_data[]     =['key' => $key, 'symptom' => $symptom, 'monitoring' => $monitoring];
                }
            }
        }

        return $med_data;
    }
}

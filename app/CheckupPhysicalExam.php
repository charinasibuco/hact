<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckupPhysicalExam extends Model
{
    protected $table 	= 'checkup_physical_exam';

    public $timestamps 	= false;

    protected $fillable = [
        'checkup_id', 'general_survey', 'skin', 'heent', 'lips_buccal_mucosa', 'sclerae',
        'conjunctivae', 'chest_and_lungs', 'cardial', 'abdomen', 'extremities',

        'general_survey_remarks', 'skin_remarks', 'heent_remarks', 'chest_and_lungs_remarks',
        'cardial_remarks', 'abdomen_remarks', 'extremities_remarks'
    ];


    public function Checkup()
    {
        return $this->belongsTo('App\Checkup', 'checkup_id','id');
    }

    public function jsonConvert($value){
        return unserialize($this['attributes'][$value]);
    }


    public function editPhysicalExam($old){
        $physical_exam = $this['attributes'];
        $physical_json = ['general_survey','skin','heent','chest_and_lungs','cardial','abdomen','extremities','lips_buccal_mucosa','sclerae','conjunctivae'];
        if($physical_exam) {
            foreach ($physical_exam as $key => $value) {
                $physical_exam[$key] = (isset($value) && in_array($key, $physical_json)) ? unserialize($value) : $value;
                $physical_exam[$key] = isset($old[$key]) ? $old[$key] : $physical_exam[$key];
            }
        }
            return $physical_exam;
    }

    public function updatePhysicalExam($physical_exam)
    {
        $physical_exam['id'] = $this['attributes']['id'];
        $physical_exam['checkup_id'] = $this['attributes']['checkup_id'];
        $physical_json = ['general_survey','skin','heent','chest_and_lungs','cardial','abdomen','extremities','lips_buccal_mucosa','sclerae','conjunctivae'];
        foreach($this['attributes'] as $key => $value)
        {
            $physical_exam[$key] = isset($physical_exam[$key])?$physical_exam[$key]:"";
            $physical_exam[$key] = in_array($key, $physical_json)?serialize($physical_exam[$key]):$physical_exam[$key];
        }


        $this->update($physical_exam);
    }
}

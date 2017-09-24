<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckupNeuroExam extends Model
{
    protected $table 	= 'checkup_neuro_exam';

    public $timestamps 	= false;

    protected $fillable = [
    	'checkup_id', 'level_of_consciousness', 'orientation', 'mood_and_behavior',
        'memory', 'cognitive_function', 'able_to_smell', 'visual_acuity', 'pupils',
        'funduscopy', '2_3', '3_4_6_eoms', 'lateralizing_gaze', 'temporal_strength',
        'able_to_clench_teeth', 'able_to_feel_pain_in_facial_area', 'corneal_reflex',
        'vii', 'taste', 'response_to_whispered_voice', 'gag_reflex', 'xi', 'xii', 'muscle_bulk',
        'muscle_tone', 'muscle_strength', 'sensory', 'reflexes', 'cerebellars', 'meningeals'
    ];

    public function Checkup()
    {
        return $this->belongsTo('App\Checkup', 'checkup_id','id');
    }

    public function jsonConvert($value){
        return unserialize($this['attributes'][$value]);
    }


    public function editNeuroExam($old){
        $neuro_exam = $this['attributes'];
        $neuro_json = ['orientation','memory','vii','xi','xii','muscle_strength','sensory','reflexes','cerebellars','meningeals','funduscopy','2_3'];
        if($neuro_exam){
            foreach($neuro_exam as $key => $value){
                $neuro_exam[$key] = (isset($value) && in_array($key, $neuro_json))? unserialize($value):$value;
                $neuro_exam[$key] = isset($old[$key])?$old[$key]:$neuro_exam[$key];
            }
            return $neuro_exam;
        }


    }
    public function updateNeuroExam($neuro_exam)
    {
        $neuro_exam['id'] = $this['attributes']['id'];
        $neuro_exam['checkup_id'] = $this['attributes']['checkup_id'];
        $neuro_json = ['orientation','memory','vii','xi','xii','muscle_strength','sensory','reflexes','cerebellars','meningeals','funduscopy','2_3'];
        foreach($this['attributes'] as $key => $value)
        {
            $neuro_exam[$key] = isset($neuro_exam[$key])?$neuro_exam[$key]:"";
            $neuro_exam[$key] = in_array($key, $neuro_json)?serialize($neuro_exam[$key]):$neuro_exam[$key];
        }

        $this->update($neuro_exam);
    }


}

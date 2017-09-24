<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CheckupRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            /*'patient_id'                => 'required|exists:patient,id',
            'checkup_date'              => 'required',
            'follow_up_date'            => 'required',
        
            'weight'                    => 'required|max:255',
            'height'                    => 'required|max:255',
            #'bmi'                       => 'required|max:255',
        
            'blood_pressure'            => 'required|max:255',
            'temperature'               => 'required|max:255',
            'pulse_rate'                => 'required|max:255',
            'respiration_rate'          => 'required|max:255',
            'lab_other_specify'         => 'required_if:lab[0],1',
            'stis'                      => 'required_if:stis_checkbox,1',
            'others'                    => 'required_if:others_checkbox,1',
            'others_referral'           => 'required_if:referral_status,1'*/
        ];
    }

    public function attributes()
    {
        return [
            'patient_id'                => 'Patient',
            'checkup_date'              => 'Checkup Date',
            'follow_up_date'            => 'Follow up Date',
                
            'weight'                    => 'Weight',
            'height'                    => 'Height',
            'bmi'                       => 'Body Mass Index',
        
            'blood_pressure'            => 'Blood Pressure',
            'temperature'               => 'Temperature',
            'pulse_rate'                => 'Pulse Rate',
            'respiration_rate'          => 'Respiration Rate',


            'lab_other_specify'         => 'Other Laboratory Request',
            'stis'                      => 'STIs',
            'others'                    => 'Other Infections',
            'others_referral'           => 'Other Referrals'
        ];
    }
    
    public function messages()
    {
        return [
            'required'      => ':attribute is required.',
            'required_if'   => ':attribute is required.',
            'exists'        => ':attribute not exists.',
            'max'           => ':attribute exceeded to 255 characters.'
        ];
    }
}

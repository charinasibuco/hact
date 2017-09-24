<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PatientStoreRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         return [
             'enrolment_date'       => 'required|date',
            'phil_health_number'    => 'max:255',

            'nationality'           => 'required|max:255',
            'birth_date'            => 'required',
            'dependents'            => 'numeric',
            'civil_status'          => 'required',
            'is_living_with_partner'=> 'required',

            'gender'                => 'required',
            'is_presently_pregnant' => 'required_if:gender,0',
            
            'code_name'             => 'required|unique:patient,code_name|max:255',

            'ui_code1'              => 'required|max:2',
            'ui_code2'              => 'required|max:2',
            'ui_code3'              => 'required|max:2',

            'permanent_address'     => 'required|max:255',
            'current_city'          => 'required|max:255',
            'current_province'      => 'max:255',

            'birth_place_city'      => 'required|max:255',
            'birth_place_province'  => 'max:255',

            'contact_number'        => 'max:255',
            'email'                 => 'email|max:255|unique:patient,email',

            'highest_educational_attainment' => 'required',

            'is_working'            => 'required',
            'current_occupation'    => 'required_if:occupation,1|max:255',
            'previous_occupation'   => 'max:255',

            'is_work_abroad_in_past_5years' => 'required',
            'last_contract'         => 'required_if:is_work_abroad_in_past_5years,1|max:255',
            'is_based'              => 'required_if:is_work_abroad_in_past_5years,1',
            'last_work_country'     => 'required_if:is_work_abroad_in_past_5years,1|max:255',

            'ui_code'               => 'unique:patient,ui_code'
        ];
    }

    public function attributes()
    {
        return [
            'phil_health_number'    => "Phil Health Number",

            'nationality'           => "Nationality",
            'birth_date'            => "Birth Date",
            'dependents'            => "Number of Children",
            'civil_status'          => "Civil Status",
            'is_living_with_partner'=> "Living with a partner",

            'gender'                => "Gender",
            'is_presently_pregnant' => "Presently Pregnant",

            'ui_code1'              => "First two letter's of mother's name",
            'ui_code2'              => "First two letter's of father's name",
            'ui_code3'              => "Birth Order",

            'permanent_address'     => "Permanent Address",
            'current_city'          => "Current Address(City)",
            'current_province'      => "Current Address(Province)",

            'birth_place_city'      => "Place of Birth(City)",
            'birth_place_province'  => "Place of Birth(Province)",

            'contact_number'        => "Contact Number",
            'email'                 => "Email",

            'highest_educational_attainment' => "Highest Educational Attainment",

            'is_working'            => "Presently Working",
            'current_occupation'    => "Current Occupation",
            'previous_occupation'   => "Previous Occupation",

            'is_work_abroad_in_past_5years' => 'Work Overseas/Abroad',

            'last_contract'         => "Last Contract Overseas/Abroad",
            'is_based'              => 'Overseas/Abroad Based',
            'last_work_country'     => "Last work country",

            'ui_code'               => "UI Code",
            'code_name'             => "Code Name",
            'saccl_code'            => "SACCL Code"
        ];
    }

    public function messages()
    {
        return [
            'required'                          => ":attribute is required",
            'required_if'                       => ":attribute is required",
            'numeric'                           => ":attribute require numeric",
            'max'                               => "The maximum characters for :attribute has been reached",
            'unique'                            => ':attribute already exist'
        ];
    }
    
    public function getValidatorInstance()
    {
        $data       = $this->all();
        $birth_date = date('m-d-Y', strtotime($data['birth_date']));
        $data['ui_code'] = $data['ui_code1'] . '-' . $data['ui_code2'] . '-' . $data['ui_code3'] . '-' . $birth_date;
        
        $this->getInputSource()->replace($data);

        return parent::getValidatorInstance();
    }
}

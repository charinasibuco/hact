<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MortalityUpdateRequest extends Request
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
            //"patient_id" => "required|unique:mortality,patient_id,". $this->patient_id,
            "date_of_death" => "required|date",
            "is_hiv_related" => "required",
            "immediate_cause" => "required|max:255",
            "underlying_cause" => "max:255",
            "antecedent_cause" => "max:255",
            "other" => "required_if:other_check,1|max:255",
            "last_cd4_count" => "required_if:have_cd4_info,1|date",
            "cd4_count" => "required_if:have_cd4_info,1|numeric|max:255",
            "have_taken_arv" => "required",
            "last_arv_regimen" => "required_if:have_taken_arv,1",
            "death_certificate" => "max:2048|mimes:jpeg,bmp,png"

        ];
       
    }

    public function attributes()
    {
        return [
            "patient_id" => "Patient",
            "date_of_death" => "Date of Death",
            "is_hiv_related" => "HIV Related",
            "immediate_cause" => "Immediate Cause",
            "underlying_cause" => "Underlying Cause",
            "antecedent_cause" => "Antecedent Cause",
            "other" => "Other",
            "have_cd4_info" => "Have CD4 Information",
            "last_cd4_count" => "Last CD4 Count",
            "cd4_count" => "CD4 Count",
            "have_taken_arv" => "Have Taken ARV",
            "last_arv_regimen" => "Last ARV Regimen",
        ];
    }

    public function messages()
    {
        return [
            'required'                          => ":attribute is required",
            'required_if'                       => ":attribute is required",
            'numeric'                           => ":attribute require numeric",
            'max'                               => "The maximum characters for :attribute has been reached",
            'unique'                            => ':attribute already exist',
        ];
    }

    /*public function getValidatorInstance()
    {
        $data = $this->all();
        $data['date_of_death'] = date('Y-m-d', strtotime($data['date_of_death']));
        $data['last_cd4_count'] = date('Y-m-d', strtotime($data['last_cd4_count']));
        $this->getInputSource()->replace($data);

        return parent::getValidatorInstance();
    }*/
}

<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InfectionsStoreRequest extends Request
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
            "stis"   =>  "required_if:stis_checkbox,1|max:255",
            "clinical_stage"   =>  "required",
            "result_date"   =>  "required|date",
            "others"  =>  "required_if:others_checkbox,1|max:255",
        ];
    }

    public function attributes()
    {
        return [
            "hemoglobin_result"   =>  "Hemoglobin Test Result",
            "hemoglobin_result_date"  =>  " Date of Hemoglobin Test Result",
            "clinical_stage"    => "Clinical Stage",
            "result_date"    => "Result Date"
        ];
    }

    public function messages()
    {
        return [
            'required'    => ":attribute is required",
            'required_if' => ":attribute is required",
            'max'         => "The maximum characters for :attribute has been reached"
        ];
    }

    /*public function getValidatorInstance()
    {
        $data = $this->all();
        $data['result_date'] = date('F d, Y', strtotime($data['result_date']));
        $this->getInputSource()->replace($data);

        return parent::getValidatorInstance();
    }*/
}

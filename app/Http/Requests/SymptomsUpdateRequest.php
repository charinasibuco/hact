<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SymptomsUpdateRequest extends Request
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
            "pill"   =>  "required|max:255|unique:symptoms,pill,".$this->id,
            "symptoms"  =>  "required|max:255",
            "monitoring" =>"required|max:255"
        ];
    }

    public function attributes()
    {
        return [
           "pill" => "Pill",
           "symptoms" => "Symptoms",
           "monitoring" => "Monitoring"
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
            'image'                             =>':attribute must be an image file'
        ];
    }
}

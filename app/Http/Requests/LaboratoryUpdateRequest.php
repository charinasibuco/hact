<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LaboratoryUpdateRequest extends Request
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
        $rules = [
            "laboratory_test_id" => "required",
            "other" => "required_if:laboratory_test_id,16|string|max:255",
            "result_date"  =>  "required|date",
            "image" => "image",
            "result" => "required|numeric"
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            "result" => "Result",
            "other" =>  "Other",
            "image" => "Image",
            "result_date"   => "Result Date",
            "laboratory_test_id" => "Laboratory Test"
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

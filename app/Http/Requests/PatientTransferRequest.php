<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PatientTransferRequest extends Request
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
            "transfer" => "required",
            "transfer_date" => "date|required_if:transfer,2"
        ];
    }

    public function attributes()
    {
        return [
            "transfer_date" => "Transfer Date"
        ];
    }

    public function messages()
    {
        return [
            "required" => ":attribute is required.",
            "required_if" => ":attribute is required.",
            "date" => ":attribute should be in a date format."
        ];
    }
}

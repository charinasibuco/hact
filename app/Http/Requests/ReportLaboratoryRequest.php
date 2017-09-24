<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReportLaboratoryRequest extends Request
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
            'patient_id' => 'required',
            'labs' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'patient_id' => 'Valid Patient',
            'labs' => 'A Laboratory'
        ];
    }

    public function messages()
    {
        return [
            'required'      => ':attribute is required.'
        ];
    }
}

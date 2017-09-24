<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReprotsMedicineDispensePatientRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'patient_id'    => 'required',
            'from'          => 'required',
            'to'            => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'patient_id'    => 'Patient',
            'from'          => 'Date From',
            'to'            => 'Date To',
        ];
    }

    public function messages()
    {
        return [
            'required'      => ':attribute is required'
        ];
    }
}

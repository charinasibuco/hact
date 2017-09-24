<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReprotsMedicineDispenseInfectionRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            #'infection'     => 'required',
            'from'          => 'required',
            'to'            => 'required',
        ];
    }

    public function attributes()
    {
        return [
            #'infection'     => 'Infection',
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

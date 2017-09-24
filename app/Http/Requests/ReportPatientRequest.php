<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReportPatientRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'gender'   => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'gender'   => 'Gender'
        ];
    }
    
    public function messages()
    {
        return [
            'required'      => ':attribute is required.'
        ];
    }
}

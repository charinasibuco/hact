<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReportVCTScheduledRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'from' => 'required',
            'to'   => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'from' => 'Date From',
            'to'   => 'Date To'
        ];
    }
    
    public function messages()
    {
        return [
            'required'      => ':attribute is required.'
        ];
    }
}

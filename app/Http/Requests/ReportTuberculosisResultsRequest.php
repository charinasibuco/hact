<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReportTuberculosisResultsRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'result'    => 'required',
            'from' => 'required',
            'to'   => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'result'    => 'Result',
            'from' => 'Date From',
            'to'   => 'Date To'
        ];
    }
    
    public function messages()
    {
        return [
            'required'    => ':attribute is required'
        ];
    }
}

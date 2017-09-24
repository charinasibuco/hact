<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReportVCTResultsRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'from_date' => 'required',
            'to_date'   => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'from_date' => 'Date From',
            'to_date'   => 'Date To'
        ];
    }
    
    public function messages()
    {
        return [
            'required'      => ':attribute is required.'
        ];
    }
}

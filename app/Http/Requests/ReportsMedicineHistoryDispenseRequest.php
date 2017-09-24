<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReportsMedicineHistoryDispenseRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'medicine_id'   => 'required',
            'from'          => 'required',
            'to'            => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'medicine_id'   => 'Medicine',
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

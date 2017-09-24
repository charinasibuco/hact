<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ARVRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'patient_id'            => 'required|exists:patient,id',
            //'infection'             => 'required',
            'medicine_id'           => 'required_if:specified_medicine,|exists:medicines,id',
            'specified_medicine'    => 'required_if:medicine_id,',

            'pills_per_day'             => 'required|numeric',


            #'date_started' => 'date|required',
            #'reason'            => 'required',
            'specify'           => 'required_if:reason,6,7'
        ];
    }

    public function attributes()
    {
        return [
            'patient_id'    => 'Patient',
            'infection'     => 'Infection',
            'medicine_id'   => 'Medicine',

            'pills_per_day'             => 'No. of pills per day',
            

            #'date_discontinued' => 'Date Discontinued',
            #'reason'            => 'Reason',
            'specify'           => 'Specify'
        ];
    }

    public function messages()
    {
        return [
            'required'      => ':attribute is required',
            'required_if'   => ':attribute is required',
            'numeric'       => ':attribute required numeric'
        ];
    }
}
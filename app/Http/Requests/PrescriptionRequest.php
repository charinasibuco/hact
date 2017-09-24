<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PrescriptionRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'medicine_inventory_id' => 'required',
            'pills_dispense'        => 'required|numeric',
            'date_dispense'         => 'required',
            'pills_missed_in_30_days'   => 'required|numeric',
            'pills_left'                => 'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'medicine_inventory_id' => 'Medicine',
            'pills_dispense'        => 'No. of pills dispense',
            'date_dispense'         => 'Date Dispense',
            'pills_missed_in_30_days'   => 'No. of missed in past 30 days',
            'pills_left'                => 'No. of pills left',
        ];
    }
    
    public function messages()
    {
        return [
            #'unique'        => ':attribute already exists in ARV.',
            'exists'        => ':attribute not exists in ARV.',
            'required'      => ':attribute is required.',
            'numeric'       => ':attribute is not a number.'
        ];
    }
}

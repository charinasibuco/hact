<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DoctorRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|unique:patient_doctor,user_id,NULL,id,patient_id,' . $this->id . '|exists:users,id',
        ];
    }

    public function attributes()
    {
        return [
            'user_id'    => 'Doctor'
        ];
    }
    
    public function messages()
    {
        return [
            'required'  => ':attribute is required.',
            'unique'    => ':attribute already exists.',
            'exists'    => ':attribute not exists.'
        ];
    }
}

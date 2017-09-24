<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserPasswordResetRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password'          => 'required|min:6',
            'confirm_password'  => 'required|same:password'
        ];
    }
    
    public function messages()
    {
        return [
            'password.required'         => 'Password is required.',
            'password.min'              => 'Password minimum of 6 characters.',
            'confirm_password.required' => 'Confirm Password is required.',
            'confirm_password.same'     => 'Password not matched.'
        ];
    }
}

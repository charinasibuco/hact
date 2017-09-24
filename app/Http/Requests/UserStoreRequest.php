<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserStoreRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'         => 'required|unique:users,email',
            'name'          => 'required|max:255',
            'contact_number'=> 'max:255',
            'access'        => 'required'
        ];
    }
    
    public function messages()
    {
        return [
            'email.required'        => 'Email is required.',
            'email.unique'          => 'Email has been already taken.',

            'name.required'         => 'Name is required.',
            'name.max'              => 'Name exceeded to 255 characters.',

            'contact_number.max'    => 'Contact Number exceeded to 255 characters.',

            'access.required'       => 'Access is required.'
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_name' => 'required',
            'email'     => 'required|email',
            'message'   => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'full_name'    => 'Full Name',
            'email'        => 'Email',
            'message'      => 'Message'
        ];
    }

    public function messages()
    {
        return [
            'required'      => ':attribute is required.',
            'email'   => ':attribute is not a valid email address.'
        ];
    }
}

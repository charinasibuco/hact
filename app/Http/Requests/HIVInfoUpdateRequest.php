<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HIVInfoUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "description"   =>  "required|max:255",
            "image"   =>  "image",
        ];
    }

    public function attributes()
    {
        return [
            "description"   =>  "Description",
            "file"  =>  "File",
            "image"    => "Image",
        ];
    }

    public function messages()
    {
        return [
            'file'    => "the :attribute needs to be a file",
            'image' => "the :attribute needs to be an image file",
            'max'         => "The maximum characters for :attribute has been reached",
            'size'  => "the :attribute is too big"
        ];
    }
}

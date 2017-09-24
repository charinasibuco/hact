<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MedicineStoreRequest extends Request
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
            'name'            => 'required|unique:medicines,name',
            'item_code'       => 'required',
            'classification'  => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name'            => 'Drug Description',
            'item_code'       => 'Code',
            'classification'  => 'Classification',
        ];
    }
    public function messages()
    {
        return [
            'required'         =>':attributes is required',
            'unique'           =>':attributes already exists'
        ];
    }
}

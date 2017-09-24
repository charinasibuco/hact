<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReportPatientStopTakingARVRequest extends Request
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
            'from'          => 'required',
            'to'            => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'from'          => 'Date From',
            'to'            => 'Date To'
        ];
    }

    public function messages()
    {
        return [
            'required'      => ':attribute is required.',
        ];
    }
}

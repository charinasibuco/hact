<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MedicineRestockStoreRequest extends Request
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
            'medicine_id'       => 'required',
//            'tabs_per_bottle'   => 'required',
            'lot_number'        => 'required',
            'quantity'          => 'required',
            'expiry_date'       => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'medicine_id'       => 'Drug Description',
            'tabs_per_bottle'   => 'Tabs per bottle',
            'lot_number'        => 'Lot Number',
            'quantity'          => 'Quantity',
            'expiry_date'       => 'Expiry Date'
        ];
    }
    public function messages()
    {
        return [
            'required'         =>':attributes is required',
        ];
    }
}

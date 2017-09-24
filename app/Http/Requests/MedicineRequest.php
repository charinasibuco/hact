<?php
/**
 * Created by PhpStorm.
 * User: Jaime
 * Date: 12/22/2015
 * Time: 4:53 PM
 */

namespace App\Http\Requests;


class MedicineRequest {
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            ''
        ];
    }

    public function messages(){
        return[];
    }

    public function attributes(){


    }
    public function getValidatorInstance(){
        $data                       = $this->all();
        $data['expiry_date']      = Carbon::parse($data['expiry_date'])->format('Y-m-d');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Jaime
 * Date: 12/22/2015
 * Time: 4:32 PM
 */

namespace App\Http\Requests;


use Carbon\Carbon;
use Illuminate\Http\Request;

class ObGyneRequest extends Request{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'gestation_age'           => 'required_if:currently_pregnant,1',
            'currently_pregnant'    => 'required'
        ];
    }

    public function messages(){
        return[];
    }

    public function attributes(){


    }
    public function getValidatorInstance(){
        $data                       = $this->all();
        $data['date_of_delivery']      = Carbon::parse($data['delivery_date'])->format('Y-m-d');
    }

}
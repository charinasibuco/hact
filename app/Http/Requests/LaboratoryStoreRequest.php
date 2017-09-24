<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\LaboratoryType;

class LaboratoryStoreRequest extends Request
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
        $rules = [
            "laboratory_test_id" => "required",
            "other" => "required_if:laboratory_test_id,other|string|max:255",
            "result_date"  =>  "required|date",
            "image" => "max:2048|mimes:jpeg,bmp,png"
        ];
        foreach($this->request->get('labs') as $key => $result)
        {
            if($key == 'other'){
                $rules['labs.'.$key] = "required_if:laboratory_test_id,other";
            }else{
                if(LaboratoryType::find($key)->id < 14){
                    $rules['labs.'.$key] = "required_if:laboratory_test_id,".LaboratoryType::find($key)->LaboratoryTest->id."|numeric";
                }else{
                    $rules['labs.'.$key] = "required_if:laboratory_test_id,".LaboratoryType::find($key)->LaboratoryTest->id;
                }

            }
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            "labs.1.1"   =>  "CD4",
            "labs.2.2"   =>  "Viral Load",
            "labs.3.3"   =>  "Hgb",
            "labs.3.4"   =>  "RBC",
            "labs.3.5"   =>  "WBC",
            "labs.3.6"   =>  "Plt",
            "labs.4.7"   =>  "FBS",
            "labs.5.8"   =>  "Chol",
            "labs.5.9"   =>  "HDL",
            "labs.5.10"   =>  "LDL",
            "labs.5.11"   =>  "Trigly",
            "labs.6.2"   =>  "Crea",
            "labs.7.13"   =>  "SGPT",
            "labs.8.14"   =>  "RPR",
            "labs.9.15"   =>  "HbsAg",
            "labs.10.16"   =>  "HCV",
            "labs.11.17"   =>  "U/A",
            "labs.12.18"   =>  "S/E",
            "labs.13.19"   =>  "CXR",
            "labs.14.20"   =>  "AFB-1",
            "labs.14.21"   =>  "AFB-2",
            "labs.15.22"   =>  "Genexpert",
            "labs.16.0"   =>  "Other Result",
            "other" =>  "Other",
            "image" => "Image",
            "result_date"   => "Result Date",
            "laboratory_test_id" => "Laboratory Test"
        ];
    }

    public function messages()
    {
        return [
            'required'                          => ":attribute is required",
            'required_if'                       => ":attribute is required",
            'numeric'                           => ":attribute require numeric",
            'max'                               => "The maximum characters for :attribute has been reached",
            'unique'                            => ':attribute already exist',
            'image'                             =>':attribute must be an image file'
        ];
    }
    
}

<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class VCTStoreRequest extends Request
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
            'patient_id'        => 'required|exists:patient,id',
            'vct_date'          => 'required|date',
            'reason_other'      => 'required_with:reason_15',
            'is_your_mother_infected_with_hiv'      => 'required',

            'experience_1_if_yes_what_year'     => 'required_if:experience1,1',
            'experience_2_if_yes_what_year'     => 'required_if:experience2,1',
            'experience_3_if_yes_what_year'     => 'required_if:experience3,1',
            'experience_4_if_yes_what_year'     => 'required_if:experience4,1',
            'experience_5_if_yes_what_year'     => 'required_if:experience5,1',
            'experience_6_if_yes_what_year'     => 'required_if:experience6,1',
            'experience_7_if_yes_what_year'     => 'required_if:experience7,1',
            'experience_8_if_yes_what_year'     => 'required_if:experience8,1',

            'number_of_female'                  => 'numeric|min:0',
            'number_of_male'                    => 'numeric|min:0',

            'last_year_sex_female'              => 'required_with:number_of_female',
            'last_year_sex_male'                => 'required_with:number_of_male,1',

            'been_tested_for_hiv_before'        => 'required',
            'been_tested_for_hiv_before_month'  => 'required_if:been_tested_for_hiv_before,1',
            'been_tested_for_hiv_before_year'   => 'required_if:been_tested_for_hiv_before,1',

            // if pregnant
            'last_period'                       => 'required_if:is_pregnant,1',
            'months_pregnant'                   => 'required_if:is_pregnant,1',
            'weeks_pregnant'                    => 'required_if:is_pregnant,1',
            'delivery_date'                     => 'required_if:is_pregnant,1',
            'where_prenatal_care'               => 'required_if:where_prenatal_care_no,null',
            'plan_to_deliver_baby'              => 'required_if:is_pregnant,1',
            'plan_to_deliver_baby_specify'      => 'required_if:plan_to_deliver_baby,2,5',
            'partner_hiv_tested'                => 'required_if:is_pregnant,1',

            // if 18 Below
            'mother_hiv_status'                 => 'required_if:is_your_mother_infected_with_hiv, 1',
            'hiv_diagnosis'                     => 'required_if:mother_hiv_status,1',
            #'mother_saccl'                      => 'required_if:hiv_diagnosis,',
            'mother_arv_pregnancy'              => 'required_if:is_your_mother_infected_with_hiv, 1',
            //'mother_arv_pregnancy_reason'       => 'required_if:is_your_mother_infected_with_hiv, 1|required_if:mother_arv_pregnancy,0',
            'she_breastfeed_baby'               => 'required_if:is_your_mother_infected_with_hiv, 1',
            'is_mother_alive_or_dead'           => 'required_if:is_your_mother_infected_with_hiv, 1',
            //'is_mother_alive_or_dead_when'      => 'required_if:is_mother_alive_or_dead,0',
        ];
    }

    public function attributes()
    {
        return [
            'patient_id'                        => 'Patient',
            'vct_date'                          => 'VCT Date',
            'reason_other'                      => 'Other Specify',
            'is_your_mother_infected_with_hiv'  => 'Was your MOTHER infected with HIV when you were born field',

            'experience_1_if_yes_what_year'     => 'Year when you Received blood transfusion',
            'experience_2_if_yes_what_year'     => 'Year when you Injected drugs without doctor\'s advice',
            'experience_3_if_yes_what_year'     => 'Year when you Accidental needle prick',
            'experience_4_if_yes_what_year'     => 'Year when you Sexually transmittted infections (STI)',
            'experience_5_if_yes_what_year'     => 'Year when you Sex with female with no condom',
            'experience_6_if_yes_what_year'     => 'Year when you Sex with male with no condom',
            'experience_7_if_yes_what_year'     => 'Year when you Sex with a person in prostitution',
            'experience_8_if_yes_what_year'     => 'Year when you Regularly accept payment for sex',

            'number_of_female'                  => 'Number of past female sex partners',
            'number_of_male'                    => 'Number of past male sex partners',

            'last_year_sex_female'              => 'Year of last sex with a female',
            'last_year_sex_male'                => 'Year of last sex with a male',

            'been_tested_for_hiv_before'        => 'Have you ever been tested for HIV before field',
            'been_tested_for_hiv_before_month'  => 'Recent test month',
            'been_tested_for_hiv_before_year'   => 'Recent test year',

            // if Pregnant
            'last_period'                       => 'Last Menstrual Period',
            'months_pregnant'                   => 'Number of months pregnant',
            'weeks_pregnant'                    => 'Number of weeks pregnant',
            'delivery_date'                     => 'Expected Date of Delivery',
            'mother_saccl'                      => 'Mother SACCL',
            'where_prenatal_care'               => 'Where do you seek prenatal care',
            'plan_to_deliver_baby'              => 'Where do you plan to deliver the baby',
            'plan_to_deliver_baby_specify'      => 'Specify to deliver baby',
            'partner_hiv_tested'                => 'Partner tested for HIV',

            // if 18 Below
            'mother_hiv_status'                 => 'HIV Status of Mother',
            'hiv_diagnosis'                     => 'Date of HIV diagnosis',
            'mother_arv_pregnancy'              => 'Mother took ARV medication/s during pregnancy',
            'mother_arv_pregnancy_reason'       => 'Reason of mother took ARV medication/s during pregnancy',
            'she_breastfeed_baby'               => 'Did she breastfeed the baby',
            'is_mother_alive_or_dead'           => 'Is mother alive or dead',
            'is_mother_alive_or_dead_when'      => 'When is mother alive or dead'
        ];
    }

    public function messages()
    {
        return [
            'exists' => ':attribute not exists',
            'date' => ':attribute should be in Date format',
            'required' => ':attribute is required',
            'required_if' => ':attribute is required',
            'required_with' => ':attribute is required',
            'required_without' => ':attribute is required',
            'numeric' => ':attribute must be numeric',
            'min' => ':attribute must be atleast 0'
        ];
    }
}

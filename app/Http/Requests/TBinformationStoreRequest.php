<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TBinformationStoreRequest extends Request
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'presence'              => 'required',
            'tb_status'             => 'required',

            'on_ipt'                => 'required_if:tb_status,1',
            'ipt_outcome'           => 'required_if:tb_status,1 | required_if:on_ipt,1',
            'ipt_outcome_other'     => 'required_if:tb_status,1 | required_if:ipt_outcome,3',

            'site'                  => 'required_if:tb_status,2',
            'site_extrapulmonary'   => 'required_if:tb_status,2 | required_if:site,2',


            'drug_resistance'       => 'required_if:tb_status,2',
            'drug_resistance_other' => 'required_if:tb_status,2 | required_if:drug_resistance,4',
            'current_tb_regimen'    => 'required_if:tb_status,2',
            'tx_outcome'            => 'required_if:tb_status,2',
            'tx_outcome_other'      => 'required_if:tb_status,2 | required_if:tx_outcome,4',
            'tx_date_outcome'       => 'required_if:tb_status,2 | required_if:tx_outcome,1,3',
            'tx_facility'           => 'required_if:tb_status,2',

            'date_started'          => 'required'
        ];
    }

    public function attributes()
    {
        return[
            'presence'              => 'Presence',
            'tb_status'             => 'TB Status',
            'on_ipt'                => 'On IPT',
            'ipt_outcome'           => 'IPT Outome',
            'ipt_outcome_other'     => 'IPT Outome Reason',
            'site'                  => 'Site',
            'drug_resistance'       => 'Drug Resistance',
            'drug_resistance_other' => 'Other Specification of Drug Resistance',
            'current_tb_regimen'    => 'Current TB Regimen',
            'tx_outcome'            => 'Tx Outcome',
            'tx_outcome_other'      => 'Other Specification of Tx Outcome',
            'date_started'          => 'Date Started'
        ];
    }

    public function messages()
    {
        return[
            'required'              =>  ':attribute is required.',
            'required_if'           =>  ':attribute is required.'
        ];
    }
}

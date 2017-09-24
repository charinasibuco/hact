@extends("hact.layouts.print_layout")

@section("content")

<div class="row">
    <div class="large-12 column text-center">
    <br>
        HIV VCT REGISTRY
    </div>
</div>
<br />
{{-- <div class="row">   
    <div class="large-12 columns">
        <input type="submit" class="button small alert" name="excel" value="Excel" />
    </div>
</div> --}}
<div class="row">
    <div class="large-12 column list">
        <table width="100%">
            <thead>
                <tr class="head">
                    <th style="width:3%;">Date Consult</th>
                    <th style="width:10%;">Code Name</th>
                    <th style="width:3%">Age</th>
                    <th style="width:3%">Sex</th>
                    <th style="width:15%">Code(UIC)</th>
                    <th style="width:3%;">Date of Birth</th>
                    <th style="width:15%;">Address</th>
                    <th style="width:9%;">HIV Risks (SW, Client of SW, MSM, IDU,OE)</th>
                    <th style="width:9%;">Tested for HIV</th>
                    <th style="width:9%;">Positive for HIV</th>
                    <th style="width:9%;">Provided Post-test Counseling and HIV Result</th>
                    <th style="width:9%;">Provided PEP</th>
                    <th style="width:3%;">Date of Follow-up</th>
                </tr>
            </thead>
            <tbody>
            @foreach($patients as $row)
            <?php 

                $death = App\Mortality::find($row->id);

                if(is_null($death))
                {
                    $today = date("Y-m-d");
                }
                else
                {
                    $today = $death->date_of_death;
                }

//                $age   = floor($today - $row->birth_date /(365.25 * 24 * 60 * 60 * 1000)-$row->birth_date);
            ?>
                <tr>
                    <td style="text-align:center;">{{ (isset($row->VCT->first()->vct_date)?$row->VCT->first()->vct_date: 'None') }}</td>
                    <td>{{ $row->code_name }}</td>
                    <td style="text-align:center;">{{ $row->age }}</td>
                    <td style="text-align:center;">{{ ($row->gender == 1)?'M':'F' }}</td>
                    <td>{{ $row->ui_code }}</td>
                    <td>{{ $row->birth_date }}</td>
                    <td>{{ $row->current_city }}</td>
                    <td style="text-align:center;">
                        @foreach($row->hiv_risk as $risk)
                            {{ $risk."," }}
                        @endforeach
                    </td>
                    <td style="text-align:center;">{{ (isset($row->VCT->first()->result) ? (($row->VCT->first()->result != '' || $row->VCT->first()->result >= 0) ?  'Yes':'No') : 'No') }}</td>
                    <td style="text-align:center;">{{ (isset($row->VCT->first()->result) ? (($row->VCT->first()->result == 2) ?  'Yes':'No') : 'No') }}</td>
                    <td style="text-align:center;">{{ (isset($row->VCT->first()->result) ? (($row->VCT->first()->result != '' || $row->VCT->first()->result >= 0) ?  'Yes':'No') : 'No') }}</td> 
                    <td style="text-align:center;">{{ (isset($row->arv->first()->patient_id) ? (($row->arv->first()->patient_id) ? 'Yes': 'No') : 'No') }} </td>
                    <td style="text-align:center;">
                    @if($row->VCT->where('result', 2)->count() < 1)
                        {{ (isset($row->VCT->first()->total_vct_record) ? date('Y-m-d', strtotime(($row->VCT->first()->total_vct_record == 1) ? "+90 days": "+180 days", strtotime($row->VCT->first()->last_vct_record->vct_date))) : '') }}
                    @else
                        -
                    @endif
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="7">
                    &nbsp;
                </td>
                <td colspan="6">
                    <div>Generated By:<br/>
                        Name: {{ Auth::user()->name }}<br/>
                        Email: {{ Auth::user()->email }}
                    </div>
                </td>
            </tr>
            </tbody> 
        </table>
    </div>              
</div>
<style type="text/css">
.row{
    max-width:none; 
}

table tr th{
    text-align: center;
}

table tbody td, table thead th{
    font-size: 12px !important;
    padding: 7px !important;
}

</style>
@endsection
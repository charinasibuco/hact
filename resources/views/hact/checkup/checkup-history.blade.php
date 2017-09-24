@extends('hact.layouts.print_layout')

@section('content')
    <input id="print" type="button" value="Print">
    <script>
        $('#print').click(function(){
            $(this).hide();
            window.print();
            $(this).show();
        });
    </script>
    <br/>
    <br/>
<h4 style="color:#4d4d4d">{{ $patient->code_name }} Consultation History</h4>
@if(count($histories) > 0)
<div class="row">
    <div class="medium-12 columns">
        @foreach($histories as $history)
            <fieldset>
                <legend>{{ $history['checkup']->checkup_date->format('m/d/Y') }}</legend>
                <table width="100%" class="checkup-table" role="grid">
                    <tr>
                        <td>
                            <label><span>Patient:</span>
                                {{ $history['checkup']->Patient->code_name }}
                            </label>
                        </td>
                        <td>
                            <label><span>Age:</span>
                                {{ $history['checkup']->Patient->age }}
                            </label>
                        </td>
                        <td>
                            <label><span>Sex:</span>
                                {{ $history['checkup']->Patient->gender_format }}
                            </label>
                        </td>
                        <td>
                            <label><span>SACCL Code:</span>
                                {{ $history['checkup']->Patient->saccl_code }}
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><span>Phil Health Number:</span>
                                {{ $history['checkup']->Patient->phil_health_number }}
                            </label>
                        </td>
                        <td>
                            <label><span>UIC:</span>
                                {{ $history['checkup']->Patient->ui_code }}
                            </label>
                        </td>
                        <td>
                            <label><span>Consultation Date:</span>
                                {{ $history['checkup']->checkup_date->format('m/d/Y') }}
                            </label>
                        </td>
                        <td>
                            <label><span>Follow-up On:</span>
                                {{ $history['checkup']->follow_up_date->format('m/d/Y') }}
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><span>Patient Type:</span>
                                {{ $history['checkup']->patient_type }}
                            </label>
                        </td>
                        <td>
                            <label><span>Attending Physician:</span>
                                {{ $history['checkup']->User->name }}
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><span>General Summary:</span>
                                <ul>
                                    <li>Weight: {{ $history['checkup']->weight }}kg</li>
                                    <li>Height: {{ $history['checkup']->height }}meters</li>
                                    <li>BMI: {{ $history['checkup']->bmi }}</li>
                                </ul>
                            </label>
                        </td>
                        <td>
                            <label><span>Vital Signs:</span>
                                <ul>
                                    <li>BP: {{ $history['checkup']->blood_pressure }}</li>
                                    <li>PR: {{ $history['checkup']->pulse_rate }}</li>
                                    <li>RR: {{ $history['checkup']->respiration_rate }}</li>
                                    <li>Temp: {{ $history['checkup']->temperature }}</li>
                                </ul>
                            </label>
                        </td>
                        <td>
                            <label><span>TB Screening:</span>
                                <ul>
                                    {!! ($history['checkup']->cough == 1) ? '<li>Cough</li>' : '' !!}
                                    {!! ($history['checkup']->fever == 1) ? '<li>Fever</li>' : '' !!}
                                    {!! ($history['checkup']->night_sweat == 1) ? '<li>Night Sweat</li>' : '' !!}
                                    {!! ($history['checkup']->weight_loss == 1) ? '<li>Weight Loss</li>' : '' !!}
                                </ul>
                            </label>
                        </td>
                        <td>
                            <label><span>Immunologic Profile:</span>
                                <ul>
                                    @if($history['checkup']->CheckupLaboratory->count() > 0)
                                        @foreach($history['checkup']->CheckupLaboratory as $row)
                                            @if($row->Laboratory)
                                                <li>Last {{$row->Laboratory->laboratory_type->description}}:{{  $row->Laboratory->result }}</li>
                                                <li>Result Date:{{ $row->Laboratory->result_date->format('m/d/Y')  }}</li>
                                            @endif
                                         @endforeach
                                    @else
                                        None
                                    @endif
                                    {{--<li>Last CD4 Count: {{ isset($last_cd4_count) ? $last_cd4_count->result : 'None' }}</li>
                                    <li>Result Date:<br/> {{ isset($last_cd4_count) ? $last_cd4_count->result_date_format : 'None' }}</li>
                                    <li>Viral Load: {{ isset($viral_load) ? $viral_load->result : 'None' }}</li>
                                    <li>Result Date:<br/> {{ isset($viral_load) ? $viral_load->result_date_format : 'None' }}</li>--}}
                                </ul>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <label><span>Subjective:</span>
                                <pre>{{ $history['checkup']->subjective }}</pre>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <label><span>Chief Complaints</span>
                                <pre>{{ $history['checkup']->patient_complaints }}</pre>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <label><span>Objective:</span>
                                @if($history['checkup']->PhysicalExam)
                                    <fieldset>
                                        <legend>Physical Exam</legend>
                                        <table class="checkup-table" width="100%">
                                            <thead>
                                            <tr>
                                                <th width="25%">Description</th>
                                                <th width="35%">Result</th>
                                                <th width="40%">Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>General Survey</td>
                                                <td>
                                                    <ol class="inline-list">
                                                        @if($history['checkup']->PhysicalExam->jsonConvert('general_survey'))
                                                            @foreach($history['checkup']->PhysicalExam->jsonConvert('general_survey') as $key => $value)
                                                                <li>{{ $key }}</li>
                                                            @endforeach
                                                        @endif
                                                    </ol>
                                                </td>
                                                <td>{{ $history['checkup']->PhysicalExam->general_survey_remarks }}</td>
                                            </tr>
                                            <tr>
                                                <td>Skin</td>
                                                <td>
                                                    <ol class="inline-list">
                                                        @if($history['checkup']->PhysicalExam->jsonConvert('skin'))
                                                            @foreach($history['checkup']->PhysicalExam->jsonConvert('skin') as $key => $value)
                                                                <li>{{ $key }}</li>
                                                            @endforeach
                                                        @endif
                                                    </ol>
                                                </td>
                                                <td>{{ $history['checkup']->PhysicalExam->skin_remarks }}</td>
                                            </tr>
                                            <tr>
                                                <td>HEENT</td>
                                                <td>
                                                    <ol class="inline-list">
                                                        @if($history['checkup']->PhysicalExam->jsonConvert('heent'))
                                                            @foreach($history['checkup']->PhysicalExam->jsonConvert('heent') as $key => $value)
                                                                <li>{{ $key }}</li>
                                                            @endforeach
                                                        @endif
                                                    </ol>
                                                </td>
                                                <td>{{ $history['checkup']->PhysicalExam->heent_remarks }}</td>
                                            </tr>
                                            <tr>
                                                <td>Lips/Buccal Mucosa</td>
                                                <td colspan="2">
                                                    <ol class="inline-list">
                                                        @if($history['checkup']->PhysicalExam->jsonConvert('lips_buccal_mucosa'))
                                                            @foreach($history['checkup']->PhysicalExam->jsonConvert('lips_buccal_mucosa') as $key => $value)
                                                                <li>{{ $key }}</li>
                                                            @endforeach
                                                        @endif
                                                    </ol>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>sclerae</td>
                                                <td colspan="2">
                                                    <ol class="inline-list">
                                                        @if($history['checkup']->PhysicalExam->jsonConvert('sclerae'))
                                                            @foreach($history['checkup']->PhysicalExam->jsonConvert('sclerae') as $key => $value)
                                                                <li>{{ $key }}</li>
                                                            @endforeach
                                                        @endif
                                                    </ol>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Conjunctivae</td>
                                                <td colspan="2">
                                                    <ol class="inline-list">
                                                        @if($history['checkup']->PhysicalExam->jsonConvert('conjunctivae'))
                                                            @foreach($history['checkup']->PhysicalExam->jsonConvert('conjunctivae') as $key => $value)
                                                                <li>{{ $key }}</li>
                                                            @endforeach
                                                        @endif
                                                    </ol>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Chest and Lungs</td>
                                                <td>
                                                    <ol class="inline-list">
                                                        @if($history['checkup']->PhysicalExam->jsonConvert('chest_and_lungs'))
                                                            @foreach($history['checkup']->PhysicalExam->jsonConvert('chest_and_lungs') as $key => $value)
                                                                <li>{{ $key }}</li>
                                                            @endforeach
                                                        @endif
                                                    </ol>
                                                </td>
                                                <td>{{ $history['checkup']->PhysicalExam->chest_and_lungs_remarks }}</td>
                                            </tr>
                                            <tr>
                                                <td>Cardiovascular</td>
                                                <td>
                                                    <ol class="inline-list">
                                                        @if($history['checkup']->PhysicalExam->jsonConvert('cardial'))
                                                            @foreach($history['checkup']->PhysicalExam->jsonConvert('cardial') as $key => $value)
                                                                <li>{{ $key }}</li>
                                                            @endforeach
                                                        @endif
                                                    </ol>
                                                </td>
                                                <td>{{ $history['checkup']->PhysicalExam->cardial_remarks }}</td>
                                            </tr>
                                            <tr>
                                                <td>Abdomen</td>
                                                <td>
                                                    <ol class="inline-list">
                                                        @if($history['checkup']->PhysicalExam->jsonConvert('abdomen'))
                                                            @foreach($history['checkup']->PhysicalExam->jsonConvert('abdomen') as $key => $value)
                                                                <li>{{ $key }}</li>
                                                            @endforeach
                                                        @endif
                                                    </ol>
                                                </td>
                                                <td>{{ $history['checkup']->PhysicalExam->abdomen_remarks }}</td>
                                            </tr>
                                            <tr>
                                                <td>Extremities</td>
                                                <td>
                                                    <ol class="inline-list">
                                                        @if($history['checkup']->PhysicalExam->jsonConvert('extremities'))
                                                            @foreach($history['checkup']->PhysicalExam->jsonConvert('extremities') as $key => $value)
                                                                <li>{{ $key }}</li>
                                                            @endforeach
                                                        @endif
                                                    </ol>
                                                </td>
                                                <td>{{ $history['checkup']->PhysicalExam->extremities_remarks }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                @endif
                                <br/>
                                @if($history['checkup']->NeuroExam)
                                    <fieldset>
                                        <legend>Neurologic Exam</legend>
                                        <table class="checkup-table" width="100%">
                                            <thead>
                                            <tr>
                                                <th width="30%">Description</th>
                                                <th width="70%">Result</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th colspan="2">MENTAL STATUS EXAM</th>
                                                </tr>
                                                <tr>
                                                    <td>Level of Consciousness</td>
                                                    <td>{{ $history['checkup']->NeuroExam->level_of_consciousness }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Orientation</td>
                                                    <td>
                                                        <ol class="inline-list">
                                                            @if($history['checkup']->NeuroExam->jsonConvert('orientation'))
                                                                @foreach(($history['checkup']->NeuroExam->jsonConvert('orientation')) as $key => $value)
                                                                    <li>{{ $key }}</li>
                                                                @endforeach
                                                            @endif
                                                        </ol>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Mood and Behavior</td>
                                                    <td>
                                                        {{ $history['checkup']->NeuroExam->mood_and_behaviour }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Memory</td>
                                                    <td>
                                                        <ol class="inline-list">
                                                            @if($history['checkup']->NeuroExam->jsonConvert('memory'))
                                                                @foreach(($history['checkup']->NeuroExam->jsonConvert('memory')) as $key => $value)
                                                                    <li>{{ $key }}</li>
                                                                @endforeach
                                                            @endif
                                                        </ol>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Cognitive Function</td>
                                                    <td>
                                                        {{ $history['checkup']->NeuroExam->cognitive_function }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2">CRANIAL NERVE</th>
                                                </tr>
                                                <tr>
                                                    <td>I</td>
                                                    <td>{{ $history['checkup']->NeuroExam->able_to_smell  }}</td>
                                                </tr>
                                                <tr>
                                                    <td>II Visual Acuity</td>
                                                    <td>{{ $history['checkup']->NeuroExam->visual_acuity  }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Visual Fields</td>
                                                    <td>{{ $history['checkup']->NeuroExam->pupils  }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Funduscopy</td>
                                                    <td>
                                                        <ol class="inline-list">
                                                            @if($history['checkup']->NeuroExam->jsonConvert('funduscopy'))
                                                                @foreach($history['checkup']->NeuroExam->jsonConvert('funduscopy') as $key => $value)
                                                                    <li>{{ $key }}</li>
                                                                @endforeach
                                                            @endif
                                                        </ol>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>II, III</td>
                                                    <td>
                                                        <ol class="inline-list">
                                                            @if($history['checkup']->NeuroExam->jsonConvert('2_3'))
                                                                @foreach($history['checkup']->NeuroExam->jsonConvert('2_3') as $key => $value)
                                                                    <li>{{ $key }}</li>
                                                                @endforeach
                                                            @endif
                                                        </ol>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>III, IV, VI EOMs</td>
                                                    <td>{{ $history['checkup']->NeuroExam['attributes']['3_4_6_eoms']  }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Primary Gaze</td>
                                                    <td>{{ $history['checkup']->NeuroExam['attributes']['lateralizing_gaze']  }}</td>
                                                </tr>
                                                <tr>
                                                    <td>V Temporal Strength</td>
                                                    <td>{{ $history['checkup']->NeuroExam->temporal_strength  }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Masseter Strength</td>
                                                    <td>{{ $history['checkup']->NeuroExam->able_to_clench_teeth  }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Facial Sensation</td>
                                                    <td>{{ $history['checkup']->NeuroExam->able_to_feel_pain_in_facial_area  }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Corneal Reflex</td>
                                                    <td>{{ $history['checkup']->NeuroExam->corneal_reflex  }}</td>
                                                </tr>
                                                <tr>
                                                    <td>VII</td>
                                                    <td>
                                                        <ol class="inline-list">
                                                            @if($history['checkup']->NeuroExam->jsonConvert('vii'))
                                                                @foreach(($history['checkup']->NeuroExam->jsonConvert('vii')) as $key => $value)
                                                                    <li>{{ $key }}</li>
                                                                @endforeach
                                                            @endif
                                                        </ol>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Taste</td>
                                                    <td>{{ $history['checkup']->NeuroExam->taste  }}</td>
                                                </tr>
                                                <tr>
                                                    <td>VIII Response to Whispered Voice</td>
                                                    <td>{{ $history['checkup']->NeuroExam->response_to_whispered_voice  }}</td>
                                                </tr>
                                                <tr>
                                                    <td>IX, X</td>
                                                    <td>
                                                        <ol class="inline-list">
                                                            {{ $history['checkup']->NeuroExam->gag_reflex  }}
                                                        </ol>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>XI</td>
                                                    <td>
                                                        <ol class="inline-list">
                                                            @if($history['checkup']->NeuroExam->jsonConvert('xi'))
                                                                @foreach(($history['checkup']->NeuroExam->jsonConvert('xi')) as $key => $value)
                                                                    <li>{{ $key }}</li>
                                                                @endforeach
                                                            @endif
                                                        </ol>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>XII</td>
                                                    <td>
                                                        <ol class="inline-list">
                                                            @if($history['checkup']->NeuroExam->jsonConvert('xii'))
                                                                @foreach(($history['checkup']->NeuroExam->jsonConvert('xii')) as $key => $value)
                                                                    <li>{{ $key }}</li>
                                                                @endforeach
                                                            @endif
                                                        </ol>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2">MOTOR EXAM</th>
                                                </tr>
                                                <tr>
                                                    <td>Muscle Bulk</td>
                                                    <td>{{ $history['checkup']->NeuroExam->muscle_bulk  }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Muscle Tone</td>
                                                    <td>{{ $history['checkup']->NeuroExam->muscle_tone }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Muscle Strength</td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>{{ $history['checkup']->NeuroExam->jsonConvert('muscle_strength')['left_arm'] or "" }}</td>
                                                                <td rowspan="2">
                                                                    <img class="img-responsive" style="height:100%; width:100%" src="{{ asset('frontend/images/neuro_diagram.png') }}">
                                                                </td>
                                                                <td>{{ $history['checkup']->NeuroExam->jsonConvert('muscle_strength')['right_arm'] or "" }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>{{ $history['checkup']->NeuroExam->jsonConvert('muscle_strength')['left_leg'] or "" }}</td>
                                                                <td>{{ $history['checkup']->NeuroExam->jsonConvert('muscle_strength')['right_leg'] or "" }}</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sensory</td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>{{ $history['checkup']->NeuroExam->jsonConvert('sensory')['left_arm'] or "" }}</td>
                                                                <td rowspan="2">
                                                                    <img class="img-responsive" style="height:100%; width:100%" src="{{ asset('frontend/images/neuro_diagram.png') }}">
                                                                </td>
                                                                <td>{{ $history['checkup']->NeuroExam->jsonConvert('sensory')['right_arm'] or "" }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>{{ $history['checkup']->NeuroExam->jsonConvert('sensory')['left_leg'] or "" }}</td>
                                                                <td>{{ $history['checkup']->NeuroExam->jsonConvert('sensory')['right_leg'] or "" }}</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Reflexes</td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>{{ $history['checkup']->NeuroExam->jsonConvert('reflexes')['left_arm'] or "" }}</td>
                                                                <td rowspan="2">
                                                                    <img class="img-responsive" style="height:100%; width:100%" src="{{ asset('frontend/images/neuro_diagram.png') }}">
                                                                </td>
                                                                <td>{{ $history['checkup']->NeuroExam->jsonConvert('reflexes')['right_arm'] or "" }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>{{ $history['checkup']->NeuroExam->jsonConvert('reflexes')['left_leg'] or "" }}</td>
                                                                <td>{{ $history['checkup']->NeuroExam->jsonConvert('reflexes')['right_leg'] or "" }}</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                @endif
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <fieldset>
                                <legend>Assessment</legend>
                                <label for="general_assessment">
                                    General Assessment:
                                    <pre>{{ $history['checkup']->remarks }}</pre>
                                </label>
                                @if($history['checkup']->CheckupInfections)
                                    <label for="">Infections Record:
                                        <table width="100%">
                                            <tr>
                                                <th colspan="2">
                                                    Clinical Stage: {{ $history['checkup']->CheckupInfections->Infections->clinical_stage }}
                                                </th>
                                            </tr>
                                            @foreach($history['checkup']->CheckupInfections->Infections->infections_clinical_stage as $ics)
                                                <tr>
                                                    <td colspan="2">
                                                        {{ $ics->details->infection_name }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2">
                                                    <ul>
                                                        {!! ($history['checkup']->CheckupInfections->Infections->hepatitis_b == 1) ? "<li>Hepatitis B</li>": "" !!}
                                                        {!! ($history['checkup']->CheckupInfections->Infections->hepatitis_c == 1) ? "<li>Hepatitis C</li>": "" !!}
                                                        {!! ($history['checkup']->CheckupInfections->Infections->pneumocystis_pneumonia == 1) ? "<li>Pneumocystis Pneumonia</li>": "" !!}
                                                        {!! ($history['checkup']->CheckupInfections->Infections->oropharyngeal_candidiasis == 1) ? "<li>Oropharyngeal Candidiasis</li>": "" !!}
                                                        {!! ($history['checkup']->CheckupInfections->Infections->syphilis == 1) ? "<li>Syphilis</li>": "" !!}
                                                        {!! ($history['checkup']->CheckupInfections->Infections->stis != "") ? "<li>STIs:".$history['checkup']->stis."</li>": "" !!}
                                                        {!! ($history['checkup']->CheckupInfections->Infections->others != "") ? "<li>Others:".$history['checkup']->others."</li>": "" !!}
                                                    </ul>
                                                </td>
                                            </tr>
                                        </table>
                                    </label>
                                @endif
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label><span>Laboratory Requests:</span>
                                @if($history['lab_request'])
                                    <ul>
                                        @foreach($history['lab_request'] as $row)
                                            <li>{{ $row->LaboratoryTest->description }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </label>
                        </td>
                        <td colspan="2">
                            <label><span>Referrals:</span>
                                @if($history['checkup']->Referrals)
                                    <ul>
                                        @if($history['checkup']->Referrals)
                                            <ul>
                                                {!! (($history['checkup']->Referrals->surgeon == 1) ? "<li>Surg</li>" : "") !!}
                                                {!! (($history['checkup']->Referrals->ob_gyne == 1) ? "<li>OB Gyne</li>" : "") !!}
                                                {!! (($history['checkup']->Referrals->opthamology == 1) ? "<li>Opthal</li>" : "") !!}
                                                {!! (($history['checkup']->Referrals->dentis == 1) ? "<li>Dentist</li>" : "") !!}
                                                {!! (($history['checkup']->Referrals->psychiatrist == 1) ? "<li>Psych</li>" : "") !!}
                                                {!! (($history['checkup']->Referrals->tb_dots == 1) ? "<li>TB Dots</li>" : "") !!}
                                                {!! (($history['checkup']->Referrals->others != "") ? "<li>Others:".$history['checkup']->Referrals->others."</li>" : "") !!}
                                                {!! (($history['checkup']->Referrals->reason) ? "<li>Reason:".$history['checkup']->Referrals->reason."</li>" : "") !!}
                                            </ul>
                                        @endif
                                    </ul>
                                @endif
                            </label>
                        </td>
                    </tr>
                    @if($history['checkup']->CheckupARV && $history['checkup']->CheckupARV->ARV)
                        <tr>
                            <td colspan="4">
                                <fieldset>
                                    <legend>ARV Regimen</legend>
                                    <div class="row">
                                        <div id="arv_regimen" class="medium-12 columns">

                                            <table id="prescriptions" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="45%">Medicine</th>
                                                    <th width="5%">Pills/Day</th>
                                                    <th width="20%"><center>Date Started</center></th>
                                                    <th width="30%"><center>Date Discontinued</center></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($history['checkup']->CheckupARV->ARV->ARVItems as $item)
                                                    @if($item->prescription_type == 'arv')
                                                        <tr>
                                                            <td>{{ $item->Medicine->name or "" }}</td>
                                                            <td><center>{{ $item->pills_per_day }}</center></td>
                                                            <td><center>{{ $item->date_started->format('F d, Y') }}</center></td>
                                                            <td><center>{{ ($item->date_discontinue != null) ? $item->date_discontinue->format('F d, Y') : '' }}</center></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td>Pill</td>
                                                                        <td>Symptoms</td>
                                                                        <td>Monitoring</td>
                                                                    </tr>
                                                                    @foreach($item->medicine_data as $dataitem)
                                                                        <tr>
                                                                            <td>{{ $dataitem['key'] }}</td>
                                                                            <td>{{ $dataitem['symptom'] }}</td>
                                                                            <td>{{ $dataitem['monitoring'] }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="medium-6 columns"></div>
                                    </div>
                                </fieldset>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <fieldset>
                                    <legend>OI Medicine</legend>
                                    <table width="100%">
                                        <thead>
                                        <th width="15%"></th>
                                        <th width="25%">Name</th>
                                        <th width="20%">Pills/Day</th>
                                        <th width="40%">Suggested Dosage</th>
                                        </thead>
                                        <tbody id="oi_medicine">
                                        @if($history['checkup']->CheckupARV->ARV->ARVItems->count() > 0)
                                            @foreach($history['checkup']->CheckupARV->ARV->ARVItems as $item)
                                                @if($item->prescription_type == 'oi')
                                                    <td></td>
                                                    <td>{{ $item->specified_medicine  }}</td>
                                                    <td>{{ $item->pills_per_day }}</td>
                                                    <td>{{ $item->suggested_dosage }}</td>
                                                @endif
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </fieldset>
                            </td>
                            <td colspan="2">
                                <fieldset>
                                    <legend>Other Medicine</legend>
                                    <table width="100%">
                                        <thead>
                                        <th width="15%"></th>
                                        <th width="25%">Name</th>
                                        <th width="20%">Pills/Day</th>
                                        <th width="40%">Suggested Dosage</th>
                                        </thead>
                                        <tbody id="other_medicine">
                                        @if($history['checkup']->CheckupARV->ARV->ARVItems->count() > 0)
                                            @foreach($history['checkup']->CheckupARV->ARV->ARVItems as $item)
                                                @if($item->prescription_type == 'others')
                                                    <td></td>
                                                    <td>{{ $item->specified_medicine  }}</td>
                                                    <td>{{ $item->pills_per_day }}</td>
                                                    <td>{{ $item->suggested_dosage }}</td>
                                                @endif
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </fieldset>
                            </td>
                        </tr>
                    @endif
                </table>
            </fieldset>
        @endforeach
        <tr>
            <td colspan="2">
                &nbsp;
            </td>
            <td colspan="2">
                <div>Generated By:<br/>
                    Name: {{ Auth::user()->name }}<br/>
                    Email: {{ Auth::user()->email }}
                </div>
            </td>
        </tr>
    </div>
</div>


@endif
@endsection
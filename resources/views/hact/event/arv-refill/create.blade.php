@extends('hact.layouts.layout_admin')

@section('content')

    <div class='row'>
        <div class='large-12 columns'>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('arv_refill_index') }}">AIDS-related virus(ARV) Refill</a></li>
                <li class="current"><a href="#">New Record</a></li>
            </ul>
        </div>
    </div>

	@include('hact.messages.success')
	@include('hact.messages.error_list')

    <div class="panel">
    	<form action="{{ $action }}" method="post">

            <fieldset>
                <legend>Patient's</legend>
                <div class="row">
                    <div class="large-6 columns">
                        <div class="row collapse">
                            <div class="small-10 columns">
                                <input type="text" id="search_patient" name="search_patient" placeholder="Search Patient" value="{{ $search_patient }}">
                                <input type="hidden" id="demographics_id" name="demographics_id" value="{{ $demographics_id }}" />
                                <input type="hidden" id="search_patient_url" name="search_patient_url" value="{{ route('search_demographics_patient') }}" />
                            </div>
                            <div class="small-2 columns">
                                <span class="postfix"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="large-6 columns">&nbsp;</div>
                </div>
            </fieldset>
    		<fieldset>
        		<legend>ARV Refill</legend>
                <div class="row">
                    <div class="large-6 columns">
                        <label for="blood_pressure">Blood Pressure:</label>
                        <input type="text" id="blood_pressure" name="blood_pressure" placeholder="Blood Pressure" value="{{ $blood_pressure }}" />
                    </div>
                    <div class="large-6 columns">
                        <label for="temperature">Temperature:</label>
                        <input type="text" id="temperature" name="temperature" placeholder="Temperature" value="{{ $temperature }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="large-6 columns">
                        <label for="pulse_rate">Pulse Rate:</label>
                        <input type="text" id="pulse_rate" name="pulse_rate" placeholder="Pulse Rate" value="{{ $pulse_rate }}" />
                    </div>
                    <div class="large-6 columns">
                        <label for="respiration_rate">Respiration Rate:</label>
                        <input type="text" id="respiration_rate" name="respiration_rate" placeholder="Respiration Rate" value="{{ $respiration_rate }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="large-6 columns">
                        <label for="weight">Weight:</label>
                        <input type="text" id="weight" name="weight" placeholder="Weight" value="{{ $weight }}" />

                        <div class="row">
                            <div class="large-6 columns">
                                <label for="change_arv_regimen_yes">Change ARV Regimen:</label>
                                <input type="radio" id="change_arv_regimen_yes" name="change_arv_regimen" value="1" /> <label for="change_arv_regimen_yes">Yes</label>
                                <input type="radio" id="change_arv_regimen_no" name="change_arv_regimen" value="0" /> <label for="change_arv_regimen_no">No</label>
                                <label for="change_arv_regimen_yes_reason">Reason:</label>
                                <input type="text" id="change_arv_regimen_yes_reason" name="change_arv_regimen_yes_reason" placeholder="Reason" value="" />
                                <label for="date_change">Date Change:</label>
                                <input type="text" class="fdatepicker" id="date_change" name="date_change" placeholder="Date Change" value="" readonly="readonly" />
                                <label for="new_arv_regimen">New ARV Regimen:</label>
                                <input type="text" id="new_arv_regimen" name="new_arv_regimen" placeholder="New ARV Regimen" value="" />
                            </div>
                            <div class="large-6 columns">&nbsp;</div>
                        </div>
                    </div>
                    <div class="large-6 columns">
                        <label for="recommendations">Recommendations:</label>
                        <textarea name="recommendations" id="recommendations" placeholder="Recommendations" rows="11">{{ $recommendations }}</textarea>
                    </div>
                </div>
    		</fieldset><br />

    		<div class="row">
    			<div class="large-4 columns">&nbsp;</div>
    			<div class="large-4 columns">
                    <div class="row">
                        <div class="large-3 columns">&nbsp;</div>
                        <div class="large-6 columns">
                            {!! csrf_field() !!}
                            <input type="submit" class="button alert expand" value="Submit">
                        </div>
                        <div class="large-3 columns">&nbsp;</div>
                    </div>
    			</div>
    			<div class="large-4 columns">&nbsp;</div>
    		</div>
    		{!! csrf_field() !!}
    	</form>
    </div>

<script type="text/javascript">
<?php
if($change_arv_regimen == 1)
{
    echo '$(\'#change_arv_regimen_yes\').attr(\'checked\', true);';
    echo '$(\'#change_arv_regimen_yes_reason\').val(\'' . $change_arv_regimen_yes_reason . '\').attr(\'readonly\', false);';
    echo '$(\'#date_change\').val(\'' . $date_change . '\');';
    echo '$(\'#new_arv_regimen\').val(\'' . $new_arv_regimen . '\').attr(\'readonly\', false);';
}
else
{
    echo '$(\'#change_arv_regimen_no\').attr(\'checked\', true);';
    echo '$(\'#change_arv_regimen_yes_reason\').val(\'\').attr(\'readonly\', true);';
    echo '$(\'#date_change\').val(\'\');';
    echo '$(\'#new_arv_regimen\').val(\'\').attr(\'readonly\', true);';
}
?>

$(function(){
    $("input[name='change_arv_regimen']").change(function(){
        var status = $(this).is(':checked');
        var value = $(this).val();

        if(value == 1)
        {
        	$('#change_arv_regimen_yes_reason').val('').attr('readonly', false);
            $('#new_arv_regimen').val('').attr('readonly', false);
        }
        else
        {
            $('#change_arv_regimen_yes_reason').val('').attr('readonly', true);
            $('#new_arv_regimen').val('').attr('readonly', true);
        }
    });
});

</script>
@endsection
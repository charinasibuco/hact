@extends('hact.layouts.layout_admin')

@section('content')

    <div class='row'>
        <div class='large-12 columns'>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('medication_index') }}">Medication</a></li>
                <li class="current"><a href="#">New Record</a></li>
            </ul>
        </div>
    </div>

	@include('hact.messages.success')
	@include('hact.messages.error_list')

    <div class="panel">
    	<form action="{{ $action }}" method="post">
            <fieldset>
                <legend>Patient's Name</legend>
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
                </div>
            </fieldset>
    		<fieldset>
        		<legend>Medications Profile</legend>
        		<div class="row">
        			<div class="large-6 columns">
    					<div class="row">
    						<div class="large-12 columns">
    							<label for="medication_name">Name of Medication:</label>
    							<input type="text" id="item_search" name="search_item" placeholder="Search Medication" value="{{ $search_item }}" />
                                <input type="hidden" id="item_id" name="item_id" value="{{ $item_id }}" />
                                <input type="hidden" id="search_item_url" name="search_item_url" value="{{ route('search_item') }}" />
    						</div>
    					</div>
    					<div class="row">
    						<div class="large-12 columns">
    							<label for="dosage">Dosage:</label>
    							<input type="text" id="dosage" name="dosage" placeholder="Dosage" value="{{ $dosage }}" />
    						</div>
    					</div>
        			</div>
        			<div class="large-6 columns">
    					<div class="row">
    						<div class="large-12 columns">
    							<label for="frequency">Frequency:</label>
    							<input type="text" id="frequency" name="frequency" placeholder="Frequency" value="{{ $frequency }}" />
    						</div>
    					</div>
    					<div class="row">
    						<div class="large-12 columns">
    							<label for="date_started">Date Started:</label>
    							<input type="text" id="date_started" name="date_started" placeholder="Date Started" value="{{ $date_started }}" class="fdatepicker" readonly="readonly" />
    						</div>
    					</div>
        			</div>
        		</div>
    		</fieldset><br/>

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
    	</form>
    </div>
<script type="text/javascript">


$(function(){
    $("#occupational_exposure").click(function(){
        var status = $(this).is(':checked');

        if(status == true)
        {
        	$('.occupational_exposure_selection').show();
        }
        else
        {
        	$('.occupational_exposure_selection').hide();
        }
    });
});
</script>

@endsection
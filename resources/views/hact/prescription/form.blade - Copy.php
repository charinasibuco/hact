@extends('hact.layouts.layout_admin')

@section('content')

<div class='row'>
	<div class='large-12 columns'>
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="#">ART</a></li>
			<li><a href="{{ route('checkup') }}">Medication</a></li>
			<li class="current"><a href="#">Prescription</a></li>
		</ul>
	</div>
</div>

	@include("hact.messages.success")
	@include("hact.messages.error_list")
	
<div class="panel">
	<form action="{{ $action }}" method="post">
		<fieldset>
			<legend>Doctor Prescription</legend>
			<div class="row">
				<div class="large-4 columns">
					<label for="search_patient">Patient</label>
					<div class="row collapse">
				    	<div class="small-10 columns">
							<input type="text" id="search_vct" name="search_vct" value="{{ $search_vct }}" />
							<input type="hidden" id="patient_id" name="patient_id" value="{{ $patient_id }}" />
							<input type="hidden" id="search_vct_url" name="search_vct_url" value="{{ route('vct_search') }}" />
				    	</div>
				    	<div class="small-2 columns">
				      		<span class="postfix"><i class="fa fa-search"></i></span>
				    	</div>
					</div>
				</div>
				<div class="large-4 columns">
					<label for="search_patient">Medicine</label>
					<div class="row collapse">
				    	<div class="small-10 columns">
							<input type="text" id="search_item" name="search_item" value="{{ $search_vct }}" />
							<input type="hidden" id="item_id" name="item_id" value="{{ $patient_id }}" />
							<input type="hidden" id="search_item_url" name="search_item_url" value="{{ route('medicine_search_json') }}" />
				    	</div>
				    	<div class="small-2 columns">
				      		<span class="postfix"><i class="fa fa-search"></i></span>
				    	</div>
					</div>
				</div>
				<div class="large-4 columns">&nbsp;</div>
			</div>
			<div class="row">
				<div class="large-4 columns">
					<label for="pills_per_day">No. of pills per day</label>
					<input type="number" id="pills_per_day" name="pills_per_day" value="{{ $pills_per_day }}" required />
				</div>
				<div class="large-4 columns">
					<label for="pills_missed">No. of pills missed in past 30 days</label>
					<input type="number" id="pills_missed" name="pills_missed" value="{{ $pills_missed }}" required />
				</div>
				<div class="large-4 columns">
					<label for="pills_left">No. of pills left</label>
					<input type="number" id="pills_left" name="pills_left" value="{{ $pills_left }}" required />
				</div>
			</div>
			<div class="row">
				<div class="large-4 columns">
					<label for="date_discontinued">Date Discontinued</label>
					<input type="text" id="date_discontinued" name="date_discontinued" value="{{ $date_discontinued }}" class="fdatepicker" readonly required />
				</div>
				<div class="large-8 columns">&nbsp;</div>
			</div>
			<div class="row">
				<div class="large-4 columns">
					<label for="reason">Reason</label>
					<select id="reason" name="reason" required>
						<option value=""></option>
						<option value="1">Treatment Failure</option>
						<option value="2">Clinical Progression/Hospitalization</option>
						<option value="3">Patient Decision/Request</option>
						<option value="4">Compliance Difficulties</option>
						<option value="5">Drug Interaction</option>
						<option value="6">Adverse Events(Specify)</option>
						<option value="7">Other (Specify)</option>
						<option value="8">Death</option>
					</select>
				</div>
				<div class="large-8 columns">
					<label for="reason_specify">Specify</label>
					<input type="text" id="reason_specify" name="reason_specify" value="" readonly />
				</div>
			</div>
		</fieldset>
		<br/>
		<div class="row">	
			<div class="large-12 columns">
				<button type="submit" class="button small alert">Save</button>
				<a class="button small info" href=""><strong>Back</strong></a>
				{!! csrf_field() !!}
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
<?php
	if($reason != '')
	{
		echo '$(\'#reason\').val(\'' . $reason . '\')';

		if(in_array($reason_specify, [6, 7]))
		{
			echo '$(\'#reason_specify\').val(\'' . $reason_specify . '\').attr(\'readonly\', false);';
		}
	}
?>


//	scripts
$(function(){
	$('#reason').change(function(){

		var value = $(this).val();

		if(value == 6 || value == 7)
		{
			$('#reason_specify').attr('readonly', false);
		}
		else
		{
			$('#reason_specify').attr('readonly', true);
		}

	});
});
</script>

@endsection
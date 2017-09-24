@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-12 columns'>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Home</a></li>
				<li><a href="{{ route('caip_index') }}">Clinical and Immunoligic</a></li>
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
					<div class="large-4 columns">
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
				<legend>Clinical and Immunoligic</legend>
				<div class="row">
					<div class="large-4 columns">
						<label for="laboratory">Laboratory:</label>
						<select id="laboratory" name="laboratory">
							<option value="">-- Select --</option>
							<option value="CD4">CD4</option>
							<optgroup label="CBC">
								<option value="CBC Hgb">Hgb</option>
								<option value="CBC RBC">RBC</option>
								<option value="CBC WBC">WBC</option>
								<option value="CBC Plt">Plt</option>
							</optgroup>
							<option value="FBS">FBS</option>
							<optgroup label="Lipid Prof">
								<option value="Lipid Prof Chol">Chol</option>
								<option value="Lipid Prof HDL">HDL</option>
								<option value="Lipid Prof LDL">LDL</option>
								<option value="Lipid Prof Trigly">Trigly</option>
							</optgroup>
							<option value="Crea">Crea</option>
							<option value="SGPT">SGPT</option>
							<option value="RPR">RPR</option>
							<option value="HbsAg">HbsAg</option>
							<option value="HCV">HCV</option>
							<option value="U/A">U/A</option>
							<option value="S/E">S/E</option>
							<option value="CXR">CXR</option>
							<optgroup label="Sputum AFB">
								<option value="Sputum AFB 1">CHOL</option>
								<option value="Sputum AFB 2">LDL</option>
							</optgroup>
							<option value="FBS">Genexpert</option>
							<option value="others">Others</option>
						</select>
					</div>
					<div class="large-8 columns">
						<label for="laboratory_others">Others:</label>
						<input type="text" placeholder="Others" id="laboratory_others" name="laboratory_others" value="{{ $laboratory_others }}" {{ ($laboratory != 'others')? 'disabled="disabled"' : '' }} />
					</div>
				</div>
				<div class="row">
					<div class="large-4 columns">
						<label for="date_result">Date:</label>
						<input type="text" placeholder="MM dd, yyyy" class="fdatepicker" id="date_result" name="date_result" value="{{ $date_result }}" readonly="readonly" />
					</div>
					<div class="large-8 columns">
						<label for="result">Result:</label>
						<input type="text" placeholder="Result" id="result" name="result" value="{{ $result }}" />
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
	$("#laboratory").val("<?php echo $laboratory; ?>");
});

$(function(){
	$('#laboratory').change(function(){
		var value = $(this).val();

		if(value == 'others')
		{
			$('#laboratory_others').val('').attr('disabled', false);
		}
		else
		{
			$('#laboratory_others').val('').attr('disabled', true);
		}
	});
});
</script>
@endsection
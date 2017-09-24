@extends('hact.layouts.layout_admin')

@section('content')

<div class='row'>
	<div class='large-12 columns'>
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('arv') }}">ART (Anti-Retroviral Regimen)</a></li>
			<li><a href="{{ route('arv') }}">Prescription</a></li>
			<li class="current"><a href="#">Form</a></li>
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
					<label for="search_vct">Patient</label>
					<div class="row collapse">
				    	<div class="small-10 columns">
							<input type="text" id="search_vct" name="search_vct" value="{{ $search_vct }}" readonly />
							<input type="hidden" id="patient_id" name="patient_id" value="{{ $patient_id }}" />
							<input type="hidden" id="search_vct_url" name="search_vct_url" value="{{ route('vct_search') }}" />
				    	</div>
				    	<div class="small-2 columns">
				      		<span class="postfix"><i class="fa fa-search"></i></span>
				    	</div>
					</div>
				</div>
				<div class="large-4 columns">&nbsp;</div>
				<div class="large-4 columns">&nbsp;</div>
			</div>
			<div class="row">
				<div class="large-4 columns">
					<label for="search_item">Infections</label>
					<select id="infection" name="infection">
						<option value=""></option>
						@foreach($infections as $key => $value)
						<option value="{{ $key }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="large-4 columns">
					<label for="search_item">Medicine</label>
					<div class="row collapse">
				    	<div class="small-10 columns">
							<input type="text" id="search_item" name="search_item" value="{{ $search_item }}" />
							<input type="hidden" id="medicine_id" name="medicine_id" value="{{ $medicine_id }}" />
							<input type="hidden" id="search_item_url" name="search_item_url" value="{{ route('prescription_search_json') }}" />
				    	</div>
				    	<div class="small-2 columns">
				      		<span class="postfix"><i class="fa fa-search"></i></span>
				    	</div>
					</div>
				</div>
				<div class="large-4 columns">
					<label for="specified_medicine">Specify Medicine</label>
					<input type="text" id="specified_medicine" name="specified_medicine" value="{{ $specified_medicine }}" />
				</div>
			</div>
			<div class="row">
				<div class="large-4 columns">
					<label for="pills_per_day">No. of pills per day</label>
					<input type="number" id="pills_per_day" name="pills_per_day" value="{{ $pills_per_day }}" required />
				</div>
				<div class="large-4 columns">
					<label for="pills_missed_in_30_days">No. of missed in past 30 days</label>
					<input type="number" id="pills_missed_in_30_days" name="pills_missed_in_30_days" value="{{ $pills_missed_in_30_days }}" required />
				</div>
				<div class="large-4 columns">
					<label for="pills_left">No. of pills left</label>
					<input type="number" id="pills_left" name="pills_left" value="{{ $pills_left }}" required />
				</div>
			</div>
			<div class="row">
				<div class="large-4 columns">
					<label for="date_discontinued">Date Discontinued</label>
					<input type="text" id="date_discontinued" name="date_discontinued" value="{{ $date_discontinued }}" class="fdatepicker" readonly />
				</div>
				<div class="large-4 columns">
					<label for="reason">Reason</label>
					<select id="reason" name="reason">
						<option value=""></option>
						<option value="1">Treatment Failure</option>
						<option value="2">Clinical Progression/Hospitalization</option>
						<option value="3">Patient Decision/Request</option>
						<option value="4">Compliance Difficulties</option>
						<option value="5">Drug Interaction</option>
						<option value="6">Adverse Event (Specify)</option>
						<option value="7">Others (Specify)</option>
						<option value="8">Death</option>
					</select>
				</div>
				<div class="large-4 columns">
					<label for="specify">Specify</label>
					<input type="text" id="specify" name="specify" value="" readonly />
				</div>
			</div>
		</fieldset>
		<br/>
		<div class="row">	
			<div class="large-12 columns">
				<button type="submit" class="button small alert">Add</button>
				<!--a class="button small info" href="{{ route('arv') }}"><strong>Back</strong></a-->
				<a class="button small info" href="{{ route('arv_clear_session', $id) }}"><strong>Clear</strong></a>
				{!! csrf_field() !!}
			</div>
		</div>
	</form>
</div>

@if(Session::has('prescription.infections'))
<div class="panel">
	<table width="100%">
		<thead>
			<tr>
				<th width="4%"></th>
				<th width="15%">Infections</th>
				<th width="29%">Medicine</th>
				<th width="14%" class="text-center">Pills/Day</th>
				<th width="14%" class="text-center">Pills Missed</th>
				<th width="14%" class="text-center">Pills Left</th>
			</tr>
		</thead>
		@foreach(Session::get('prescription.infections') as $key => $value)
		<tbody>
			<tr>
				<td><a href="{{ route('arv_destroy_session', [$id, $value['infection']]) }}" title="Remove"><i class="fa fa-lg fa-times"></i></a></td>
				<td>
					@if($value['infection'] == 'hepatitis_b')
						Hepatitis B
					@elseif($value['infection'] == 'hepatitis_c')
						Hepatitis C
					@elseif($value['infection'] == 'pneumocystis_pneumonia')
						Pneumocystis Pneumonia
					@elseif($value['infection'] == 'orpharyngeal_candidiasis')
						Orpharyngeal Candidiasis
					@elseif($value['infection'] == 'syphilis')
						Syphilis
					@elseif($value['infection'] == 'stis')
						Stis
					@elseif($value['infection'] == 'others')
						Others
					@endif
				</td>
				<td>
					@if($value['specified_medicine'] == '')
						{{ $value['search_item'] }}
					@else
						{{ $value['specified_medicine'] }}
					@endif
				</td>
				<td class="text-center">{{ $value['pills_per_day'] }}</td>
				<td class="text-center">{{ $value['pills_missed_in_30_days'] }}</td>
				<td class="text-center">{{ $value['pills_left'] }}</td>
			</tr>
		</tbody>
		@endforeach
	</table>
	<div class="row">	
		<div class="large-12 columns">
			<form action="{{ route('arv_store', $id) }}" method="post">
				<button type="submit" class="button small alert">Submit</button>
				{!! csrf_field() !!}
			</form>
		</div>
	</div>
</div>
@endif

<script type="text/javascript">

<?php

/*if(Session::has('prescription.infections'))
{
	foreach(Session::get('prescription.infections') as $key => $value)
	{
		echo '$("#infection option[value=\'' . $value['infection'] . '\']").remove();';
	}
}*/

if($reason != '')
{
	echo '$(\'#reason\').val(' . $reason . ');';

	if(in_array($reason, [6,7]))
	{
		echo '$(\'#specify\').attr(\'readonly\', false).val(\'' . $specify . '\')';
	}
}

?>

//	scripts
$(function(){
	$('#reason').change(function(){

		var value = $(this).val();

		if(value == 6 || value == 7)
		{
			$('#specify').attr('readonly', false).focus();
		}
		else
		{
			$('#specify').attr('readonly', true);
		}

	});
});

$(function(){
	$('#search_item').change(function(){

		var value = $(this).val();

		if(value != '')
		{
			$('#specified_medicine').val('').attr('readonly', true);
		}
		else
		{
			$('#specified_medicine').attr('readonly', false).focus();
		}

	});
});

$(function(){
	$('#specified_medicine').change(function(){

		var value = $(this).val();

		if(value != '')
		{
			$('#search_item').val('');
			$('#medicine_id').val('');
		}

	});
});

</script>

@endsection
@extends('hact.layouts.layout_admin')

@section('content')
<style type="text/css">
	.optionGroup{
		font-weight:bold ;
	}	
</style>

<div class="row">
	<div class="large-7 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li class="current"><a href="#">VCT (Voluntary Counseling and Testing)</a></li>
		</ul>
	</div>
	<div class="large-5 columns">
		<form>
			<div class="row">
				<div class="large-12 columns">
					<div class="row collapse">
						<div class="small-9 columns">
							<input name="search" type="text" placeholder="Search" value="{{ $search }}" readonly>
						</div>
				    	<div class="small-3 columns">
				      		<button type="submit" class="button alert postfix"><i class="fa fa-search"></i></button>
				    	</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<div class='row'>
	<div class='large-12 columns'>
		@include('hact.messages.success')

		{!! str_replace('/?', '?', $patients->appends($pagination)->render()) !!}
		<table width="100%">
			<thead>
				<tr>
					<th></th>
                    <th><a href="{{ $code_name_sort }}">Code Name</a></th>
                    <th><a href="{{ $birth_date_sort }}">Age</a></th>
                    <th><a href="{{ $gender_sort }}">Sex</a></th>
                    <th><a href="{{ $saccl_code_sort }}">SACCL</a></th>
                    <th><a href="{{ $ui_code_sort }}">UIC</a></th>
					<th width="18%"><a href="#">VCT Date</a></th>
					<th width="10%"><a href="#">Result</a></th>
				</tr>
			</thead>
			<tbody>
			@foreach($patients as $row)
			<tr class="{{ ($row->is_mortality == 0) ? '' : 'mortality' }}">
				<td>
					<a href="{{ route('vct_edit', $row->last_vct_record->id) }}" title="Edit VCT"><i class="fa fa-edit fa-lg"></i></a>
					<a href="{{ route('vct_records', [$row->last_vct_record->id, $row->id]) }}" title="Record History"><i class="fa fa-table fa-lg"></i></a>
					<a href="#" title="Patient’s Results" onclick="VCTResultSettings({{ $row->last_vct_record->id }}, {{ $row->id }}, '{{ $row->last_vct_record->result }}', '{{ $row->saccl_code }}','{{ $row->ConfirmatoryDate->confirmatory_date_format or '' }}')"><i class="fa fa-calendar-check-o fa-lg"></i></a>
					@if($row->last_vct_record->result == 2)
					<a href="{{ route('vct_doctor', $row->id) }}" title="Attending Physician"><i class="fa fa-user-md fa-lg"></i></a>
					@endif
				</td>
				<td>{{ $row->code_name }}</td>
                <td>{{ $row->age }}</td>
                <td>{{ $row->gender_format }}</td>
                <td>{{ $row->saccl_code }}</td>
                <td>{{ $row->ui_code }}</td>
				<td>{{ $row->last_vct_record->vct_date_format2 }}</td>
				<td>{{ $row->last_vct_record->result_format }}</td>
			</tr>
			@endforeach
			</tbody>
		</table>
		{!! str_replace('/?', '?', $patients->appends($pagination)->render()) !!}
	</div>
</div>

<div id="VCTResultSettings" class="reveal-modal tiny" data-reveal aria-labelledby="VCTResultSettings" aria-hidden="true" role="dialog">
	<a class="close-reveal-modal" aria-label="Close">&#215;</a>
	<h4 id="modalTitle">VCT Result</h4>
	<form action="{{ route('vct_result') }}" method="post">
		<div class="row">
			<div class="large-12 columns">
				<label for="result">Result</label>
				<select name="result" id="result" required>
					<option value=""></option>
					<option value="0" class="optionGroup"><strong>Non Reactive</strong></option>
					<optgroup label="Reactive" style="margin-left:3px;">
						<option value="1">Negative</option>
						<option value="2">Positive</option>
						<option value="3">Indeterminate</option>
					</optgroup>					
				</select>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<label for="saccl_code">SACCL Code</label>
				<input type="text" name="saccl_code" id="saccl_code" value="">
			</div>
		</div>
		<div class="confirmatory_date row">
			<div class="large-12 columns">
				<label for="confirmatory_date">Confirmatory Date</label>
				<input type="text" name="confirmatory_date" id="confirmatory_date" class="fdatepicker" value="" readonly>
			</div>
		</div>
		<div class="row">
			<div class="large-4 columns">
				{!! csrf_field() !!}
				<input type="hidden" id="vct_id" name="vct_id" />
				<input type="hidden" id="patient_id" name="patient_id" />
				<button type="submit" class="button expand">Submit</button>
			</div>
		</div>
	</form>
</div>


<div id="DoctorSettings" class="reveal-modal tiny" data-reveal aria-labelledby="DoctorSettings" aria-hidden="true" role="dialog">
	<a class="close-reveal-modal" aria-label="Close">&#215;</a>
	<h4 id="modalTitle">Assign a Doctor</h4>
	<form action="{{ route('vct_assign_doctor') }}" method="post">
		<div class="row">
			<div class="large-12 columns">
				<label for="user_id">Doctor</label>
				<select name="user_id" id="user_id" required>
					<option value=""></option>
					@foreach($doctors as $row)
						<option value="{{ $row->id }}">{{ $row->name }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="large-4 columns">
				{!! csrf_field() !!}
				<input type="hidden" id="assign_doctor_patient_id" name="patient_id" />
				<button type="submit" class="button expand">Submit</button>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
	$('#result').change(function(){
		if($(this).val()==2){
			$('.confirmatory_date').show();
		}
		else
		{
			$('.confirmatory_date').hide();
		}
	});


function VCTResultSettings(vct_id, patient_id, result, saccl_code, confirmatory_date)
{
	$('#vct_id').val(vct_id);
	$('#patient_id').val(patient_id);

	$('#result').val(result);
	$('#saccl_code').val(saccl_code);

	$('#confirmatory_date').val(confirmatory_date);

	if($('#result').val()==2)
	{
		$('.confirmatory_date').show();
	}
	else
	{
		$('.confirmatory_date').hide();
	}


	$('#VCTResultSettings').foundation('reveal', 'open');
}

function DoctorSettings(patient_id, doctor_id)
{
	var doctor_id = (doctor_id == '' || doctor_id == null)? '' : doctor_id;

	$('#assign_doctor_patient_id').val(patient_id);
	$('#user_id').val(doctor_id);

	$('#DoctorSettings').foundation('reveal', 'open');
}

</script>

@endsection

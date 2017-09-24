@extends('hact.layouts.layout_admin')

@section('content')

<div class="row">
	<div class="large-12 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('vct') }}">VCT (Voluntary Counseling and Testing)</a></li>
			<li class="current"><a href="#">Patient {{ $patient->code_name }}</a></li>
		</ul>
	</div>
</div>
@include('hact.messages.success')
<div class='row'>
	<div class='large-12 columns'>
		{!! str_replace('/?', '?', $vct->render()) !!}
		<table width="100%">
			<thead>
				<tr>
					<th width="10%"></th>
					<th width="20%"><a href="#">VCT Date</a></th>
					<th width="15%"><a href="#">Result</a></th>
					<th width="25%"><a href="#">Counsellor</a></th>
					<th width="30%"><a href="#">Date Created</a></th>
				</tr>
			</thead>
			<tbody>
			@foreach($vct as $row)
			<tr>
				<td>
					<a href="{{ route('vct_edit', $row->id) }}" title="Edit VCT"><i class="fa fa-edit fa-lg"></i></a>
					<a href="#" title="Patient Result" onclick="VCTResultSettings({{ $row->id }}, {{ $row->patient_id }}, '{{ $row->result }}', '{{ $row->saccl_code }}')"><i class="fa fa-calendar-check-o fa-lg"></i></a>
					@if($row->result == 1 && Auth::user()->access != 2)
					<a href="{{ route('vct_doctor', $row->id) }}" title="Assign Doctor"><i class="fa fa-user-md fa-lg"></i></a>
					@endif
				</td>
				<td>{{ $row->vct_date_format }}</td>
				<td>{{ $row->result_format }}</td>
				<td>{{ $row->User->name }}</td>
				<td>{{ $row->created_at_format }}</td>
			</tr>
			@endforeach
			</tbody>
		</table>
		{!! str_replace('/?', '?', $vct->render()) !!}
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

function VCTResultSettings(vct_id, patient_id, result, saccl_code)
{
	$('#vct_id').val(vct_id);
	$('#patient_id').val(patient_id);

	$('#result').val(result);
	$('#saccl_code').val(saccl_code);

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

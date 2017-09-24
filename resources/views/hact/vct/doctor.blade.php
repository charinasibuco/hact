@extends('hact.layouts.layout_admin')

@section('content')

<div class="row">
	<div class="large-12 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('patient') }}">Patient</a></li>
			<li><a href="{{ route('patient_profile',$patient->id) }}">{{ $patient->code_name  }}</a></li>
			<li class="current"><a href="#">Doctor</a></li>
		</ul>
	</div>
</div>

		@include('hact.messages.success')
		@include('hact.messages.error_list')

<div class="panel">

	<div class="row">
		<div class="large-4 columns">
			<form action="{{ $action }}" method="post">

				<div class="row">
					<div class="large-12 columns">
						<label for="patient">Patient</label>
						<input type="text" id="patient" name="patient" value="{{ $patient->code_name }}" readonly />
					</div>
				</div>

				<div class="row">
					<div class="large-12 columns">
						<label for="user_id">Attending Physician</label>
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
					<div class="large-6 columns">
						{!! csrf_field() !!}
						<input type="hidden" name="active" value="1">
						<button type="submit" class="button expand">Submit</button>
					</div>
					<div class="large-6 columns">&nbsp;</div>
				</div>

			</form>
		</div>

		<div class="large-8 columns">
			
			<table width="100%">
				<thead>
					<tr>
						<th width="5%"></th>
						<th width="95%">Attending Physician</th>
					</tr>
				</thead>
				<tbody>
				@foreach($my_doctors as $row)
				<tr>
					<td>
						@if($row->active == 1)
							<a href="{{ route('vct_disable_doctor', [$row->id, $row->patient_id]) }}" title="Disabled"><i class="fa fa-lg fa-check-square-o"></i></a>
						@else
							<a href="{{ route('vct_enable_doctor', [$row->id, $row->patient_id]) }}" title="Enabled"><i class="fa fa-lg fa-square-o"></i></a>
						@endif
					</td>
					<td>{{ $row->Doctor->name }}</td>
				</tr>
				@endforeach
				</tbody>
			</table>

		</div>
	</div>

</div>


@endsection

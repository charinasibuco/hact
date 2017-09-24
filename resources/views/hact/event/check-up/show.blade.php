@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-12 columns'>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Home</a></li>
				<li><a href="{{ route('checkup_index') }}">Check Up</a></li>
				<li class="current"><a href="#">{{ $patient->EnrolmentDemographics->full_name2 }}</a></li>
			</ul>
		</div>
	</div>


	<div class='row'>
		<div class='large-12 columns'>
			<a title="add lab test" href="{{ route('checkup_create', ['demographics_id' => $patient->demographics_id, 'search_patient' => $patient->full_name2]) }}"><i class="fa fa-2x fa-plus-circle"></i></a>
		</div>
	</div>

	<div class='row'>
		<div class='large-12 columns'>
			@include('hact.messages.success')
			@include('hact.messages.error_list')
			<table width="100%">
				<thead>
					<tr>
						<th width="5%"></th>
						<th width="35%">Check Up Date</th>
						<th width="30%">Diagnoses</th>
						<th width="30%">Recommendation</th>
					</tr>
				</thead>
				<tr>
					<td><a href="{{ route('checkup_edit', $patient->id) }}"><i class="fa fa-edit fa-lg"></i></a></td>
					<td>{{ $patient->id }}</td>
					<td></td>
					<td>{{ $patient->recommendation }}</td>
				</tr>
			<td></td>
		</table>
        </div>
    </div>

@endsection

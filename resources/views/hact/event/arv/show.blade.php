@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-12 columns'>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Home</a></li>
				<li><a href="{{ route('arv_index') }}">Antiretroviral (ARV)</a></li>
				<li class="current"><a href="#">{{ $patient->full_name }}</a></li>
			</ul>
		</div>
	</div>


	<div class='row'>
		<div class='large-12 columns'>
			<a title="add lab test" href="{{ route('arv_create', $patient->id) }}"><i class="fa fa-2x fa-plus-circle"></i></a>
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
						<th width="15%">Blood Pressure</th>
						<th width="15%">Temperature</th>
						<th width="15%">Pulse Rate</th>
						<th width="15%">Respiration Rate</th>
						<th width="10%">Weight</th>
						<th width="15%">Classification</th>
						<th width="10%">Date</th>
					</tr>
				</thead>
			@foreach($rows as $row)
				<tr>
					<td>
						<a href="{{ route('arv_edit', $row->id) }}" title="Edit ARV Profile"><i class="fa fa-edit fa-lg"></i></a>
					</td>
					<td>{{ $row->blood_pressure }}</td>
					<td>{{ $row->temperature }}</td>
					<td>{{ $row->pulse_rate }}</td>
					<td>{{ $row->respiration_rate }}</td>
					<td>{{ $row->weight }}</td>
					<td>{{ $row->classification }}</td>
					<td>{{ $row->arv_date }}</td>
				</tr>
			@endforeach
		</table>
        </div>
    </div>

@endsection

@extends('hact.layouts.layout_admin')

@section('content')

<div class="row">
	<div class="large-12 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="#">ART (Anti-Retroviral Regimen)</a></li>
			<li><a href="{{ route('arv') }}">Prescription</a></li>
			<li><a href="{{ route('prescription_history', $patient->id) }}">History</a></li>
			<li class="current"><a href="#">Dispense Details ( {{ $patient->code_name }} )</a></li>
		</ul>
	</div>
</div>

<div class='row'>
	<div class='large-12 columns'>
		@include('hact.messages.success')
		@include('hact.messages.error_list')
		
		<table width="100%">
			<thead>
				<tr>
					<th width="30%"><a href="#">Medicines</a></th>
					<th width="15%"><a href="#">No. of Pills per Day</a></th>
					<th width="20%"><a href="#">Pills Missed in 30 Days</a></th>
					<th width="10%"><a href="#">Pills Left</a></th>
					<th width="15%"><a href="#">Date Dispense</a></th>
					<th width="30%"><a href="#">Issued By</a></th>
				</tr>
			</thead>
			<tbody>
				@foreach($prescription as $row)
					<tr>
						<td>{{ $row->ARVItems->Medicine->name }}</td>
						<td class="text-center">{{ $row->ARVItems->pills_per_day }}</td>
						<td class="text-center">{{ $row->pills_missed_in_30_days }}</td>
						<td class="text-center">{{ $row->pills_left }}</td>
						<td class="text-center">{{ $row->date_dispense->format('m/d/Y') }}</td>
						<td class="text-center">{{ $row->User->name }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection
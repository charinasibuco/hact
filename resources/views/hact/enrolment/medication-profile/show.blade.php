@extends('hact.layouts.layout_admin')

@section('content')

    <div class='row'>
        <div class='large-12 columns'>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('medication_index') }}">Medication</a></li>
                <li class="current"><a href="#">{{ $patient->full_name }}</a></li>
            </ul>
        </div>
    </div>

	<div class='row'>
		<div class="large-12 columns">
			<a title="add medication" href="{{ route('medication_create', $patient->id) }}"><i class="fa fa-2x fa-plus-circle"></i></a>
		</div>
    </div>

	<div class='row'>
		<div class='large-12 columns'>
			@include('hact.messages.success')
			@include('hact.messages.error_list')
			{!! str_replace('/?', '?', $medications->render()) !!}
			<table width="100%">
				<thead>
					<tr>
						<th width="10%" rowspan="2"></th>
						<th width="25%" rowspan="2">Medicine Name</th>
						<th width="10%" rowspan="2">Dosage</th>
						<th width="10%" rowspan="2">Frequency</th>
						<th colspan="2" class="text-center">Date</th>
						<th width="25%" rowspan="2">Reason for Discontinuation</th>
					</tr>
					<tr>
						<th width="10%">Started</th>
						<th width="10%">Discontinued</th>
					</tr>
				</thead>
				<tbody>
				@foreach($medications as $medication)
					<tr>
						<td>
							<a title="Edit Medication" href="{{ route('medication_edit', $medication->medication_id) }}"><i class="fa fa-edit fa-lg"></i></a>
							<a title="Stop Medication" href="{{ route('medication_edit_stop', [$medication->medication_id]) }}"><i class="fa fa-hand-paper-o fa-lg"></i></a>
						</td>
						<td>{{ $medication->Item->item_name }}</td>
						<td>{{ $medication->dosage  }}</td>
						<td>{{ $medication->frequency  }}</td>
						<td>{{ $medication->date_started  }}</td>
						<td>{{ $medication->date_discontinued  }}</td>
						<td>{{ $medication->discontinuation_reason  }}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			{!! str_replace('/?', '?', $medications->render()) !!}
		</div>
	</div>

@endsection
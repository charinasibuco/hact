@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-12 columns'>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Home</a></li>
				<li><a href="{{ route('caip_index') }}">Clinical and Immunoligic</a></li>
				<li class="current"><a href="#">{{ $patient->full_name }}</a></li>
			</ul>
		</div>
	</div>


	<div class='row'>
		<div class='large-12 columns'>
			<a title="add lab test" href="{{ route('caip_create',  $patient->id) }}"><i class="fa fa-2x fa-plus-circle"></i></a>
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
						<th width="35%">Date Taken</th>
						<th width="30%">Laboratory Test</th>
						<th width="30%">Result</th>
					</tr>
				</thead>
			@foreach($caips as $caip)
				<tr>
					<td><a href="{{ route('caip_edit', $caip->id) }}"><i class="fa fa-edit fa-lg"></i></a></td>
					<td>{{ $caip->date_result  }}</td>
					<td>{{ $caip->laboratory  }}</td>
					<td>{{ $caip->result  }}</td>
				</tr>
			@endforeach
		</table>
        </div>
    </div>

@endsection

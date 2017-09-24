@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-4 columns'>
			<form>
				<div class="row collapse">
					<div class="small-9 columns">
						<input name="search" type="text" placeholder="Search">
					</div>
			    	<div class="small-3 columns">
			      		<button type="submit" class="button alert postfix"><i class="fa fa-search"></i></button>
			    	</div>
				</div>
			</form>
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
						<th width="15%"><a href="{{-- $code_name_sort --}}">Code Name</a></th>
						<th width="15%"><a href="{{-- $last_name_sort --}}">SACCL</a></th>
						<th width="35%"><a href="{{-- $last_name_sort --}}">Name</a></th>
						<th width="15%"><a href="{{-- $date_started_sort --}}">Death Date</a></th>
						<th width="15%"><a href="{{-- $dosage_sort --}}">Cause of Death</a></th>

					</tr>
				</thead>
				<tbody>
				@foreach($patients as $patient)
				<tr>
					<td>
						<a href="{{ route('death_edit', $patient->id) }}"><i class="fa fa-edit"></i></a>
					</td>
					<td>{{ $patient->EnrolmentDemographics->code_name }}</td>
					<td>{{ $patient->EnrolmentDemographics->saccl_code }}</td>
					<td>{{ $patient->EnrolmentDemographics->full_name2  }}</td>
					<td>{{ $patient->death_date }}</td>
					<td>{{ $patient->death_cause }}</td>
				</tr>
				@endforeach	
				</tbody>
			</table>
		</div>
	</div>

@endsection
@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-7 columns'>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Home</a></li>
				<li class="current"><a href="#">Opportunistic Infections</a></li>
			</ul>
		</div>
		<div class='large-5 columns'>
			<form>
				<div class="row">
					<div class="large-12 columns">
						<div class="row collapse">
							<div class="small-9 columns">
								<input name="search" type="text" placeholder="Search" value="{{ $search }}">
							</div>
					    	<div class="small-3 columns">
					      		<button type="submit" class="button alert postfix"><i class="fa fa-search"></i></buatton>
					    	</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class='row'>
		<div class='large-12 columns'>
			<table width="100%">
				<thead>
					<tr>
						<th width="5%"></th>
						<th width="20%"><a href="{{ $ui_code_sort }}">UI Code</a></th>
						<th width="20%"><a href="{{ $saccl_code_sort }}">SACCL Code</a></th>
						<th width="20%"><a href="{{ $code_name_sort }}">Code Name</a></th>
						<th width="35%"><a href="{{ $last_name_sort }}">Name</a></th>
					</tr>
				</thead>
				<tbody>
				@foreach($patients as $patient)
				<tr>
					<td>
						<a href="{{ route('oi_profile_edit', $patient->id) }}"><i class="fa fa-edit fa-lg"></i></a>
					</td>
					<td>{{ $patient->EnrolmentDemographics->ui_code }}</td>
					<td>{{ $patient->EnrolmentDemographics->saccl_code }}</td>
					<td>{{ $patient->EnrolmentDemographics->code_name }}</td>
					<td>{{ $patient->EnrolmentDemographics->full_name2  }}</td>
				</tr>
				@endforeach	
				</tbody>
			</table>
		</div>
	</div>

@endsection
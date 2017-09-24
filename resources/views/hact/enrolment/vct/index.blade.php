@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-7 columns'>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Home</a></li>
				<li class="current"><a href="#">Voluntary Counseling Testing</a></li>
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
			@include('hact.messages.success')
			@include('hact.messages.error_list')
			{!! str_replace('/?', '?', $patients->appends($pagination)->render()) !!}
			<table width="100%">
				<thead>
				<tr>
					<th width="5%"></th>	
					<th width="20%"><a href="{{ $ui_code_sort }}">UI Code</a></th>
					<th width="35%"><a href="{{ $patient_name_sort }}">Name</a></th>
					<th width="10%"><a href="{{ $gender_sort }}">Gender</a></th>
					<th width="15%"><a href="{{ $hiv_positive_sort }}">HIV Positive</a></th>
					<th width="15%"><a href="{{ $vct_date_sort }}">VCT Date</a></th>
				</tr>
				</thead>
				<tbody>
				@foreach($patients as $patient)
				<tr>
					<td>
						<a href="{{ route('vct_edit',$patient->id) }}" title="Edit VCT Record"><i class="fa fa-edit"></i></a>
					</td>
					<td>{{ $patient->ui_code }}</td>
					<td>{{ $patient->last_name . ', ' . $patient->first_name . ' ' . $patient->middle_name . '.' }}</td>
					<td>{{ $patient->gender }}</td>
					<td>{{ $patient->hiv_positive_format }}</td>
					<td>{{ $patient->vct_date }}</td>
				</tr>
				@endforeach	
				</tbody>
			</table>
			{!! str_replace('/?', '?', $patients->appends($pagination)->render()) !!}
		</div>
	</div>

@endsection
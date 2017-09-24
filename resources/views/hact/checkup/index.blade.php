@extends('hact.layouts.layout_admin')

@section('content')

<div class="row">
	<div class="large-7 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li class="current"><a href="#">Checkup</a></li>
		</ul>
	</div>
	<div class="large-5 columns">
		<form>
			<div class="row">
				<div class="large-12 columns">
					<div class="row collapse">
						<div class="small-9 columns">
							<input name="search" type="text" placeholder="Search" value="{{ $search }}">
						</div>
				    	<div class="small-3 columns">
				      		<button type="submit" class="button alert postfix"><i class="fa fa-search"></i></button>
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
					<th></th>
					<th><a href="{{ $code_name_sort }}">Code Name</a></th>
					<th><a href="{{ $birth_date_sort }}">Age</a></th>
					<th><a href="{{ $gender_sort }}">Sex</a></th>
					<th><a href="{{ $saccl_code_sort }}">SACCL</a></th>
					<th><a href="{{ $ui_code_sort }}">UIC</a></th>
				</tr>
			</thead>
			<tbody>
				@foreach($patients as $row)
					<tr class="{{ ($row->is_mortality == 0) ? '' : 'mortality' }}">
						<td>
							<a href="{{ route('checkup_records', $row->id) }}" title="Checkup Records"><i class="fa fa-folder-open fa-lg"></i></a>
							<a href="{{ route('checkup_create', $row->id) }}" title="Schedule a Checkup"><i class="fa fa-plus fa-lg"></i></a>
						</td>
						<td>{{ $row->code_name }}</td>
						<td>{{ $row->age }}</td>
						<td>{{ $row->gender_format }}</td>
						<td>{{ $row->saccl_code }}</td>
						<td>{{ $row->ui_code }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		
		{!! str_replace('/?', '?', $patients->appends($pagination)->render()) !!}
	</div>
</div>

@endsection
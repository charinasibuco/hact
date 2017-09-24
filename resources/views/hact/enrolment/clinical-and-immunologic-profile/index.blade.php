@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-7 columns'>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Home</a></li>
				<li class="current"><a href="#">Clinical and Immunoligic</a></li>
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
						<th width="10%"></th>

						<th width="20%"><a href="{{ $ui_code_sort }}">UI Code</a></th>
						<th width="20%"><a href="{{ $saccl_code_sort }}">SACCL Code</a></th>
						<th width="20%"><a href="{{ $code_name_sort }}">Code Name</a></th>
						<th width="30%"><a href="{{ $last_name_sort }}">Name</a></th>

					</tr>
				</thead>
				<tbody>
					@foreach($patients as $patient)
					<tr>
						<td>
							<a href="{{ route('caip_show', $patient->id) }}" title="View Clinical and Immunoligic Profile"><i class="fa fa-user fa-lg"></i></a>
							<a href="{{ route('caip_create', $patient->id) }}" title="Add Clinical and Immunoligic"><i class="fa fa-plus fa-lg"></i></a>
						</td>
						<td>{{ $patient->ui_code }}</td>
						<td>{{ $patient->saccl_code }}</td>
						<td>{{ $patient->code_name }}</td>
						<td>{{ $patient->full_name2  }}</td>
					</tr>
					@endforeach	
				</tbody>
			</table>
			{!! str_replace('/?', '?', $patients->appends($pagination)->render()) !!}
		</div>
	</div>

@endsection
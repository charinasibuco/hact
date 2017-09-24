@extends('hact.layouts.layout_admin')
<div class="row sticky-search">
	<form>
		<div class="row collapse">
			<div class="small-9 columns">
				<input name="search" type="text" placeholder="Search" value="{{ $search }}">
			</div>
			<div class="small-3 columns">
				<button type="submit" class="button alert postfix"><i class="fa fa-search"></i></button>
			</div>
		</div>
	</form>
</div>
@section('content')
<div class="row">
	<div class="large-7 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li class="current"><a href="#">Mortality</a></li>
		</ul>
	</div>
	<div class="large-5 columns">
		<form>
			<div class="row search-bar">
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
<div class="row overflow">
	<div class="large-12 columns overflow-profile">
		@include('hact.messages.success')
		@include('hact.messages.error_list')
		<div class="row">
			@if(Auth::user()->access != 3)
			<div class="medium-4 columns"><a href="{{ route('mortality_create') }}" class="button small" title="Add New Mortality"><i class="fa fa-plus fa-lg"></i> Add New Mortality</a></div>
			@endif
			<div class="medium-8 columns">{!! str_replace('/?', '?', $patients->appends($pagination)->render()) !!}</div>
		</div>
		<br/>
		<table  class="responsive" width="100%">
			<thead>
				<tr>
					<th width="10%">Action</th>
					<th class="main-column"><a href="{{ $code_name_sort }}">Code Name</a></th>
					<th><a href="{{ $birth_date_sort }}">Age</a></th>
					<th><a href="{{ $gender_sort }}">Sex</a></th>
					<th><a href="{{ $saccl_code_sort }}">SACCL</a></th>
					<th><a href="{{ $ui_code_sort }}">UIC</a></th>
				</tr>
			</thead>
			<tbody>
			@foreach($patients as $row)
			<tr>
				<td>
					<a href="{{ route('mortality_show', $row->id) }}" title="Show Mortality Report"><i class="fa fa-file-text fa-lg"></i></a>
					{{--@if(Auth::user()->access == 1)--}}
					<a href="{{ route('mortality_edit', $row->id) }}" title="Edit Mortality Report"><i class="fa fa-pencil-square-o fa-lg"></i></a>
					<a href="{{ route('mortality_destroy', $row->id) }}" onclick="return confirm('Are you sure you want to delete this record?');" title="Remove Mortality Report"><i class="fa fa-times fa-lg"></i></a>
					{{--@endif--}}
				</td>
				<td class="main-column">{{ $row->code_name }}</td>
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
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
			<li class="current"><a href="#">Infections</a></li>
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
				      		<button type="submit" class="button alert postfix"><i class="fa fa-search"></i></buatton>
				    	</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<div class='row overflow'>
	<div class='large-12 columns overflow-profile'>
		@include('hact.messages.success')
		@include('hact.messages.error_list')
		<div class="row">
			<div class="medium-4 columns"></div>
			<div class="medium-8 columns">{!! str_replace('/?', '?', $patients->appends($pagination)->render()) !!}</div>
		</div>
		<table width="100%" class="responsive">
			<thead>
				<tr>
					<th width="10%"></th>
					<th class="main-column" width="15%" nowrap><a href="{{ $code_name_sort }}">Code Name</a></th>
					<th width="5%"><a href="{{ $birth_date_sort }}">Age</a></th>
					<th width="10%"><a href="{{ $gender_sort }}">Sex</a></th>
					<th width="20%"><a href="{{ $saccl_code_sort }}">SACCL</a></th>
					<th width="20%"><a href="{{ $ui_code_sort }}">UIC</a></th>
				</tr>
			</thead>
			<tbody>
			@foreach($patients as $row)
			<tr class="{{ ($row->is_mortality == 0) ? '' : 'mortality' }}">
				<td>
					<a href="{{ route('infections_show', $row->id) }}" title="View Infections Reports"><i class="fa fa-folder-open fa-lg"></i></a>
					<a href="{{ route('infections_create', $row->id) }}" title="Create New Infections Report"><i class="fa fa-plus fa-lg"></i></a>
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

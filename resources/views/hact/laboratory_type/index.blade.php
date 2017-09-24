@extends('hact.layouts.layout_admin')

@section('content')

<div class="row">
	<div class="large-7 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('laboratory') }}">Laboratory</a></li>
			<li class="current"><a href="#">Laboratory Types</a></li>
		</ul>
	</div>
	<div class="large-5 columns">
		<form>
			<div class="row">
				<div class="large-12 columns">
					<div class="row collapse">
						<div class="small-9 columns">
							<input name="search" type="text" placeholder="Search" value="">
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
		
		{!! str_replace('/?', '?', $laboratory_types->appends($pagination)->render()) !!}
		<table width="100%">
			<thead>
				<tr>
					<th width="10%"><a href="{{ route('laboratory_type_create') }}" title="Add Laboratory Type"><i class="fa fa-plus fa-lg"></i></a></th>
					<th width="90%"><a href="{{ $description_sort }}">Laboratory Type</a></th>
				</tr>
			</thead>
			<tbody>
			@foreach($laboratory_types as $row)
			<tr>
				<td>
					<a href="{{ route('laboratory_type_edit', $row->id) }}" title="Edit Laboratory Type"><i class="fa fa-pencil-square-o fa-lg"></i></a>
				</td>
				<td>{{ $row->description }}</td>
			</tr>
			@endforeach	
			</tbody>
		</table>
		{!! str_replace('/?', '?', $laboratory_types->appends($pagination)->render()) !!}
	</div>
</div>

@endsection
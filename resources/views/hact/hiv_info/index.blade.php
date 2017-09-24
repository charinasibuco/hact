@extends('hact.layouts.layout_admin')
<div class="row sticky-search">
	<form>
		<div class="row collapse">
			<div class="small-9 columns">
				<input name="search" type="text" placeholder="Search" value="">
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
			<li>HIV Info</li>
			<li class="{{ route('hiv_info',$type) }}"><a href="#">{{ $page }}</a></li>
		</ul>
	</div>
	<div class="large-5 columns">
		<form>
			<div class="row search-bar">
				<div class="large-12 columns">
					<div class="row collapse">
						<div class="small-9 columns">
							<input name="search" type="text" placeholder="Search" value="">
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

<div class="row">
	<div class="large-12 columns">
		<h3>Currently Displayed</h3>
		@include('hact.messages.success')
		@include('hact.messages.error_list')
		<table class="responsive" width="100%">
			<tr>
				<th width="10%"></th>
				<th class="main-column" width="25%">Description</th>
				<th width="25%">File</th>
				<th width="20%">Image</th>
				<th width="20%">User</th>
			</tr>
			@foreach($hiv_info as $row)
				@if($row->display == 1 || $row->display == '1')
					<tr>
						<td>
							<a href="{{ route('hiv_info_edit', $row->id) }}" title="Edit Content"><i class="fa fa-pencil-square-o fa-lg"></i></a> 
						</td>
						<td class="main-column">{{ $row->description }}</td>
						<td><a href="{{ asset($row->file) }}">{{ $row->file }}</a></td>
						<td><a href="{{ asset($row->image) }}">{{ $row->image }}</a></td>
						<td>{{ $row->User->name }}</td>
					</tr>
				@endif
			@endforeach	
		</table>
	</div>
</div>
<br/>
<div class="row">
	<div class="large-12 columns">
		{!! str_replace('/?', '?', $hiv_info->render()) !!}
		<table class="responsive" width="100%">
			<thead>
				<tr>
					<th width="10%"><a href="{{ route('hiv_info_create', $type) }}" title="Add Content"><i class="fa fa-plus fa-lg"></i></a></th>
					<th class="main-column" width="25%">Description</th>
					<th width="25%">File</th>
					<th width="20%">Image</th>
					<th width="20%">User</th>
				</tr>
			</thead>
			<tbody>
			@foreach($hiv_info as $row)
				<tr>
					<td>
						<a href="{{ route('hiv_info_edit', $row->id) }}" title="Edit Content"><i class="fa fa-pencil-square-o fa-lg"></i></a> <a href="{{ route('hiv_info_display', [$row->type, $row->id]) }}" title="Display this Content in the Landing Page"><i class="fa fa-play fa-lg"></i></a>
					</td>
					<td class="main-column">{{ $row->description }}</td>
					<td><a target='_blank' href="{{ asset($row->file) }}">{{ $row->file }}</a></td>
					<td><a target='_blank' href="{{ asset($row->image) }}">{{ $row->image }}</a></td>
					<td>{{ $row->User->name }}</td>
				</tr>
			@endforeach	
			</tbody>
		</table>
		{!! str_replace('/?', '?', $hiv_info->render()) !!}
	</div>
</div>

@endsection
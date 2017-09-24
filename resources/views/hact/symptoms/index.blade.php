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
			<li><a href="{{ route('medicine') }}">Pharmacy</a></li>
			<li class="current"><a href="#">Symptoms</a></li>
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

<div class='row'>
	<div class='large-12 columns'>
		@include('hact.messages.success')
		@include('hact.messages.error_list')
		<a href="{{ route('symptoms_create') }}" class="button small label success" title="Add pill and symptoms"><i class="fa fa-plus fa-lg"></i> Create Symptom</a>
		{!! str_replace('/?', '?', $symptoms->appends($pagination)->render()) !!}
		<table class="responsive" width="100%">
			<thead>
				<tr>
					<th width="10%"></th>
					<th class="main-column" width="30%"><a href="{{ $pill_sort }}">Pill</a></th>
					<th width="30%"><a href="{{ $symptoms_sort }}">Signs & Symptoms</a></th>
					<th width="30%"><a href="{{ $monitoring_sort }}">Monitoring</a></th>
				</tr>
			</thead>
			<tbody>
			@foreach($symptoms as $row)
			<tr>
				<td>
					<a href="{{ route('symptoms_edit', $row->id) }}" title="View Symptoms Details"><i class="fa fa-pencil-square-o fa-lg"></i></a>
				</td>
				<td class="main-column">{{ $row->pill }}</td>
				<td>{{ $row->symptoms }}</td>
				<td>{{ $row->monitoring }}</td>
			</tr>
			@endforeach	
			</tbody>
		</table>
		{!! str_replace('/?', '?', $symptoms->appends($pagination)->render()) !!}
	</div>
</div>

@endsection
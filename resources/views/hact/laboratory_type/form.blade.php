@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-12 columns'>
			<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('laboratory') }}">Laboratory</a></li>
			<li><a href="{{ route('laboratory_type') }}">Laboratory Types</a></li>
			<li class="current"><a href="#">{{ $page }}</a></li>
		</ul>
		</div>
	</div>
	@include("hact.messages.success")
	@include("hact.messages.error_list")
	<div class="panel">
		<form method="post" action="{{ $action }}">
		 	<fieldset>
		 		<legend>Laboratory Type</legend>
				<div class="row">
					<div class="large-12 columns">
						<label for="pill">Laboratory Name:</label>
						<input type="text" id="description" name="description" value="{{ $description }}" placeholder="Laboratory Name">
					</div>
				</div>
				
			</fieldset>
			<br/>
			<div class="row">	
				<div class="large-12 columns">
					<button type="submit" class="button small alert">Save</button>
					{!! csrf_field() !!}
				</div>
			</div>
		</div>
		</form>
	</div>
@endsection
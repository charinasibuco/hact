@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-12 columns'>
			<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('medicine') }}">Pharmacy</a></li>
			<li><a href="{{ route('symptoms') }}">Symptoms</a></li>
			<li class="current"><a href="#">{{ $page }}</a></li>
		</ul>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			@include("hact.messages.success")
			@include("hact.messages.error_list")
		</div>
	</div>
	<div class="row">
		<div class="large-12 medium-12 small-12 columns">
			<div class="custom-panel-heading">
				<span>{{ $page }} Symptoms</span>
				<a href="{{ route('symptoms') }}" class="alert tiny button right" title="Cancel Checkup"><i class="fi fi-x"></i> Cancel</a>
			</div>
			<div class="custom-panel-details">
				<form method="post" action="{{ $action }}">
					<fieldset>
						<legend>Pill and Symptoms</legend>
						<div class="row">
							<div class="large-4 columns">
								<label for="pill">Pill Name:</label>
								<input type="text" id="pill" name="pill" value="{{ $pill }}" placeholder="Pill">
							</div>
							<div class="large-4 columns">
								<label for="pill">Symptoms:</label>
								<input type="text" id="symptoms" name="symptoms" value="{{ $symptom }}" placeholder="Symptoms">
							</div>
							<div class="large-4 columns">
								<label for="pill">Monitoring:</label>
								<input type="text" id="monitoring" name="monitoring" value="{{ $monitoring }}" placeholder="Monitoring">
							</div>
						</div>

					</fieldset>
					<br/>
					<div class="row">
						<div class="medium-12 columns">
							<div class="right">
								{!! csrf_field() !!}
								<button class="button success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
								<a href="{{ route('symptoms') }}" class="button alert" title="Cancel"><i class="fi fi-x"></i> Cancel</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="panel">

	</div>
@endsection
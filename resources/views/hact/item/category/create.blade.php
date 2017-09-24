@extends('hact.layouts.layout_admin')

@section('content')
	<div class="row">
		<div class="large-12 column">
			@include("hact.messages.success")
			@include("hact.messages.error_list")
		</div>
	</div>
	<div class="row">
		<div class="large-12 medium-12 small-12 columns">
			<div class="custom-panel-heading">
				<span>{{ $page }} Category</span>
				{{--<a href="{{ route('patient_profile',$patient_id) }}" class="alert tiny button right" title="Cancel Checkup"><i class="fi fi-x"></i> Cancel</a>--}}
			</div>
			<div class="custom-panel-details">
				<form method='post' action="{{ route('item_category_store') }}">

					<div class='row'>
						<div class='large-12 columns'>
							<label>Category Name:
								<input type='text' id='category_name' name='category_name' placeholder='Category Name' value="{{ old('category_name') }}">
							</label>
						</div>
					</div>

					<div class='row'>
						<div class='large-12 columns'>
							<input type='submit' value='submit'>
							{!! csrf_field() !!}
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>

@endsection
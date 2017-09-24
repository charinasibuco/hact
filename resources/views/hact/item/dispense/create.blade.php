@extends("hact.layouts.layout_admin")

@section("content")
	<div class="row">
		<div class="large-12 column">
			@include("hact.messages.success")
			@include("hact.messages.error_list")
		</div>
	</div>
	<div class="row">
		<div class="large-12 medium-12 small-12 columns">
			<div class="custom-panel-heading">
				<span>Dispense Item</span>
				<a href="{{ route('item_list') }}" class="alert tiny button right" title="Cancel Checkup"><i class="fi fi-x"></i> Cancel</a>
			</div>
			<div class="custom-panel-details">
				<form method="get" action="{{ $action }}">
					<div class="row">
						<div class="large-6 columns">
							<label for="medication_name">Name of Medication:</label>
							<input type="text" id="item_search" name="search_item" placeholder="Search Medication" value="{{ $search_item }}" />
							<input type="hidden" id="item_id" name="item_id" value="{{ $item_id }}" />
							<input type="hidden" id="search_item_url" name="search_item_url" value="{{ route('search_item') }}" />
						</div>
					</div>
					<div class="large-6 columns">
						<label>Quantity:</label>
						<input type="number" id="quantity" name="quantity" placeholder="Quantity" value="{{ $quantity }}">
					</div>
					<div class="row">
						<div class="medium-12 columns">
							<div class="right">
								{!! csrf_field() !!}
								<button class="button success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
								<a href="{{ route('item_list') }}" class="button alert" title="Cancel"><i class="fi fi-x"></i> Cancel</a>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<fieldset>
				<legend>Dispense Item</legend>

			</fieldset>
		</div>	
	</div>


			

@endsection
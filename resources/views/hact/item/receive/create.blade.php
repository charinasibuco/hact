@extends("hact.layouts.layout_admin")
@section("content")
	<div class="row">
		<div class="large-12 columns">
			<fieldset>
				<legend>Receive Item</legend>
				@include("hact.messages.success")
				@include("hact.messages.error_list")
				<form method="get" action="{{ $action }}">
					<div class="row">
						<div class="large-6 columns">
							<label for="medication_name">Name of Medication:</label>
							<input type="text" id="item_search" name="search_item" placeholder="Search Medication" value="{{ $search_item }}" />
                            <input type="hidden" id="item_id" name="item_id" value="{{ $item_id }}" />
                            <input type="hidden" id="search_item_url" name="search_item_url" value="{{ route('search_item') }}" />
						</div>
						<div class="large-6 columns">
							<label>Quantity:</label>
							<input type="number" id="quantity" name="quantity" placeholder="Quantity" value="{{ $quantity }}">
						</div>
					</div>
					<div class="row">	
						<div class="large-12 columns">
							<button type="submit" class="button small alert">Save</button>
				    		<a class="button small info" href="{{ route('item_list') }}"><strong>Back</strong></a>
							{!! csrf_field() !!}
						</div>
					</div>
				</form>
			</fieldset>
		</div>	
	</div>


			

@endsection
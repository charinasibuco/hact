@extends("hact.layouts.layout_admin")

@section("content")

    <div class='row'>
        <div class='large-12 columns'>
            <ul class="breadcrumbs">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('medicine') }}">Pharmacy</a></li>
                <li class="current"><a href="#">Restock Medicine</a></li>
            </ul>
        </div>
    </div>
	<div class="row">
		<div class="large-12 column">
			@include("hact.messages.success")
			@if(count($errors) > 0)
				<div class="alert-box alert ">Error: Highlight fields are required!</div>
				@include("hact.messages.other_error")
			@endif
			{{--@include("hact.messages.error_list")--}}
		</div>
	</div>
	<div class="row">
		<div class="large-12 medium-12 small-12 columns">
			<div class="custom-panel-heading">
				<span>Stocking Medicine</span>
				<a href="{{ route('medicine') }}" class="alert tiny button right" title="Cancel Checkup"><i class="fi fi-x"></i> Cancel</a>
			</div>
			<div class="custom-panel-details">
				<form method="post" action="{{ route('medicine_saverestock') }}">
					<fieldset>
						<div class="row">
							<div class="large-12 columns">
								<label>Drug Description and Formulation:</label>
								<select name="medicine_id" class="{{ ($errors->has('medicine_id')) ? 'highlight_error' : '' }}">
									<option value="">Select</option>
									@foreach($medicines as $medicine)
										<option value="{{ $medicine->id }}" {{ ($medicine->id == $medicine_id) ? 'selected="selected"':'' }}>{{ $medicine->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="row">
							<div class="large-6 columns">
								<label>LOT Number:</label>
								<input type="text" id="lot_number" name="lot_number" placeholder="LOT Number" value="{{ $lot_number }}" class="{{ ($errors->has('lot_number')) ? 'highlight_error' : '' }}">
							</div>

							<div class="large-6 columns">
								<label>Tablets per bottle:</label>
								<input type="text" id="tabs_per_bottle" name="tabs_per_bottle" placeholder="Quantity" value="{{ $tabs_per_bottle }}" class="{{ ($errors->has('tabs_per_bottle')) ? 'highlight_error' : '' }}">
							</div>
						</div>
						<div class="row">
							<div class="large-6 columns">
								<label>Quantity (Bottles):</label>
								<input type="text" id="quantity" name="quantity" placeholder="Quantity" value="{{ $quantity }}" class="{{ ($errors->has('quantity')) ? 'highlight_error' : '' }}">
							</div>
							<div class="large-6 columns">
								<label>Expiry Date:</label>
								<input type="text" id="expiration_date" class="fdatepicker {{ ($errors->has('expiry_date')) ? 'highlight_error' : '' }}" name="expiry_date" placeholder="MM dd,yyyy" value="{{ $expiry_date }}" readonly>
							</div>
						</div>

					</fieldset>
					<br>
					<div class="row">
						<div class="medium-12 columns">
							<div class="right">
								{!! csrf_field() !!}
								<button class="button success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
								<a href="{{ route('medicine') }}" class="button alert" title="Cancel"><i class="fi fi-x"></i> Cancel</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


@endsection
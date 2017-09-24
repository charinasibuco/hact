@extends("hact.layouts.layout_admin")

@section("content")

    <div class='row'>
        <div class='large-12 columns'>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('item_list') }}">Pharmacy</a></li>
                <li class="current"><a href="#">New Medicine</a></li>
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
				<span>{{ $page }} VCT</span>
				<a href="{{ route('patient_profile',$patient_id) }}" class="alert tiny button right" title="Cancel Checkup"><i class="fi fi-x"></i> Cancel</a>
			</div>
			<div class="custom-panel-details">
				<form method="post" action="{{ $action }}">
					<fieldset>
						<legend>Medicine</legend>
						<div class="row">
							<div class="large-7 columns">
								<label>Drug Description and Formulation:</label>
								<input type="text" id="item_name" name="item_name" placeholder="Drug Description and Formulation" value="{{ $item_name }}" required>
							</div>
							<div class="large-5 columns">
								<label>Suggested Dosage:</label>
								<input type="text" id="suggested_dosage" name="suggested_dosage" placeholder="Suggested Dosage" value="{{ $suggested_dosage }}" required>
							</div>
						</div>
						<div class="row">
							<div class="large-6 columns">
								<label>Code:</label>
								<input type="text" id="item_code" name="item_code" placeholder="Item Code" value="{{ $item_code }}" required>
							</div>
							<div class="large-6 columns">
								<label>LOT Number:</label>
								<input type="text" id="lot_number" name="lot_number" placeholder="LOT Number" value="{{ $lot_number }}" required>
							</div>
						</div>
						<div class="row">
							<div class="large-6 columns">
								<label>Quantity per Bottle:</label>
								<input type="number" id="quantity_per_bottle" name="quantity_per_bottle" placeholder="Quantity" value="{{ $quantity_per_bottle }}" required>
							</div>
							<div class="large-6 columns">
								<label>Expiry Date:</label>
<<<<<<< HEAD
								<input type="text" id="expiration_date" class="fdatepicker" name="expiration_date" placeholder="MM dd,yyyy" value="{{ $expiration_date }}" readonly>
=======
								<input type="text" id="expiration_date" class="fdatepicker" name="expiration_date" placeholder="MM dd,yyyy" value="{{ $expiration_date }}" readonly required>
>>>>>>> 4d3467514a129de98fd162c9f69c167beeb018bf
							</div>
						</div>
						<div class="row">
							<div class="medium-12 columns">
								<div class="right">
									{!! csrf_field() !!}
									<button class="button success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
									<a href="{{ route('item_list') }}" class="button alert" title="Cancel"><i class="fi fi-x"></i> Back</a>
								</div>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
@endsection
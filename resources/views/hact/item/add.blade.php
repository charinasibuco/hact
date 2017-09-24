@extends("hact.layouts.layout_admin")

@section("content")

    <div class='row'>
        <div class='large-12 columns'>
            <ul class="breadcrumbs">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('medicine') }}">Pharmacy</a></li>
                <li class="current"><a href="#">New Medicine</a></li>
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
				<span>New Medicine</span>
				<a href="{{ route('medicine') }}" class="alert tiny button right" title="Cancel Checkup"><i class="fi fi-x"></i> Cancel</a>
			</div>
			<div class="custom-panel-details">
				<form method="post" action="{{route('medicine_store')}}">
					<fieldset>
						<div class="row">
							<div class="large-12 columns">
								<label>Drug Description and Formulation:</label>
								<input type="text" id="item_name" name="name" class="{{ ($errors->has('name')) ? 'highlight_error' : '' }}" placeholder="Drug Description and Formulation" value="{{ $name }}">
								<input type="hidden" name="classification" value="1">
							</div>
						</div>
						<div class="row">
							<div class="large-6 columns">
								<label>Code:</label>
								<input type="text" id="item_code" name="item_code" placeholder="Item Code" value="{{ $item_code }}" class="{{ ($errors->has('item_code')) ? 'highlight_error' : '' }}">
							</div>
							<div class="large-6 columns">
								<label>Suggested Dosage:</label>
								<input type="text" id="suggested_dosage" name="suggested_dosage" placeholder="Suggested Dosage" value="{{ $suggested_dosage }}" class="{{ ($errors->has('suggested_dosage')) ? 'highlight_error' : '' }}">
							</div>
							{{--<!--div class="large-6 columns">
								<label>Quantity per Bottle:</label>
								<input type="number" id="quantity" name="tabs_per_bottle" placeholder="Quantity" value="{{ $tabs_per_bottle }}">
							</div-->--}}
						</div>

					</fieldset><br>
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
	<script>
		$(function(){
			<?php
				if($classification==1)
				{
					echo "$('#arv').prop('selected', true);";
				}
				elseif($classification==2)
				{
					echo "$('#oi').prop('selected', true);";
				}
				else
				{
					echo "$('#none').prop('selected', true);";
				}
			?>
		});
	</script>

@endsection
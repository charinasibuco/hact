@extends('hact.layouts.layout_admin')

@section('content')

<div class='row'>
	<div class='large-12 columns'>
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="#">ART (Anti-Retroviral Regimen)</a></li>
			<li><a href="{{ route('arv') }}">Prescription</a></li>
			<li><a href="{{ route('prescription_history', $patient_id) }}">History</a></li>
			<li class="current"><a href="#">Form</a></li>
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
			<span>Doctor Prescription</span>
			<a href="{{ route('prescription_history', $patient_id) }}" class="alert tiny button right" title="Cancel Checkup"><i class="fi fi-x"></i> Cancel</a>
		</div>
		<div class="custom-panel-details">
			<form action="{{ $action }}" method="post">
					<div class="row">
						<div class="large-4 columns">
							<label for="search_vct">Patient</label>
							<div class="row collapse">
								<div class="small-10 columns">
									<input type="text" id="search_vct" name="search_vct" value="{{ $search_vct }}" readonly />
									<input type="hidden" id="patient_id" name="patient_id" value="{{ $patient_id }}" />
									<input type="hidden" id="search_vct_url" name="search_vct_url" value="{{ route('vct_search') }}" />
								</div>
								<div class="small-2 columns">
									<span class="postfix"><i class="fa fa-search"></i></span>
								</div>
							</div>
						</div>
						<div class="large-4 columns">
							<label for="search_item">Medicine</label>
							<select id="medicine_inventory_id" name="medicine_inventory_id">
								<option value="" selected disabled>Select Medicine</option>
								@foreach($items as $item)
									@foreach($item->MedicineInventory as $row)
										@if($row->current_medicine_stock > 0)
											<option @if($medicine_inventory_id==$item->id.'_'.$row->id) selected @endif value="{{ $item->id.'_'.$row->id }}">{{ $item->Medicine->name }}{{ '(#'.$row->current_medicine_stock.')('.$row->lot_number . ' )' }}</option>
										@else
											<option value="{{ $item->id.'_'.$row->id }}" disabled>No Stock - {{ $item->Medicine->name }}{{ '(#'.$row->current_medicine_stock.')('.$row->lot_number . ' )' }}</option>
										@endif
									@endforeach
								@endforeach
							</select>
						</div>
						<div class="large-4 columns">&nbsp;</div>
					</div>
					<div class="row">
						<div class="large-4 columns">
							<label for="pills_dispense">No. of bottle/s dispense</label>
							<input type="number" id="pills_dispense" name="pills_dispense" value="{{ $pills_dispense }}" required />
						</div>
						<div class="large-4 columns">
							<label for="date_dispense">Date Dispensed</label>
							<input type="text" id="date_dispense" name="date_dispense" value="{{ $date_dispense }}" class="fdatepicker" readonly required />
						</div>
						<div class="large-4 columns">&nbsp;</div>
					</div>
					<div class="row">
						<div class="large-4 columns">
							<label for="pills_missed_in_30_days">Pills Missed in 30 Days</label>
							<input type="number" id="pills_missed_in_30_days" name="pills_missed_in_30_days" value="{{ $pills_missed_in_30_days }}" required />
						</div>
						<div class="large-4 columns">
							<label for="pills_left">Pills Left</label>
							<input type="number" id="pills_left" name="pills_left" value="{{ $pills_left }}" />
						</div>
						<div class="large-4 columns">&nbsp;</div>
					</div>
				<br/>
				<div class="row">
					<div class="medium-12 columns">
						<div class="right">
							{!! csrf_field() !!}
							<button class="button success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
							<a href="{{ route('prescription_history', $patient_id) }}" class="button alert" title="Cancel"><i class="fi fi-x"></i> Cancel</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

<?php

/*foreach ($prescription as $row)
{
	echo '$("#arv_item_id option[value=\'' . $row->arv_item_id . '\']").remove();';
}*/

?>

//	scripts
$(function(){
	$('#reason').change(function(){

		var value = $(this).val();

		if(value == 6 || value == 7)
		{
			$('#reason_specify').attr('readonly', false);
		}
		else
		{
			$('#reason_specify').attr('readonly', true);
		}

	});
});
</script>

@endsection

@extends("hact.layouts.print_layout")

@section("content")
<br/>
<input id="print" type="button" value="Print">
<script>
	$('#print').click(function(){
		$(this).hide();
		window.print();
		$(this).show();
	});
</script>
<br/>
<br/>
<div class="row">
	<div class="large-12 column">
		<h5>{{ $search_item }} report based on dispensed medicine</h5>
		<strong>{{ $from }} - {{ $to }}</strong>
	</div>
</div>

<br />
<div class="row">
	<div class="large-12 column">
		<table width="100%">
			<tbody>
				<tr>
					<th width="15%"><a href="#">Patient</a></th>
					<th width="30%"><a href="#">Medicine</a></th>
					<th width="15%"><a href="#">Lot Number</a></th>
					<th width="10%"><a href="#">No. of Bottles</a></th>
					<th width="15%"><a href="#">Date Dispensed</a></th>
					<th width="15%"><a href="#">Issued By</a></th>
				</tr>
			</tbody>
			<tbody>
			@foreach($prescription as $row)
			<?php
			$inventory = App\MedicineInventory::where('id', $row->medicine_inventory_id)->first();
			$medicine = App\MedicineModel::where('id', $inventory->medicine_id)->first();
			?>
				<tr>
					<td>{{ $row->Patient->code_name }}</td>
					<td>{{ $medicine->name }}</td>
					<td>{{ $inventory->lot_number }}</td>
					<td class="text-center">{{ $row->pills_dispense }}</td>
					<td>{{ $row->date_dispense->format('m/d/Y') }}</td>
					<td>{{ $row->User->name }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection
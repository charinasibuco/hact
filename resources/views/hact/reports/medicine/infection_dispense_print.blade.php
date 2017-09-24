
@extends("hact.layouts.print_layout")

@section("content")

<div class="row">
	<div class="large-12 column">
		<h5>{{ $infection_format }} report based on dispense medicine</h5>
		<strong>{{ $from }} - {{ $to }}</strong>
	</div>
</div>

<br />
<div class="row">
	<div class="large-12 column">
		<table width="100%">
			<tbody>
				<tr>
					<th width="55%"><a href="#">Medicines</a></th>
					<th width="10%"><a href="#">No. of Pills</a></th>
					<th width="15%"><a href="#">Date Dispense</a></th>
					<th width="20%"><a href="#">Issued By</a></th>
				</tr>
			</tbody>
			<tbody>
			@foreach($prescription as $row)
				<tr>
					<td>
						@if($row->ARVItems->specified_medicine == '')
							{{ $row->ARVItems->Medicine->name }}
						@else
							{{ $row->ARVItems->specified_medicine }}
						@endif
					</td>
					<td class="text-center">{{ $row->pills_dispense }}</td>
					<td>{{ $row->date_dispense_format2 }}</td>
					<td>{{ $row->User->name }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection

@extends("hact.layouts.print_layout")

@section("content")

<div class="row">
	<div class="large-12 column">
		<h5>{{ $patient_name }} report based on prescribe medicine/s</h5>
		<strong>{{ $from }} - {{ $to }}</strong>
	</div>
</div>

<br />
<div class="row">
	<div class="large-12 column">
		<table width="100%">
			<tbody>
				<tr>
					<th width="15%"><a href="#">Infections</a></th>
					<th width="40%"><a href="#">Medicines</a></th>
					<th width="10%" class="text-center"><a href="#">Pills/Day</a></th>
					<th width="15%" class="text-center"><a href="#">Pills miss in 30 days</a></th>
					<th width="20%" class="text-center"><a href="#">Pills Left</a></th>
				</tr>
			</tbody>
			<tbody>
			@foreach($arv_items as $row)
				<tr>
					<td>{{ $row->infection_format }}</td>
					<td>
						@if($row->specified_medicine == '')
							{{ $row->Medicine->name }}
						@else
							{{ $row->specified_medicine }}
						@endif
					</td>
					<td class="text-center">{{ $row->pills_per_day }}</td>
					<td class="text-center">{{ $row->pills_missed_in_30_days }}</td>
					<td class="text-center">{{ $row->pills_left }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection
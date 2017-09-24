
@extends("hact.layouts.print_layout")

@section("content")
<br/>
<div class="row">
	<div class="large-3 column">
		<strong>VCT Schedules</strong>
	</div>
	<div class="large-9 column">
		<strong>{{ $from }} - {{ $to }}</strong>
	</div>
</div>

<br />
<div class="row">
	<div class="large-12 column">
		<table width="100%">
			<thead>
				<th width="10%">Code Name</th>
				<th width="5%">Age</th>
				<th width="5%">Sex</th>
				<th width="15%">SACCL</th>
				<th width="15%">UIC</th>
				<th width="15%">Last VCT</th>
				<th width="15%">Next VCT</th>
			</thead>
			<tbody>
			@foreach($vct as $row)

				@if($row->total_vct_record == 1)
					<!-- 2nd Visit -->
					<?php $next_vct = date('Y-m-d', strtotime("+90 days", strtotime($row->last_vct_record->vct_date))); ?>
					@if($next_vct >= date('Y-m-01', strtotime($from)) && $next_vct <= date('Y-m-t', strtotime($to)))
						<tr>
							<td>{{ $row->Patient->code_name }}</td>
							<td>{{ $row->Patient->age }}</td>
							<td>{{ $row->Patient->gender_format }}</td>
							<td>{{ $row->Patient->saccl_code }}</td>
							<td>{{ $row->Patient->ui_code }}</td>
							<td>{{ $row->last_vct_record->vct_date }}</td>
							<td>{{ $next_vct }}</td>
						</tr>
					@endif
				@else
					<!-- 3rd Visit and so on -->
					<?php $next_vct = date('Y-m-d', strtotime("+180 days", strtotime($row->last_vct_record->vct_date))); ?>
					@if($next_vct >= date('Y-m-01', strtotime($from)) && $next_vct <= date('Y-m-t', strtotime($to)))
						<tr>
							<td>{{ $row->Patient->ui_code }}</td>
							<td>{{ $row->Patient->code_name }}</td>
							<td>{{ $row->Patient->nationality }}</td>
							<td>{{ $row->Patient->gender_format }}</td>
							<td>{{ $row->last_vct_record->vct_date }}</td>
							<td>{{ $next_vct }}</td>
						</tr>
					@endif
				@endif
			@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection
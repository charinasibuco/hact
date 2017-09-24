@extends('hact.layouts.layout_admin')

@section('content')

<div class="row">
	<div class="large-12 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('arv') }}">ART (Anti-Retroviral Regimen)</a></li>
			<li class="current"><a href="#">{{ $patient->code_name }} - Records</a></li>
		</ul>
	</div>
</div>

<div class='row'>
	<div class='large-12 columns'>
		@include('hact.messages.success')
		@include('hact.messages.error_list')
		
		{!! str_replace('/?', '?', $arv->render()) !!}
		<table width="100%">
			<thead>
				<tr>
					<th width="25%"><a href="#">Medicine</a></th>
					<th width="12%" class="text-center"><a href="#" title="No. of Pills per day">Pills/day</a></th>
					<th width="12%" class="text-center"><a href="#" title="No. of pills missed in past 30 days">Pills Missed</a></th>
					<th width="12%" class="text-center"><a href="#" title="No. of pills left">Pills left</a></th>
					<th width="17%"><a href="#">Date discontinued</a></th>
					<th width="18%"><a href="#">Reason</a></th>
				</tr>
			</thead>
			<tbody>
				@foreach($arv as $row)
					<tr>
						<td>{{ $row->Medicine->name }}</td>
						<td class="text-center">{{ $row->pills_per_day }}</td>
						<td class="text-center">{{ $row->pills_missed_in_30_days }} Bot.</td>
						<td class="text-center">{{ $row->pills_left }}</td>
						<td>{{ $row->date_discontinued_format1 }}</td>
						<td>{{ $row->reason_format }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{!! str_replace('/?', '?', $arv->render()) !!}
	</div>
</div>

@endsection
@extends('hact.layouts.layout_admin')

@section('content')

<div class="row">
	<div class="large-12 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="#">ART (Anti-Retroviral Regimen)</a></li>
			<li><a href="{{ route('arv') }}">Prescription</a></li>
			<li class="current"><a href="#">Dispense ( {{ $patient->code_name }} )</a></li>
		</ul>
	</div>
</div>

<div class='row'>
	<div class='large-12 columns'>
		@include('hact.messages.success')
		@include('hact.messages.error_list')
		
		<table width="100%">
			<thead>
				<tr>
					<th width="10%"></th>
					<th width="50%"><a href="#">Medicines</a></th>
					<th width="20%"><a href="#">Doctor</a></th>
					<th width="20%"><a href="#">Date Issued</a></th>
				</tr>
			</thead>
			<tbody>
				@foreach($arv as $row)
					<tr>
						<td>
							<a href="{{ route('prescription_create', $row->id) }}" title="Dispense"><i class="fa fa-lg fa-download"></i></a>
							<a href="{{ route('prescription_details', $row->id) }}" title="Dispense Details"><i class="fa fa-lg fa-file-text-o"></i></a>
						</td>
						<td>
							@foreach($row->ARVItems as $item)
								@if($item->specified_medicine == '')
									{{ $item->Medicine->name }} ( {{ $item->infection_format }} )
								@else
									{{ $item->specified_medicine }} ( {{ $item->infection_format }} )
								@endif
								<br />
							@endforeach
						</td>
						<td>{{ $row->User->name }}</td>
						<td>{{ $row->Checkup->Checkup->checkup_date->format('d/m/Y') }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection
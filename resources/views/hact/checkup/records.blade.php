@extends('hact.layouts.layout_admin')

@section('content')

<div class="row">
	<div class="large-7 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('patient') }}">Patient</a></li>
			<li class="current"><a href="#">Checkup</a></li>
			<li class="current"><a href="#">{{ $patient->code_name }}</a></li>
		</ul>
	</div>
	<div class="large-5 columns">
		<form>
			<div class="row">
				<div class="large-12 columns">
					<div class="row collapse">
						<div class="small-9 columns">
							<input name="search" type="text" placeholder="Search" value="">
						</div>
				    	<div class="small-3 columns">
				      		<button type="submit" class="button alert postfix"><i class="fa fa-search"></i></buatton>
				    	</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<div class='row'>
	<div class='large-12 columns'>
		@include('hact.messages.success')
		@include('hact.messages.error_list')

		<table width="100%">
			<tr>
				<th width="10%"><a href="{{ route('checkup_create', $id) }}"><i class="fa fa-lg fa-plus"></i></a></th>
				<th width="20%"><a href="#">Date</a></th>
				<th width="20%"><a href="#">Follow up Date</a></th>
				<th width="20%"><a href="#">Clinical Stage</a></th>
				<th width="30%"><a href="#">In Charge</a></th>
			</tr>

				@foreach($checkups as $row)
					<tr>
						<td>
							<a href="{{ route('checkup_edit', $row->id) }}" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
							<a href="{{ route('checkup_show', $row->id) }}" target="_blank" title="Show Full Form"><i class="fa fa-file-text fa-lg"></i></a>
							<!-- <a href="{{ route('checkup_show', $row->id) }}" title="Show Check Up Form"><i class="fa fa-newspaper-o fa-lg"></i></a> -->
						</td>

						<td>{{ $row->checkup_date_format }}</td>
						<td>{{ $row->follow_up_date_format }}</td>
						<td>{{ $clinical_stage }}</td>
						<td>{{ (isset($incharge)? $incharge : '') }}</td>
					</tr>
				@endforeach

		</table>
	</div>
</div>

@endsection

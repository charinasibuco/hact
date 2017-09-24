@extends('hact.layouts.layout_admin')
<div class="row sticky-search">
	<form>
		<div class="row collapse">
			<div class="small-9 columns">
				<input name="search" type="text" placeholder="Search" value="{{ $search }}">
			</div>
			<div class="small-3 columns">
				<button type="submit" class="button alert postfix"><i class="fa fa-search"></i></button>
			</div>
		</div>
	</form>
</div>
@section('content')

<div class="row">
	<div class="large-7 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('lab_requests') }}">Consultation Laboratory Requests</a></li>
		</ul>
	</div>
	<div class="large-5 columns">
		<form>
			<div class="row search-bar">
				<div class="large-12 columns">
					<div class="row collapse">
						<div class="small-9 columns">
							<input name="search" type="text" placeholder="Search" value="{{ $search }}">
						</div>
				    	<div class="small-3 columns">
				      		<button type="submit" class="button alert postfix"><i class="fa fa-search"></i></button>
				    	</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="row overflow">
	<div class="large-12 columns overflow-profile">
		@include('hact.messages.success')
		@include('hact.messages.error_list')

		{!! str_replace('/?', '?', $lab_requests->appends($pagination)->render()) !!}
		<table class="responsive" width="100%">
			<thead>
				<tr>
					<td colspan="6">
						<a href="{{ route('lab_requests', 'incomplete') }}" class="button small active inactive-tab{{ ($status=='incomplete')?'active-tab' : '' }}"><i class="fa fa-times fa-lg"></i> Incomplete Lab Request</a>
						<a href="{{ route('lab_requests', 'complete') }}" class="button small inactive-tab{{ ($status=='complete')?'active-tab' : '' }}"><i class="fa fa-check fa-lg"></i> Completed Lab Request</a>
						<a href="{{ route('lab_requests', 'all') }}" class="button small inactive-tab{{ ($status=='all')?'active-tab' : '' }}"> All Lab Request</a>
					</td>
				</tr>
				<tr>
					<th width="5%"><a href="{{ $status }}">Status</a></th>
					<th class="main-column" width="20%"><a href="{{ $patient_sort }}">Patient</a></th>
					<th width="15%"><a href="{{ $lab_request }}">Lab Request</a></th>
					<th width="15%"><a href="{{ $checkup_date }}">Consultation Date</a></th>
					<th width="15%"><a href="{{ $follow_up_date }}">Follow-up Date</a></th>
					<th width="30%"><a href="{{ $remarks }}">Remarks</a></th>
				</tr>
			</thead>
			<tbody>
				@foreach($lab_requests as $row)
					@if($row->Checkup)
						<tr>
							<td>
								@if($row->status == 1)
									<a class="incomplete" href="{{ route('lab_requests_incomplete',[$row->id, 1]) }}" title="Set as Incomplete"><i class="fa fa-check fa-lg"></i></a>
								@else
									<a class="complete" href="{{ route('lab_requests_complete',[$row->id, 1]) }}" title="Set as Complete"><i class="fa fa-times fa-lg"></i></a>
								@endif
							</td>
							<td>{{ $row->Checkup->Patient->code_name }}</td>
							<td>{{ $row->LaboratoryTest->description or $row->other_specify }}</td>
							<td>{{ $row->Checkup->checkup_date->format('m/d/Y') }}</td>
							<td>{{ $row->Checkup->follow_up_date->format('m/d/Y') }}</td>
							<td><a href="#" data-reveal-id="myModal{{ $row->id }}"><i class="fa fa-lg fa-pencil-square-o"></i> Edit</a>
								<pre>{{ $row->remarks or "" }}</pre>
							</td>
							<div id="myModal{{ $row->id }}" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
								<h5 id="modalTitle">Laboratory Request Remarks</h5>
								<form method="post" action="{{ route('lab_requests_remarks',$row->id) }}">
									<textarea name="remarks" rows=2 id="remarks">{{ $row->remarks or "" }}</textarea>
									{!! csrf_field() !!}
									<button type="submit" class="btn">Submit</button>
								</form>
								<a class="close-reveal-modal" aria-label="Close">&#215;</a>
							</div>
						</tr>
					@endif
				@endforeach
			</tbody>
		</table>
		{!! str_replace('/?', '?', $lab_requests->appends($pagination)->render()) !!}

	</div>
</div>
@endsection
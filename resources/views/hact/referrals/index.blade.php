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
<script>
	$(function(){
		$('.not_referred').css('font-style','italic');
		$('.not_referred').css('color','#C0C0C0');
	});
</script>
<div class="row">
	<div class="large-7 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('referrals') }}">Referrals</a></li>
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

<div class="row">
	<div class="large-12 columns">
		@include('hact.messages.success')
		@include('hact.messages.error_list')

		{!! str_replace('/?', '?', $referrals->appends($pagination)->render()) !!}
		<table class="responsive" width="100%">
			<thead>
				<tr>
					<th class="main-column" width="10%"><a href="{{ $patient_sort }}">Patient</a></th>
					<th width="20%"><a href="{{ $reason_sort }}">Reason</a></th>
					<th width="5%"><a href="{{ $surgeon_sort }}">Surgery</a></th>
					<th width="5%"><a href="{{ $ob_gyne_sort }}">OB-Gyne</a></th>
					<th width="5%"><a href="{{ $opthamology_sort }}">Opthal</a></th>
					<th width="5%"><a href="{{ $dentis_sort }}">Dentist</a></th>
					<th width="5%"><a href="{{ $psychiatrist_sort }}">Psych</a></th>
					<th width="5%"><a href="{{ $others_sort }}">Others</a></th>
					<th width="20%"><a href="{{ $checkup_date }}">Consultation Date</a></th>
					<th width="20%"><a href="{{ $follow_up_date }}">Follow-up Date</a></th>
				</tr>
			</thead>
			<tbody>
			@foreach($referrals as $row)
				<tr>
					<td>{{ $row->Checkup->Patient->code_name }}</td>
					<td>{{ $row->reason }}</td>
					<td>
						@if($row->surgeon == 2)
							<a class="incomplete" href="{{ route('referrals_incomplete',[$row->id, 1, 1]) }}" title="Set as Incomplete"><i class="fa fa-check fa-lg"></i></a>
						@elseif($row->surgeon == 1)
							<a class="complete" href="{{ route('referrals_complete',[$row->id, 1, 1]) }}" title="Set as Complete"><i class="fa fa-times fa-lg"></i></a>
						@else
							<center><span class='not_referred'>Not Referred</span></center>
						@endif
					</td>
					<td>
						@if($row->ob_gyne == 2)
							<a class="incomplete" href="{{ route('referrals_incomplete',[$row->id, 2, 1]) }}" title="Set as Incomplete"><i class="fa fa-check fa-lg"></i></a>
						@elseif($row->ob_gyne == 1)
							<a class="complete" href="{{ route('referrals_complete',[$row->id, 2, 1]) }}" title="Set as Complete"><i class="fa fa-times fa-lg"></i></a>
						@else
							<center><span class='not_referred'>Not Referred</span></center>
						@endif
					</td>
					<td>
						@if($row->ophtamology == 2)
							<a class="incomplete" href="{{ route('referrals_incomplete',[$row->id, 3, 1]) }}" title="Set as Incomplete"><i class="fa fa-check fa-lg"></i></a>
						@elseif($row->ophtamology == 1)
							<a class="complete" href="{{ route('referrals_complete',[$row->id, 3, 1]) }}" title="Set as Complete"><i class="fa fa-times fa-lg"></i></a>
						@else
							<center><span class='not_referred'>Not Referred</span></center>
						@endif
					</td>
					<td>
						@if($row->dentis == 2)
							<a class="incomplete" href="{{ route('referrals_incomplete',[$row->id, 4, 1]) }}" title="Set as Incomplete"><i class="fa fa-check fa-lg"></i></a>
						@elseif($row->dentis == 1)
							<a class="complete" href="{{ route('referrals_complete',[$row->id, 4, 1]) }}" title="Set as Complete"><i class="fa fa-times fa-lg"></i></a>
						@else
							<center><span class='not_referred'>Not Referred</span></center>
						@endif
					</td>
					<td>
						@if($row->psychiatrist == 2)
							<a class="incomplete" href="{{ route('referrals_incomplete',[$row->id, 5, 1]) }}" title="Set as Incomplete"><i class="fa fa-check fa-lg"></i></a>
						@elseif($row->psychiatrist == 1)
							<a class="complete" href="{{ route('referrals_complete',[$row->id, 5, 1]) }}" title="Set as Complete"><i class="fa fa-times fa-lg"></i></a>
						@else
							<center><span class='not_referred'>Not Referred</span></center>
						@endif
					</td>
					<td>
						@if($row->others_status == 2)
							<a class="incomplete" href="{{ route('referrals_incomplete',[$row->id, 6, 1]) }}" title="Set as Incomplete"><i class="fa fa-check fa-lg"></i></a>
							{{ $row->others }}
						@elseif($row->others_status == 1 || $row->others != '')
							<a class="complete" href="{{ route('referrals_complete',[$row->id, 6, 1]) }}" title="Set as Complete"><i class="fa fa-times fa-lg"></i></a>
							{{ $row->others }}
						@else
							<center><span class='not_referred'>Not Referred</span></center>
						@endif
					</td>
					<td>{{ $row->Checkup->checkup_date->format('m/d/Y') }}</td>
					<td>{{ $row->Checkup->follow_up_date->format('m/d/Y') }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		{!! str_replace('/?', '?', $referrals->appends($pagination)->render()) !!}
	</div>
</div>
@endsection
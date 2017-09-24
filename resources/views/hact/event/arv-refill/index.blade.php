@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-7 columns'>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Home</a></li>
				<li class="current"><a href="#">Voluntary Counseling Testing</a></li>
			</ul>
		</div>
		<div class='large-5 columns'>
			<form>
				<div class="row">
					<div class="large-12 columns">
						<div class="row collapse">
							<div class="small-9 columns">
								<input name="search" type="text" placeholder="Search" value="{{ $search }}">
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
				<thead>
				<tr>
					<th width="5%"></th>	
					<th width="20%"><a href="#">UI Code</a></th>
					<th width="20%"><a href="#">Code Name</a></th>
					<th width="20%"><a href="#">SACCL Code</a></th>
					<th width="35%"><a href="#">Name</a></th>
				</tr>
				</thead>
				<tbody>
				@foreach($patients as $patient)
				<tr>
					<td>
						<a href="{{ route('vct_edit',$patient->id) }}" title="Edit VCT Record"><i class="fa fa-edit"></i></a>
					</td>
					<td>{{ $patient->EnrolmentDemographics->ui_code }}</td>
					<td>{{ $patient->EnrolmentDemographics->code_name }}</td>
					<td>{{ $patient->EnrolmentDemographics->saccl_code }}</td>
					<td>{{ $patient->EnrolmentDemographics->full_name2 }}</td>
				</tr>
				@endforeach	
				</tbody>
			</table>
		</div>
	</div>

@endsection
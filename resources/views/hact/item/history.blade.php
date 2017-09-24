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
				<li><a href="{{ route('medicine') }}">Pharmacy</a></li>
				<li class="current"><a href="#">Restocking History ( {{ $medicine->name}} - {{ $medicine->classification_format }} )</a></li>
			</ul>
		</div>
		<div class="large-5 columns">
			<!-- <form method="get" action="{{ route('medicine_search') }}"> -->
			<form>
				<div class="row search-bar">
					<div class="large-12 columns">
						<div class="row collapse">
							<div class="small-9 columns">
								<input name="search" type="text" placeholder="Search" value="">
							</div>
					    	<div class="small-3 columns">
					      		<button type="submit" class="button alert postfix"><i class="fa fa-search"></i></button>
					    	</div>
                            {!! csrf_field() !!}
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			<a href="{{ route('medicine') }}" class="button alert small" title="Cancel"><i class="fi fi-x"></i> Cancel</a>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			{!! str_replace('/?', '?', $medicines->render()) !!}
			<table class="responsive" width="100%">
			  <thead>
			    <tr>
			      <th class="main-column" width="20%"><a href="#">Lot Number</a></th>
			      <th width="15%" class="text-center"><a href="#">Tabs/Bot.</a></th>
			      <th width="15%" class="text-center"><a href="#">Quantity</a></th>
			      <th width="10%" class="text-center"><a href="#">Balance</a></th>
			      <th width="20%"><a href="#">Expiry Date</a></th>
			      <th width="20%"><a href="#">Create At</a></th>
			    </tr>
			  </thead>
			  <tbody>
              @foreach($medicines as $row)
                <tr>
                    <td class="main-column">{{ $row->lot_number }}</td>
                    <td class="text-center">{{ $row->tabs_per_bottle }}</td>
                    <td class="text-center">{{ $row->quantity }}</td>
                    <td class="text-center">{{ $row->current_medicine_stock }}</td>
                    <td>{{ $row->expiry_date->format('m/d/Y') }}</td>
                    <td>{{ $row->created_at->format('m/d/Y') }}</td>
                </tr>
              @endforeach
			  </tbody>
			</table>
			{!! str_replace('/?', '?', $medicines->render()) !!}
		</div>
	</div>

@endsection
@extends('hact.layouts.layout_admin')

@section('content')

    <div class='row'>
        <div class='large-12 columns'>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('item_list') }}">Pharmacy</a></li>
                <li class="current"><a href="#">Dispense or Stock Out Medicine</a></li>
            </ul>
        </div>
    </div>

	<div class="row">
		<div class="large-2 columns">&nbsp;</div>
		<div class="large-8 columns">
			@include("hact.messages.success")
			@include("hact.messages.error_list")
			<div class="panel">
				<form method="get" action="{{ $action }}">
					<fieldset>
						<legend>Dispense/Stock Out Medicine</legend>
		                <div class="row">
		                    <div class="large-12 columns">
		                        <div class="row collapse">
		                            <div class="small-10 columns">
		                                <input type="text" id="search_patient" name="search_patient" placeholder="Search Patient" value="{{ $search_patient }}">
		                            	<input type="hidden" id="demographics_id" name="demographics_id" value="{{ $demographics_id }}" />
		                                <input type="hidden" id="search_patient_url" name="search_patient_url" value="{{ route('search_demographics_patient') }}" />
		                            </div>
		                            <div class="small-2 columns">
		                                <span class="postfix"><i class="fa fa-search"></i></span>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                <div class="row">
		                    <div class="large-12 columns">
								<label for="item_search">Search Medicine or Lot Number:</label>
		                        <div class="row collapse">
		                            <div class="small-10 columns">
		                                <input type="text" id="item_search" name="search_item" placeholder="Search Medicine Name or Lot Number" value="{{ $search_item }}" />
                        				<input type="hidden" id="item_id" name="item_id" value="{{ $item_id }}" />
                        				<input type="hidden" id="search_item_url" name="search_item_url" value="{{ route('search_item') }}" />
		                            </div>
		                            <div class="small-2 columns">
		                                <span class="postfix"><i class="fa fa-search"></i></span>
		                            </div>
		                        </div>
		                    </div>
		                </div>
						<div class="row">
							<div class="large-6 columns">
								<label for="quantity">Quantity:</label>
								<input type="number" id="quantity" name="quantity" placeholder="Quantity" value="{{ $quantity }}">
							</div>
							<div class="large-6 columns">&nbsp;</div>
						</div>
						<div class="row">	
							<div class="large-12 columns">
								<button type="submit" class="button small alert">Save</button>
					    		<a class="button small info" href="{{ route('item_list') }}"><strong>Back</strong></a>
								{!! csrf_field() !!}
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		<div class="large-2 columns">&nbsp;</div>
	</div>

	<div class='row'>
		<div class='large-12 columns'>
			{!! str_replace('/?', '?', $item_dispenses->appends($pagination)->render()) !!}
			<table width="100%">
				<thead>
					<tr>
						<th width="20%">Item Code</th>
						<th width="25%">Item Name</th>
						<th width="25%">Lot Number</th>
						<th width="10%">Quantity</th>
						<!-- <th>User Name</th> -->
						<th width="20%">Transaction Date</th>
					</tr>
				</thead>
				<tbody>
				@foreach($item_dispenses as $item_dispense)
				<tr>
					<td>{{ $item_dispense->item_code }}</td>
					<td>{{ $item_dispense->item_name }}</td>
					<td>{{ $item_dispense->lot_number }}</td>
					<td>{{ $item_dispense->quantity }}</td>	
					<td>{{ $item_dispense->transaction_date }}</td>
				</tr>
				@endforeach	
				</tbody>
			</table>
			{!! str_replace('/?', '?', $item_dispenses->appends($pagination)->render()) !!}
		</div>
	</div>

@endsection
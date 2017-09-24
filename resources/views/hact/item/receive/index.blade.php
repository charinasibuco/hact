@extends('hact.layouts.layout_admin')

@section('content')

    <div class='row'>
        <div class='large-12 columns'>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('item_list') }}">Pharmacy</a></li>
                <li class="current"><a href="#">Receive or Stock In Medicine</a></li>
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
						<legend>Receive/Stock In Medicine</legend>
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
					    		<a class="button small info" href="{{ route('item_list') }}">Clear</a>
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
			{!! str_replace('/?', '?', $item_receives->appends($pagination)->render()) !!}
			<table width="100%">
				<thead>
					<tr>
						<th width="20%">Item Code</th>
						<th width="30%">Item Name</th>
						<th width="20%">Lot Number</th>
						<th width="10%" class="text-center">Quantity</th>
						<th width="20%">Transaction Date</th>
					</tr>
				</thead>
				<tbody>
				@foreach($item_receives as $item_receive)
				<tr>
					<td>{{ $item_receive->item_code }}</td>
					<td>{{ $item_receive->item_name }}</td>
					<td>{{ $item_receive->lot_number }}</td>
					<td class="text-center">{{ $item_receive->quantity }}</td>	
					<td>{{ $item_receive->transaction_date }}</td>
				</tr>
				@endforeach	
				</tbody>
			</table>
			{!! str_replace('/?', '?', $item_receives->appends($pagination)->render()) !!}
		</div>
	</div>

@endsection
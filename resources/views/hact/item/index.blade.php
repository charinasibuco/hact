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
				<li class="current"><a href="#">Pharmacy</a></li>
			</ul>
		</div>
		<div class="large-5 columns">
			<!-- <form method="get" action="{{ route('medicine_search') }}"> -->
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
                            {!! csrf_field() !!}
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<a href="{{ route('medicine_add') }}" class="button small label success" title="Add New Patient"><i class="fa fa-plus fa-lg"></i> Add Medicine</a>
			<a href="{{ route('medicine_restock') }}" class="button small label warning" title="Stock-In Medicine"><i class="fa fa-cubes fa-lg"></i>Stock-In</a>
			<br/><br/>
			<div>
				<small><i class="fa fa-square" style="color:red"></i> Critical (less than 20 bottles)</small><br>
				<small><i class="fa fa-square" style="color:orange"></i> Warning (less than 100 bottles)</small><br>
			</div>
			<table id="myTable" class="responsive tablesorter" style="width:100%">
			  <thead>
			  	<tr>
			      <th colspan="3">

				  </th>
			      <th colspan="3" style="text-align:right; font-size:10px;	"></th>
			    </tr>
			    <tr style="border-bottom:2px solid gray;">
			      <th class="main-column" width="50%"><a href="{{ $name }}">Drug Description &amp; Formulation</a></th>
			      <th width="15%"><a href="{{ $item_code }}">Item Code</a></th>
			      <th width="10%"><a href="{{ $item_code }}">Classification</a></th>
			      <th width="20%"><a href="{{ $suggested_dosage }}">Suggested Dosage</a></th>
			      <th width="5%" class="text-center"><a href="#">Balance</a></th>
			    </tr>
			  </thead>
			  <tbody>
              @foreach($medicines as $medicine)
                    <?php $current_stock = $medicine->current_stock; ?>
                    @if($current_stock <= 20)
                        <tr class="critical_medicine">
                    @elseif($current_stock <= 100)
                        <tr class="warning_medicine">
                    @else
                        <tr class="">
                    @endif
                            <td class="main-column">
                            	<a href="{{route('medicine_show', ['id' => $medicine->id])}}"><i class="fa fa-edit fa-lg"></i></a>
                            	<a href="{{route('medicine_history', ['id' => $medicine->id])}}"><i class="fa fa-list fa-lg"></i></a>
                                {{$medicine->name}}
                            </td>
                            <td>{{$medicine->item_code}}</td>
                            <td>{{$medicine->classification_format}}</td>
                            <td>{{$medicine->suggested_dosage}}</td>
                            <td class="text-center">{{ $current_stock }}</td>
                        </tr>
              @endforeach
			  </tbody>
			</table>
            {!! $medicines->render() !!}
		</div>
	</div>

@endsection
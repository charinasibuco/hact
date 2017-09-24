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
			<li class="current"><a href="#">OB-GYNE</a></li>
		</ul>
	</div>
	<div class="large-5 columns">
		<form method="get" action="{{route('ob_gyne')}}">
			<div class="row search-bar">
				<div class="large-12 columns">
					<div class="row collapse">
						<div class="small-9 columns">
							<input name="search" type="text" placeholder="Search" value="{{$search}}">
							<input type="hidden" name="order_by" value="max_delivered_date">
							<input type="hidden" name="sort" value="desc">
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
		<div class="row">
			<div class="medium-4 columns"><a href="{{ route('ob_gyne_create') }}" class="button small" title="Create New Ob-Gyne"><i class="fa fa-plus fa-lg"></i> Create New Ob-Gyne</a></div>
			<div class="medium-8 columns">{!! str_replace('/?', '?', $obgynes->appends($pagination)->render()) !!}</div>
		</div>
		<table class="responsive" width="100%">
			<thead>
				<tr>
					<th width="7%">
                        <a href="#" title="OBGYNE History" style="visibility: hidden"><i class="fa fa-list-alt fa-lg"></i></a>
                        <a href="{{ route('ob_gyne_create') }}" title="Create New OB-Gyne"><i class="fa fa-plus fa-lg"></i></a>
                    </th>
					<th width="20%"><a href="{{route('ob_gyne').'?search='.$search.'&order_by=ui_code&sort='.$sort}}">UI Code</a></th>
					<th class="main-column" width="20%"><a href="{{route('ob_gyne').'?search='.$search.'&order_by=code_name&sort='.$sort}}">Code Name</a></th>
					<th width="20%"><a href="{{route('ob_gyne').'?search='.$search.'&order_by=saccl_code&sort='.$sort}}">Saccl</a></th>
					<th width="33%"><a href="{{route('ob_gyne').'?search='.$search.'&order_by=max_delivered_date&sort='.$sort}}">Delivery Date</a></th>
				</tr>
			</thead>
			<tbody>
            @foreach($obgynes as $obgyne)
			
			<tr class="mortality">
                    <td>
                        <a href="{{route('ob_gyne_history',['id' => $obgyne->id])}}" title="OB-Gyne History"><i class="fa fa-folder-open fa-lg"></i></a>
                        <a href="{{ route('ob_gyne_patient_create',['id' => $obgyne->id]) }}" title="Create New OB-Gyne record for {{$obgyne->code_name}}"><i class="fa fa-plus fa-lg"></i></a>
                    </td>
                    <td>{{$obgyne->ui_code}}</td>
                    <td class="main-column">{{$obgyne->code_name}}</td>
                    <td>{{$obgyne->saccl_code}}</td>
                    <td>{{($obgyne->max_delivered_date != NULL) ? $obgyne->max_delivered_date:''}}</td>
                </tr>
            @endforeach

			</tbody>
		</table>
        {!! $obgynes->render() !!}
	</div>
</div>

@endsection
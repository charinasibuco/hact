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

	<div class='row'>
		<div class='large-7 columns'>
			<ul class="breadcrumbs">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li class="current"><a href="#">Activity Logs</a></li>
			</ul>
		</div>
		<div class="large-5 columns">
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
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="row">
		<div class="large-12 columns">
			{!! str_replace('/?', '?', $logs->appends([])->render()) !!}
			<table class="responsive" width="100%">
				<thead>
					<tr>
						<th class="main-column" width="20%"><a href="{{ $page_sort }}">Module</a></th>
						<th width="30%"><a href="{{ $message_sort }}">Message</a></th>
						<th width="25%"><a href="{{ $user_sort }}">User</a></th>
						<th width="25%"><a href="{{ $date_sort }}">Date & Time</a></th>
					</tr>
				</thead>
				<tbody>
					@foreach($logs as $log)
					<tr>
						<td class="main-column">{{ $log->page }}</td>
						<td>{{ $log->message }}</td>
						<td>{{ $log->User->name }}</td>
						<td>{{ $log->created_at->format('m/d/Y h:i:s a') }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{!! str_replace('/?', '?', $logs->appends([])->render()) !!}
		</div>
	</div>

@endsection
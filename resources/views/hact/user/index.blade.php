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
				<li class="current"><a href="#">Users</a></li>
			</ul>
		</div>
		<div class='large-5 columns'>
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
			{!! str_replace('/?', '?', $users->appends($pagination)->render()) !!}
			<table class="responsive" width="100%">
				<thead>
					<tr>



						<th width="5%">
							@if(Auth::user()->access == 1)<a href="{{ route('user_create') }}" title="Create New User"><i
										class="fa fa-plus fa-lg"></i></a>
							@endif
						</th>
						<th class="main-column" width="35%"><a href="{{ $name_sort }}">Name</a></th>
						<th width="30%"><a href="{{ $email_sort }}">Email</a></th>
						<th width="20%"><a href="{{ $access_sort }}">Access</a></th>
						<th width="10%"><a href="{{ $access_sort }}">Status</a></th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td><a href="{{ route('user_edit', $user->id) }}"><i class="fa fa-edit fa-lg"></i></a></td>
						<td class="main-column">{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->access_name }}</td>
						<td>{{ $user->active_format }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{!! str_replace('/?', '?', $users->appends($pagination)->render()) !!}
		</div>
	</div>

@endsection
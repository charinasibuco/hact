@extends('hact.layouts.layout_admin')

@section('content')

<div class='row'>
	<div class='large-12 columns'>
		<ul class="breadcrumbs">
			<li><a href="{{ route('user') }}">User</a></li>
			<li class="current"><a href="#">Reset Password</a></li>
		</ul>
	</div>
</div>

<div class="row">
	<div class="large-3 column">&nbsp;</div>
	<div class="large-6 column">

		@include('hact.messages.success')
		@include('hact.messages.error_list')

		<div class="panel">
			<fieldset>
				<legend>User</legend>

				<form action="{{ $action }}" method="post">

					<div class="row">
				    	<div class="large-12 columns">
							<label>Password
				        		<input name="password" id="password" value="" type="password" placeholder="Password" />
							</label>
				    	</div>
					</div>

					<div class="row">
				    	<div class="large-12 columns">
							<label>Confirm Password
				        		<input name="confirm_password" id="confirm_password" value="" type="password" placeholder="Confirm Password" />
							</label>
				    	</div>
					</div>

					<div class="row">
						<br />
				    	<div class="large-12 columns">
				    		{!! csrf_field() !!}
				    		<button type="submit" class="button small alert"><strong>Reset</strong></button>
				    	</div>
					</div>
				</form>
			</fieldset>
		</div>
	</div>
	<div class="large-3 column">&nbsp;</div>
</div>


@endsection
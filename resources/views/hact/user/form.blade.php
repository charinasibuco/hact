@extends('hact.layouts.layout_admin')

@section('content')

<div class='row'>
	<div class='large-12 columns'>
		<ul class="breadcrumbs">
			<li><a href="{{ route('user') }}">User</a></li>
			<li class="current"><a href="#">{{ $page }}</a></li>
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
							<label>Email
				        		<input name="email" id="email" value="{{ $email }}" type="text" placeholder="Email" />
							</label>
				    	</div>
					</div>

					<div class="row">
				    	<div class="large-12 columns">
							<label>Name
				        		<input name="name" id="name" value="{{ $name }}" type="text" placeholder="Name" />
							</label>
				    	</div>
					</div>

					<div class="row">
				    	<div class="large-12 columns">
							<label>Contact Number
				        		<input name="contact_number" id="contact_number" value="{{ $contact_number }}" type="text" placeholder="Contact Number" />
							</label>
				    	</div>
					</div>
					
					<div class="row">
				    	<div class="large-12 columns">
							<label>Access</label>
			        		<select name="access" id="access">
			        			<option value=""></option>
	        					<option value="1">Admin</option>
	        					<option value="2">Attending Physician</option>
	        					<option value="3">Laboratory</option>
			        		</select>
				    	</div>
					</div>
					
					<div class="row">
				    	<div class="large-12 columns">
							<label>Active</label>
			        		<select name="active" id="active">
			        			<option value="0">Inactive</option>
	        					<option value="1">Active</option>
			        		</select>
				    	</div>
					</div>

					@if(!empty($id))
					<div class="row">
						<input type="hidden" id="user_password_reset_url" name="user_password_reset_url" value="{{ route('user_password_reset', $id) }}" />
						<div class="large-12 columns">
							<br />Password
							<div class="row collapse">
								<div class="small-8 columns">
									<input type="text" name="generated_password" id="generated_password" readonly="readonly" />
								</div>
								<div class="small-4 columns">
									<a id="user_password_reset" href="#" class="button postfix"><span class="reset_value">Reset</span> <div class="loader">Loading</div></a>
								</div>
							</div>
						</div>
					</div>
					@endif
					
					<div class="row">
						<br />
				    	<div class="large-12 columns">
				    		{!! csrf_field() !!}
				    		<button class="button small alert"><strong><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</strong></button>
				    		<a class="button small info" href="{{ route('user') }}"><strong><i class="fi fi-x"></i> Cancel</strong></a>
				    	</div>
					</div>
				</form>
			</fieldset>
		</div>
	</div>
	<div class="large-3 column">&nbsp;</div>
</div>

<script type="text/javascript">

$('.loader').hide();

<?php
if($access != '')
{
	echo '$(\'#access\').val(\'' . $access . '\');';
}

if($active != '')
{
	echo '$(\'#active\').val(\'' . $active . '\');';
}

?>
</script>

@endsection
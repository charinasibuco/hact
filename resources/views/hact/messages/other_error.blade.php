@if(count($errors) > 0)
 	@foreach ($errors->all() as $error)
		@if(strpos($error, 'required') == false)
			<div class="alert-box alert ">{{ $error }} <a href="#" class="close">&times;</a></div>
		@endif
	@endforeach
@endif
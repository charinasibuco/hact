@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-12 columns'>
			<ul class="breadcrumbs">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li>HIV Info</li>
				<li class=""><a href="{{ route('hiv_info',$type) }}">{{ $page }}</a></li>
				<li class="current"><a href="#">{{ $action_name }}</a></li>
			</ul>
		</div>
	</div>

	@include("hact.messages.success")
	@if(count($errors) > 0)
		<div class="alert-box alert ">Error: Highlight fields are required!</div>
		@include("hact.messages.other_error")
	@endif
	<div class="panel">
		<form method="post" action="{{ $action }}" method="post" enctype="multipart/form-data">
		 	<fieldset>
		 		<legend>{{ $page }}</legend>
				<div class="row">
					<input type="hidden" id="type" name="type" value="{{ $type }}" placeholder="type">
					<div class="large-4 columns">
						<label for="description">description:</label>
						<input type="text" id="description" class="{{ ($errors->has('description')) ? 'highlight_error' : '' }}" name="description" value="{{ $description }}" placeholder="Description" required>
					</div>
					<div class="large-4 columns">
						<label for="pill">File:</label>
						<p id="file_preview">{{ $file }}</p>
						Select file to upload:
						<input type="file" name="file" id="file" class='file error {{ ($errors->has('file')) ? 'highlight_error' : '' }}'>
						@if($errors->has('file'))
							<small class="error">Limit Exceeded (5MB)</small>
						@endif
					</div>
					<div class="large-4 columns">
				        <label for="pill">Image:</label>
				        <img id='image_preview' src="{{ asset($image) }}" alt="No Image Selected"><br/>
				        Select image to upload:
				        <input type="file" name="image" id="image" class='image error {{ ($errors->has('image')) ? 'highlight_error' : '' }}'>
						@if($errors->has('image'))
							<small class="error">File not in Image Format or  Limit Exceeded (2MB)</small>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="medium-12 columns">
						{!! csrf_field() !!}
						<input type="hidden" name="ui_code">
						<button class="button success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
						<a href="{{ route('home') }}" class="button alert" title="Cancel"><i class="fi fi-x"></i> Cancel</a>
					</div>
				</div>
			</fieldset>
		</form>
			</div>
		</div>
	</div>

	<script>
		$(function(){
		    $(".image").change(function(){
		        if (typeof (FileReader) != "undefined") {
		            var reader = new FileReader();
		            reader.onload = function (e) {
		               $("#image_preview").attr("src", e.target.result).show();
		            }
		            reader.readAsDataURL($(this)[0].files[0]);
		        } else {
		            alert("This browser does not support FileReader.");
		        }
		    });
		});

		$(function(){
		    $(".file").change(function(){
		        if (typeof (FileReader) != "undefined") {
		            var reader = new FileReader();
		            reader.onload = function (e) {
		               $("#file_preview").html('');
		            }
		            reader.readAsDataURL($(this)[0].files[0]);
		        } else {
		            alert("This browser does not support FileReader.");
		        }
		    });
		});
	</script>
@endsection
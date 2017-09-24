@extends('hact.layouts.layout_admin')

@section('content')

<div class='row'>
	<div class='large-12 columns'>
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('patient') }}">Patient</a></li>
			<li><a href="{{ route('patient_profile',$patient_id) }}">{{ $search_patient }}</a></li>
			<li><a href="{{ route('patient_profile',$patient_id) . "#tab4" }}">Laboratory</a></li>
			<li class="current"><a href="#">{{ $action_name }}</a></li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="large-12 column">
		@include("hact.messages.success")
		@if(count($errors) > 0)
			<div class="alert-box alert ">Error: Highlight fields are required!</div>
			@include("hact.messages.other_error")
		@endif
		{{--@include("hact.messages.error_list")--}}
	</div>
</div>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<div class="custom-panel-heading">
			<span>{{ $action_name }} Laboratory</span>
			<a href="{{ route('patient_profile',$patient_id) }}" class="alert tiny button right" title="Cancel {{ $action_name }} Laboratory"><i class="fi fi-x"></i> Cancel</a>
		</div>
		<div class="custom-panel-details">
			<form method="post" action="{{ $action }}" enctype="multipart/form-data" files="true">
				<fieldset>
					<legend>Laboratory Test</legend>
					<div class="row">
						<div class="large-4 columns">
							<label for="search_patient">Patient</label>
							<div class="row collapse">
								<div class="small-10 columns">
									<input type="text" id="search_patient" name="search_patient" value="{{ $search_patient }}" @if($search_patient) readonly @endif/>
									<input type="hidden" id="patient_id" name="patient_id" value="{{ $patient_id }}" />
									<input type="hidden" id="search_patient_url" name="search_patient_url" value="{{ route('patient_search') }}" />
									<input type="hidden" id="patient_record_url" name="patient_record_url" value="{{ route('patient_record') }}" />
								</div>
								<div class="small-2 columns">
									<span class="postfix"><i class="fa fa-search"></i></span>
								</div>
							</div>
						</div>

						<div class="large-8 columns">
							&nbsp;
						</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<label for="laboratory_type_id">Laboratory:</label>
							<span id="type_edit">
								@if(isset($laboratory_test_description))
									{{ $laboratory_test_description }}
								@endif
							</span>
							<select id="laboratory_test_id" name="laboratory_test_id" class="{{ ($errors->has('laboratory_test_id')) ? 'highlight_error' : '' }}">
								@if(!isset($laboratory_test_id))
									<option value="" selected disabled>Select Laboratory Test</option>
								@else
									<option value="" disabled>Select Laboratory Test</option>
								@endif
								@foreach($laboratory_tests as $row)
									@if($row->id == $laboratory_test_id)
										<option value="{{ $row->id }}" selected>{{ $row->description }}</option>
									@else
										<option value="{{ $row->id }}">{{ $row->description }}</option>
									@endif
								@endforeach
								@if(isset($labs['other']))
									<option value="other" selected>Other</option>
								@else
									<option value="other">Other</option>
								@endif
							</select>
						</div>
						<div class="large-6 columns">
							<label class="result other" for="other">Other Laboratory Name:
								<input type="text" id="other" name="other" class="{{ ($errors->has('other')) ? 'highlight_error' : '' }} @if($action_name != "Edit" && isset($labs['other']))result other @endif" placeholder="Other Laboratory Name" value="{{ $other or '' }}">
							</label>
						</div>
					</div>
					<br/>
					<div class="row">
						<div class="large-6 columns">
							@foreach($laboratory_types as $row)
								<label class="result {{ $row->laboratory_test_id }}" for="labs[{{$row->id}}]">{{ $row->description }} Result:</label>
								@if($row->id < 14)
									<input placeholder="Result" type="text" class="result {{ $row->laboratory_test_id }} {{ ($errors->has('labs.'.$row->id)) ? 'highlight_error' : '' }}" id="labs[{{ $row->id }}]" name="labs[{{ $row->id }}]" value="{{ $labs[$row->id] or '' }}">
								@else
									<div class="result {{ $row->laboratory_test_id }} {{ ($errors->has('labs.'.$row->id)) ? 'highlight_error' : '' }}">
										<input type="radio" id="labs[{{ $row->id }}]_reactive" name="labs[{{ $row->id }}]" value="Reactive" @if(isset($labs[$row->id]) && $labs[$row->id]=="Reactive") checked @endif><label for="labs[{{ $row->id }}]_reactive">Reactive</label>
										<input type="radio" id="labs[{{ $row->id }}]_non_reactive" name="labs[{{ $row->id }}]" value="Non-Reactive" @if(isset($labs[$row->id]) && $labs[$row->id]=="Reactive") checked @endif><label for="labs[{{ $row->id }}]_non_reactive">Non-Reactive</label>
									</div>
								@endif
							@endforeach
								<label class="result other" for="labs[other]">Other Result:</label>
								<div class="{{ ($errors->has('labs.other')) ? 'highlight_error' : '' }} result other">
									<input type="radio" id="labs[other]_reactive" name="labs[other]" value="Reactive" @if(isset($labs['other']) && $labs['other']=="Reactive") checked @endif><label for="labs[other]_reactive">Reactive</label>
									<input type="radio" id="labs[other]_non_reactive" name="labs[other]" value="Non-Reactive" @if(isset($labs['other']) && $labs['other']=="Reactive") checked @endif><label for="labs[other]_non_reactive">Non-Reactive</label>
								</div>
							@if(isset($result))
								<label class="" for="result">{{ $laboratory_type_description }} Result:</label>
								<input placeholder="Result" type="text" class="" id="result" name="result" class="{{ ($errors->has('result')) ? 'highlight_error' : '' }}" value="{{ $result }}">
							@endif
						</div>
						<div class="large-6 columns">
							<label for="result">Result Date:</label>
							<input type="text" id="result_date" name="result_date"  class="{{ ($errors->has('result_date')) ? 'highlight_error' : '' }} fdatepicker" placeholder="Lab Result Date" value="{{ $result_date }}" readonly>
						</div>
					</div>

					<div class="row">
						<div class="large-12 columns">
							<fieldset>
								<legend>Test Result Image</legend>
								<img id='image_preview' src="{{ asset($image) }}" alt="No Image Selected"><br/>

								Select image to upload:

								<input type="file" name="image" id="image" class='image error {{ ($errors->has('image')) ? 'highlight_error' : '' }}'>
								@if($errors->has('image'))
									<small class="error">File not in Image Format or  Limit Exceeded (2MB)</small>
								@endif
							</fieldset><br/>
						</div>
					</div>

				</fieldset>
				<br/>
				<div class="row">
					<div class="medium-12 columns">
						<div class="right">
							{!! csrf_field() !!}
							<button class="button success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
							<a href="{{ route('patient_profile', $patient_id) }}" class="button alert" title="Cancel"><i class="fi fi-x"></i> Cancel</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>

	<?php

		if(isset($labs['other']))
		{
			echo "$('.other').show();";
		}
		else
		{
			echo "$('.other').hide();";
			echo "$('#other').val('');";
		}

		if($action_name=="Edit")
		{
			echo "$('#search_patient').attr('readonly',true);";
			echo "$('#order_number').attr('readonly',true);";
			echo "$('#laboratory_test_id').hide()";
		}
		
	?>


	//$('.result').hide();
	$('.result').each(function(){
		if($(this).hasClass($("#laboratory_test_id").val()))
		{
   			//$(this).prop('disabled', false);
   			$(this).show();
		}
		else
		{
			$(this).hide();
			$(this).val('');
			//$(this).prop('disabled', false);
		}
	});

	$(function(){
	    $("#laboratory_test_id").change(function(){
	    	$('.result').each(function(){
	    		if($(this).hasClass($("#laboratory_test_id").val()))
	    		{
	       			//$(this).prop('disabled', false);
	       			$(this).show();
	    		}
	    		else
	    		{
	    			$(this).hide();
	    			$(this).val('');
	    			//$(this).prop('disabled', false);
	    		}
	    	});
	    });
	});

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





</script>

@endsection

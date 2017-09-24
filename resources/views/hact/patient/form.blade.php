@extends('hact.layouts.layout_admin')

@section('content')

<div class='row'>
	<div class='large-12 columns'>
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('patient') }}">Patient</a></li>
			@if($page!="New")
				<li><a href="{{ route('patient_profile', $id) . "#tab1" }}">{{ $code_name }}</a></li>
			@endif
			<li class="current"><a href="#">{{ $page }}</a></li>
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
			<span>{{ $page }} Patient</span>
			<div class="right">
				<a href="{{ route('patient') }}" class="alert tiny button right" title="Cancel new patient"><i class="fi fi-x"></i> Cancel</a>
			</div>
		</div>
		<div class="custom-panel-details">
			<form method="post" action="{{ $action }}">
				<fieldset>
					<legend>Personal Information</legend>
					<div class="row">
						<div class="large-4 columns">
							<label for="enrolment_date">Enrolment Date</label>

							<input type="text" id="enrolment_date" name="enrolment_date" placeholder="Date of Enrolment" class="fdatepicker {{ ($errors->has('enrolment_date')) ? 'highlight_error' : '' }}" readonly value="{{ $enrolment_date != "-0001-11-30 00:00:00"? Carbon\Carbon::parse($enrolment_date)->format('m/d/Y'):"" }}">

						</div>
						<div class="large-8 columns">
							<label for="phil_health_number">Phil Health Number: </label><input type="text" id="phil_health_number" name="phil_health_number" value="{{ $phil_health_number }}" placeholder="Phil Health Number">
						</div>
					</div>
					<div class="row">
						<div class="large-8 columns">
							<label for="code_name">Code Name</label><input type="text" id="code_name" class="{{ ($errors->has('code_name')) ? 'highlight_error' : '' }}" name="code_name" value="{{ $code_name }}" placeholder="Code Name">
						</div>
						<div class="large-4 columns"><br/><span id="code_name_ajax"></span></div>
					</div>
					<div class="row">
						<div class="large-4 columns">
							<label for="nationality">Nationality: </label>
							<input type="text" id="nationality" name="nationality" class="{{ ($errors->has('nationality')) ? 'highlight_error' : '' }}" value="{{ $nationality }}">
						</div>
						<div class="large-4 columns">
							<label for="birth_date">Birth Date </label>
							<input type="text" id="birth_date" name="birth_date" value="{{ $birth_date }}" placeholder="Birth Date" class="fdatepicker {{ ($errors->has('birth_date')) ? 'highlight_error' : '' }}" readonly>
						</div>
						<div class="large-2 columns">
							<label for="age">Age</label>
							<div class="row">
								<div class="large-8 columns">
									<input type="text" id="age" name="age" value="" readonly>
								</div>
								<div class="large-4 columns">&nbsp;</div>
							</div>
						</div>
						<div class="large-2 columns">
							<label for="dependents"> Number of Children</label>
							<div class="row">
								<div class="large-8 columns">
									<input type="text" id="dependents" name="dependents" value="{{ $dependents }}">
								</div>
								<div class="large-4 columns">&nbsp;</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="large-4 columns ">
							<label for="gender">Gender</label>
							@if($errors->has('gender'))
								<div class="highlight_error">
							@endif
							<input type="radio" id="male" name="gender" value="1"><label for="male"> Male</label><input type="radio" id="female" value="0" name="gender"><label for="female"> Female</label>
							@if($errors->has('gender'))
										<div class="clearfix"></div>
								</div>
							@endif
						</div>
						<div class="large-8 columns">
							<label for="single">Civil Status </label>
							@if($errors->has('civil_status'))
								<div class="highlight_error" >
							@endif
							<input type="radio" id="single" value="1" name="civil_status"><label for="single"> Single</label>
							<input type="radio" id="married" value="2" name="civil_status"><label for="married"> Married</label>
							<input type="radio" id="separated" value="3" name="civil_status"><label for="separated"> Separated</label>
							<input type="radio" id="widowed" value="4" name="civil_status"><label for="widowed"> Widowed</label>
							@if($errors->has('civil_status'))
									<div class="clearfix"></div>
								</div>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="large-4 columns" @if($gender == 0) style="display:block"@endif>
							<label for="partner_no">Are you living with a partner? </label>
							@if($errors->has('is_living_with_partner'))
								<div class="highlight_error">
							@endif
							<input type="radio" id="partner_yes" value="1" name="is_living_with_partner"><label for="partner_yes"> Yes</label>
							<input type="radio" id="partner_no" value="0" name="is_living_with_partner"><label for="partner_no"> No</label>
							@if($errors->has('is_living_with_partner'))
								<div class="clearfix"></div>
								</div>
							@endif
						</div>
						<div class="large-4 columns is_presently_pregnant_div">
							<label for="pregnant_no">Are you presently pregnant?</label>
							@if($errors->has('is_presently_pregnant'))
								<div class="highlight_error">
							@endif
							<input type="radio" id="pregnant_yes" name="is_presently_pregnant" value="1"><label for="pregnant_yes"> Yes</label>
							<input type="radio" id="pregnant_no" name="is_presently_pregnant" value="0"><label for="pregnant_no"> No</label>
							@if($errors->has('is_presently_pregnant'))
							<div class="clearfix"></div>
							</div>
							@endif
						</div>
						<div class="large-4 columns">&nbsp;</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>Unique Identifier Code</legend>
					<div class="row">
						<div class="large-4 columns">
							<div class="row">
								<div class="large-12 columns text-center">
									<label for="ui_code1">First 2 letters of mother's real name</label>
								</div>
							</div>
							<div class="row">
								<div class="large-4 columns">&nbsp;</div>
								<div class="large-4 columns">
									<input type="text" id="ui_code1" name="ui_code1" class="{{ ($errors->has('ui_code1')) ? 'highlight_error' : '' }}" value="{{ $ui_code1 }}" placeholder="" maxlength="2" class="text-center">
								</div>
								<div class="large-4 columns">&nbsp;</div>
							</div>
						</div>
						<div class="large-4 columns">
							<div class="row">
								<div class="large-12 columns text-center">
									<label for="ui_code2">First 2 letters of father's real name</label>
								</div>
							</div>
							<div class="row">
								<div class="large-4 columns">&nbsp;</div>
								<div class="large-4 columns">
									<input type="text" id="ui_code2" name="ui_code2" class="{{ ($errors->has('ui_code2')) ? 'highlight_error' : '' }}" value="{{ $ui_code2 }}" placeholder="" maxlength="2" class="text-center">
								</div>
								<div class="large-4 columns">&nbsp;</div>
							</div>
						</div>
						<div class="large-4 columns">
							<div class="row">
								<div class="large-12 columns text-center">
									<label for="ui_code3">Birth Order</label>
								</div>
							</div>
							<div class="row">
								<div class="large-4 columns">&nbsp;</div>
								<div class="large-4 columns">
									<input type="text" id="ui_code3" class="{{ ($errors->has('ui_code3')) ? 'highlight_error' : '' }}" name="ui_code3" value="{{ $ui_code3 }}" placeholder="" maxlength="2" class="text-center">
								</div>
								<div class="large-4 columns">&nbsp;</div>
							</div>

						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Address</legend>
					<div class="row">
						<div class="large-12 columns">
							<label for="permanent_address">Permanent Address: </label><input type="text" id="permanent_address" class="{{ ($errors->has('permanent_address')) ? 'highlight_error' : '' }}" name="permanent_address" value="{{ $permanent_address }}" placeholder="Permanent Address">
						</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<label for="current_city">Current Municipality/City: </label><input type="text" id="current_city" class="{{ ($errors->has('current_city')) ? 'highlight_error' : '' }}" name="current_city" value="{{ $current_city }}" placeholder="Current Municipality/City">
						</div>
						<div class="large-6 columns">
							<label for="current_province">Current Province: </label><input type="text" id="current_province" class="{{ ($errors->has('current_province')) ? 'highlight_error' : '' }}" name="current_province" value="{{ $current_province }}" placeholder="Current Province">
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Place of Birth</legend>
					<div class="row">
						<div class="large-6 columns">
							<label for="birth_place_city">Municipality/City: </label>
							<input type="text" id="birth_place_city" name="birth_place_city" class="{{ ($errors->has('birth_place_city')) ? 'highlight_error' : '' }}" value="{{ $birth_place_city }}" placeholder="Municipality/City of Birth">
						</div>
						<div class="large-6 columns">
							<label for="birth_place_province">Province: </label>
							<input type="text" id="birth_place_province" name="birth_place_province" value="{{ $birth_place_province }}" placeholder="Province of Birth">
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Contact Details</legend>
					<div class="row">
						<div class="large-4 columns">
							<label for="contact_number">Contact Number: </label><input type="text" id="contact_number" name="contact_number" value="{{ $contact_number }}" placeholder="Contact Number">
						</div>
						<div class="large-4 columns">
							<label for="email">Email: </label><input type="email" id="email" name="email" value="{{ $email }}" class="{{ ($errors->has('email')) ? 'highlight_error' : '' }}" placeholder="Email">
						</div>
						<div class="large-4 columns">&nbsp;</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>Highest Educational Attaintment <span>*</span></legend>
					<div class="row">
						@if($errors->has('highest_educational_attainment'))
							<div class="highlight_error" style="padding:3px">
						@endif
						<div class="large-4 columns">
							<label for="none"><input type="radio" id="none" value="0" name="highest_educational_attainment" > None</label>
							<label for="elementary"><input type="radio" id="elementary" value="1" name="highest_educational_attainment"> Elementary</label>
						</div>
						<div class="large-4 columns">
							<label for="highschool"><input type="radio" id="highschool" value="2" name="highest_educational_attainment" > Highschool</label>
							<label for="vocational"><input type="radio" id="vocational" value="3" name="highest_educational_attainment" > Vocational</label>
						</div>
						<div class="large-4 columns">
							<label for="post_graduate"><input type="radio" id="post_graduate" value="4" name="highest_educational_attainment"> Post-Graduate</label>
							<label for="college"><input type="radio" id="college" value="5" name="highest_educational_attainment" > College</label>
						</div>
						@if($errors->has('highest_educational_attainment'))
							<div class="clearfix"></div>
							</div>
						@endif
					</div>

				</fieldset>

				<fieldset>
					<legend>Employment</legend>
					<div class="row">
						<div class="large-2 columns">
							<label for="working_yes">Currently Working? </label>
							@if($errors->has('is_working'))
								<div class="highlight_error" style="padding:3px">
							@endif
							<input type="radio" id="working_yes" name="is_working" value="1"><label for="working_yes"> Yes</label>
							<input type="radio" id="working_no" name="is_working" value="0"><label for="working_no"> No</label>
							@if($errors->has('is_working'))
										<div class="clearfix"></div>
								</div>
							@endif
						</div>
						<div class="large-5 columns">
							<label for="current_occupation">Current Occupation: </label>
							<input type="text" id="current_occupation" name="current_occupation" class="{{ ($errors->has('current_occupation')) ? 'highlight_error' : '' }}" value="{{ $current_occupation }}" placeholder="Current Occupation">
						</div>
						<div class="large-5 columns">
							<label for="previous occupation">Previous Occupation: </label>
							<input type="text" id="previous_occupation" name="previous_occupation" value="{{ $previous_occupation }}" placeholder="leave blank if never been employed">
						</div>
					</div>
					<div class="row">
						<div class="large-7 columns">
							<label for="abroad_no">Do you work overseas/abroad in the past 5 years? </label>
							@if($errors->has('is_work_abroad_in_past_5years'))
								<div class="highlight_error">
							@endif
							<input type="radio" id="abroad_yes" name="is_work_abroad_in_past_5years" value="1"><label for="abroad_yes"> Yes</label>
							<input type="radio" id="abroad_no" name="is_work_abroad_in_past_5years" value="0"><label for="abroad_no"> No</label>
							@if($errors->has('is_work_abroad_in_past_5years'))
								<div class="clearfix"></div>
								</div>
							@endif
						</div>
						<div class="large-5 columns work_abroad">
							<label for="last_contract">When did you return from your last contract? </label>
							<input type="text" id="last_contract" name="last_contract" value="" class="fdatepicker" readonly>
						</div>
					</div>
					<div class="row work_abroad">
						<div class="large-7 columns">
							<label for="ship">Where were you based? </label>
							@if($errors->has('is_based'))
								<div class="highlight_error">
							@endif
							<input type="radio" id="ship" name="is_based" value="1"><label for="ship">On a ship</label>
							<input type="radio" id="land" name="is_based" value="2"><label for="land"> Land</label>
							@if($errors->has('is_based'))
								<div class="clearfix"></div>
								</div>
							@endif
						</div>
						<div class="large-5 columns">
							<label for="last_work_country">What country did you last work in?</label>
							<input type="text" id="last_work_country" name="last_work_country" value="">
						</div>
					</div>
				</fieldset><br>
				<div class="row">
					<div class="medium-12 columns">
						<div class="right">
							{!! csrf_field() !!}
							<input type="hidden" name="ui_code">
							<button class="button success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
							<a href="{{ route('patient') }}" class="button alert" title="Cancel"><i class="fi fi-x"></i> Cancel</a>
						</div>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>



<script>

	<?php
	// Gender
		if(is_numeric($gender))
		{
			if($gender == 1)
			{
				echo '$(\'#male\').prop(\'checked\', true);';
				echo '$(\'.is_presently_pregnant_div\').hide();';
			}
			elseif($gender == 0)
			{
				echo '$(\'#female\').prop(\'checked\', true);';
				echo '$(\'.is_presently_pregnant_div\').show();';
			}
		}
		else
		{
			echo '$(\'.is_presently_pregnant_div\').hide();';
		}

		if(is_numeric($is_presently_pregnant))
		{
			if($is_presently_pregnant == 1)
			{
				echo '$(\'#pregnant_yes\').prop(\'checked\', true);';
			}
			elseif($is_presently_pregnant == 0)
			{
				echo '$(\'#pregnant_no\').prop(\'checked\', true);';
			}
		}
//		else
//		{
//			echo '$(\'.is_presently_pregnant_div\').hide();';
//		}


		// Civil Status
		if($civil_status == 1)
		{
			echo '$(\'#single\').prop(\'checked\', true);';
		}
		elseif($civil_status == 2)
		{
			echo '$(\'#married\').prop(\'checked\', true);';
		}
		elseif($civil_status == 3)
		{
			echo '$(\'#separated\').prop(\'checked\', true);';
		}
		elseif($civil_status == 4)
		{
			echo '$(\'#widowed\').prop(\'checked\', true);';
		}

		// Are you living with a partner?
		if(is_numeric($is_living_with_partner))
		{
			if($is_living_with_partner == 1)
			{
				echo '$(\'#partner_yes\').prop(\'checked\', true);';
			}

			elseif($is_living_with_partner == 0)
			{
				echo '$(\'#partner_no\').prop(\'checked\', true);';
			}
		}


		// Highest Educational Attaintment
		if(is_numeric($highest_educational_attainment))
		{
			if($highest_educational_attainment == 0)
			{
				echo '$(\'#none\').prop(\'checked\', true);';
			}
			elseif($highest_educational_attainment == 1)
			{
				echo '$(\'#elementary\').prop(\'checked\', true);';
			}
			elseif($highest_educational_attainment == 2)
			{
				echo '$(\'#highschool\').prop(\'checked\', true);';
			}
			elseif($highest_educational_attainment == 3)
			{
				echo '$(\'#vocational\').prop(\'checked\', true);';
			}
			elseif($highest_educational_attainment == 4)
			{
				echo '$(\'#post_graduate\').prop(\'checked\', true);';
			}
			elseif($highest_educational_attainment == 5)
			{
				echo '$(\'#college\').prop(\'checked\', true);';
			}
		}

		// Currently Working
		if(is_numeric($is_working))
		{
			if($is_working == 1)
			{
				echo '$(\'#working_yes\').prop(\'checked\', true);';
				echo '$(\'#current_occupation\').attr(\'readonly\', false);';
			}
			elseif($is_working == 0)
			{
				echo '$(\'#working_no\').prop(\'checked\', true);';
				echo '$(\'#current_occupation\').attr(\'readonly\', true);';
			}
		}
		else
		{
			echo '$(\'#current_occupation\').attr(\'readonly\', true);';
		}

		// Do you work overseas/abroad in the past 5 years?
		if(is_numeric($is_working))
		{
			if($is_work_abroad_in_past_5years == 1)
			{
				echo '$(\'#abroad_yes\').prop(\'checked\', true);';
				echo '$(\'#last_contract\').val(\'' . $last_contract . '\').show().prop(\'required\',\'true\');';
				echo '$(\'#last_work_country\').val(\'' . $last_work_country . '\').show().prop(\'required\',\'true\');';
				
				if($is_based == 1)
				{
					echo '$(\'#ship\').prop(\'checked\', true).prop(\'required\',\'true\');';
				}
				else
				{
					echo '$(\'#land\').prop(\'checked\', true).prop(\'required\',\'true\');';
				}
			}
			elseif($is_work_abroad_in_past_5years == 0)
			{
				echo '$(\'#abroad_no\').prop(\'checked\', true).prop(\'required\',\'false\');';
				echo '$(\'.work_abroad\').hide();';
			}
		}
		else
		{
			echo '$(\'.work_abroad\').hide();';
		}

		if($birth_date)
		{
			echo '$(\'#age\').val(getAge(\''.$birth_date.'\'));';
		}
	?>
	

	$(function(){
		$('#birth_date').change(function(){
			var value = $(this).val();
			var age = getAge(value);

			$('#age').val();
		});
	});

	$(function(){
		$('input[name=gender]').change(function(){
			var value = $(this).val();
			//var value = $(this).is(':checked');
			//$('#female').is(':checked')
			
			if(value == 1)
			{
				$('.is_presently_pregnant_div').hide();
				$('#pregnant_no').prop('disabled', true);
				$('#pregnant_yes').prop('disabled', true);
				$('#pregnant_no').prop('checked', false);
				$('#pregnant_yes').prop('checked', false);
			}
			else
			{
				$('.is_presently_pregnant_div').show();
				$('#pregnant_no').prop('disabled', false);
				$('#pregnant_yes').prop('disabled', false);
			}
		});
	});

	$(function(){
		$('input[name=is_working]').change(function(){
			var value = $(this).val();
			
			if(value == 1)
			{
				$('#current_occupation').attr('readonly', false).focus();
			}
			else
			{
				$('#current_occupation').attr('readonly', true);
			}
		});
	});

	$(function(){
		$('input[name=is_work_abroad_in_past_5years]').change(function(){
			var value = $(this).val();
			
			if(value == 1)
			{

				$('.work_abroad').show();
				$('#last_contract, #last_work_country').prop('required',true);
				$('input[name=is_based]').prop('required',true);
				//$('#last_contract').show();
				//$('#last_work_country').show();
			}
			else
			{
				$('.work_abroad').hide();
				$('#last_contract, #last_work_country').val('').prop('required',false);

				$('input[name=is_based]').prop('checked', false);
				$('input[name=is_based]').prop('required', false);
				/*$('#last_contract').hide();
				$('#last_work_country').hide();

				$('#last_contract').val('');
				$('#last_work_country').val('');*/
			}
		});
	});
	$(function(){
		$('input[name=is_working]').change(function(){
			var value = $(this).val();
			
			if(value == 0)
			{
				$('#current_occupation').val('');
			}
		});
	});

	$('input').keyup(function(){
		var field_name = $(this).attr('name');
		$.post("{{ route('validation_ajax') }}",{"field":$(this).attr('name'),"input":$(this).val(),"_token":"{{ csrf_token() }}"},function(data){
			if(data==1){
				$("#"+field_name+"_ajax").html("<i class='fa fa-lg fa-times' aria-hidden='true'></i> Code name already taken").css({"color":"#990000"});
				$("#"+field_name).addClass('highlight_error');
			}else {
				$("#"+field_name+"_ajax").html("<i class='fa fa-lg fa-check' aria-hidden='true'></i> Code name is available").css({"color":"#43ac6a"});
				$("#"+field_name).removeClass('highlight_error');
			}
			if($("#"+field_name).val()==""){
				$("#"+field_name+"_ajax").html("");
			}
		});
	});

</script>
	
@endsection
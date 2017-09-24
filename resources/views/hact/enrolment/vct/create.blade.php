@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-12 columns'>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Home</a></li>
				<li><a href="{{ route('vct_index') }}">Voluntary Counseling Testing</a></li>
				<li class="current"><a href="#">New Record</a></li>
			</ul>
		</div>
	</div>

	@include('hact.messages.success')
	@include('hact.messages.error_list')

	<div class="panel">
		<form action="{{ $action }}" method="post">
			<div class="row">
				<div class="large-4 columns">
					<label for="vct_date">Date of VCT:</label>
					<input type="text" id="vct_date" name="vct_date" class="fdatepicker" value="{{ $vct_date }}" placeholder="VCT Date"  readonly="readonly"/> 
				</div>
			</div>

			<fieldset>
	    		<legend>Patient's Name</legend>
				<div class="row">
					<div class="large-4 columns">	
						<label for="first_name">First Name:</label>
						<input type="text" id="first_name" name="first_name" placeholder="First Name" value="{{ $first_name }}">
					</div>
					<div class="large-4 columns">
						<label for="middle_name">Middle Name:</label>
						<input type="text" id="middle_name" name="middle_name" placeholder="Middle Name" value="{{ $middle_name }}">
					</div>
					<div class="large-4 columns">
						<label for="last_name">Last Name:</label>
						<input type="text" id="last_name" name="last_name" placeholder="Last Name" value="{{ $last_name }}">
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Unique Identifier Code</legend>
				<div class="row">
					<div class="large-4 columns">
						<label for="uic_mother_name">First 2 letters of mother's name</label>
						<input type="text" id="uic_mother_name" name="uic_mother_name" minlength="2" maxlength="2" placeholder="A-Z" value="{{ $uic_mother_name }}">
					</div>
					<div class="large-4 columns">
						<label for="uic_father_name">First 2 letters of father's name</label>
						<input type="text" id="uic_father_name" name="uic_father_name" minlength="2" maxlength="2" placeholder="A-Z" value="{{ $uic_father_name }}">
					</div>
					<div class="large-4 columns">
						<label for="uic_birth_order">2-digit birth order</label>
						<input type="text" id="uic_birth_order" name="uic_birth_order" minlength="2" maxlength="2" placeholder="1-0" value="{{ $uic_birth_order }}">
					</div>
				</div>
			</fieldset>


			  <fieldset>
	    		<legend>Mother's Maiden Name</legend>
				<div class="row">
					<div class="large-4 columns">	
						<label for="mother_first_name">First Name:</label>
						<input type="text" id="mother_first_name" name="mother_first_name" placeholder="First Name" value="{{ $mother_first_name }}">
					</div>
					<div class="large-4 columns">
						<label for="mother_middle_name">Middle Name:</label>
						<input type="text" id="mother_middle_name" name="mother_middle_name" placeholder="Middle Name" value="{{ $mother_middle_name }}">
					</div>
					<div class="large-4 columns">
						<label for="mother_last_name">Last Name:</label>
						<input type="text" id="mother_last_name" name="mother_last_name" placeholder="Last Name" value="{{ $mother_last_name }}">
					</div>
				</div>
			</fieldset>

			<fieldset>
		    	<legend>Basic Information</legend>
				<div class="row">
					<div class="large-3 columns">
						<label for="male">Sex:</label>
						<input id="male" name="sex" type="radio" value="male" checked="checked"><label for="male">Male</label>
						<input id="female" name="sex" type="radio" value="female"><label for="female">Female</label><br/>
					</div>

					<div class="large-3 columns">
						<label for="date_of_birth">Date of Birth:</label>
						<input type="text" id="birth_date" class="fdatepicker" name="birth_date" placeholder="Date of Birth" value="{{ $birth_date }}" readonly="readonly">
					</div>

					<div class="large-2 columns">
						<label>Age:</label>
						<input type="text" id="age" name="age" placeholder="Age" value="{{ $age }}" readonly="readonly">
					</div>

					<div class="large-4 columns">&nbsp;</div>
				</div>
				
				<div class="row">
					<div class="large-12 columns">
						<label for="contact_number">Contact Number:</label>
						<input type="text" id="contact_number" name="contact_number" placeholder="Contact Number" value="{{ $contact_number }}">
					</div>
				</div>

			</fieldset>

			<fieldset>
	    		<legend>Address</legend>
				<div class="row">
					<div class="large-12 columns">
						<label for="street">Street:</label>
						<input type="text" id="street" name="street" placeholder="Street" value="{{ $street }}">
					</div>
					<div class="large-12 columns">
						<label for="purok">Purok/Avenue:</label>
						<input type="text" id="purok" name="purok" placeholder="Purok" value="{{ $purok }}">
					</div>
					<div class="large-12 columns">
						<label for="barangay">Barangay:</label>
						<input type="text" id="barangay" name="barangay" placeholder="Barangay" value="{{ $barangay }}">
					</div>
					<div class="large-12 columns">
						<label for="city">City:</label>
						<input type="text" id="city" name="city" placeholder="City" value="{{ $city }}">
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>HIV Risks</legend>
				<div class="row">
					<div class="large-6 columns">
						
						<label for="blood_transfusion">
							<input type="checkbox" id="blood_transfusion" name="blood_transfusion" value="1" {{ ($blood_transfusion == 1)? 'checked="checked"' : '' }}> 
							Blood Transfusion(BT) Recipient
						</label>
						<label for="injecting_drug_user">
							<input type="checkbox" id="injecting_drug_user" name="injecting_drug_user" value="1" {{ ($injecting_drug_user == 1)? 'checked="checked"' : '' }}> 
							Injecting Drug User(IDU)
						</label>
						<label for="substance_abuse">
							<input type="checkbox" id="substance_abuse" name="substance_abuse" value="1" {{ ($substance_abuse == 1)? 'checked="checked"' : '' }}> 
							Substance Abuse
						</label>
						<label for="occupational_exposure">
							<input type="checkbox" id="occupational_exposure" name="occupational_exposure" value="1" {{ ($occupational_exposure == 1)? 'checked="checked"' : '' }}> 
							Occupational Exposure(OE)
						</label>
						<!-- disable if occupational_exposure -->
						<div class="occupational_exposure_selection">
							<label for="provided_post_exposure_prophylaxis_yes">Provided Post Exposure Prophylaxis</label>
							<input type="radio" id="provided_post_exposure_prophylaxis_yes" name="provided_post_exposure_prophylaxis" value="1" {{ ($provided_post_exposure_prophylaxis == 1)? 'checked="checked"' : '' }}> 
							<label for="provided_post_exposure_prophylaxis_yes">YES</label>
							<input type="radio" id="provided_post_exposure_prophylaxis_no" name="provided_post_exposure_prophylaxis" value="1" {{ ($provided_post_exposure_prophylaxis == 0)? 'checked="checked"' : '' }}> 
							<label for="provided_post_exposure_prophylaxis_no">NO</label>
						</div>
						<!--  -->
					</div>
					<div class="large-6 columns">
						<label for="sexually_transmitted_infections">
							<input type="checkbox" id="sexually_transmitted_infections" name="sexually_transmitted_infections" value="1" {{ ($sexually_transmitted_infections == 1)? 'checked="checked"' : '' }}> 
							Sexually Transmitted Infections(STI)
						</label>
						<label for="multiple_sexual_partners">
							<input type="checkbox" id="multiple_sexual_partners" name="multiple_sexual_partners" value="1" {{ ($multiple_sexual_partners == 1)? 'checked="checked"' : '' }}> 
							Multiple Sexual Partners
						</label>
						<label for="male_sex_with_other_male">
							<input type="checkbox" id="male_sex_with_other_male" name="male_sex_with_other_male" value="1" {{ ($male_sex_with_other_male == 1)? 'checked="checked"' : '' }}> 
							Male having Sex with other Males(MSM)
						</label>
						<label for="sex_worker_client">
							<input type="checkbox" id="sex_worker_client" name="sex_worker_client" value="1" {{ ($sex_worker_client == 1)? 'checked="checked"' : '' }}> 
							Client of a Sex Worker
						</label>
						<label for="sex_worker">
							<input type="checkbox" id="sex_worker" name="sex_worker" value="1" {{ ($sex_worker == 1)? 'checked="checked"' : '' }}> 
							Sex Worker
						</label>
						<label for="child_of_hiv_infected_mother">
							<input type="checkbox" id="child_of_hiv_infected_mother" name="child_of_hiv_infected_mother" value="1" {{ ($child_of_hiv_infected_mother == 1)? 'checked="checked"' : '' }}> 
							Child of HIV Infected Mother
						</label>
					</div>
				</div>
			</fieldset>
				
			<fieldset>
				<legend>HIV Testing</legend>
				<div class="row">
					<div class="large-5 columns">
						<label for="tested_for_hiv_yes">Tested for HIV?</label>
						<input type="radio" id="tested_for_hiv_yes" name="tested_for_hiv" value="1" {{ ($tested_for_hiv == 1)? 'checked="checked"' : '' }}> 
						<label for="tested_for_hiv_yes">YES</label>
						<input type="radio" id="tested_for_hiv_no" name="tested_for_hiv" value="0" {{ ($tested_for_hiv == 0)? 'checked="checked"' : '' }}> 
						<label for="tested_for_hiv_no">NO</label><br />
						<label for="reason_for_not_testing">Reason for not testing:</label>
						<input type="text" id="reason_for_not_testing" name="reason_for_not_testing" value="{{ $reason_for_not_testing }}" disabled="disabled" />
					</div>
					<div class="large-3 columns">
						<label for="positive_for_hiv_yes">Positive for HIV?</label>
						<input type="radio" id="positive_for_hiv_yes" name="positive_for_hiv" value="1" {{ ($positive_for_hiv == 1)? 'checked="checked"' : '' }}> 
						<label for="positive_for_hiv_yes">YES</label>
						<input type="radio" id="positive_for_hiv_no" name="positive_for_hiv" value="0" {{ ($positive_for_hiv == 0)? 'checked="checked"' : '' }}> 
						<label for="positive_for_hiv_no">NO</label><br />
						<label for="reason_for_not_testing">Date of Re-test:</label>
						<input type="text" id="hiv_positive_date_retest" class="fdatepicker" name="hiv_positive_date_retest" value="{{ $hiv_positive_date_retest }}" disabled="disabled" readonly="readonly" />
					</div>
					<div class="large-4 columns">
						<label for="provide_post_test_counselling_and_hiv_result_yes">Provided Post-test Counseling and HIV Result?</label>
						<input id="provide_post_test_counselling_and_hiv_result_yes" type="radio" name="provide_post_test_counselling_and_hiv_result" value="1" {{ ($provide_post_test_counselling_and_hiv_result == 1)? 'checked="checked"' : '' }}> 
						<label for="provide_post_test_counselling_and_hiv_result_yes">YES</label>
						<input id="provide_post_test_counselling_and_hiv_result_no" type="radio" name="provide_post_test_counselling_and_hiv_result" value="0" {{ ($provide_post_test_counselling_and_hiv_result == 0)? 'checked="checked"' : '' }}>
						<label for="provide_post_test_counselling_and_hiv_result_no">NO</label>
					</div>
				</div>
			</fieldset><br/>

			<div class="row">
				<div class="large-4 columns">&nbsp;</div>
				<div class="large-4 columns">
					<div class="row">
						<div class="large-3 columns">&nbsp;</div>
						<div class="large-6 columns">
							<input type="hidden" name="ui_code" value="">
							{!! csrf_field() !!}
							<input type="hidden" name="id" value="{{ $id }}">
							<input type="submit" class="button alert expand" value="Submit" />
						</div>
						<div class="large-3 columns">&nbsp;</div>
					</div>
				</div>
				<div class="large-4 columns">&nbsp;</div>
			</div>
		</form>
	</div>

<script type="text/javascript">
<?php

if($occupational_exposure == 0){
	echo '$(\'.occupational_exposure_selection\').hide();';
}else{
	echo '$(\'.occupational_exposure_selection\').show();';
}

if($tested_for_hiv == 1){
	echo '$(\'#reason_for_not_testing\').val(\'\').attr(\'disabled\', true);';
}else{
	echo '$(\'#reason_for_not_testing\').attr(\'disabled\', false);';
}

if($positive_for_hiv == 0){
	echo '$(\'#hiv_positive_date_retest\').attr(\'disabled\', false);';
}else{
	echo '$(\'#hiv_positive_date_retest\').val(\'\').attr(\'disabled\', true);';
}

?>




$(function(){
    $("#occupational_exposure").click(function(){
        var status = $(this).is(':checked');

        if(status == true)
        {
        	$('.occupational_exposure_selection').show();
        }
        else
        {
        	$('.occupational_exposure_selection').hide();
        }
    });
});

$(function(){
    $("input[name='tested_for_hiv'").click(function(){
        var value = $(this).val();


        if(value == 1)
        {
        	$('#reason_for_not_testing').val('').attr('disabled', true);
        }
        else
        {
        	$('#reason_for_not_testing').attr('disabled', false);
        }
    });
});

$(function(){
    $("input[name='positive_for_hiv'").click(function(){
        var value = $(this).val();


        if(value == 1)
        {
        	$('#hiv_positive_date_retest').val('').attr('disabled', true);
        }
        else
        {
        	$('#hiv_positive_date_retest').attr('disabled', false);
        }
    });
});
</script>
@endsection
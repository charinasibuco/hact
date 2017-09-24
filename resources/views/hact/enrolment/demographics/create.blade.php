@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-12 columns'>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Home</a></li>
				<li><a href="{{ route('demographics_index') }}">Demographics</a></li>
				<li class="current"><a href="#">New Record</a></li>
			</ul>
		</div>
	</div>

	@include('hact.messages.success')
	@include('hact.messages.error_list')

	<div class="panel">
		<form action="{{ $action }}" method="post">

			<fieldset>
	    		<legend>Patient's Name</legend>
				<div class="row">
					<div class="large-4 columns">
						<div class="row collapse">
							<div class="small-10 columns">
								<input type="text" id="search_patient" name="search_patient" placeholder="Search Patient" value="{{ $search_patient }}">
			                    <input type="hidden" id="vct_record_url" name="vct_record_url" value="{{ route('vct_record') }}" />
			                    <input type="hidden" id="search_patient_url" name="search_patient_url" value="{{ route('search_vct_patient') }}" />
							</div>
					    	<div class="small-2 columns">
					      		<span class="postfix"><i class="fa fa-search"></i></span>
					    	</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="large-4 columns">	
						<label for="first_name">First Name:</label>
						<input type="text" id="first_name" name="first_name" placeholder="First Name" value="{{ $first_name }}" />
					</div>
					<div class="large-4 columns">
						<label for="middle_name">Middle Name:</label>
						<input type="text" id="middle_name" name="middle_name" placeholder="Middle Name" value="{{ $middle_name }}" />
					</div>
					<div class="large-4 columns">
						<label for="last_name">Last Name:</label>
						<input type="text" id="last_name" name="last_name" placeholder="Last Name" value="{{ $last_name }}" />
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Enrolment Details</legend>

				<div class="row">
					<div class="large-4 columns">
						<label for="code_name">Code Name:</label>
						<input type="text" id="code_name" name="code_name" value="{{ $code_name }}" placeholder="Code Name" /> 
					</div>
					<div class="large-4 columns">
						<label for="saccl">SACCL Code:</label>
						<input type="text" id="saccl" name="saccl" value="{{ $saccl }}" placeholder="SACCL" /> 
					</div>
					<div class="large-4 columns">&nbsp;</div>
				</div>

				<div class="row">
					<div class="large-4 columns">
						<label for="initial_contract_date">Date of Initial Contact:</label>
						<input type="text" id="initial_contract_date" name="initial_contract_date" class="fdatepicker" value="{{ $initial_contract_date }}" placeholder="Date of Initial Contract" readonly="readonly" /> 
					</div>
					<div class="large-4 columns">
						<label for="enrolment_date">Date of Enrolment:</label>
						<input type="text" id="enrolment_date" name="enrolment_date" class="fdatepicker" value="{{ $enrolment_date }}" placeholder="Date of Enrolment" readonly="readonly" /> 
					</div>
					<div class="large-4 columns">
						<label for="diagnosis_date">Date of Diagnosis:</label>
						<input type="text" id="diagnosis_date" name="diagnosis_date" class="fdatepicker" value="{{ $diagnosis_date }}" placeholder="Date of Enrolment"  readonly="readonly" /> 
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Unique Identifier Code</legend>
				<div class="row">
					<div class="large-4 columns">
						<label for="uic_mother_name">First 2 letters of mother's name</label>
						<input type="text" id="uic_mother_name" name="uic_mother_name" minlength="2" maxlength="2" placeholder="A-Z" value="{{ $uic_mother_name }}" />
					</div>
					<div class="large-4 columns">
						<label for="uic_father_name">First 2 letters of father's name</label>
						<input type="text" id="uic_father_name" name="uic_father_name" minlength="2" maxlength="2" placeholder="A-Z" value="{{ $uic_father_name }}" />
					</div>
					<div class="large-4 columns">
						<label for="uic_birth_order">2-digit birth order</label>
						<input type="text" id="uic_birth_order" name="uic_birth_order" minlength="2" maxlength="2" placeholder="1-0" value="{{ $uic_birth_order }}" />
					</div>
				</div>
			</fieldset>


			  <fieldset>
	    		<legend>Mother's Maiden Name</legend>
				<div class="row">
					<div class="large-4 columns">	
						<label for="mother_first_name">First Name:</label>
						<input type="text" id="mother_first_name" name="mother_first_name" placeholder="First Name" value="{{ $mother_first_name }}" />
					</div>
					<div class="large-4 columns">
						<label for="mother_middle_name">Middle Name:</label>
						<input type="text" id="mother_middle_name" name="mother_middle_name" placeholder="Middle Name" value="{{ $mother_middle_name }}" />
					</div>
					<div class="large-4 columns">
						<label for="mother_last_name">Last Name:</label>
						<input type="text" id="mother_last_name" name="mother_last_name" placeholder="Last Name" value="{{ $mother_last_name }}" />
					</div>
				</div>
			</fieldset>

			<fieldset>
		    	<legend>Basic Information</legend>
				<div class="row">
					<div class="large-4 columns">
						<label for="male">Sex:</label>
						<input id="male" name="gender" type="radio" value="male" /><label for="male">Male</label>
						<input id="female" name="gender" type="radio" value="female" /><label for="female">Female</label><br/>
					</div>

					<div class="large-8 columns">
						<label for="male">Civil Status:</label>
						<input id="single" name="civil_status" type="radio" value="single" />
						<label for="single">Single</label>
						<input id="married" name="civil_status" type="radio" value="married" />
						<label for="married">Married</label>
						<input id="separated" name="civil_status" type="radio" value="separated" />
						<label for="separated">Separated</label>
						<input id="widowed" name="civil_status" type="radio" value="widowed" />
						<label for="widowed">Widowed</label>
					</div>

					<div class="large-4 columns">
						<label for="date_of_birth">Date of Birth:</label>
						<input type="text" id="birth_date" class="fdatepicker" name="birth_date" placeholder="Date of Birth" value="{{ $birth_date }}" readonly="readonly" />
					</div>

					<div class="large-2 columns">
						<label>Age:</label>
						<input type="text" id="age" name="age" placeholder="Age" value="{{ $age }}" readonly="readonly" />
					</div>

					<div class="large-4 columns">&nbsp;</div>

					<div class="large-4 columns">&nbsp;</div>
				</div>
				
				<div class="row">
					<div class="large-12 columns">
						<label for="contact_number">Contact Number:</label>
						<input type="text" id="contact_number" name="contact_number" placeholder="Contact Number" value="{{ $contact_number }}" />
					</div>
					<div class="large-12 columns">
						<label for="philheath_number">Philhealth Number:</label>
						<input type="text" id="philheath_number" name="philheath_number" placeholder="Philhealth Number" value="{{ $philheath_number }}" />
					</div>
				</div>

			</fieldset>

			<fieldset>
	    		<legend>Place of Birth</legend>
				<div class="row">
					<div class="large-12 columns">
						<label for="street">City:</label>
						<input type="text" id="birth_place_city" name="birth_place_city" placeholder="City" value="{{ $birth_place_city }}" />
					</div>
					<div class="large-12 columns">
						<label for="barangay">Province:</label>
						<input type="text" id="birth_place_province" name="birth_place_province" placeholder="Province" value="{{ $birth_place_province }}" />
					</div>
				</div>
			</fieldset>

			<fieldset>
	    		<legend>Address</legend>
				<div class="row">
					<div class="large-12 columns">
						<label for="street">Street:</label>
						<input type="text" id="street" name="street" placeholder="Street" value="{{ $street }}" />
					</div>
					<div class="large-12 columns">
						<label for="purok">Purok/Avenue:</label>
						<input type="text" id="purok" name="purok" placeholder="Purok" value="{{ $purok }}" />
					</div>
					<div class="large-12 columns">
						<label for="barangay">Barangay:</label>
						<input type="text" id="barangay" name="barangay" placeholder="Barangay" value="{{ $barangay }}" />
					</div>
					<div class="large-12 columns">
						<label for="city">City:</label>
						<input type="text" id="city" name="city" placeholder="City" value="{{ $city }}" />
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>HIV Risks</legend>
				<div class="row">
					<div class="large-6 columns">
						<label for="blood_transfusion">
							<input type="checkbox" id="blood_transfusion" name="blood_transfusion" value="1" {{ ($blood_transfusion == 1)? 'checked="checked"' : '' }} /> 
							Blood Transfusion(BT) Recipient
						</label>
						<label for="injecting_drug_user">
							<input type="checkbox" id="injecting_drug_user" name="injecting_drug_user" value="1" {{ ($injecting_drug_user == 1)? 'checked="checked"' : '' }} /> 
							Injecting Drug User(IDU)
						</label>
						<label for="substance_abuse">
							<input type="checkbox" id="substance_abuse" name="substance_abuse" value="1" {{ ($substance_abuse == 1)? 'checked="checked"' : '' }} /> 
							Substance Abuse
						</label>
						<label for="occupational_exposure">
							<input type="checkbox" id="occupational_exposure" name="occupational_exposure" value="1" {{ ($occupational_exposure == 1)? 'checked="checked"' : '' }} /> 
							Occupational Exposure(OE)
						</label>
						<!-- disable if occupational_exposure -->
						<div class="occupational_exposure_selection">
							<label for="provided_post_exposure_prophylaxis_yes">Provided Post Exposure Prophylaxis</label>
							<input type="radio" id="provided_post_exposure_prophylaxis_yes" name="provided_post_exposure_prophylaxis" value="1" {{ ($provided_post_exposure_prophylaxis == 1)? 'checked="checked"' : '' }} /> 
							<label for="provided_post_exposure_prophylaxis_yes">YES</label>
							<input type="radio" id="provided_post_exposure_prophylaxis_no" name="provided_post_exposure_prophylaxis" value="1" {{ ($provided_post_exposure_prophylaxis == 0)? 'checked="checked"' : '' }} /> 
							<label for="provided_post_exposure_prophylaxis_no">NO</label>
						</div>
						<!--  -->
					</div>
					<div class="large-6 columns">
						<label for="sexually_transmitted_infections">
							<input type="checkbox" id="sexually_transmitted_infections" name="sexually_transmitted_infections" value="1" {{ ($sexually_transmitted_infections == 1)? 'checked="checked"' : '' }} /> 
							Sexually Transmitted Infections(STI)
						</label>
						<label for="multiple_sexual_partners">
							<input type="checkbox" id="multiple_sexual_partners" name="multiple_sexual_partners" value="1" {{ ($multiple_sexual_partners == 1)? 'checked="checked"' : '' }} /> 
							Multiple Sexual Partners
						</label>
						<label for="male_sex_with_other_male">
							<input type="checkbox" id="male_sex_with_other_male" name="male_sex_with_other_male" value="1" {{ ($male_sex_with_other_male == 1)? 'checked="checked"' : '' }} /> 
							Male having Sex with other Males(MSM)
						</label>
						<label for="sex_worker_client">
							<input type="checkbox" id="sex_worker_client" name="sex_worker_client" value="1" {{ ($sex_worker_client == 1)? 'checked="checked"' : '' }} /> 
							Client of a Sex Worker
						</label>
						<label for="sex_worker">
							<input type="checkbox" id="sex_worker" name="sex_worker" value="1" {{ ($sex_worker == 1)? 'checked="checked"' : '' }} /> 
							Sex Worker
						</label>
						<label for="child_of_hiv_infected_mother">
							<input type="checkbox" id="child_of_hiv_infected_mother" name="child_of_hiv_infected_mother" value="1" {{ ($child_of_hiv_infected_mother == 1)? 'checked="checked"' : '' }} /> 
							Child of HIV Infected Mother
						</label>
					</div>
					<div class="large-12 columns">
						<label for="hiv_risk_others">Others</label>
						<input type="text" id="hiv_risk_others" name="hiv_risk_others" value="{{ $hiv_risk_others }}" />
					</div>
				</div>
			</fieldset>
				
			<fieldset>
				<legend>Attending Physician</legend>
				<div class="row">
					<div class="large-5 columns">
						<div class="row collapse">
							<div class="small-10 columns">
								<input type="text" id="search_physician" name="search_physician" placeholder="Search Patient" value="{{ $search_physician }}">
						<input type="hidden" id="attending_physician" name="attending_physician" value="{{ $attending_physician }}" />
						<input type="hidden" id="search_physician_url" name="search_physician_url" value="{{ route('search_physician') }}" />
							</div>
					    	<div class="small-2 columns">
					      		<span class="postfix"><i class="fa fa-search"></i></span>
					    	</div>
						</div>
					</div>
					<div class="large-3 columns">&nbsp;</div>
					<div class="large-4 columns">&nbsp;</div>
				</div>
			</fieldset><br/>

			<div class="row">
				<div class="large-4 columns">&nbsp;</div>
				<div class="large-4 columns">
					<div class="row">
						<div class="large-3 columns">&nbsp;</div>
						<div class="large-6 columns">
							<input type="hidden" name="ui_code" value="" />
							{!! csrf_field() !!}
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
// gender
if($gender == "male")
{
	echo '$(\'#male\').prop(\'checked\', true).change();';
}
elseif($gender == "female")
{
	echo '$(\'#female\').prop(\'checked\', true).change();';
}
//	civil status
if($civil_status == "single")
{
	echo '$(\'#single\').prop(\'checked\', true).change();';
}
else if($civil_status == "married")
{
	echo '$(\'#married\').prop(\'checked\', true).change();';
}
else if($civil_status == "separated")
{
	echo '$(\'#separated\').prop(\'checked\', true).change();';
}
else if($civil_status == "widowed")
{
	echo '$(\'#widowed\').prop(\'checked\', true).change();';
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

var xhr_patient_search = null;
var xhr_patient_record = null;
$(function(){
    $("#search_patient").autocomplete({
        source: function (request, response) 
        {
            xhr_patient_search = $.ajax({
                type : 'get',
                url : $("#search_patient_url").val(),
                data : 'search_patient=' + request.term,
                cache : false,
                dataType : "json",
                beforeSend: function(xhr) 
                {
                    if (xhr_patient_search != null)
                    {
                        xhr_patient_search.abort();
                    }
                }
            }).done(function(data){
                response($.map( data, function(value, key) 
                {
                    return { label: value, value: key }
                }));

            }).fail(function(jqXHR, textStatus){
                //console.log('Request failed: ' + textStatus);
            });
        }, 
        minLength: 2,
        autoFocus: true,
        select: function(a, b)
        {
            var id = b.item.value;
            var name = b.item.label;

            $('#vct_id').val(id);
            $('#search_patient').val(name).focus();
            //alert(id);

            xhr_patient_record = $.ajax({
                type : 'get',
                url : $("#vct_record_url").val(),
                data : 'vct_record_id=' + id,
                cache : false,
                dataType : "json",
                beforeSend: function(xhr) 
                {
                    if (xhr_patient_search != null)
                    {
                        xhr_patient_search.abort();
                    }
                }
            }).done(function(data){
                //console.log(data['first_name']);
                $('#first_name').val(data['first_name']);
                $('#last_name').val(data['last_name']);
                $('#middle_name').val(data['middle_name']);

                var ui_code = data['ui_code'].split('-');
                $('#uic_mother_name').val(ui_code[0]);
                $('#uic_father_name').val(ui_code[1]);
                $('#uic_birth_order').val(ui_code[2]);

                //console.log(data['first_name']);
                $('#mother_first_name').val(data['mother_first_name']);
                $('#mother_last_name').val(data['mother_last_name']);
                $('#mother_middle_name').val(data['mother_middle_name']);

                $('#birth_date').val(data['birth_date']);
                $('#age').val(getAge(data['birth_date']));

                $('#contact_number').val(data['contact_number']);

                $('#contact_number').val(data['contact_number']);

                $('#street').val(data['street']);
                $('#barangay').val(data['brgy']);
                $('#purok').val(data['sitio']);
                $('#city').val(data['city']);

                // Gender
                if(data['gender'].toLowerCase() == "male")
                {
                    $('#male').prop('checked', true);
                }
                else if(data['gender'].toLowerCase() == "female")
                {
                    $('#female').prop('checked', true);
                }

                // Blood Transfusion
                if(data['blood_transfusion'] == 1)
                {
                    $('#blood_transfusion').prop('checked', true);
                }
                else
                {
                    $('#blood_transfusion').prop('checked', false);
                }

                // Injecting Drug User
                if(data['injecting_drug_user'] == 1)
                {
                    $('#injecting_drug_user').prop('checked', true);
                }
                else
                {
                    $('#injecting_drug_user').prop('checked', false);
                }

                // Substance Abuse
                if(data['substance_abuse'] == 1)
                {
                    $('#substance_abuse').prop('checked', true);
                }
                else
                {
                    $('#substance_abuse').prop('checked', false);
                }

                // Occupational Exposure
                if(data['occupational_exposure'] == 1)
                {
                    $('#occupational_exposure').prop('checked', true);

                    $('.occupational_exposure_selection').show();

                     // Provided post exposure prophylaxis
                    if(data['provided_post_exposure_prophylaxis'] == 1)
                    {
                        $('#provided_post_exposure_prophylaxis_yes').prop('checked', true);
                    }
                    else
                    {
                        $('#provided_post_exposure_prophylaxis_no').prop('checked', true);
                    }
                }
                else
                {
                    $('#occupational_exposure').prop('checked', false);
                    $('.occupational_exposure_selection').hide();
                }

                // sexually transmitted infections
                if(data['sexually_transmitted_infections'] == 1)
                {
                    $('#sexually_transmitted_infections').prop('checked', true);
                }
                else
                {
                    $('#sexually_transmitted_infections').prop('checked', false);
                }

                // multiple sexual partners
                if(data['multiple_sexual_partners'] == 1)
                {
                    $('#multiple_sexual_partners').prop('checked', true);
                }
                else
                {
                    $('#multiple_sexual_partners').prop('checked', true);
                }

                // male sex with other male
                if(data['male_sex_with_other_male'] == 1)
                {
                    $('#male_sex_with_other_male').prop('checked', true);
                }
                else
                {
                    $('#male_sex_with_other_male').prop('checked', false);
                }

                // sex worker client
                if(data['sex_worker_client'] == 1)
                {
                    $('#sex_worker_client').prop('checked', true);
                }
                else
                {
                    $('#sex_worker_client').prop('checked', false);
                }

                // sex worker
                if(data['sex_worker'] == 1)
                {
                    $('#sex_worker').prop('checked', true);
                }
                else
                {
                    $('#sex_worker').prop('checked', false);
                }

                // child of hiv infected_mother
                if(data['child_of_hiv_infected_mother'] == 1)
                {
                    $('#child_of_hiv_infected_mother').prop('checked', true);
                }
                else
                {
                    $('#child_of_hiv_infected_mother').prop('checked', false);
                }

            }).fail(function(jqXHR, textStatus){
                //console.log('Request failed: ' + textStatus);
            });

            return false;
        }
    });
});
</script>
@endsection
@extends('hact.layouts.layout_admin')

@section('content')

<div class='row'>
	<div class='large-12 columns'>
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('patient') }}">Patient</a></li>
			<li><a href="{{ route('patient_profile',$patient_id) }}">{{ $search_patient  }}</a></li>
			<li><a href="{{ route('patient_profile',$patient_id) . "#tab3" }}">VCT (Voluntary Counseling and Testing)</a></li>
			<li class="current"><a href="#">{{ $page }}</a></li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="large-12 column">
		@include("hact.messages.success")
		@if(count($errors) > 0)
			<div class="alert-box alert ">Error: Highlight fields are required!</div>
		@endif
		{{--@include("hact.messages.error_list")--}}
	</div>
</div>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<div class="custom-panel-heading">
			<span>{{ $page }} VCT</span>
			<a href="{{ route('patient_profile',$patient_id) }}" class="alert tiny button right" title="Cancel Checkup"><i class="fi fi-x"></i> Cancel</a>
		</div>
		<div class="custom-panel-details">
			<form action="{{ $action }}" method="post">
				<fieldset>
					<legend>Voluntary Counseling Testing</legend>
					<div class="row">
						<div class="large-4 columns">
							<label for="search_patient">Patient</label>
							<div class="row collapse">
								<div class="small-10 columns">
									<input type="text" id="search_patient" name="search_patient" value="{{ $search_patient }}" readonly />
									<input type="hidden" id="patient_id" name="patient_id" value="{{ $patient_id }}" />
									<input type="hidden" id="gender" name="gender" value="{{ $gender }}" />
									<input type="hidden" id="age" name="age" value="{{ $age }}" />
									<input type="hidden" id="is_pregnant" name="is_pregnant" value="{{ $is_pregnant }}" />
									<input type="hidden" id="search_patient_url" name="search_patient_url" value="{{ route('patient_search') }}" />
									<input type="hidden" id="patient_record_url" name="patient_record_url" value="{{ route('patient_record') }}" />
								</div>
								<div class="small-2 columns">
									<span class="postfix"><i class="fa fa-search"></i></span>
								</div>
							</div>
						</div>
						<div class="large-4 columns">
							<label for="vct_date">VCT Date</label>
							<input type="text" id="vct_date" name="vct_date" value="{{ $vct_date != ""? Carbon\Carbon::parse($vct_date)->format('m/d/Y'):"" }}" class="{{ ($errors->has('vct_date')) ? 'highlight_error' : '' }} fdatepicker" readonly />
						</div>
						<div class="large-4 columns">&nbsp;</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>Reason for HIV Testing: (check all that apply)</legend>
					<div class="row">
						<div class="large-4 columns">
							<input type="checkbox" id="reason_1" name="reason_1" value="1"><label for="reason_1"> Mother is infected with HIV</label>
						</div>
						@if($gender == 0)
							<div class="large-4 columns">
						@else
							<div class="large-8 columns">
						@endif
								<input type="checkbox" id="reason_6" name="reason_6" value="1"><label for="reason_6"> Required for insurance</label>
							</div>
						@if($gender == 0)
						<div class="large-4 columns">
							<input type="checkbox" id="reason_11" name="reason_11" value="1"><label for="reason_11"> Pregnant</label>
						</div>
						@endif

					</div>
					<div class="row">
						<div class="large-4 columns">
							<input type="checkbox" id="reason_2" name="reason_2" value="1"><label for="reason_2"> Sex partner is infected with HIV</label>
						</div>
						<div class="large-4 columns">
							<input type="checkbox" id="reason_7" name="reason_7" value="1"><label for="reason_7"> Received blood transfusion</label>
						</div>
						<div class="large-4 columns">
							<input type="checkbox" id="reason_12" name="reason_12" value="1"><label for="reason_12"> TB Patient</label>
						</div>
					</div>
					<div class="row">
						<div class="large-4 columns">
							<input type="checkbox" id="reason_3" name="reason_3" value="1"><label for="reason_3"> Shared needles/syringes with IDUs</label>
						</div>
						<div class="large-4 columns">
							<input type="checkbox" id="reason_8" name="reason_8" value="1"><label for="reason_8"> Re-check previous HIV test result</label>
						</div>
						<div class="large-4 columns">
							<input type="checkbox" id="reason_13" name="reason_13" value="1"><label for="reason_13"> Patient is infected with Hepatitis B/C</label>
						</div>
					</div>
					<div class="row">
						<div class="large-4 columns">
							<input type="checkbox" id="reason_4" name="reason_4" value="1"><label for="reason_4"> Accidental needle prick</label>
						</div>
						<div class="large-4 columns">
							<input type="checkbox" id="reason_9" name="reason_9" value="1"><label for="reason_9"> Employment - Local/In the Philippines</label>
						</div>
						<div class="large-4 columns">
							<input type="checkbox" id="reason_14" name="reason_14" value="1"><label for="reason_14">No particular reason</label>
						</div>
					</div>
					<div class="row">
						<div class="large-4 columns">
							<input type="checkbox" id="reason_5" name="reason_5" value="1"><label for="reason_5"> Recommended by physician</label>
						</div>
						<div class="large-4 columns">
							<input type="checkbox" id="reason_10" name="reason_10" value="1"><label for="reason_10"> Employment = Overseas/Abroad</label>
						</div>
						<div class="large-4 columns">
							<input type="checkbox" id="reason_15" name="reason_15" value="1"><label for="reason_15"> Other (pls specify):</label>
							<input type="text" id="reason_other" name="reason_other" class="{{ ($errors->has('reason_other')) ? 'highlight_error' : '' }}" readonly>
						</div>
					</div>
				</fieldset>



				<fieldset>
					<legend>History of Exposure</legend>
					<div class="row">
						<div class="large-6 columns">
							<label for="infected_mother_no">Was your MOTHER infected with HIV when you were born?</label>
						</div>
						<div class="large-6 columns">
							<input type="radio" id="infected_mother_no" name="is_your_mother_infected_with_hiv" value="0" @if($is_your_mother_infected_with_hiv == '0') checked @endif><label for="infected_mother_no"> No</label>
							<input type="radio" id="infected_mother_yes" name="is_your_mother_infected_with_hiv" value="1" @if($is_your_mother_infected_with_hiv == '1') checked @endif><label for="infected_mother_yes"> Yes</label>
						</div>
					</div>
					<hr />
					<div class="row">
						<div class="large-6 columns">
							<p>Answer all. Have you experienced any of the following?</p>
						</div>
						<div class="large-6 columns">
							<p>(If yes, state the MOST RECENT year)</p>
						</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<div class="row">
								<div class="large-7 columns">
									<label for="experience1_no">Received blood transfusion?</label>
								</div>
								<div class="large-5 columns">
									<input type="radio" id="experience1_no" name="experience1"  value="0"><label for="experience1_no"> No</label>
									<input type="radio" id="experience1_yes" name="experience1" value="1" ><label for="experience1_yes"> Yes</label>
								</div>
							</div>
						</div>
						<div class="large-2 columns">
							<input type="text" id="experience_1_if_yes_what_year" name="experience_1_if_yes_what_year" class="{{ ($errors->has('experience_1_if_yes_what_year')) ? 'highlight_error' : '' }}" placeholder="What Year?">
						</div>
						<div class="large-4 columns">&nbsp;</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<div class="row">
								<div class="large-7 columns">
									<label for="experience2_no"> Injected drugs without doctor's advice</label>
								</div>
								<div class="large-5 columns">
									<input type="radio" id="experience2_no" name="experience2"  value="0"><label for="experience2_no"> No</label>
									<input type="radio" id="experience2_yes" name="experience2" value="1" ><label for="experience2_yes"> Yes</label>
								</div>
							</div>
						</div>
						<div class="large-2 columns">
							<input type="text" id="experience_2_if_yes_what_year" name="experience_2_if_yes_what_year" class="{{ ($errors->has('experience_2_if_yes_what_year')) ? 'highlight_error' : '' }}" placeholder="What Year?">
						</div>
						<div class="large-4 columns">&nbsp;</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<div class="row">
								<div class="large-7 columns">
									<label for="experience3_no">Accidental needle prick</label>
								</div>
								<div class="large-5 columns">
									<input type="radio" id="experience3_no" name="experience3"  value="0"><label for="experience3_no"> No</label>
									<input type="radio" id="experience3_yes" name="experience3" value="1" ><label for="experience3_yes"> Yes</label>
								</div>
							</div>
						</div>
						<div class="large-2 columns">
							<input type="text" id="experience_3_if_yes_what_year" name="experience_3_if_yes_what_year" class="{{ ($errors->has('experience_3_if_yes_what_year')) ? 'highlight_error' : '' }}" placeholder="What Year?">
						</div>
						<div class="large-4 columns">&nbsp;</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<div class="row">
								<div class="large-7 columns">
									<label for="experience4_no">Sexually transmitted infections (STI)</label>
								</div>
								<div class="large-5 columns">
									<input type="radio" id="experience4_no" name="experience4"  value="0"><label for="experience4_no"> No</label>
									<input type="radio" id="experience4_yes" name="experience4" value="1" ><label for="experience4_yes"> Yes</label>
								</div>
							</div>
						</div>
						<div class="large-2 columns">
							<input type="text" id="experience_4_if_yes_what_year" name="experience_4_if_yes_what_year" class="{{ ($errors->has('experience_4_if_yes_what_year')) ? 'highlight_error' : '' }}" placeholder="What Year?">
						</div>
						<div class="large-4 columns">&nbsp;</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<div class="row">
								<div class="large-7 columns">
									<label for="experience5_no">Sex with <b>female</b> with no condom</label>
								</div>
								<div class="large-5 columns">
									<input type="radio" id="experience5_no" name="experience5"  value="0"><label for="experience5_no"> No</label>
									<input type="radio" id="experience5_yes" name="experience5" value="1" ><label for="experience5_yes"> Yes</label>
								</div>
							</div>
						</div>
						<div class="large-2 columns">
							<input type="text" id="experience_5_if_yes_what_year" name="experience_5_if_yes_what_year" class="{{ ($errors->has('experience_5_if_yes_what_year')) ? 'highlight_error' : '' }}" placeholder="What Year?" >
						</div>
						<div class="large-4 columns">&nbsp;</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<div class="row">
								<div class="large-7 columns">
									<label for="experience6_no">Sex with <b>male</b> with no condom</label>
								</div>
								<div class="large-5 columns">
									<input type="radio" id="experience6_no" name="experience6"  value="0"><label for="experience6_no"> No</label>
									<input type="radio" id="experience6_yes" name="experience6" value="1" ><label for="experience6_yes"> Yes</label>
								</div>
							</div>
						</div>
						<div class="large-2 columns">
							<input type="text" id="experience_6_if_yes_what_year" name="experience_6_if_yes_what_year" class="{{ ($errors->has('experience_6_if_yes_what_year')) ? 'highlight_error' : '' }}" placeholder="What Year?">
						</div>
						<div class="large-4 columns">&nbsp;</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<div class="row">
								<div class="large-7 columns">
									<label for="experience7_no">Sex with a person in prostitution</label>
								</div>
								<div class="large-5 columns">
									<input type="radio" id="experience7_no" name="experience7"  value="0" ><label for="experience7_no"> No</label>
									<input type="radio" id="experience7_yes" name="experience7" value="1" ><label for="experience7_yes"> Yes</label>
								</div>
							</div>
						</div>
						<div class="large-2 columns">
							<input type="text" id="experience_7_if_yes_what_year" name="experience_7_if_yes_what_year" class="{{ ($errors->has('experience_7_if_yes_what_year')) ? 'highlight_error' : '' }}" placeholder="What Year?">
						</div>
						<div class="large-4 columns">&nbsp;</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<div class="row">
								<div class="large-7 columns">
									<label for="experience7_no">Regularly accept payment for sex</label>
								</div>
								<div class="large-5 columns">
									<input type="radio" id="experience8_no" name="experience8"  value="0" ><label for="experience8_no"> No</label>
									<input type="radio" id="experience8_yes" name="experience8" value="1" ><label for="experience8_yes"> Yes</label>
								</div>
							</div>
						</div>
						<div class="large-2 columns">
							<input type="text" id="experience_8_if_yes_what_year" name="experience_8_if_yes_what_year" class="{{ ($errors->has('experience_8_if_yes_what_year')) ? 'highlight_error' : '' }}" placeholder="What Year?">
						</div>
						<div class="large-4 columns">&nbsp;</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Sexual Partners</legend>
					<div class="row">
						<div class="large-4 columns">
							<label for="number_of_female">Number of past female sex partners:</label>
							<input type="number" min="1" id="number_of_female" name="number_of_female" value="{{ ($number_of_female == 0)? '': $number_of_female}}" placeholder="Leave blank if none">
						</div>
						<div class="large-2 columns">&nbsp;</div>
						<div class="large-3 columns">
							<label for="last_year_sex_female">Year of last sex with a female:</label>
							<input type="text" id="last_year_sex_female" name="last_year_sex_female" class="{{ ($errors->has('last_year_sex_female')) ? 'highlight_error' : '' }}" value="{{ ($number_of_female == 0)? '' : $last_year_sex_female }}">
						</div>
						<div class="large-3 columns">&nbsp;</div>
					</div>
					<div class="row">
						<div class="large-4 columns">
							<label for="number_of_male">Number of past male sex partners:</label>
							<input type="number" min="1" id="number_of_male" name="number_of_male" value="{{ ($number_of_male == 0)? '' : $number_of_male }}"  placeholder="Leave blank if none">
						</div>
						<div class="large-2 columns">&nbsp;</div>
						<div class="large-3 columns">
							<label for="last_year_sex_male">Year of last sex with a male:</label>
							<input type="text" id="last_year_sex_male" name="last_year_sex_male" class="{{ ($errors->has('last_year_sex_male')) ? 'highlight_error' : '' }}" value="{{ ($number_of_male == 0)? '' : $last_year_sex_male }}">
						</div>
						<div class="large-3 columns">&nbsp;</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>HIV Testing</legend>
					<div class="row">
						<div class="large-4 columns">
							<label for="tested_no">Have you ever been tested for HIV before?</label>
							<input type="radio" id="tested_yes" name="been_tested_for_hiv_before" value="1"><label for="tested_yes"> Yes</label>
							<input type="radio" id="tested_no" name="been_tested_for_hiv_before" value="0"><label for="tested_no"> No</label>
						</div>
						<div class="large-2 columns">&nbsp;</div>
						<div class="large-2 columns">
							<label for="tested_month">Recent Test:</label>
							<input type="text" id="tested_month" name="been_tested_for_hiv_before_month" class="{{ ($errors->has('been_tested_for_hiv_before_month')) ? 'highlight_error' : '' }}" value="{{ $been_tested_for_hiv_before_month }}" placeholder="Month">
						</div>
						<div class="large-2 columns">
							<label>&nbsp;</label>
							<input type="text" id="tested_year" name="been_tested_for_hiv_before_year" class="{{ ($errors->has('been_tested_for_hiv_before_year')) ? 'highlight_error' : '' }}" value="{{ $been_tested_for_hiv_before_year }}" placeholder="Year">
						</div>
						<div class="large-2 columns">&nbsp;</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<label for="which_testing_facility">Testing Facility:</label>
							<input type="text" id="which_testing_facility" name="which_testing_facility" value="{{ $which_testing_facility }}">
						</div>
						<div class="large-6 columns">
							<label for="which_testing_facility_city">Municipality/City:</label>
							<input type="text" id="which_testing_facility_city" name="which_testing_facility_city" value="{{ $which_testing_facility_city }}">
						</div>
					</div>
				</fieldset>

				<!-- Pregnancy History -->

				<fieldset class="pregnancy_history">
					<legend>Pregnancy History</legend>
					<div class="row">
						<div class="large-6 columns">
							<div class="row">
								<div class="large-6 column">
									<label for="children_alive">Number of Alive Children:</label>
									<input id="children_alive" min="1" name="children_alive" type="number" value="" autocomplete="off" placeholder="Leave blank if none">
								</div>
								<div class="large-6 column">&nbsp;</div>
							</div>
							<div class="row">
								<div class="large-6 column">
									<label for="last_period">Last Menstrual Period</label>
									<input id="last_period" name="last_period" type="text" value="" class="fdatepicker {{ ($errors->has('last_period')) ? 'highlight_error' : '' }}" readonly>
								</div>
								<div class="large-6 column">&nbsp;</div>
							</div>
							<div class="row">
								<div class="large-12 column">
									<label for="months_pregnant">Number of months and weeks pregnant</label>
									<div class="row">
										<div class="large-3 column">
											<input id="months_pregnant" min="0" name="months_pregnant" type="number" value="" class="{{ ($errors->has('months_pregnant')) ? 'highlight_error' : '' }}" placeholder="Months">
										</div>
										<div class="large-3 column">
											<input id="weeks_pregnant" min="0" name="weeks_pregnant" type="number" value="" class="{{ ($errors->has('weeks_pregnant')) ? 'highlight_error' : '' }}" placeholder="Weeks">
										</div>
										<div class="large-6 column">&nbsp;</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="large-6 column">
									<label for="delivery_date">Expected Date of Delivery</label>
									<input id="delivery_date" name="delivery_date" type="text" class="fdatepicker {{ ($errors->has('delivery_date')) ? 'highlight_error' : '' }}" value="" readonly>
								</div>
								<div class="large-6 column">&nbsp;</div>
							</div>
							<div class="row">
								<div class="large-12 column">
									<label for="where_prenatal_care">Where do you seek prenatal care?</label>
									<div class="row">
										<div class="large-6 columns">
											<label for="where_prenatal_care_no"><input type="checkbox" id="where_prenatal_care_no" name="where_prenatal_care_no" value="0"> No prenatal clinic visit</label>
										</div>
										<div class="large-6 columns">
											<input id="where_prenatal_care" name="where_prenatal_care" type="text" value="" class="{{ ($errors->has('where_prenatal_care')) ? 'highlight_error' : '' }}">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="large-12 column">
									<label for="plan_to_deliver_baby">Where do you plan to deliver the baby?</label>
									<div class="row">
										<div class="large-6 columns">
											<select id="plan_to_deliver_baby" name="plan_to_deliver_baby" class="{{ ($errors->has('plan_to_deliver_baby')) ? 'highlight_error' : '' }}">
												<option value="">--Please Select--</option>
												<option value="1">Home</option>
												<option value="2">Lying-in Clinic</option>
												<option value="3">Hospital</option>
												<option value="4">No plans yet</option>
												<option value="5">Others</option>
											</select>
										</div>
										<div class="large-6 columns">
											<input type="text" placeholder="Please Specify" name="plan_to_deliver_baby_specify" id="plan_to_deliver_baby_specify" class="{{ ($errors->has('plan_to_deliver_baby_specify')) ? 'highlight_error' : '' }}" value="" readonly>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="large-7 columns {{ ($errors->has('partner_hiv_tested')) ? 'highlight_error' : '' }}">
									<label for="partner_hiv_tested">Partner tested for HIV?</label>
									<input type="radio" id="partner_hiv_tested_yes" name="partner_hiv_tested" value="1"><label for="partner_hiv_tested_yes">Yes</label>
									<input type="radio" id="partner_hiv_tested_no" name="partner_hiv_tested" value="0"><label for="partner_hiv_tested_no">No</label>
									<input type="radio" id="partner_hiv_tested_dont_know" name="partner_hiv_tested" value="2"><label for="partner_hiv_tested_dont_know">Don't Know</label>
								</div>
								<div class="large-5 columns">&nbsp;</div>
							</div>
						</div>


						<div class="large-6 columns">
							<fieldset>
								<legend>Children HIV Testing Status</legend>
								<div class="row">
									<div class="large-4 columns">HIV Status</div>
									<div class="large-4 columns">Place Tested</div>
									<div class="large-4 columns">Date Tested</div>
								</div>
								<div id="children_row" class="row"></div>
							</fieldset>
						</div>
					</div>

					<div class="row partner_hiv_tested_yes_row">
						<div class="large-3 columns">
							<label for="partner_hiv_tested_when">When?</label>
							<input type="text" id="partner_hiv_tested_when" name="partner_hiv_tested_when" class="fdatepicker" readonly>
						</div>
						<div class="large-6 columns">
							<label for="partner_hiv_tested_facility">Facility</label>
							<input type="text" id="partner_hiv_tested_facility" name="partner_hiv_tested_facility">
						</div>
						<div class="large-3 columns">
							<label for="partner_hiv_tested_result">Result</label>
							<select id="partner_hiv_tested_result" name="partner_hiv_tested_result">
								<option value="">--Please Select--</option>
								<option value="1">Positive</option>
								<option value="2">Negative</option>
								<option value="3">Don't Know</option>
								<option value="4">Did not get result</option>
							</select>
						</div>
					</div>

					<div class="row partner_hiv_tested_yes_row">
						<div class="large-4 columns">
							<label for="partner_taking_arv">Partner taking ARV medication/s?</label>
							<select id="partner_taking_arv" name="partner_taking_arv">
								<option value="">--Please Select--</option>
								<option value="1">Positive</option>
								<option value="2">Negative</option>
								<option value="3">Don't Know</option>
								<option value="4">Stopped</option>
							</select>
						</div>
						<div class="large-8 columns">
							<label for="partner_taking_arv_stopped_reason">Reason</label>
							<input type="text" id="partner_taking_arv_stopped_reason" name="partner_taking_arv_stopped_reason">
						</div>
					</div>
				</fieldset>

				<!-- Mother's HIV History -->

				<fieldset class="mother_hiv_history">
					<legend>Mother's HIV History</legend>
					<div class="row">
						<div class="large-3 columns">
							<label for="mother_hiv_status">HIV Status of Mother?</label>
							<select id="mother_hiv_status" name="mother_hiv_status" class="{{ ($errors->has('mother_hiv_status')) ? 'highlight_error' : '' }}">
								<option value="">--Please Select--</option>
								<option value="1" {{ ($mother_hiv_status == 1)? 'selected="selected"': '' }}>Positive</option>
								<option value="2" {{ ($mother_hiv_status == 2)? 'selected="selected"': '' }}>Negative</option>
								<option value="3" {{ ($mother_hiv_status == 3)? 'selected="selected"': '' }}>Don't Know</option>
							</select>
						</div>
						<div class="large-9 columns">&nbsp;</div>
					</div>
					<div class="row">
						<div class="large-3 columns">
							<label for="hiv_diagnosis">Date of HIV diagnosis</label>
							<input type="text" name="hiv_diagnosis" id="hiv_diagnosis" value="{{ $hiv_diagnosis }}" class="fdatepicker {{ ($errors->has('hiv_diagnosis')) ? 'highlight_error' : '' }}" readonly />
						</div>
						<div class="large-4 columns">
							<label for="mother_saccl">Mother SACCL Number</label>
							<input type="text" name="mother_saccl" value="{{ $mother_saccl }}" id="mother_saccl" />
						</div>
						<div class="large-5 columns">&nbsp;</div>
					</div>
					<div class="row">
						<div class="large-5 columns">
							<label for="mother_arv_pregnancy">Mother took ARV medication/s during pregnancy?</label>
							<input type="radio" id="mother_arv_pregnancy_yes" name="mother_arv_pregnancy" value="1" {{ ($mother_arv_pregnancy == 1)? 'checked="checked"' : '' }} ><label for="mother_arv_pregnancy_yes">Yes</label>
							<input type="radio" id="mother_arv_pregnancy_no" name="mother_arv_pregnancy" value="0" {{ ($mother_arv_pregnancy == 0)? 'checked="checked"' : '' }}><label for="mother_arv_pregnancy_no">No</label>
							<input type="radio" id="mother_arv_pregnancy_dont_know" name="mother_arv_pregnancy" value="2" {{ ($mother_arv_pregnancy == 2)? 'checked="checked"' : '' }}><label for="mother_arv_pregnancy_dont_know">Don't Know</label>
						</div>
						<div class="large-7 columns">
							<label for="mother_arv_pregnancy_reason">Reason</label>
							<input type="text" name="mother_arv_pregnancy_reason" id="mother_arv_pregnancy_reason" value=" {{ $mother_arv_pregnancy_reason }} " class="{{ ($errors->has('mother_arv_pregnancy_reason')) ? 'highlight_error' : '' }}" />
						</div>
					</div>
					<div class="row">
						<div class="large-4 columns {{ ($errors->has('she_breastfeed_baby')) ? 'highlight_error' : '' }}">
							<label for="she_breastfeed_baby">Did she breastfeed the baby?</label>
							<input type="radio" name="she_breastfeed_baby" id="she_breastfeed_baby_yes" value="1" {{ ($she_breastfeed_baby == 1) ? 'checked="checked"' : '' }} /><label for="she_breastfeed_baby_yes">Yes</label>
							<input type="radio" name="she_breastfeed_baby" id="she_breastfeed_baby_no" value="0" {{ ($she_breastfeed_baby == 0) ? 'checked="checked"' : '' }}/><label for="she_breastfeed_baby_no">No</label>
						</div>
						<div class="large-8 columns">&nbsp;</div>
					</div>
					<div class="row">
						<div class="large-3 columns {{ ($errors->has('is_mother_alive_or_dead')) ? 'highlight_error' : '' }}">
							<label for="is_mother_alive_or_dead">Is mother alive or dead?</label>
							<input type="radio" name="is_mother_alive_or_dead" id="mother_is_alive" value="1" {{ ($is_mother_alive_or_dead == 1)? 'checked="checked"' : ''}} /><label for="mother_is_alive">Alive</label>
							<input type="radio" name="is_mother_alive_or_dead" id="mother_is_dead" value="0"  {{ ($is_mother_alive_or_dead == 0)? 'checked="checked"' : ''}} /><label for="mother_is_dead">Dead</label>
						</div>
						<div class="large-3 columns mother_dead_or_alive_when">
							<label for="is_mother_alive_or_dead_when">When?</label>
							<input type="text" id="is_mother_alive_or_dead_when" name="is_mother_alive_or_dead_when" value="{{ $is_mother_alive_or_dead_when }}" class="fdatepicker {{ ($errors->has('is_mother_alive_or_dead_when')) ? 'highlight_error' : '' }}" readonly>
						</div>
						<div class="large-6 columns">&nbsp;</div>
					</div>
				</fieldset><br>
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

<script type="text/javascript">
	
	<?php
	/**
	Reason
	**/
	// Reason 1
	if($reason_1 == 1)
	{
		echo '$(\'#reason_1\').prop(\'checked\', true);';
	}
	else
	{
		echo '$(\'#reason_1\').prop(\'checked\', false);';
	}
	// Reason 2
	if($reason_2 == 1)
	{
		echo '$(\'#reason_2\').prop(\'checked\', true);';
	}
	else
	{
		echo '$(\'#reason_2\').prop(\'checked\', false);';
	}
	// Reason 3
	if($reason_3 == 1)
	{
		echo '$(\'#reason_3\').prop(\'checked\', true);';
	}
	else
	{
		echo '$(\'#reason_3\').prop(\'checked\', false);';
	}
	// Reason 4
	if($reason_4 == 1)
	{
		echo '$(\'#reason_4\').prop(\'checked\', true);';
	}
	else
	{
		echo '$(\'#reason_4\').prop(\'checked\', false);';
	}
	// Reason 5
	if($reason_5 == 1)
	{
		echo '$(\'#reason_5\').prop(\'checked\', true);';
	}
	else
	{
		echo '$(\'#reason_5\').prop(\'checked\', false);';
	}
	// Reason 6
	if($reason_6 == 1)
	{
		echo '$(\'#reason_6\').prop(\'checked\', true);';
	}
	else
	{
		echo '$(\'#reason_6\').prop(\'checked\', false);';
	}
	// Reason 7
	if($reason_7 == 1)
	{
		echo '$(\'#reason_7\').prop(\'checked\', true);';
	}
	else
	{
		echo '$(\'#reason_7\').prop(\'checked\', false);';
	}
	// Reason 8
	if($reason_8 == 1)
	{
		echo '$(\'#reason_8\').prop(\'checked\', true);';
	}
	else
	{
		echo '$(\'#reason_8\').prop(\'checked\', false);';
	}
	// Reason 9
	if($reason_9 == 1)
	{
		echo '$(\'#reason_9\').prop(\'checked\', true);';
	}
	else
	{
		echo '$(\'#reason_9\').prop(\'checked\', false);';
	}
	// Reason 10
	if($reason_10 == 1)
	{
		echo '$(\'#reason_10\').prop(\'checked\', true);';
	}
	else
	{
		echo '$(\'#reason_10\').prop(\'checked\', false);';
	}
	// Reason 11
	if($reason_11 == 1)
	{
		echo '$(\'#reason_11\').prop(\'checked\', true);';
	}
	else
	{
		echo '$(\'#reason_11\').prop(\'checked\', false);';
	}
	// Reason 12
	if($reason_12 == 1)
	{
		echo '$(\'#reason_12\').prop(\'checked\', true);';
	}
	else
	{
		echo '$(\'#reason_12\').prop(\'checked\', false);';
	}
	// Reason 13
	if($reason_13 == 1)
	{
		echo '$(\'#reason_13\').prop(\'checked\', true);';
	}
	else
	{
		echo '$(\'#reason_13\').prop(\'checked\', false);';
	}
	// Reason 14
	if($reason_14 == 1)
	{
		echo '$(\'#reason_14\').prop(\'checked\', true);';
	}
	else
	{
		echo '$(\'#reason_14\').prop(\'checked\', false);';
	}
	// Reason 15
	if($reason_15 == 1)
	{
		echo '$(\'#reason_15\').prop(\'checked\', true);';
		echo '$(\'#reason_other\').attr(\'readonly\', false).val(\'' . $reason_other . '\');';
	}
	else
	{
		echo '$(\'#reason_15\').prop(\'checked\', false);';
	}
	/**
	Mother infected
	**/
	if($is_your_mother_infected_with_hiv == 1)
	{
		echo '$(\'#infected_mother_yes\').prop(\'checked\', true);';
	}
	else
	{
		echo '$(\'#infected_mother_no\').prop(\'checked\', true);';
	}

	/**
	Exprience
	**/
	// Experienc 1
	if($experience1 == 1)
	{
		echo '$(\'#experience1_yes\').prop(\'checked\', true);';
		echo '$(\'#experience_1_if_yes_what_year\').val(\'' . $experience_1_if_yes_what_year . '\').attr(\'readonly\', false).prop(\'required\',\'true\');';
	}
	else
	{
		echo '$(\'#experience_1_if_yes_what_year\').attr(\'readonly\', true);';
		echo '$(\'#experience1_no\').prop(\'checked\', true);';
	}
	// Experienc 2
	if($experience2 == 1)
	{
		echo '$(\'#experience2_yes\').prop(\'checked\', true);';
		echo '$(\'#experience_2_if_yes_what_year\').val(\'' . $experience_2_if_yes_what_year . '\').attr(\'readonly\', false).prop(\'required\',\'true\');';
	}
	else
	{
		echo '$(\'#experience_2_if_yes_what_year\').attr(\'readonly\', true);';
		echo '$(\'#experience2_no\').prop(\'checked\', true);';
	}
	// Experienc 3
	if($experience3 == 1)
	{
		echo '$(\'#experience_3_if_yes_what_year\').val(\'' . $experience_3_if_yes_what_year . '\').attr(\'readonly\', false).prop(\'required\',\'true\');';
		echo '$(\'#experience3_yes\').prop(\'checked\', true);';
	}
	else
	{
		echo '$(\'#experience_3_if_yes_what_year\').attr(\'readonly\', true);';
		echo '$(\'#experience3_no\').prop(\'checked\', true);';
	}
	// Experienc 4
	if($experience4 == 1)
	{
		echo '$(\'#experience4_yes\').prop(\'checked\', true);';
		echo '$(\'#experience_4_if_yes_what_year\').val(\'' . $experience_4_if_yes_what_year . '\').attr(\'readonly\', false).prop(\'required\',\'true\');';
	}
	else
	{
		echo '$(\'#experience4_no\').prop(\'checked\', true);';
		echo '$(\'#experience_4_if_yes_what_year\').attr(\'readonly\', true);';
	}
	// Experienc 5
	if($experience5 == 1)
	{
		echo '$(\'#experience5_yes\').prop(\'checked\', true);';
		echo '$(\'#experience_5_if_yes_what_year\').val(\'' . $experience_5_if_yes_what_year . '\').attr(\'readonly\', false).prop(\'required\',\'true\');';
	}
	else
	{
		echo '$(\'#experience5_no\').prop(\'checked\', true);';
		echo '$(\'#experience_5_if_yes_what_year\').attr(\'readonly\', true);';
	}
	// Experienc 6
	if($experience6 == 1)
	{
		echo '$(\'#experience6_yes\').prop(\'checked\', true);';
		echo '$(\'#experience_6_if_yes_what_year\').val(\'' . $experience_6_if_yes_what_year . '\').attr(\'readonly\', false).prop(\'required\',\'true\');';
	}
	else
	{
		echo '$(\'#experience6_no\').prop(\'checked\', true);';
		echo '$(\'#experience_6_if_yes_what_year\').attr(\'readonly\', true);';
	}
	// Experienc 7
	if($experience7 == 1)
	{
		echo '$(\'#experience7_yes\').prop(\'checked\', true);';
		echo '$(\'#experience_7_if_yes_what_year\').val(\'' . $experience_7_if_yes_what_year . '\').attr(\'readonly\', false).prop(\'required\',\'true\');';
	}
	else
	{
		echo '$(\'#experience7_no\').prop(\'checked\', true);';
		echo '$(\'#experience_7_if_yes_what_year\').attr(\'readonly\', true);';
	}
	// Experienc 8
	if($experience8 == 1)
	{
		echo '$(\'#experience8_yes\').prop(\'checked\', true);';
		echo '$(\'#experience_8_if_yes_what_year\').val(\'' . $experience_8_if_yes_what_year . '\').attr(\'readonly\', false).prop(\'required\',\'true\');';
	}
	else
	{
		echo '$(\'#experience8_no\').prop(\'checked\', true);';
		echo '$(\'#experience_8_if_yes_what_year\').attr(\'readonly\', true);';
	}

	// HIV Testing
	if($been_tested_for_hiv_before == 1)
	{
		echo '$(\'#tested_yes\').prop(\'checked\', true);';
		echo '$(\'#tested_month, #tested_year, #which_testing_facility, #which_testing_facility_city\').attr(\'readonly\', false).prop(\'required\',\'true\');';
	}
	elseif(in_array($been_tested_for_hiv_before, [0, 1]))
	{
		echo '$(\'#tested_no\').prop(\'checked\', true);';
		echo '$(\'#tested_month, #tested_year, #which_testing_facility, #which_testing_facility_city\').val(\'\').attr(\'readonly\', true);';
	}

	// Pregnancy History
	if($is_pregnant == 1)
	{
		echo '$(\'.pregnancy_history\').show();';

		echo '$(\'#children_alive\').val(\'' . $children_alive . '\');';
		echo '$(\'#last_period\').val(\'' . $last_period . '\');';
		echo '$(\'#months_pregnant\').val(\'' . $months_pregnant . '\');';
		echo '$(\'#weeks_pregnant\').val(\'' . $weeks_pregnant . '\');';
		echo '$(\'#delivery_date\').val(\'' . $delivery_date . '\');';

		if(is_numeric($where_prenatal_care_no) && $where_prenatal_care_no != '')
		{
			echo '$(\'#where_prenatal_care_no\').prop(\'checked\', true);';
			echo '$(\'#where_prenatal_care\').attr(\'readonly\', true).val(\'\');';
		}
		else
		{
			echo '$(\'#where_prenatal_care\').val(\'' . $where_prenatal_care . '\');';
		}

		if($plan_to_deliver_baby != '')
		{
			echo '$(\'#plan_to_deliver_baby\').val(\'' . $plan_to_deliver_baby . '\');';

			if(in_array($plan_to_deliver_baby, [1, 4]))
			{
				echo '$(\'#plan_to_deliver_baby_specify\').attr(\'readonly\', true);';
			}
			else
			{
				echo '$(\'#plan_to_deliver_baby_specify\').val(\'' . $plan_to_deliver_baby_specify . '\').attr(\'readonly\', false);';
			}
		}
		else
		{
			echo '$(\'#plan_to_deliver_baby_specify\').attr(\'checked\', true);';
		}

		if($partner_hiv_tested == 1)
		{
			echo '$(\'#partner_hiv_tested_yes\').attr(\'checked\', true);';

			echo '$(\'#partner_hiv_tested_when\').val(\'' . $partner_hiv_tested_when . '\');';
			echo '$(\'#partner_hiv_tested_facility\').val(\'' . $partner_hiv_tested_facility . '\');';
			echo '$(\'#partner_hiv_tested_result\').val(\'' . $partner_hiv_tested_result . '\');';
			echo '$(\'#partner_taking_arv\').val(\'' . $partner_taking_arv . '\');';
			echo '$(\'#partner_taking_arv_stopped_reason\').val(\'' . $partner_taking_arv_stopped_reason . '\');';

			echo '$(\'.partner_hiv_tested_yes_row\').show();';
		}
		elseif(is_numeric($partner_hiv_tested) && $partner_hiv_tested == 0)
		{
			echo '$(\'#partner_hiv_tested_no\').attr(\'checked\', true);';
			echo '$(\'.partner_hiv_tested_yes_row\').hide();';
		}
		elseif($partner_hiv_tested == 2)
		{
			echo '$(\'#partner_hiv_tested_dont_know\').attr(\'checked\', true);';
			echo '$(\'.partner_hiv_tested_yes_row\').hide();';
		}
		else
		{
			echo '$(\'.partner_hiv_tested_yes_row\').hide();';
		}

		// Children
		if(isset($mother_child))
		{
			if($mother_child != '')
			{
				#echo '// inserted';
				$children = '';
				$i = 1;
				foreach ($mother_child as $key => $value)
				{
					#echo '// loop ';
	                $hiv_status  	= isset($value['status'])?$value['status']:"";
	                $place_tested 	= isset($value['place_tested'])?$value['place_tested']:"";
	                $date_tested  	= isset($value['date_tested'])?$value['date_tested']:"";

					$children .= '<div class="large-4 columns"><select id="hiv_status" name="child[' . $i . '][status]" required><option value=""></option><option value="1"' . (($hiv_status == 1)? 'selected' : '') . '>Positive</option><option value="2"' . (($hiv_status == 2)? 'selected' : '') . '>Negative</option><option value="3"' . (($hiv_status == 3)? 'selected' : '') . '>Unknown</option></select></div>' .
								 '<div class="large-4 columns"><input id="place_tested" name="child[' . $i . '][place_tested]" type="text" value="' . $place_tested . '" ></div>' .
								 '<div class="large-4 columns"><input id="date_tested" name="child[' . $i . '][date_tested]" class="fdatepicker" type="text" value="' . $date_tested . '" readonly ></div>';
					$i++;
				}
				echo '$(\'#children_row\').html(\'' . $children . '\');';
			}
		}
	}
	else
	{
		echo '$(\'.pregnancy_history\').hide();';
	}



	// Mother HIV History (Age less than 18)


	if(is_numeric($number_of_female))
		{
			if($number_of_female > 0)
			{
				echo '$(\'#last_year_sex_female\').attr(\'readonly\', false);';
			}
			else
			{
				echo '$(\'#last_year_sex_female\').attr(\'readonly\', true);';
			}
		}
		else
		{
			echo '$(\'#last_year_sex_female\').attr(\'readonly\', true);';
		}

	if(is_numeric($number_of_male))
		{
			if($number_of_male > 0)
			{
				echo '$(\'#last_year_sex_male\').attr(\'readonly\', false);';
			}
			else
			{
				echo '$(\'#last_year_sex_male\').attr(\'readonly\', true);';
			}
		}
		else
		{
			echo '$(\'#last_year_sex_male\').attr(\'readonly\', true);';
		}

	?>

	/**
	 * script for MOTHER HIV HISTORY
	 * **/
	$("input[name=mother_arv_pregnancy]").change(function() {
		if($(this).val() == 1) {
			$('#mother_arv_pregnancy_yes').prop('checked', true);
			$('#mother_arv_pregnancy_reason').val("");
		}
		else if($(this).val() == 2) {
			$('#mother_arv_pregnancy_dont_know').prop('checked', true);
			$('#mother_arv_pregnancy_reason').val("");
		}
		else if($(this).val() == 0) {
			$('#mother_arv_pregnancy_no').prop('checked', true);
			$('#mother_arv_pregnancy_reason').val("{{ $mother_arv_pregnancy_reason }}");
		}

	});
	$("input[name=is_your_mother_infected_with_hiv]").change(function() {
		if($(this).val()==1){
			$('.mother_hiv_history').show();
			$('.mother_hiv_history').find('input').prop('disabled',false);

			$('#mother_hiv_status').val("{{ $mother_hiv_status }}");
			$('#hiv_diagnosis').val("{{ $hiv_diagnosis }}");
			$('#mother_saccl').val("{{ $mother_saccl }}");
			$('#mother_arv_pregnancy').val("{{ $mother_arv_pregnancy }}");

			if("{{ $mother_arv_pregnancy }}" == 1) {
				$('#mother_arv_pregnancy_yes').prop('checked', true);
				$('#mother_arv_pregnancy_reason').val("");
			}
			else if("{{ $mother_arv_pregnancy }}" == 2) {
				$('#mother_arv_pregnancy_dont_know').prop('checked', true);
				$('#mother_arv_pregnancy_reason').val("");
			}
			else if("{{ $mother_arv_pregnancy }}" == 0) {
				$('#mother_arv_pregnancy_no').prop('checked', true);
				$('#mother_arv_pregnancy_reason').val("{{ $mother_arv_pregnancy_reason }}");
			}

			// Did she breastfeed the baby?
			if($.isNumeric("{{$she_breastfeed_baby}}") && ("{{  $she_breastfeed_baby }}") == 1) {
				$('#she_breastfeed_baby_yes').prop('checked', true);
			}
			else if($.isNumeric("{{ $she_breastfeed_baby }}") && ("{{ $she_breastfeed_baby }}") == 0) {
				$('#she_breastfeed_baby_no').prop('checked', true);
			}

			// Is mother alive or dead?
			if($.isNumeric("{{$is_mother_alive_or_dead}}") && ("{{ $is_mother_alive_or_dead }}") == 1) {
				$('#mother_is_alive').prop('checked', true);
				$('.mother_dead_or_alive_when').hide();
				$('#is_mother_alive_or_dead_when').val("");
			}
			else if($.isNumeric("{{$is_mother_alive_or_dead}}") && ("{{ $is_mother_alive_or_dead }}") == 0) {
				$('#mother_is_dead').prop('checked', true);
				$('.mother_dead_or_alive_when').show();
				$('#is_mother_alive_or_dead_when').val("{{$is_mother_alive_or_dead_when}}");
			}
			else{
				$('.mother_dead_or_alive_when').show();
				$('#is_mother_alive_or_dead_when').val("");
			}
		}
		else
		{
			$('.mother_hiv_history').find('input').each(function(){
				$(this).prop('disabled',true);
			});

			$('.mother_hiv_history').hide();
		}

	});
	if("{{ $is_your_mother_infected_with_hiv }}" != 1){
		$('.mother_hiv_history').hide();
	}

	/**
	------- script Reason
	**/
	$(function(){
		$('input[name=\'reason_15\']').change(function(){

			var value = $(this).is(':checked');

			if(value == true)
			{
				$('#reason_other').attr('readonly', false).focus();
			}
			else
			{
				$('#reason_other').attr('readonly', true).val('');
			}
		});
	});
	
	/**
	-------Experience
	**/
	//	Experienc 1
	$(function(){
		$('input[name=\'experience1\']').change(function(){

			var value = $(this).val();

			if(value == 1)
			{
				$('#experience_1_if_yes_what_year').prop('required',true).attr('readonly', false).focus();
			}
			else
			{
				$('#experience_1_if_yes_what_year').prop('required',false).attr('readonly', true);
			}
		});
	});

	//	Experienc 2
	$(function(){
		$('input[name=\'experience2\']').change(function(){
			
			var value = $(this).val();

			if(value == 1)
			{
				$('#experience_2_if_yes_what_year').prop('required',true).attr('readonly', false).focus();
			}
			else
			{
				$('#experience_2_if_yes_what_year').prop('required',false).attr('readonly', true);
			}
		});
	});

	//	Experienc 3
	$(function(){
		$('input[name=\'experience3\']').change(function(){
			
			var value = $(this).val();

			if(value == 1)
			{
				$('#experience_3_if_yes_what_year').prop('required',true).attr('readonly', false).focus();
			}
			else
			{
				$('#experience_3_if_yes_what_year').prop('required',false).attr('readonly', true);
			}
		});
	});

	//	Experienc 4
	$(function(){
		$('input[name=\'experience4\']').change(function(){
			
			var value = $(this).val();

			if(value == 1)
			{
				$('#experience_4_if_yes_what_year').prop('required',true).attr('readonly', false).focus();
			}
			else
			{
				$('#experience_4_if_yes_what_year').prop('required',false).attr('readonly', true);
			}
		});
	});

	//	Experienc 5
	$(function(){
		$('input[name=\'experience5\']').change(function(){
			
			var value = $(this).val();

			if(value == 1)
			{
				$('#experience_5_if_yes_what_year').prop('required',true).attr('readonly', false).focus();
			}
			else
			{
				$('#experience_5_if_yes_what_year').prop('required',false).attr('readonly', true);
			}
		});
	});

	//	Experienc 6
	$(function(){
		$('input[name=\'experience6\']').change(function(){
			
			var value = $(this).val();

			if(value == 1)
			{
				$('#experience_6_if_yes_what_year').prop('required',true).attr('readonly', false).focus();
			}
			else
			{
				$('#experience_6_if_yes_what_year').prop('required',false).attr('readonly', true);
			}
		});
	});

	//	Experienc 7
	$(function(){
		$('input[name=\'experience7\']').change(function(){
			
			var value = $(this).val();

			if(value == 1)
			{
				$('#experience_7_if_yes_what_year').prop('required',true).attr('readonly', false).focus();
			}
			else
			{
				$('#experience_7_if_yes_what_year').prop('required',false).attr('readonly', true);
			}
		});
	});

	//	Experienc 8
	$(function(){
		$('input[name=\'experience8\']').change(function(){
			
			var value = $(this).val();

			if(value == 1)
			{
				$('#experience_8_if_yes_what_year').prop('required',true).attr('readonly', false).focus();
			}
			else
			{
				$('#experience_8_if_yes_what_year').prop('required',false).attr('readonly', true);
			}
		});
	});
	
	/**
	-------Reason
	**/
	$(function(){
		$('input[name=been_tested_for_hiv_before]').change(function(){

			var value = $(this).val();

			if(value == 1)
			{
				$('#tested_month').attr('readonly', false).focus();
				$('#tested_year, #which_testing_facility, #which_testing_facility_city').attr('readonly', false);
				$('#tested_month,#tested_year, #which_testing_facility, #which_testing_facility_city').prop('required', true);
				//$('#which_testing_facility').attr('readonly', false);
				//$('#which_testing_facility_city').attr('readonly', false);
			}
			else
			{
				$('#tested_month, #tested_year, #which_testing_facility, #which_testing_facility_city').val('').attr('readonly', true).prop('required',false);
				//$('#tested_year').attr('readonly', true);
				//$('#which_testing_facility').attr('readonly', true);
				//$('#which_testing_facility_city').attr('readonly', true);
			}
		});
	});

	$(function(){
		$('input[name=where_prenatal_care_no]').change(function(){

			var check = $(this).is(':checked');

			if(check == true)
			{
				$('#where_prenatal_care').attr('readonly', true);
			}
			else
			{
				$('#where_prenatal_care').attr('readonly', false);
			}
		});
	});

	$(function(){
		$('#plan_to_deliver_baby').change(function(){

			var value = $(this).val();

			if(value == 1 || value == 4)
			{
				$('#plan_to_deliver_baby_specify').val('').attr('readonly', true);
			}
			else
			{
				$('#plan_to_deliver_baby_specify').attr('readonly', false).focus();
			}
		});
	});

	$(function(){
		$('input[name=partner_hiv_tested]').change(function(){

			var value = $(this).val();

			if(value == 1)
			{
				$('.partner_hiv_tested_yes_row').show();
			}
			else
			{
				$('.partner_hiv_tested_yes_row').hide();
				$('.partner_hiv_tested_yes_row input, .partner_hiv_tested_yes_row select').val('');
			}
		});
	});

	$(function(){
		$('input[name=partner_taking_arv]').change(function(){

			var value = $(this).val();

			if(value == 4)
			{
				$('#partner_taking_arv_stopped_reason').attr('redonly', false);
			}
			else
			{
				$('#partner_taking_arv_stopped_reason').attr('redonly', true);
			}
		});
	});

	$(function(){
		$('input[name=mother_arv_pregnancy]').change(function(){

			var value = $(this).val();

			if(value == 0)
			{
				$('#mother_arv_pregnancy_reason').attr('readonly', false);
			}
			else
			{
				$('#mother_arv_pregnancy_reason').attr('readonly', true);
			}
		});
	});
	@if($mother_arv_pregnancy == 0)
		$('#mother_arv_pregnancy_reason').prop('readonly',false);
	@else
		$('#mother_arv_pregnancy_reason').prop('readonly',true);
		$('#mother_arv_pregnancy_reason').val('');
	@endif

	@if($is_mother_alive_or_dead == 0)
		$('.mother_dead_or_alive_when').show();
	@else
		$('.mother_dead_or_alive_when').hide();
	@endif
	$(function(){
		$('input[name=is_mother_alive_or_dead]').change(function(){

			var value = $(this).val();

			if(value == 0)
			{
				$('.mother_dead_or_alive_when').show();
			}
			else
			{
				$('.mother_dead_or_alive_when').hide();
				$('#is_mother_alive_or_dead_when').val('');
			}
		});
	});

	$(function(){
		$('#children_alive').on('keydown', function(e){
			var list = [8, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105];
			var code = e.keyCode;

			if($.inArray(code, list) === -1)
			{
				return false;
				e.preventDefault();
			}
		});
	});

	$(function(){
		$('#children_alive').on('keyup', function(e){
			var list = [8, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105];
			var code = e.keyCode;

			//console.log(code);
			if($.inArray(code, list) !== -1)
			{
				children_fields();
			}
		});
	});

	function children_fields()
	{
		var number = $('#children_alive').val();
		var rows = '';

		for(var i = 1; i <= number; i++)
		{
			var text = 	'<div class="large-4 columns"><select id="hiv_status" name="child[' + i + '][status]" required><option value=""></option><option value="1">Positive</option><option value="2">Negative</option><option value="3">Unknown</option></select></div>' + 
						'<div class="large-4 columns"><input id="place_tested" name="child[' + i + '][place_tested]" type="text" ></div>' + 
						'<div class="large-4 columns"><input id="date_tested" name="child[' + i + '][date_tested]" class="fdatepicker" type="text" readonly></div>';
			rows += text;
		}
		
		$('#children_row').html(rows);

	    $(".fdatepicker").fdatepicker({
	        format: 'MM dd, yyyy',
	         startDate: '',
	        disableDblClickSelection: true
	    });	
	}
	$(function(){
		$('input[name=number_of_female]').change(function(){
			var value = $(this).val();
			
			if(value == 0)
			{
				$('#last_year_sex_female').val('').attr('readonly', true);
			}
			else
			{
				$('#last_year_sex_female').attr('readonly', false);
			}
		});
	});

	$(function(){
		$('input[name=number_of_male]').change(function(){
			var value = $(this).val();
			
			if(value == 0)
			{
				$('#last_year_sex_male').val('').attr('readonly', true);
			}
			else
			{
				$('#last_year_sex_male').attr('readonly', false);
			}
		});
	});
	$(function(){
		$('input[name=is_your_mother_infected_with_hiv]').change(function(){
			var value = $(this).val();
			
			if(value == 0)
			{
				$('#mother_hiv_status').val('');
				$('#hiv_diagnosis').val('');
				$('#mother_saccl').val('');
				$('#mother_arv_pregnancy_reason').val('');
				$('#is_mother_alive_or_dead_when').val('');
				$('#mother_hiv_status').attr('required', false);
				$('#hiv_diagnosis').attr('required', false);
				$('#mother_saccl').attr('required', false);
				$('#mother_arv_pregnancy_reason').attr('required', false);
				$('#is_mother_alive_or_dead_when').attr('required', false);
			}
			else{
				//$('#mother_hiv_status').attr('required', true);
				//$('#hiv_diagnosis').attr('required', true);
				$('#hiv_diagnosis').attr('readonly', false);
				//$('#mother_saccl').attr('required', true);
				//$('#mother_arv_pregnancy_reason').attr('required', true);
				//$('#is_mother_alive_or_dead_when').attr('required', true);
				$('#is_mother_alive_or_dead_when').attr('readonly', false);
			}
		});
	});
</script>
@endsection
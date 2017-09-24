@extends('hact.layouts.layout_admin')

@section('content')		

	@include('hact.messages.success')
	@include('hact.messages.error_list')
 
	<script src="{{ asset('js/hact_forms_js/enrolment.js') }}"></script>
	<form>
		{!! csrf_field() !!}
		<fieldset>
			<legend>DEMOGRAPHICS</legend><br/>
			<fieldset>
				<div class='row'>
					<div class='large-6 columns'>
						<label for='initial_contact_date'>Date of Initial Contact</label><br/>
						<input type='text'  id='initial_contact_date' class='fdatepicker' name='initial_contact_date' placeholder='MM dd, yyyy' value="{{ old('initial_contact_date') }}">
					</div>
					<div class='large-6 columns'>
						<label for='enrolment_date'>Date of Enrolment</label><br/>
						<input type='text'  id='enrolment_date' class='fdatepicker' name='enrolment_date' placeholder='MM dd, yyyy' value="{{ old('enrolment_date') }}">
					</div>
				</div>
			</fieldset><br/>

			<fieldset>
				<legend>Patient's Name</legend><br/>
				<div class='row'>
					<div class='large-6 columns'>
						<label for='last_name'>Last Name:</label><br/>
						<input type='text' id='last_name' name='last_name' placeholder='Last Name' value="{{ old('last_name') }}">
					</div>
					<div class='large-6 columns'>
						<label for='middle_name'>Middle Name:</label><br/>
						<input type='text' id='middle_name' name='middle_name' placeholder='Middle Name' value="{{ old('middle_name') }}">
					</div>
				</div>
				<div class='row'>
					<div class='large-6 columns'>
						<label for='first_name'>First Name:</label><br/>
						<input type='text' id='first_name' name='first_name' placeholder='First Name' value="{{ old('first_name') }}">
					</div>
					<div class='large-6 columns'>
						<label for='code_name'>Code Name:(check for repititions)</label><br/>
						<input type='text' id='code_name' name='code_name' placeholder='Code Name' value="{{ old('code_name') }}">
					</div>
				</div>
			</fieldset><br/>

			<fieldset>
				<div class='row'>
					<div class='large-3 columns'>
						<label for='saccl_code'>SACCL Code:</label><br/>
						<input type='text' id='saccl_code' name='saccl_code' placeholder='SACCL Code' value="{{ old('saccl_code') }}">
					</div>
					<div class='large-3 columns'>
						<label for='diagnosis_date'>Date of Diagnosis:</label><br/>
						<input type='text'  id='diagnosis_date' class='fdatepicker' name='diagnosis_date' placeholder='MM dd, yyyy' value="{{ old('diagnosis_date') }}">
					</div>
					<div class='large-2 columns'>
						<label for='male'>Sex:</label><br/>
						<input type='radio' id='male' name='sex' value='1'><label for='male'>Male</label><br/>
						<input type='radio' id='female' name='sex' value='0'><label for='female'>Female</label>
					</div>
					<div class='large-4 columns'>
						<label for='single'>Civil Status:</label><br/>
						<div class='row'>
							<div class='large-6 columns'>
								<input type='radio' id='single' name='civil_status' value='1'><label for='single'>Single</label><br/>
							</div>
							<div class='large-6 columns'>	
								<input type='radio' id='separated' name='civil_status' value='3'><label for='separated'>Separated</label><br/>
							</div>
						</div>
						<div class='row'>
							<div class='large-6 columns'>
								<input type='radio' id='married' name='civil_status' value='2'><label for='married'>Married</label><br/>
							</div>
							<div class='large-6 columns'>	
								<input type='radio' id='widowed' name='civil_status' value='4'><label for='widowed'>Widowed</label>
							</div>
						</div>
					</div>
				</div>
			</fieldset><br/>
			
			<fieldset>
				<legend>Unique Identifier Code</legend><br/>
				<div class='row'>
					<div class='large-4 columns'>
						<label for='uic_mother_name'>first 2 letters of mother's name</label><br/>
						<input type='text' id='uic_mother_name' name='uic_mother_name' minlength='2' maxlength='2' placeholder='00'>
					</div>
					<div class='large-4 columns'>
						<label for='uic_father_name'>first 2 letters of father's name</label><br/>
						<input type='text' id='uic_father_name' name='uic_father_name' minlength='2' maxlength='2' placeholder='00'>
					</div>
					<div class='large-4 columns'>
						<label for='uic_birth_order'>2-digit birth order</label><br/>
						<input type='text' id='uic_birth_order' name='uic_birth_order' minlength='2' maxlength='2' placeholder='00'>
					</div>
				</div>
			</fieldset><br/>


				<div class='row'>
					<div class='large-3 columns'>
						<fieldset>
							<div class='row'>
								<div class='large-12 columns'><br/>
									<label for='birth_date'>Date of Birth:</label><br/>
									<input type='text'  id='birth_date' class='fdatepicker' name='birth_date' placeholder='MM dd, yyyy' value="{{ old('birth_date') }}">
								</div>
							</div>
							<div class='row'>
								<div class='large-12 columns'>
									<label for='birth_date'>Age:</label><br/>
									<input type='text' id='' name='age' placeholder='Age' value="{{ old('age') }}">
								</div>
							</div>
						</fieldset>
					</div>
					<div class='large-9 columns'>
						<fieldset>
				    		<legend>Mother's Maiden Name</legend><br/>
							<div class='row'>
								<div class='large-2 columns'>
									<label for='mother_maiden_last_name'>Last Name:</label>
								</div>
								<div class='large-10 columns'>
									<input type='text' id='mother_maiden_last_name' name='mother_maiden_last_name' placeholder='Last Name' value="{{ old('mother_maiden_last_name') }}">
								</div>
							
							</div>
							<div class='row'>
								<div class='large-2 columns'>	
									<label for='mother_maiden_first_name'>First Name:</label>
								</div>
								<div class='large-10 columns'>
									<input type='text' id='mother_maiden_first_name' name='mother_maiden_first_name' placeholder='First Name' value="{{ old('mother_maiden_first_name') }}">
								</div>
							</div>
							<div class='row'>
								<div class='large-2 columns'>
									<label for='mother_maiden_middle_name'>Middle Name:</label>
								</div>
								<div class='large-10 columns'>
									<input type='text' id='mother_maiden_middle_name' name='mother_maiden_middle_name' placeholder='Middle Name' value="{{ old('mother_maiden_middle_name') }}">
								</div>
							</div>
						</fieldset><br/>
					</div>
				</div>
				
			<fieldset>
				<div class='row'>
					<div class='large-6 columns'>
						<label for='contact_number'>Contact Number:</label><br/>
						<input type='text' id='contact_number' name='contact_number' placeholder='Contact Number' value="{{ old('contact_number') }}">
					</div>
					<div class='large-6 columns'>
					<label for='philhealth_number'>PhilHealth Number:</label><br/>
						<input type='text' id='philhealth_number' name='philhealth_number' placeholder='PhilHealth Number' value="{{ old('philhealth_number') }}">
					</div>
				</div>	
			</fieldset><br/>
			<fieldset>
				<legend>HIV Risks</legend><br/>
				<div class='row'>
					<div class='large-6 columns'>
						<input type='checkbox' id='blood_transfusion_recipient' name='hiv_risks' value='blood_transfusion_recipient'>
						<label for='blood_transfusion_recipient'>Blood Transfusion(BT) Recipient</label><br/>
						<input type='checkbox' id='injecting_drug_user' name='hiv_risks' value='injecting_drug_user'>
						<label for='injecting_drug_user'>Injecting Drug User(IDU)</label><br/>
						<input type='checkbox' id='substance_abuse' name='hiv_risks' value='substance_abuse'>
						<label for='substance_abuse'>Substance Abuse</label><br/>
						<input type='checkbox' id='occupational_exposure' name='hiv_risks' value='occupational_exposure'>
						<label for='occupational_exposure'>Occupational Exposure(OE)</label><br/>
						<!-- disable if occupational_exposure -->
						<label for='provided_post_exposure_prophylaxis_yes'>Provided Post Exposure Prophylaxis</label>
						<input type='radio' id='provided_post_exposure_prophylaxis_yes' name='hiv_risks' value='provided_post_exposure_prophylaxis_yes'>
						<label for='provided_post_exposure_prophylaxis_yes'>YES</label><br/>
						<input type='radio' id='provided_post_exposure_prophylaxis_no' name='hiv_risks' value='provided_post_exposure_prophylaxis_no'>
						<label for='provided_post_exposure_prophylaxis_no'>NO</label><br/>
						<input type='checkbox' id='sexually_transmitted_infections' name='hiv_risks' value='sexually_transmitted_infections'>
						<label for='sexually_transmitted_infections'>Sexually Transmitted Infections(STI)</label><br/>
						<!--  -->
					</div>
					<div class='large-6 columns'>
						<input type='checkbox' id='multiple_sexual_partners' name='hiv_risks' value='multiple_sexual_partners'>
						<label for='multiple_sexual_partners'>Multiple Sexual Partners</label><br/>
						<input type='checkbox' id='male_have_sex_with_other_males' name='hiv_risks' value='male_have_sex_with_other_males'>
						<label for='male_have_sex_with_other_males'>Male having Sex with other Males(MSM)</label><br/>
						<input type='checkbox' id='sex_worker_client' name='hiv_risks' value='sex_worker_client'>
						<label for='sex_worker_client'>Client of a Sex Worker</label><br/>
						<input type='checkbox' id='sex_worker' name='hiv_risks' value='sex_worker'>
						<label for='sex_worker'>Sex Worker</label><br/>
						<input type='checkbox' id='child_of_hiv_mother' name='hiv_risks' value='child_of_hiv_mother'>
						<label for='child_of_hiv_mother'>Child of HIV Infected Mother</label><br/>
						<input type='checkbox' id='others' name='hiv_risks' value='others'>
						<label for='others'>Others:</label>
						<input type='text' id='others_name' name='others_name' placeholder='Others' value="{{ old('others_name') }}">
					</div>
				</div>
			</fieldset><br/>

		</fieldset><br/><br/><br/>
		<fieldset>
			<legend>CLINICAL &amp; IMMUNOLOGIC PROFILE</legend><br/>
			<fieldset>
				<legend>CD4</legend><br/>
				<div class='row'>
					<div class='large-6 columns'>
						<label for='cd4_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='cd4_date' name='cd4_date' value="{{ old('cd4_date') }}">
					</div>
					<div class='large-6 columns'>
						<label for='cd4_result'>Result:</label><input type='text' placeholder='CD4 Result' id='cd4_result' name='cd4_result' value="{{ old('cd4_result') }}">
					</div>
				</div>
			</fieldset><br/>

			<fieldset>
				<legend>Viral Load</legend><br/>
				<div class='row'>
					<div class='large-6 columns'>
						<label for='viral_load_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='viral_load_date' name='viral_load_date' value="{{ old('viral_load_date') }}">
					</div>
					<div class='large-6 columns'>
						<label for='viral_load_result'>Result:</label><input type='text' placeholder='Viral Load Result' id='viral_load_result' name='viral_load_result' value="{{ old('viral_load_result') }}">
					</div>
				</div>
			</fieldset><br/>

			<fieldset>
			<legend>CBC</legend><br/>
				<div class ='row'>
					<div class='large-12 columns'>
						<label for='cbc_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='cbc_date' name='cbc_date' value="{{ old('cbc_date') }}">
					</div>
				</div>
				<div class='row'>
					<div class='large-6 columns'>
						<label for='cbc_hgb_result'>Hgb:</label><input type='text' id='cbc_hgb_result' name='cbc_hgb_result' placeholder ='Hgb Result' value="{{ old('cbc_hgb_result') }}">
						<label for='cbc_rbc_result'>RBC:</label><input type='text' id='cbc_rbc_result' name='cbc_rbc_result' placeholder ='RBC Result' value="{{ old('cbc_rbc_result') }}">
					</div>
					<div class='large-6 columns'>
						<label for='cbc_wbc_result'>WBC:</label><input type='text' id='cbc_wbc_result' name='cbc_wbc_result' placeholder ='WBC Result' value="{{ old('cbc_wbc_result') }}">
						<label for='cbc_hgb_result'>Plt:</label><input type='text' id='cbc_plt_result' name='cbc_plt_result' placeholder ='Plt Result' value="{{ old('cbc_plt_result') }}">
					</div>
				</div>
			</fieldset><br/>

			<fieldset>
					<legend>Creatinine</legend><br/>
					<div class='row'>
						<div class='large-6 columns'>
							<label for='creatinine_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='creatinine_date' name='creatinine_date' value="{{ old('creatinine_date') }}">
						</div>
						<div class='large-6 columns'>
							<label for='creatinine_result'>Result:</label><input type='text' placeholder='Viral Load Result' id='creatinine_result' name='creatinine_result' value="{{ old('creatinine_result') }}">
						</div>
					</div>
			</fieldset><br/>

			<fieldset>
					<legend>SGPT</legend><br/>
					<div class='row'>
						<div class='large-6 columns'>
							<label for='sgpt_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='sgpt_date' name='sgpt_date' value="{{ old('sgpt_date') }}">
						</div>
						<div class='large-6 columns'>
							<label for='sgpt_result'>Result:</label><input type='text' placeholder='SGPT Result' id='sgpt_result' name='sgpt_result' value="{{ old('sgpt_result') }}">
						</div>
					</div>
			</fieldset><br/>

			<fieldset>
					<legend>Lipid Profile</legend><br/>
					<div class='row'>
						<div class='large-6 columns'>
							<label for='lipid_profile_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='lipid_profile_date' name='lipid_profile_date' value="{{ old('lipid_profile_date') }}">
						</div>
						<div class='large-6 columns'>
							<label for='lipid_profile_result'>Result:</label><input type='text' placeholder='Lipid Profile Result' id='lipid_profile_result' name='lipid_profile_result' value="{{ old('lipid_profile_result') }}">
						</div>
					</div>
			</fieldset><br/>

			<fieldset>
					<legend>FBS</legend><br/>
					<div class='row'>
						<div class='large-6 columns'>
							<label for='fbs_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='fbs_date' name='fbs_date' value="{{ old('fbs_date') }}">
						</div>
						<div class='large-6 columns'>
							<label for='fbs_result'>Result:</label><input type='text' placeholder='FBS Result' id='fbs_result' name='fbs_result' value="{{ old('fbs_result') }}">
						</div>
					</div>
			</fieldset><br/>

			<fieldset>
					<legend>RPR</legend><br/>
					<div class='row'>
						<div class='large-6 columns'>
							<label for='RPR_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='RPR_date' name='RPR_date' value="{{ old('RPR_date') }}">
						</div>
						<div class='large-6 columns'>
							<label for='RPR_result'>Result:</label><input type='text' placeholder='RPR Result' id='RPR_result' name='RPR_result' value="{{ old('RPR_result') }}">
						</div>
					</div>
			</fieldset><br/>

			<fieldset>
					<legend>HbsAg</legend><br/>
					<div class='row'>
						<div class='large-6 columns'>
							<label for='hbsag_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='hbsag_date' name='hbsag_date' value="{{ old('hbsag_date') }}">
						</div>
						<div class='large-6 columns'>
							<label for='hbsag_result'>Result:</label><input type='text' placeholder='NbsAg Result' id='hbsag_result' name='hbsag_result' value="{{ old('hbsag_result') }}">
						</div>
					</div>
			</fieldset><br/>

			<fieldset>
					<legend>HCV</legend><br/>
					<div class='row'>
						<div class='large-6 columns'>
							<label for='hcv_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='hcv_date' name='hcv_date' value="{{ old('hcv_date') }}">
						</div>
						<div class='large-6 columns'>
							<label for='hcv_result'>Result:</label><input type='text' placeholder='HCV Result' id='hcv_result' name='hcv_result' value="{{ old('hcv_result') }}">
						</div>
					</div>
			</fieldset><br/>

			<fieldset>
					<legend>HCV</legend><br/>
					<div class='row'>
						<div class='large-6 columns'>
							<label for='hcv_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='hcv_date' name='hcv_date' value="{{ old('hcv_date') }}">
						</div>
						<div class='large-6 columns'>
							<label for='hcv_result'>Result:</label><input type='text' placeholder='HCV Result' id='hcv_result' name='hcv_result' value="{{ old('hcv_result') }}">
						</div>
					</div>
			</fieldset><br/>

			<fieldset>
					<legend>Urinalysis</legend><br/>
					<div class='row'>
						<div class='large-6 columns'>
							<label for='urinalysis_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='urinalysis_date' name='urinalysis_date' value="{{ old('urinalysis_date') }}">
						</div>
						<div class='large-6 columns'>
							<label for='urinalysis_result'>Result:</label><input type='text' placeholder='Urinalysis Result' id='urinalysis_result' name='urinalysis_result' value="{{ old('urinalysis_result') }}">
						</div>
					</div>
			</fieldset><br/>

			<fieldset>
					<legend>Stool Exam</legend><br/>
					<div class='row'>
						<div class='large-6 columns'>
							<label for='stool_exam_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='stool_exam_date' name='stool_exam_date' value="{{ old('stool_exam_date') }}">
						</div>
						<div class='large-6 columns'>
							<label for='stool_exam_result'>Result:</label><input type='text' placeholder='Stool Exam Result' id='stool_exam_result' name='stool_exam_result' value="{{ old('stool_exam_result') }}">
						</div>
					</div>
			</fieldset><br/>

			<fieldset>
					<legend>Stool Exam</legend><br/>
					<div class='row'>
						<div class='large-6 columns'>
							<label for='stool_exam_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='stool_exam_date' name='stool_exam_date' value="{{ old('stool_exam_date') }}">
						</div>
						<div class='large-6 columns'>
							<label for='stool_exam_result'>Result:</label><input type='text' placeholder='Stool Exam Result' id='stool_exam_result' name='stool_exam_result' value="{{ old('stool_exam_result') }}">
						</div>
					</div>
			</fieldset><br/>

			<fieldset>
					<legend>Chest X-ray</legend><br/>
					<div class='row'>
						<div class='large-6 columns'>
							<label for='chest_x-ray_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='chest_x-ray_date' name='chest_x-ray_date' value="{{ old('chest_x-ray_date') }}">
						</div>
						<div class='large-6 columns'>
							<label for='chest_x-ray_result'>Result:</label><input type='text' placeholder='Chest Exam Result' id='chest_x-ray_result' name='chest_x-ray_result' value="{{ old('chest_x-ray_result') }}">
						</div>
					</div>
			</fieldset><br/>

			<fieldset>
					<legend>DSSM</legend><br/>
					<fieldset>
						<legend>1st</legend><br/>
						<div class='row'>
							<div class='large-6 columns'>
								<label for='dssm_1st_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='dssm_1st_date' name='dssm_1st_date' value="{{ old('dssm_1st_date') }}">
							</div>
							<div class='large-6 columns'>
								<label for='dssm_1st_result'>Result:</label><input type='text' placeholder='1st DSSM Result' id='dssm_1st_result' name='dssm_1st_result' value="{{ old('dssm_1st_result') }}">
							</div>
						</div>
					</fieldset><br/>
					<fieldset>
						<legend>2nd</legend><br/>
						<div class='row'>
							<div class='large-6 columns'>
								<label for='dssm_2nd_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='dssm_2nd_date' name='dssm_2nd_date' value="{{ old('dssm_2nd_date') }}">
							</div>
							<div class='large-6 columns'>
								<label for='dssm_2nd_result'>Result:</label><input type='text' placeholder='Chest Exam Result' id='dssm_2nd_result' name='dssm_2nd_result' value="{{ old('dssm_2nd_result') }}">
							</div>
						</div>
					</fieldset><br/>
			</fieldset><br/>

			<fieldset>
					<legend>Genexpert</legend><br/>
					<div class='row'>
						<div class='large-6 columns'>
							<label for='genexpert_date'>Date:</label><input type='text' placeholder='MM dd, yyyy' class='fdatepicker' id='genexpert_date' name='genexpert_date' value="{{ old('genexpert_date') }}">
						</div>
						<div class='large-6 columns'>
							<label for='genexpert_result'>Result:</label><input type='text' placeholder='Genexpert Result' id='genexpert_result' name='genexpert_result' value="{{ old('genexpert_result') }}">
						</div>
					</div>
			</fieldset><br/>

		</fieldset><br/>
		<div class='row'>
			<div class='large-12 columns'>
				<input type='submit' class='button expand' value='Submit'>
			</div>
		</div>


	</form>

@endsection
@extends('hact.layouts.layout_admin')

@section('content')


		
	<fieldset>
		<legend>Personal Information</legend>
		<fieldset>
			<legend>Informed Consent</legend>
			<div class="row">
				<div class="large-6 columns">
					<input type="checkbox" id="ic1" name=""><label for="ic1"> I was given information about HIV and HIV Testing, and was given the opportunity to ask questions</label>
				</div>
				<div class="large-6 columns">
					<label for="name">Name: </label><input type="text" id="name" name="name" value="" placeholder="Name">
				</div>
			</div>	
			<div class="row">
				<div class="large-6 columns">
					<input type="checkbox" id="ic2" name=""><label for="ic2"> I agree to be tested for HIV</label>
				</div>
				<div class="large-6 columns">
					<label for="vct_date">VCT Date: </label><input type="text" id="vct_date" name="vct_date" value="" placeholder="">
				</div>
			</div>
		</fieldset>

		<fieldset>
			<legend>Demographic Data</legend>
			<div class="row">
				<div class="large-12 columns">
					<label for="phil_health_number">Phil Health Number: </label><input type="text" id="phil_health_number" name="phil_health_number">
				</div>
			</div>
			<fieldset>
				<legend>Name</legend>
				<div class="row">
					<div class="large-4 columns">
						<label for="first_name">First Name</label><input type="text" id="first_name" name="first_name" placeholder="First Name">
					</div>
					<div class="large-4 columns">
						<label for="middle_name">Middle Name</label><input type="text" id="middle_name" name="middle_name" placeholder="Middle Name">
					</div>
					<div class="large-4 columns">
						<label for="last_name">Last Name</label><input type="text" id="last_name" name="last_name" placeholder="Last Name">
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Mother's Maiden Name</legend>
				<div class="row">
					<div class="large-4 columns">
						<label for="mother_first_name">First Name</label><input type="text" id="mother_first_name" name="mother_first_name" placeholder="First Name">
					</div>
					<div class="large-4 columns">
						<label for="mother_middle_name">Middle Name</label><input type="text" id="mother_middle_name" name="mother_middle_name" placeholder="Middle Name">
					</div>
					<div class="large-4 columns">
						<label for="mother_last_name">Last Name</label><input type="text" id="mother_last_name" name="mother_last_name" placeholder="Last Name">
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Unique Identifire Code</legend>
				<div class="row">
					<div class="large-12 columns">
						<table>
							<thead>
								<tr>
									<th><label for="">First 2 letters of mother's real name</label></th>
									<th><label for="">First 2 letters of fathers's real name</label></th>
									<th><label for="">Birth Order</label></th>
									<th><label for="">Month of Birth</label></th>
									<th><label for="">Day of Birth</label></th>
									<th><label for="">Year of Birth</label></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input type="text" id="" name="" value="" placeholder="" maxlength="2"></td>
									<td><input type="text" id="" name="" value="" placeholder="" maxlength="2"></td>
									<td><input type="text" id="" name="" value="" placeholder="" maxlength="2"></td>
									<td><input type="text" id="" name="" value="" placeholder="" maxlength="2"></td>
									<td><input type="text" id="" name="" value="" placeholder="" maxlength="2"></td>
									<td><input type="text" id="" name="" value="" placeholder="" maxlength="4"></td>
								</tr>
							</tbody>	
						</table>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<div class="row">
					<div class="large-2 columns">
						<label for="age">Age: </label><input type="text" id="age" name="age" placeholder="Age" maxlength="2">
					</div>
					<div class="large-5 columns">
						<label for="age_in_months">Age in Months(for less than 1 year old): </label><input type="text" id="age_in_months" name="age_in_months" maxlength="2">
					</div>
					<div class="large-5 columns">
						<label for="gender">Gender:</label>
						<input type="radio" id="male" name="gender" checked><label for="male"> Male</label><input type="radio" id="female" name="gender"><label for="female"> Female</label>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<div class="row">
					<div class="large-12 columns">
						<label for="permanent_Address">Permanent Address: </label><input type="text" id="permanent_address" name="permanent_address" placeholder="Permanent Address">
					</div>
				</div>
				<div class="row">
					<div class="large-3 columns">
						<br/>
						<label for="current_city">Current Place of Recidence: </label>
					</div>
					<div class="large-5 columns">
						<label for="current_city">Municipality/City: </label><input type="text" id="current_city" name="current_city" placeholder="Current Municipality/City">
					</div>
					<div class="large-4 columns">
						<label for="current_province">Province: </label><input type="text" id="current_province" name="current_province" placeholder="Current Province">
					</div>
				</div>
				<div class="row">
					<div class="large-3 columns">
						<br/>
						<label for="birth_city">Place of Birth: </label>
					</div>
					<div class="large-5 columns">
						<label for="birth_city">Municipality/City: </label><input type="text" id="birth_city" name="birth_city" placeholder="Municipality/City of Birth">
					</div>
					<div class="large-4 columns">
						<label for="birth_province">Province: </label><input type="text" id="birth_province" name="birth_province" placeholder="Province of Birth">
					</div>
				</div>
			</fieldset>

			<fieldset>
				<div class="row">
					<div class="large-6 columns">
						<label for="contact_number">Contact Number: </label><input type="text" id="contact_number" name="contact_number" placeholder="Contact Number">
					</div>
					<div class="large-6 columns">
						<label for="email">Email: </label><input type="email" id="email" name="email" placeholder="Email">
					</div>
				</div>
			</fieldset>

			<fieldset>
				<div class="row">
					<div class="large-3 columns">
						<label for="filipino">Nationality: </label>
						<input type="radio" id="filipino" name="nationality" checked><label for="filipino"> Filipino</label>
						<input type="radio" id="is_other_nationality" name="nationality"><label for="is_other_nationality"> Others,</label>
					</div>
					<div class="large-2 columns">
						<br/>
						<label for="other_nationality">please specify: </label>
					</div>
					<div class="large-7 columns">
						<br/>
						<input type="text" id="other_nationality" name="other_nationality">
					</div>
				</div>
			</fieldset>

			<fieldset>
				<div class="row">
					<div class="large-5 columns">
						<label for="college">Highest Educational Attainment: </label>
					</div>
					<div class="large-7 columns">
						<div class="row">
							<div class="large-4 columns">
								<input type="radio" id="none" name="education" checked><label for="none"> None</label>
							</div>
							<div class="large-4 columns">
								<input type="radio" id="highschool" name="education" checked><label for="highschool"> Highschool</label>
							</div>
							<div class="large-4 columns">
								<input type="radio" id="vocational" name="education" checked><label for="vocational"> Vocational</label>
							</div>
						</div>
						<div class="row">
							<div class="large-4 columns">
								<input type="radio" id="elementary" name="education" checked><label for="elementary"> Elementary</label>
							</div>
							<div class="large-4 columns">
								<input type="radio" id="college" name="education" checked><label for="highschool"> College</label>
							</div>
							<div class="large-4 columns">
								<input type="radio" id="post_graduate" name="education" checked><label for="vocational"> Post-Graduate</label>
							</div>
						</div>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<div class="row">
					<div class="large-2 columns">
						<label for="single">Civil Status: </label>
					</div>
					<div class="large-10 columns">
						<input type="radio" id="single" name="civil_status" checked><label for="single"> Single</label>
						<input type="radio" id="married" name="civil_status"><label for="married"> Married</label>
						<input type="radio" id="separated" name="civil_status"><label for="separated"> Separated</label>
						<input type="radio" id="widowed" name="civil_status"><label for="widowed"> Widowed</label>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<div class="row">
					<div class="large-3 columns">
						<label for="partner_no">Are you living with a partner? </label>
					</div>
					<div class="large-9 columns">
						<input type="radio" id="partner_no" name="is_living_with_partner" checked><label for="partner_no"> No</label>
						<input type="radio" id="partner_yes" name="is_living_with_partner"><label for="partner_yes"> Yes</label>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<div class="row">
					<div class="large-4 columns">
						<label for="children"> Number of Children:</label>
						<input type="text" id="children" name="children">
					</div>
					<div class="large-4 columns">
						<br/>
						<label for="pregnant_no">Are you presently pregnant? (for females only)</label>
					</div>
					<div class="large-4 columns">
						<br/>
						<input type="radio" id="pregnant_no" name="is_presently_pregnant" checked><label for="pregnant_no"> No</label>
						<input type="radio" id="pregnant_yes" name="is_presently_pregnant"><label for="pregnant_yes"> Yes</label>
					</div>
				</div>
			</fieldset>

		</fieldset>

		<fieldset>
			<legend>Employment</legend>
			<div class="row">
				<div class="large-2 columns">
					<label for="working_yes">Currently Working? </label>
					<input type="radio" id="working_yes" name="currently_working" checked><label for="working_yes"> Yes</label>
					<input type="radio" id="working_no" name="currently_working" checked><label for="working_no"> No</label>
				</div>
				<div class="large-10 columns">
					<div class="row">
						<div class="large-12 columns">
							<label for="current_occupation">Current Occupation: </label>
							<input type="text" id="current_occupation" name="current_occupation" placeholder="Current Occupation">
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label for="previous occupation">Previous Occupation: </label>
							<input type="text" id="previous_occupation" name="previous_occupation" placeholder="Previous Occupation">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="large-6 columns">
					<label for="abroad_no">Do you work overseas/abroad in the past 5 years? </label>
				</div>
				<div class="large-6 columns">
					<input type="radio" id="abroad_no" name="is_work_abroad_in_past_5years" checked><label for="abroad_no"> No</label>
					<input type="radio" id="abroad_yes" name="is_work_abroad_in_past_5years"><label for="abroad_yes"> Yes</label>
				</div>
			</div>
			<div class="row">
				<div class="large-3 columns">
				</div>
				<div class="large-5 columns">
					<label for="last_contract_month">When did you return from your last contract? </label>
				</div>
				<div class="large-4 columns">
					<label for="last_contract_month">Month: </label>
					<input type="text" id="last_contract_month" name="last_contract_month" placeholder="Month">
					<label for="last_contract_year">Year: </label>
					<input type="text" id="last_contract_year" name="last_contract_year" placeholder="Year">
				</div>
			</div>
			<div class="row">
				<div class="large-3 columns">
				</div>
				<div class="large-5 columns">
					<label for="ship">Where were you based? </label>
				</div>
				<div class="large-4 columns">
					<input type="radio" id="ship" name="is_based" checked><label for="ship"> </label>
					<input type="radio" id="land" name="is_based"><label for="land"> Yes</label>
				</div>
			</div>
			<div class="row">
				<div class="large-3 columns">
				</div>
				<div class="large-5 columns">
					<label for="last_work_country">What country did you last work in? </label>
				</div>
				<div class="large-4 columns">
					<input type="text" id="last_work_country" name="last_work_country">
				</div>
			</div>
		</fieldset>

	</fieldset>
	
@endsection
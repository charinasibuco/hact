@extends('hact.layouts.layout_admin')

@section('content')
<div class="row">
	<div class="large-12 column text-center">HIV CARE FORM</div>
</div>
<div class="row">
	<div class="large-12 column text-center">
		The law on Reporting Disease (R.A. 3573) & the Philippine AIDS Prevention and Control Act (R.A. 8504) requires phycisians to report all diagnosed HIVinfections to the HIV & AIDS Registrar at the Epidermiology Bureau, DOH Please write in CAPITAL LETTERS and CHECKS the appropriate boxes.
	</div>
</div>
<hr>
<div class="row">
	<div class="large-3 column">
		<input type="checkbox" name="art_enrollment"> ART Enrollment
		<br>
		<input type="checkbox" name="refill"> Refill
	</div>
	<div class="large-9 column">
		<div class="large-6 column">
			<div class="row">
				<div class="large-12 column">Date of Visit:</div>
			</div>
			<div class="row">
				<div class="large-4 column">Visit type:</div>
				<div class="large-8 column">
					<input type="checkbox"> First consult at this facility<br>
						 Trans-in from:
					<br>
					<input type="checkbox">Follow-up
				</div>
			</div>
		</div>
		<div class="large-6 column">
			<div class="large-12 column">Physician's name:</div>
			<div class="large-12 column">Facility name:</div>
			<div class="large-12 column">Address:</div>
			<div class="large-12 column">Contact #:</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="large-1 columns text-center ">P<br />A<br />T<br />I<br />E<br />N<br />T<br /> <br />I<br />N<br />F<br />O<br /><br /></div>
	<div class="large-11 column">
		<div class="row">
			<div class="large-6 column">
				SACCL Confirmatory Code:
			</div>
			<div class="large-6 column">
				Patient Code:
			</div>
		</div>
			<fieldset>
				<div class="row">
					<div class="large-12 columns">If first visit, please fill out this section</div>
				</div>
				<div class="row">
					<div class="large-4 columns">
						UIC:
						<u>0</u> <u>0</u> | <u>0</u> <u>0</u> | <u>0</u> <u>0</u> <u>0</u> <u>0</u> <u>0</u> <u>0</u> <u>0</u> <u>0</u> 
					</div>
					<div class="large-2 columns">Philhealth No.:</div>
					<div class="large-6 columns">&nbsp;</div>
				</div>
				<div class="row">
					<div class="large-12 columns">*UIC: First two letters of mother's name, first two letters of father's name, two-digit birth order, birthdate(MM-DD-YYYY)</div>
				</div>
				<div class="row">
					<div class="large-3 columns">Patient's Full Name:</div>
					<div class="large-4 columns">&nbsp;</div>
					<div class="large-1 columns">Sex:</div>
					<div class="large-2 columns"><input type="checkbox" />&nbsp;M <input type="checkbox" />&nbsp;F</div>
					<div class="large-1 columns">Age:</div>
					<div class="large-1 columns text-center"></div>
				</div>
			</fieldset>
	</div>
</div>
<div class="row">
		<div class="large-1 columns text-center">
			L<br />A<br />B<br />O<br />R<br />A<br />T<br />O<br />R<br />Y<br /> <br />T<br />E<br />S<br />T<br />S<br /><br />
		</div>
		<div class="large-11 columns">
			<div class="row">
				<div class="large-5 columns text-center">Latest laboratory results</div>
				<div class="large-3 columns text-center">Date Done</div>
				<div class="large-2 columns text-center">Results</div>
				<div class="large-2 columns">&nbsp;</div>
			</div>
			<div class="row">
				<div class="large-5 columns ">Hemoglobin</div>
				<div class="large-3 columns text-center">&nbsp;</div>
				<div class="large-2 columns text-center">&nbsp;</div>
				<div class="large-2 columns">g/L</div>
			</div>
			<div class="row">
				<div class="large-5 columns ">CD4 Test</div>
				<div class="large-3 columns text-center">&nbsp;</div>
				<div class="large-2 columns text-center">&nbsp;</div>
				<div class="large-2 columns">cells/uL</div>
			</div>
			<div class="row">
				<div class="large-5 columns ">Viral Load</div>
				<div class="large-3 columns text-center">&nbsp;</div>
				<div class="large-2 columns text-center">&nbsp;</div>
				<div class="large-2 columns">copies/ml</div>
			</div>
			<div class="row">
				<div class="large-5 columns ">Chest X-Ray</div>
				<div class="large-3 columns text-center">&nbsp;</div>
				<div class="large-4 columns">&nbsp;</div>
			</div>
			<div class="row">
				<div class="large-5 columns ">Gene Xpert</div>
				<div class="large-3 columns text-center">&nbsp;</div>
				<div class="large-4 columns">&nbsp;</div>
			</div>
			<div class="row">
				<div class="large-5 columns ">DSSM/DST</div>
				<div class="large-3 columns text-center">&nbsp;</div>
				<div class="large-4 columns">&nbsp;</div>
			</div>
			<div class="row">
				<div class="large-5 columns ">HIVDR & Genotype</div>
				<div class="large-3 columns text-center">&nbsp;</div>
				<div class="large-4 columns">&nbsp;</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-1 columns text-center">
			T<br />B<br /> <br />I<br />N<br />F<br />O<br />R<br />M<br />A<br />T<br />I<br />O<br />N<br />
		</div>
		<div class="large-11 columns">
			<div class="row">
				<div class="large-9 columns">Presence of at least one of the following: weight loss, cough, night sweats, fever?</div>
				<div class="large-3 columns"><input type="checkbox" />&nbsp;Yes <input type="checkbox" />&nbsp;No</div>
			</div>
			<div class="row">
				<div class="large-12 columns">TB Status:</div>
			</div>
			<div class="row">
				<div class="large-2 columns"><input type="checkbox" /> No Active TB</div>
				<div class="large-2 columns">On IPT?</div>
				<div class="large-2 columns"><input type="checkbox" />&nbsp;Yes <input type="checkbox" />&nbsp;No</div>
				<div class="large-2 columns">IPT Outcome?</div>
				<div class="large-4 columns">
					<input type="checkbox" /> Completed 
					<input type="checkbox" /> Failed 
					<input type="checkbox" /> Other: 
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns"><input type="checkbox" /> With Active TB</div>
			</div>
			<div class="row">
				<div class="large-1 columns">Site:</div>
				<div class="large-2 columns"><input type="checkbox" /> Pulmonary</div>
				<div class="large-3 columns">&nbsp;</div>
				<div class="large-2 columns">Drug Resistance:</div>
				<div class="large-2 columns"><input type="checkbox" /> Susceptible</div>
				<div class="large-2 columns"><input type="checkbox" /> XDR</div>
			</div>
			<div class="row">
				<div class="large-1 columns">&nbsp;</div>
				<div class="large-2 columns"><input type="checkbox" /> Extrapulmonary</div>
				<div class="large-3 columns">&nbsp;</div>
				<div class="large-2 columns">&nbsp;</div>
				<div class="large-2 columns"><input type="checkbox" /> MDR/RR</div>
				<div class="large-2 columns"><input type="checkbox" /> Other: </div>
			</div>
		</div>
	</div>



@endsection
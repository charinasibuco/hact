@extends('hact.layouts.layout_admin')

@section('content')
<div class='row'>
	<div class='large-12 columns'>
		<ul class="breadcrumbs">
			<li class="current"><a href="#">Supplemental Form for Mother and Children</a></li>
		</ul>
	</div>
</div>
<div class="panel">
<fieldset>
<legend>Demographics</legend>
	<div class="row">
		<div class="large-12 column">
			<label>Patients Name:</label>
		</div>
		<div class="large-4 column">
			<input type="text" placeholder="FIRST NAME">
		</div>
		<div class="large-4 column">
			<input type="text" placeholder="MIDDLE NAME">
		</div>
		<div class="large-4 column">
			<input type="text" placeholder="LAST NAME">
		</div>
	</div>
	<div class="row" >
		<div class="large-12 column text-center">
			<h6>UNIQUE IDENTIFIER CODE</h6>
		</div>
	</div>
	<div class="row">
		<div class="large-2 column text-center">
			<div class="row">
				<label>First 2 letters of mothers's real name</label>
			</div>
			<div class="row">
				<div class="large-12 column">
					<input type="text">
				</div>
			</div>
		</div>
		<div class="large-2 column text-center">
			<div class="row">
				<label>First 2 letters of father's real name</label>
			</div>
			<div class="row">
				<div class="large-12 column">
					<input type="text">
				</div>
			</div>
		</div>
		<div class="large-2 column text-center">
			<div class="row">
				<label>Birth Order</label>
			</div>
			<div class="row">
				&nbsp;
			</div>
			<div class="row">
				<div class="large-12 column">
					<input type="text">
				</div>
			</div>
		</div>
		<div class="large-2 column text-center">
			<div class="row">
				<label>Month of Birth</label>
			</div>
			<div class="row">
				&nbsp;
			</div>
			<div class="row">
				<div class="large-12 column">
					<input type="text">
				</div>
			</div>
		</div>
		<div class="large-2 column text-center">
			<div class="row">
				<label>Day of Birth</label>
			</div>
			<div class="row">
				&nbsp;
			</div>
			<div class="row">
				<div class="large-12 column">
					<input type="text">
				</div>
			</div>
		</div>
		<div class="large-2 column text-center">
			<div class="row">
				<label>Year of Birth</label>
			</div>
			<div class="row">
				&nbsp;
			</div>
			<div class="row">
				<div class="large-12 column">
					<input type="text">
				</div>
			</div>
		</div>
	</div>
</fieldset>
	<div class="row">
		<div class="large-12 column text-center">
			<h6>FOR PREGNANT MOTHERS ONLY</h6>
		</div>
	</div>
	<fieldset>
		<legend>Pregnancy History</legend>
		<div class="row">
			<div class="large-3 column">
				<label>Number of Alive Children:</label>
			</div>
			<div class="large-2 column">
				<input type="text">
			</div>
			<div class="large-7 column">
				&nbsp;
			</div>
		</div>
		<fieldset>
			<legend>HIV Testing Status</legend>
			<div class="row">
				<div class="large-3 column">
					<div class="row text-center">
						<label>Child #1</label>
					</div>
					<div class="row">
						<div class="large-12 columns">
			            <label>HIV Status:
				            <select id="id_datatype" name="datatype">
				                <option value="" selected="selected">-------</option>
				                <option value="positive">Positive</option>
				                <option value="negative">Negative</option>
				                <option value="dontknow">Unknown</option>
				            </select>
			            </label>
    					</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label>Place Tested:</label>
						</div>
						<div class="large-12 columns">
							<input type="text">
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label>Date Tested:</label>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<input type="text" class="fdatepicker">
						</div>
					</div>
				</div>
				<div class="large-3 column">
					<div class="row text-center">
						<label>Child #2</label>
					</div>
					<div class="row">
						<div class="large-12 columns">
			            <label>HIV Status:
				            <select id="id_datatype" name="datatype">
				                <option value="" selected="selected">-------</option>
				                <option value="positive">Positive</option>
				                <option value="negative">Negative</option>
				                <option value="dontknow">Unknown</option>
				            </select>
			            </label>
    					</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label>Place Tested:</label>
						</div>
						<div class="large-12 columns">
							<input type="text">
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label>Date Tested:</label>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<input type="text" class="fdatepicker">
						</div>
					</div>
				</div>
				<div class="large-3 column">
					<div class="row text-center">
						<label>Child #3</label>
					</div>
					<div class="row">
						<div class="large-12 columns">
			            <label>HIV Status:
				            <select id="id_datatype" name="datatype">
				                <option value="" selected="selected">-------</option>
				                <option value="positive">Positive</option>
				                <option value="negative">Negative</option>
				                <option value="dontknow">Unknown</option>
				            </select>
			            </label>
    					</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label>Place Tested:</label>
						</div>
						<div class="large-12 columns">
							<input type="text">
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label>Date Tested:</label>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<input type="text" class="fdatepicker">
						</div>
					</div>
				</div>
				<div class="large-3 column">
					<div class="row text-center">
						<label>Child #4</label>
					</div>
					<div class="row">
						<div class="large-12 columns">
			            <label>HIV Status:
				            <select id="hiv_status" name="hiv_status">
				                <option value="" selected="selected">-------</option>
				                <option value="positive">Positive</option>
				                <option value="negative">Negative</option>
				                <option value="dontknow">Unknown</option>
				            </select>
			            </label>
    					</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label>Place Tested:</label>
						</div>
						<div class="large-12 columns">
							<input type="text">
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label>Date Tested:</label>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<input type="text" class="fdatepicker">
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		<div class="row">
			<div class="large-3 column">
				<label class="inline">Last Menstrual Period:</label>
			</div>
			<div class="large-4 column top">
				<input type="text" class="fdatepicker">
			</div>
			<div class="large-5 column">
				&nbsp;
			</div>
		</div>
		<div class="row">
			<div class="large-3 column">
				<label class="inline">Number of months and weeks pregnant:</label>
			</div>
			<div class="large-2 column">
				<input type="text" placeholder="months">
			</div>
			<div class="large-2 column">
				<input type="text" placeholder="weeks">
			</div>
			<div class="large-5 column">
				&nbsp;
			</div>
		</div>
		<div class="row">
			<div class="large-3 column">
				<label class="inline">Expected Date of Delivery :</label>
			</div>
			<div class="large-4 column top">
				<input type="text" class="fdatepicker">
			</div>
			<div class="large-5 column">
				&nbsp;
			</div>
		</div>
		<div class="row">
			<div class="large-3 column">
				<label>Where do you seek prenantal care?</label>
			</div>
			<div class="large-4 column">
				<input type="text">
			</div>
			<div class="large-5 column top">
			<label class="inline"><input type="checkbox"> No prenatal clinic visit</label>	
			</div>
		</div>
		<div class="row">
			<div class="large-3 column">
				<label>Where do you plan to deliver the baby?</label>
			</div>
			<div class="large-4 column">
				<label>
				<select id="plan_to_deliver_baby" name="plan_to_deliver_baby" onchange="planToDeliver(this);">
	                <option value="" selected="selected">-------</option>
	                <option value="hospital" >Hospital</option>
	                <option value="lying_in_clinic" id="specific_lying_in_clinic">Lying-in Clinic</option>
	                <option value="others" id="specific_others">Others</option>
	                <option value="home">Home</option>
	                <option value="no_plans_yet">No plans yet</option>
	            </select>
	            </label>
			</div>
			<div class="large-5 column">
				<input type="text" placeholder="Please Specify" style="display:none" id="specified">
			</div>
		</div>
		<fieldset>
			<legend>Partner's HIV History and Tx</legend>
				<div class="large-6 column">
					<div class="row">
						<div class="large-6 column">
							<label>Partner tested for HIV?</label>
			       		 </div>
			        	<div class="large-6 column">
			        		<label>
			        		<select id="plan_to_deliver_baby" name="plan_to_deliver_baby" onchange="yesnoCheck(this);">
				                <option value="" selected="selected">-------</option>
				                <option value="partner_tested_yes" >Yes</option>
				                <option value="partner_tested_no" >No</option>
				                <option value="partner_tested_dont_know" >Don't know</option>
				            </select>
				        	</label>
			        	</div>
					</div>
					<div class="row" style="display:none" id="ifYesWhen">
						<div class="large-6 column">
							<label  class="inline">When? </label>
						</div>
						<div class="large-6 column top">
							<input type="text"  class="fdatepicker" >
						</div>
					</div>
				</div>
				<div class="large-6 column">
					<div class="row" id="ifYesFacility" style="display:none">
						<div class="large-3 column">
							<label >Facility?</label>
						</div>
						<div class="large-9 column">
							<input type="text">
						</div>
					</div>
					<div class="row" id="ifYesResult" style="display:none">
						<div class="large-3 column">
							<label >Result</label>
						</div>
						<div class="large-9 column">
							<label>
							<select id="partner_tested_result" name="partner_tested_result">
				                <option value="" selected="selected">-------</option>
				                <option value="partner_tested_positive" >Positive</option>
				                <option value="partner_tested_negative" >Negative</option>
				                <option value="partner_tested_dont_know" >Don't know</option>
				                <option value="partner_tested_did_not_get_result" >Did not get result</option>
				            </select>
				            </label>
			        	</div>
					</div>
				</div>
			<div class="row">
				&nbsp;
			</div>
				<div class="large-6 column top">
					<div class="row">
						<div class="large-6 column">
							<label>Partner taking ARV medication/s?</label>
						</div>
						<div class="large-6 column">
							<label>
								<select id="parter_taking_arv_medication" name="parter_taking_arv_medication" onchange="stopped(this);">
									<option value="">------</option>
									<option value="parter_taking_arv_medication_yes">Yes</option>
									<option value="parter_taking_arv_medication_no">No</option>
									<option value="parter_taking_arv_medication_dont_know">Don't know</option>
									<option value="parter_taking_arv_medication_stopped">Stopped</option>
								</select>
							</label>
						</div>
					</div>
				</div>
				<div class="large-6 column top">
					<div class="row" style="display:none" id="ifStopped">
						<div class="large-3 column">
							<label>Reason:</label>
						</div>
						<div class="large-9 column">
							<input type="text">
						</div>
					</div>
				</div>
		</fieldset>
	</fieldset>
	
	<div class="row">
		<div class="large-12 column text-center">
			<h6>FOR CHILDREN ONLY</h6>
		</div>
	</div>
	<fieldset>
		<legend>Mother's HIV History</legend>
		<div class="row">
			<div class="large-1 column">
				<label>Sex:</label>
			</div>
			<div class="large-1 column">
				<label><input type="radio" name="sex">Male</label>
			</div>
			<div class="large-2 column">
				<label><input type="radio" name="sex">Female</label>
			</div>
			<div class="large-8 column">
				&nbsp;
			</div>
		</div>
		<div class="row">
			<div class="large-12 column">
				<label>Full Name of Mother:</label>
			</div>
		</div>
		<div class="row">
			<div class="large-4 column">
				<input type="text" placeholder="FIRST NAME">
			</div>
			<div class="large-4 column">
				<input type="text" placeholder="MIDDLE NAME">
			</div>
			<div class="large-4 column">
				<input type="text" placeholder="LAST NAME">
			</div>
		</div>
		<div class="row">
			<div class="large-3 column">
				<label class="inline">HIV Status of Mother:</label>
			</div>
			<div class="large-3 column">
				<label>
				<select id="mother_hiv_status" name="mother_hiv_status" onchange="ifPositive(this);">
					<option value="">-----</option>
					<option value="mother_hiv_status_positive">Positive</option>
					<option value="mother_hiv_status_negative">Negative</option>
					<option value="mother_hiv_status_dont_know">Don't know</option>
				</select>
				</label>
			</div>
			<div class="large-3 column">
				<label class="inline" style="display:none" id="labelDate">Date of HIV diagnosis:</label>
			</div>
			<div class="large-3 column">
				<input type="text" class="fdatepicker" style="display:none" id="inputDate">
			</div>
		</div>
		<div class="row" style="display:none" id="mother_saccl_and_arv_medication">
			<div class="large-3 column">
				<label class="inline">Mother's SACCL Number:</label>
			</div>
			<div class="large-3 column">
				<input  type="text">
			</div>
			<div class="large-3 column">
			 	<label>Mother took A  RV medication/s during pregancy?</label>
			 </div>
			<div class="large-3 column">
				<label>
				<select id="mothet_took_arv_medication" name="mothet_took_arv_medication" onchange="ifNoDontKnow(this);">
					<option value="">-------</option>
					<option value="mother_took_arv_medication_yes">Yes</option>
					<option value="mother_took_arv_medication_no">No</option>
					<option value="mother_took_arv_medication_dont_know">Don't know</option>
				</select>
				</label>
			</div>
		</div>
		<div class="row" id="reasonIfNo" style="display:none">
			<div class="large-9 column">
			</div>
			<div class="large-3 column">
				<input type="text" placeholder="REASON">
			</div>
		</div>	
		<div class="row" id="specifyIfother" style="display:none">
			<div class="large-9 column">
			</div>
			<div class="large-3 column">
				<input type="text" placeholder="SPECIFY">
			</div>
		</div>	
		<div class="row" style="display:none" id="breastfeed_and_dead_or_alive">
			<div class="large-3 column">
				<label class="inline">Did she breastfeed the baby?</label>
			</div>
			<div class="large-1 column">
				<label class="inline"><input type="radio" name="breastfeed">Yes</label>
			</div>
			<div class="large-1 column">
				<label class="inline"><input type="radio"  name="breastfeed">No</label>
			</div>
			<div class="large-1 column">
				&nbsp;
			</div>
			<div class="large-3 column">
				<label class="inline">Is Mother alive or dead?</label>
			</div>
			<div class="large-1 column">
				<label class="inline"><input type="radio" name="alive_or_dead">Alive</label>
			</div>
			<div class="large-1 column">
				<label class="inline"><input type="radio"  name="alive_or_dead">Dead</label>
			</div>
			<div class="large-1 column">
				&nbsp;
			</div>

		</div>
	</fieldset>
</div>
	<!-- <div class="row">
		<div class="large-12 column text-center">
			<h6>TO BE FILLED OUT BY SACCL PERSONNEL ONLY</h6>
		</div>
	</div>
	<fieldset>
		<legend>HIV Testing Status</legend>
		<div class="row">
			<div class="large-2 column">
				<label class="inline"><input type="checkbox"> PCR 1</label>
			</div>
			<div class="large-1 column">
				<label class="inline">Date:</label>
			</div>
			<div class="large-3 column">
				<input type="text" class="fdatepicker">
			</div>
			<div class="large-6 column">
				&nbsp;
			</div>
		</div>
		<div class="row">
			<div class="large-2 column">
				<label class="inline"><input type="checkbox"> PCR 2</label>
			</div>
			<div class="large-1 column">
				<label class="inline">Date:</label>
			</div>
			<div class="large-3 column">
				<input type="text" class="fdatepicker">
			</div>
			<div class="large-6 column">
				&nbsp;
			</div>
		</div>
		<div class="row">
			<div class="large-2 column">
				<label class="inline"><input type="checkbox"> PCR 3</label>
			</div>
			<div class="large-1 column">
				<label class="inline">Date:</label>
			</div>
			<div class="large-3 column">
				<input type="text" class="fdatepicker">
			</div>
			<div class="large-6 column">
				&nbsp;
			</div>
		</div>
	</fieldset> -->
<script type="text/javascript">
function planToDeliver(that){
	if (that.value == "hospital"){
		document.getElementById("specified").style.display="block";
	}
	else if (that.value == "lying_in_clinic"){
		document.getElementById("specified").style.display="block";
	}
	else if(that.value == "others"){
		document.getElementById("specified").style.display="block";
	}
	else{
		document.getElementById("specified").style.display="none";
	}
}

function yesnoCheck(that){

	if(that.value  == "partner_tested_yes"){
		document.getElementById("ifYesWhen").style.display="block";
		document.getElementById("ifYesFacility").style.display="block";
		document.getElementById("ifYesResult").style.display="block";
	}
	else{
		document.getElementById("ifYesWhen").style.display="none";
		document.getElementById("ifYesFacility").style.display="none";
		document.getElementById("ifYesResult").style.display="none";
	}
}

function stopped(that){
 	if(that.value == "parter_taking_arv_medication_stopped"){
 		document.getElementById("ifStopped").style.display="block";
 	}
 	else{
 		document.getElementById("ifStopped").style.display="none";
 	}
}
function ifPositive(that){
	if(that.value == "mother_hiv_status_positive"){
		document.getElementById("labelDate").style.display="block";
		document.getElementById("inputDate").style.display="block";
		document.getElementById("mother_saccl_and_arv_medication").style.display="block";
		document.getElementById("breastfeed_and_dead_or_alive").style.display="block";
	}
	else{
		document.getElementById("labelDate").style.display="none";
		document.getElementById("inputDate").style.display="none";
		document.getElementById("mother_saccl_and_arv_medication").style.display="none";
		document.getElementById("breastfeed_and_dead_or_alive").style.display="none";
	}
}
function ifNoDontKnow(that){
	if(that.value == "mother_took_arv_medication_no"){
		document.getElementById("reasonIfNo").style.display="block";
	}
	else if(that.value == "mother_took_arv_medication_dont_know"){
		document.getElementById("specifyIfother").style.display="block";
	}
	else{
		document.getElementById("reasonIfNo").style.display="none";
		document.getElementById("specifyIfother").style.display="none";
	}
}

</script>
@endsection
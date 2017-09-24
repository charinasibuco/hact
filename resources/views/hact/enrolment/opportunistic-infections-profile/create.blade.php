@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-12 columns'>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Home</a></li>
				<li><a href="{{ route('oi_profile_index') }}">Opportunistic Infections</a></li>
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
					<div class="large-5 columns">
						<div class="row collapse">
							<div class="small-10 columns">
								<input type="text" id="search_patient" name="search_patient" placeholder="Search Patient" value="{{ $search_patient }}">
                            	<input type="hidden" id="demographics_id" name="demographics_id" value="{{ $demographics_id }}" />
			                    <input type="hidden" id="search_patient_url" name="search_patient_url" value="{{ route('search_demographics_patient') }}" />
							</div>
					    	<div class="small-2 columns">
					      		<span class="postfix"><i class="fa fa-search"></i></span>
					    	</div>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>None</legend>
				<div class="row">
					<div class="large-4 columns">
						<label for="">Started with IPT:</label>
						<input type="radio" id="ipt_yes" name="ipt" value="1" /><label for="ipt_yes">Yes</label>
						<input type="radio" id="ipt_no" name="ipt" value="0" /><label for="ipt_no">No</label>
					</div>
					<div class="large-4 columns">
						<label for="ipt_reason">Reason:</label>
						<input type="text" placeholder="Reason" id="ipt_reason" name="ipt_reason" value="{{ $ipt_reason }}" readonly="readonly" />
					</div>
					<div class="large-4 columns">&nbsp;</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Other</legend>
				<div class="row">
					<div class="large-4 columns">
						<label for="hepatitis_b"><input type="checkbox" id="hepatitis_b" name="hepatitis_b" value="1" {{ ($hepatitis_b == 1)? 'checked="checked"' : '' }} /> Hepatitis B</label>
						<label for="hepatitis_c"><input type="checkbox" id="hepatitis_c" name="hepatitis_c" value="1" {{ ($hepatitis_c == 1)? 'checked="checked"' : '' }} /> Hepatitis C</label>
						<label for="pneumocystis_pneumonia"><input type="checkbox" id="pneumocystis_pneumonia" name="pneumocystis_pneumonia" value="1" {{ ($pneumocystis_pneumonia == 1)? 'checked="checked"' : '' }} /> Pneumocystis Pneumonia</label>
						<label for="oropharyngeal_candidiasis"><input type="checkbox" id="oropharyngeal_candidiasis" name="oropharyngeal_candidiasis" value="1" {{ ($oropharyngeal_candidiasis == 1)? 'checked="checked"' : '' }} /> Oropharyngeal Candidiasis</label>
						<label for="syphilis"><input type="checkbox" id="syphilis" name="syphilis" value="1" {{ ($syphilis == 1)? 'checked="checked"' : '' }} /> Syphilis</label>
					</div>
					<div class="large-8 columns">
						<label for="sti"><input type="checkbox" id="sti" name="sti" value="1" /> STI's</label>
						<input type="text" placeholder="Specify" id="sti_reason" name="sti_reason" value="" readonly="readonly" />
						<label for="others"><input type="checkbox" id="others" name="others" value="1" {{ ($others == 1)? 'checked="checked"' : '' }} /> Others</label>
						<input type="text" placeholder="Specify" id="others_reason" name="others_reason" value="{{ $others_reason }}" readonly="readonly" />
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>TB Information</legend>
				
				<div class="row">
					<div class="large-6 columns">
						<div class="row">
							<div class="large-12 columns">
								<label for="site">Site</label>
							</div>
						</div>
						<div id="site_list" class="row">
							<div class="large-1 columns">&nbsp;</div>
							<div class="large-11 columns">
								<label for="site_pulmonary"><input type="radio" id="site_pulmonary" name="site_value" value="Pulmonary" {{ ($site_value == 'Pulmonary')? 'checked="checked"' : '' }} /> Pulmonary</label>
								<label for="site_extrapulmonary"><input type="radio" id="site_extrapulmonary" name="site_value" value="Extrapulmonary" {{ ($site_value == 'Extrapulmonary')? 'checked="checked"' : '' }} /> Extrapulmonary</label>
							</div>
						</div>
					</div>
					<div class="large-6 columns">
						<div class="row">
							<div class="large-12 columns">
								<label for="tb_regimen">TB Regimen</label>
							</div>
						</div>
						<div id="tb_regimen_list" class="row">
							<div class="large-1 columns">&nbsp;</div>
							<div class="large-4 columns">
								<label for="category_1"><input type="radio" id="category_1" name="tb_regimen_value" value="Category I" {{ ($tb_regimen_value == 'Category I')? 'checked="checked"' : '' }} /> Category I</label>
								<label for="category_2"><input type="radio" id="category_2" name="tb_regimen_value" value="Category II" {{ ($tb_regimen_value == 'Category II')? 'checked="checked"' : '' }} /> Category II</label>
								<label for="srdr"><input type="radio" id="srdr" name="tb_regimen_value" value="SRDR" {{ ($tb_regimen_value == 1)? 'checked="checked"' : '' }} /> SRDR</label>
							</div>
							<div class="large-4 columns">
								<label for="category_1a"><input type="radio" id="category_1a" name="tb_regimen_value" value="Category Ia" {{ ($tb_regimen_value == 'Category Ia')? 'checked="checked"' : '' }} /> Category Ia</label>
								<label for="category_2a"><input type="radio" id="category_2a" name="tb_regimen_value" value="Category IIa" {{ ($tb_regimen_value == 'Category IIa')? 'checked="checked"' : '' }} /> Category IIa</label>
								<label for="xdr_tb_regimen"><input type="radio" id="xdr_tb_regimen" name="tb_regimen_value" value="XDR-TB regimen" {{ ($tb_regimen_value == 'XDR-TB regimen')? 'checked="checked"' : '' }} /> XDR-TB regimen</label>
							</div>
							<div class="large-3 columns">&nbsp;</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="large-6 columns">
						<div class="row">
							<div class="large-12 columns">
								<label for="drug_resistance">Drug Resistance</label>
							</div>
						</div>
						<div id="drug_resistance_list" class="row">
							<div class="large-1 columns">&nbsp;</div>
							<div class="large-11 columns">
								<label for="susceptible"><input type="radio" id="susceptible" name="drug_resistance_value" value="Susceptible" {{ ($drug_resistance_value == 'Susceptible')? 'checked="checked"' : '' }} /> Susceptible</label>
								<label for="mdr_rr"><input type="radio" id="mdr_rr" name="drug_resistance_value" value="MDR/RR" {{ ($drug_resistance_value == 'MDR/RR')? 'checked="checked"' : '' }} /> MDR/RR</label>
								<label for="xdr"><input type="radio" id="xdr" name="drug_resistance_value" value="XDR" {{ ($drug_resistance_value == 'XDR')? 'checked="checked"' : '' }} /> XDR</label>
								<label for="drug_resistance_other"><input type="radio" id="drug_resistance_other" name="drug_resistance_value" value="Other" /> Other</label>
								<input type="text" id="drug_resistance_value_specify" name="drug_resistance_value_specify" value="" readonly="readonly" />
							</div>
						</div>
					</div>
					<div class="large-6 columns">
						<div class="row">
							<div class="large-12 columns">
								<label for="treatment_outcome">Treatment Outcome</label>
							</div>
						</div>
						<div id="treatment_outcome_list" class="row">
							<div class="large-1 columns">&nbsp;</div>
							<div class="large-11 columns">
								<label for="cured"><input type="radio" id="cured" name="treatment_outcome_value" value="Cured" {{ ($treatment_outcome_value == 'Cured')? 'checked="checked"' : '' }} /> Cured</label>
								<label for="completed"><input type="radio" id="completed" name="treatment_outcome_value" value="Completed" {{ ($treatment_outcome_value == 'Completed')? 'checked="checked"' : '' }} /> Completed</label>
								<label for="failed"><input type="radio" id="failed" name="treatment_outcome_value" value="Failed" {{ ($treatment_outcome_value == 'Failed')? 'checked="checked"' : '' }} /> Failed</label>
								<label for="treatment_outcome_other"><input type="radio" id="treatment_outcome_other" name="treatment_outcome_value" value="Other" /> Other</label>
								<input type="text" id="treatment_outcome_value_specify" name="treatment_outcome_value_specify" value="" readonly="readonly" />
							</div>
						</div>
					</div>
				</div>
			</fieldset><br />

			<div class="row">
				<div class="large-4 columns">&nbsp;</div>
				<div class="large-4 columns">
					<div class="row">
						<div class="large-3 columns">&nbsp;</div>
						<div class="large-6 columns">
							{!! csrf_field() !!}
							<input type="submit" class="button alert expand" value="Submit">
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
//	IPT
if($ipt == 1){
	echo '$(\'#ipt_yes\').attr("checked", true);';
	echo '$(\'#ipt_reason\').attr("readonly", true);';
}else{
	echo '$(\'#ipt_no\').attr("checked", true);';
	echo '$(\'#ipt_reason\').attr("readonly", false);';
}
//	STI
if($sti == 1){
	echo '$(\'#sti\').attr("checked", true);';
	echo '$(\'#sti_reason\').val(\'' . $sti_reason . '\').attr("readonly", false);';
}else{
	echo '$(\'#sti\').attr("checked", false);';
	echo '$(\'#sti_reason\').val(\'\').attr("readonly", true);';
}
//	Other
if($others == 1){
	echo '$(\'#others\').attr("checked", true);';
	echo '$(\'#others_reason\').val(\'' . $others_reason . '\').attr("readonly", false);';
}else{
	echo '$(\'#others\').attr("checked", false);';
	echo '$(\'#others_reason\').val(\'\').attr("readonly", true);';
}
//	Drug Resistance
if($drug_resistance_value == 'Other'){
	echo '$(\'#drug_resistance_other\').attr("checked", true);';
	echo '$(\'#drug_resistance_value_specify\').val(\'' . $drug_resistance_value_specify . '\').attr("readonly", false);';
}else{
	echo '$(\'#drug_resistance_other\').attr("checked", false);';
	echo '$(\'#drug_resistance_value_specify\').val(\'\').attr("readonly", true);';
}
//	Treatment Outcome
if($treatment_outcome_value == 'Other'){
	echo '$(\'#treatment_outcome_other\').attr("checked", true);';
	echo '$(\'#treatment_outcome_value_specify\').val(\'' . $treatment_outcome_value_specify . '\').attr("readonly", false);';
}else{
	echo '$(\'#treatment_outcome_other\').attr("checked", false);';
	echo '$(\'#treatment_outcome_value_specify\').val(\'\').attr("readonly", true);';
}
?>

$(function(){
	$('input[name=\'ipt\']').click(function(){
        var status = $(this).val();

		if(status == 1)
		{
			$('#ipt_reason').val('').attr('readonly', true);
		}
		else
		{
			$('#ipt_reason').val('').attr('readonly', false);
		}
	});
});

$(function(){
	$('#sti').change(function(){
        var status = $(this).is(':checked');

		if(status == true)
		{
			$('#sti_reason').val('').attr('readonly', false);
		}
		else
		{
			$('#sti_reason').val('').attr('readonly', true);
		}
	});
});

$(function(){
	$('#others').change(function(){
        var status = $(this).is(':checked');

		if(status == true)
		{
			$('#others_reason').val('').attr('readonly', false);
		}
		else
		{
			$('#others_reason').val('').attr('readonly', true);
		}
	});
});

//	TB Regimen
$(function(){
	$('input[name=\'tb_regimen_value\']').change(function(){
		$('#tb_regimen').prop('checked', true).change();
	});
});

//	Drug Resistance
$(function(){
	$('#drug_resistance').change(function(){
        var status = $(this).is(':checked');
        //console.log(status);

        if(status == false)
        {
        	$('input[name=\'drug_resistance_value\']').attr("checked",false);
			$('#drug_resistance_value_specify').val('').attr('readonly', true);
        }
	});
});

$(function(){
	$('input[name=\'drug_resistance_value\']').change(function(){
        var status = $(this).is(':checked');
        var value = $(this).val();
		//$('#drug_resistance').prop('checked', true).change();

		if(value == "Other")
		{
			$('#drug_resistance_value_specify').val('').attr('readonly', false);
		}
		else
		{
			$('#drug_resistance_value_specify').val('').attr('readonly', true);
		}
	});
});

//	Treatment Outcome
$(function(){
	$('#treatment_outcome').change(function(){
        var status = $(this).is(':checked');

        if(status == false)
        {
        	$(this).attr('checked',false);
			$(this).removeAttr('checked');
        	$('input[name=\'treatment_outcome_value\']').attr('checked', false);
			$('#treatment_outcome_value_specify').val('').attr('readonly', true);
        }
	});
});

$(function(){
	$('input[name=\'treatment_outcome_value\']').change(function(){
        var status = $(this).is(':checked');
        var value = $(this).val();
		//$('#treatment_outcome').prop('checked', true).change();

		if(value == "Other")
		{
			$('#treatment_outcome_value_specify').val('').attr('readonly', false);
		}
		else
		{
			$('#treatment_outcome_value_specify').val('').attr('readonly', true);
		}
	});
});
</script>
@endsection
@extends('hact.layouts.layout_admin')

@section('content')

    <div class='row'>
        <div class='large-12 columns'>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('arv_index') }}">Antiretroviral (ARV)</a></li>
                <li class="current"><a href="#">New Record</a></li>
            </ul>
        </div>
    </div>

	@include('hact.messages.success')
	@include('hact.messages.error_list')

	<div class="panel">
		<form action='{{ $action }}' method='post'>
		    <fieldset>
		        <legend>Patient's</legend>
                <div class="row">
                    <div class="large-6 columns">
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
                    <div class="large-6 columns">&nbsp;</div>
                </div>
		    </fieldset>
			<fieldset>
				<legend>Vital Signs</legend>
		        <div class="row">
					<div class='large-6 columns'>
						<label>Blood Pressure:</label>
						<input type='text' name='blood_pressure' placeholder='Blood Pressure' value='{{ $blood_pressure }}'>
						<label>Temperature</label>
						<input type='text' name='temperature' placeholder='Temperature' value='{{ $temperature }}'>
						<label>Pulse Rate</label>
						<input type='text' name='pulse_rate' placeholder='Pulse Rate' value='{{ $pulse_rate }}'>
					</div>
					<div class='large-6 columns'>
						<label>Respiration Rate</label>
						<input type='text' name='respiration_rate' placeholder='Respiration Rate' value='{{ $respiration_rate }}'>
						<label>Weight</label>
						<input type='text' name='weight' placeholder='Weight' value='{{ $weight }}'>
					</div>
		        </div>
			</fieldset>
			<fieldset>
				<legend>Tuberculosis Info</legend>
				<div class='row'>
					<div class='large-12 columns'>
						<label for='tuberculosis'><input type='checkbox' id='tuberculosis' name='tuberculosis' value='1' {{ ($tuberculosis == 1)? 'checked="checked"' : ''}} > Tuberculosis </label>
					<div>
				</div>
				<div class="row tubercolosis-info">
					<div class='large-4 columns'>
						<div class='row'>
							<div class='large-1 columns'>&nbsp;
							</div>
							<div class='large-11 columns'>
								<label> Site:</label>
							</div>
						</div>
						<div class='row'>
							<div class='large-2 columns'>
							</div>
							<div class='large-10 columns'>
								<label for='pulmonary'><input type='radio' id='pulmonary' name='site' value='pulmonary'> Pulmonary </label>
								<label for='extrapulmonary'><input type='radio' id='extrapulmonary' name='site' value='extrapulmonary'> Extra Pulmonary </label>
							</div>
						</div>
					</div>
					<div class='large-4 columns'>
						<div class='row'>
							<div class='large-12 columns'>
								<label>TB Regimen:</label>
							</div>
						</div>
						<div class='row'>
							<div class='large-1 columns'>&nbsp;
							</div>
							<div class='large-11 columns'>
								<label for='categoryI'><input type='radio' id='categoryI' name='regimen' value='Category I'> Category I </label>
								<label for='categoryIa'><input type='radio' id='categoryIa' name='regimen' value='Category Ia'> Category Ia </label>
								<label for='categoryII'><input type='radio' id='categoryII' name='regimen' value='Category II'> Category II </label>
								<label for='categoryIIa'><input type='radio' id='categoryIIa' name='regimen' value='Category IIa'> Category IIa </label>
								<label for='srdr'><input type='radio' id='srdr' name='regimen' value='SRDR'> SRDR </label>
								<label for='xdrtb'><input type='radio' id='xdrtb' name='regimen' value='XDR-TB'> XDR-TB </label>
							</div>
						</div>
					</div>	
					<div class='large-4 columns'>
						<div class='row'>
							<div class='large-12 columns'>
								<label>Drug Resistance:</label>
							</div>
						</div>
						<div class='row'>
							<div class='large-1 columns'>&nbsp;
							</div>
							<div class="large-11 columns">
								<label for="susceptible"><input type="radio" id="susceptible" name="drug_resistance_value" value="Susceptible" {{ ($drug_resistance_value == 'Susceptible')? 'checked="checked"' : '' }} /> Susceptible</label>
								<label for="mdr_rr"><input type="radio" id="mdr_rr" name="drug_resistance_value" value="MDR/RR" {{ ($drug_resistance_value == 'MDR/RR')? 'checked="checked"' : '' }} /> MDR/RR</label>
								<label for="xdr"><input type="radio" id="xdr" name="drug_resistance_value" value="XDR" {{ ($drug_resistance_value == 'XDR')? 'checked="checked"' : '' }} /> XDR</label>
								<label for="drug_resistance_other"><input type="radio" id="drug_resistance_other" name="drug_resistance_value" value="Other" /> Other</label>
								<input type="text" id="drug_resistance_value_specify" name="drug_resistance_value_specify" value="" readonly="readonly"/>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Others</legend>
				<div class='row'>
					<div class='large-4 columns'>
						<label for='hepatitisb'><input type='checkbox' id='hepatitisb' name='hepatitisb'  value='1' {{ ($hepatitisb == 1)? 'checked="checked"' : ''}} > Hepatitis B </label>
						<label for='hepatitisc'><input type='checkbox' id='hepatitisc' name='hepatitisc'  value='1' {{ ($hepatitisc == 1)? 'checked="checked"' : ''}}> Hepatitis C </label>
						<label for='pneumocystis_pneumonia'><input type='checkbox' id='pneumocystis_pneumonia' name='pneumocystis_pneumonia' value='1' {{ ($pneumocystis_pneumonia == 1)? 'checked="checked"' : ''}}> Pneumocystis Pneumonia </label>
						<label for='oropharyngeal_candidiasis'><input type='checkbox' id='oropharyngeal_candidiasis' name='oropharyngeal_candidiasis'value='1' {{ ($oropharyngeal_candidiasis == 1)? 'checked="checked"' : ''}}> Oropharyngeal Candidiasis </label>
						<label for='syphilis'><input type='checkbox' id='syphilis' name='syphilis' value='1' {{ ($syphilis == 1)? 'checked="checked"' : ''}}> Syphilis </label>
					</div>
					<div class="large-8 columns">
						<label for="stis"><input type="checkbox" id="stis" name="stis" value="1" /> STI's</label>
						<input type="text" placeholder="Specify" id="stis_reason" name="stis_reason" value="" readonly="readonly" />
						<label for="diagnosed_other"><input type="checkbox" id="diagnosed_other" name="diagnosed_other" value="1" {{ ($diagnosed_other == 1)? 'checked="checked"' : '' }} /> Others</label>
						<input type="text" placeholder="Specify" id="diagnosed_other_input" name="diagnosed_other_input" value="{{ $diagnosed_other_input }}" readonly="readonly" />
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>WHO Classification </legend>
				<div class='row'>
					<div class='large-4 column'>
						<label for='categoryI_classification'><input type='radio' id='categoryI_classification' name='classification' value='Category I'> Category I</label>
						<label for='categoryII_classification'><input type='radio' id='categoryII_classification'  name='classification' value='Category II'> Category II</label>
					</div>
					<div class='large-8 column'>
						<label for='categoryIII_classification'><input type='radio' id='categoryIII_classification' name='classification' value='Category III'> Category III</label>
						<label for='categoryIV_classification'><input type='radio' id='categoryIV_classification'  name='classification' value='Category IV'> Category IV</label>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Fill up</legend>
				<div class="row">
					<div class='large-4 column'>
						<label>ARV Date Started:</label>
						<input type='text' class='fdatepicker' id='datepicker' placeholder='ARV Date Started' name='arv_date' readonly="readonly" value="{{ $arv_date }}" >
						<div id='sample'>
							<label>Reason:</label>
							<label for='low'><input type='checkbox' id='low' name='low_cd4_count' {{ ($low_cd4_count == 1)? 'checked="checked"' : ''}}> Low CD4 count</label>
							<label for='active'><input type='checkbox' id='active' name='active_tb' {{ ($active_tb == 1)? 'checked="checked"' : ''}}> Active TB</label>
							<label for='child'><input type='checkbox' id='child' name='child_5yr' {{ ($child_5yr == 1)? 'checked="checked"' : ''}}> Child < 5y.o.</label>
							<label for='treatment'><input type='checkbox' id='treatment' name='hep_b_c' {{ ($hep_b_c == 1)? 'checked="checked"' : ''}}> Hep B or C requiring treatment</label>
							<label for='pregnant'><input type='checkbox' id='pregnant' name='pregnant_breastfeeding' {{ ($pregnant_breastfeeding == 1)? 'checked="checked"' : ''}}> Pregnant/ Breastfeeding</label>
							<label for='classification'><input type='checkbox' id='classification' name='who_classification' {{ ($who_classification == 1)? 'checked="checked"' : ''}}> WHO Classification 3 or 4</label>
							<label>Other<input type='text' placeholder='Please Specify' name='reason_other' value="{{ $reason_other }}"></label>
						</div>
					</div>
					<div class='large-8 column'>
						<label>Recommendations:</label>
						<textarea class='customtext' name='recommendations'>{{ $recommendations }}</textarea>
					</div>
				</div>
			</fieldset><br>
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

<script>

<?php
//	Site
if($site == 'pulmonary'){
	echo '$(\'#pulmonary\').attr("checked", true);';
}elseif($site == 'extrapulmonary'){
	echo '$(\'#extrapulmonary\').attr("checked", true);';
}
//	Regimen
if($regimen == 'Category I'){
	echo '$(\'#categoryI\').attr("checked", true);';
}elseif($regimen == 'Category Ia'){
	echo '$(\'#categoryIa\').attr("checked", true);';
}elseif($regimen == 'Category II'){
	echo '$(\'#categoryII\').attr("checked", true);';
}elseif($regimen == 'Category IIa'){
	echo '$(\'#categoryIIa\').attr("checked", true);';
}elseif($regimen == 'SRDR'){
	echo '$(\'#srdr\').attr("checked", true);';
}elseif($regimen == 'XDR-TB'){
	echo '$(\'#xdrtb\').attr("checked", true);';
}
//	Drug Resistance
if($drug_resistance_value == 'Other'){
	echo '$(\'#drug_resistance_other\').attr("checked", true);';
	echo '$(\'#drug_resistance_value_specify\').val(\'' . $drug_resistance_value_specify . '\').attr("readonly", false);';
}else{
	echo '$(\'#drug_resistance_other\').attr("checked", false);';
	echo '$(\'#drug_resistance_value_specify\').val(\'\').attr("readonly", true);';
}
// STI`s
if($stis == 1){
	echo '$(\'#stis\').attr("checked", true);';
	echo '$(\'#stis_reason\').val(\'' . $stis_reason . '\').attr("readonly", false);';
}else{
	echo '$(\'#stis\').attr("checked", false);';
	echo '$(\'#stis_reason\').val(\'\').attr("readonly", true);';
}
//	diagnosed_other
if($diagnosed_other == 1){
	echo '$(\'#diagnosed_other\').attr("checked", true);';
	echo '$(\'#diagnosed_other_input\').val(\'' . $diagnosed_other_input . '\').attr("readonly", false);';
}else{
	echo '$(\'#diagnosed_other\').attr("checked", false);';
	echo '$(\'#diagnosed_other_input\').val(\'\').attr("readonly", true);';
}
//	classification
if($classification == 'Category I'){
	echo '$(\'#categoryI_classification\').attr("checked", true);';
}elseif($classification == 'Category II'){
	echo '$(\'#categoryII_classification\').attr("checked", true);';
}elseif($classification == 'Category III'){
	echo '$(\'#categoryIII_classification\').attr("checked", true);';
}elseif($classification == 'Category IV'){
	echo '$(\'#categoryIV_classification\').attr("checked", true);';
}
?>

$('#tuberculosis').change(function(){
	$('#pulmonary').prop('checked', false);
	$('#extrapulmonary').prop('checked', false);
	$('#categoryI').prop('checked', false);
	$('#categoryIa').prop('checked', false);
	$('#categoryII').prop('checked', false);
	$('#categoryIIa').prop('checked', false);
	$('#srdr').prop('checked', false);
	$('#xdrtb').prop('checked', false);
	$('#susceptible').prop('checked', false);
	$('#mdr_rr').prop('checked', false);
	$('#xdr').prop('checked', false);
	$('#drug_resistance_other').prop('checked', false);
});

$('.tubercolosis-info input[type=\'radio\']').change(function(){
	$('#tuberculosis').prop('checked', true);
});

$(function(){
	$('#stis').change(function(){
        var status = $(this).is(':checked');

		if(status == true)
		{
			$('#stis_reason').val('').attr('readonly', false);
		}
		else
		{
			$('#stis_reason').val('').attr('readonly', true);
		}
	});
});

$(function(){
	$('#diagnosed_other').change(function(){
        var status = $(this).is(':checked');

		if(status == true)
		{
			$('#diagnosed_other_input').val('').attr('readonly', false);
		}
		else
		{
			$('#diagnosed_other_input').val('').attr('readonly', true);
		}
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
        //console.log(value);
		$('#drug_resistance').prop('checked', true).change();

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
// if($('input#datepicker:empty')){
// 	$('#sample').css({display:'none'});
// }
// else{
// 	$('#sample').css({display:'block'});

$('input#datepicker').empty(function()
{
    if( !$(this).val() ) {
         $('#sample').css({display:'none'});
    }
});
</script>

@endsection
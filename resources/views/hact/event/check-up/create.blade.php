@extends("hact.layouts.layout_admin")

@section("content")
	<div class="row">
        <div class="large-12 columns">
            <ul class="breadcrumbs">
                <li><a href="{{ route("dashboard") }}">Home</a></li>
                <li><a href="{{ route("checkup_index") }}">Check Up</a></li>
                <li class="current"><a href="#">New Record</a></li>
            </ul>
        </div>
    </div>
	@include("hact.messages.success")
	@include("hact.messages.error_list")
	<div class="panel">
		<form action="{{ $action }}" method="post">
		<fieldset>
    		<legend>Patient</legend>
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
                <div class="large-6 columns">
                	<div class="row">
		    			<div class="large-12 columns">
							<input type="hidden" class="fdatepicker" id="checkup_date" name="checkup_date" placeholder="Check Up Date" value="{{ $checkup_date }}" readonly />
		    			</div>
		    		</div>
                </div>
            </div>
		</fieldset>
		<fieldset>
			<legend>Vital Signs</legend>
			<div class="large-6 columns">
				<label>Blood Pressure:</label>
				<input type="text" name="blood_pressure" placeholder="Blood Pressure" value="{{ $blood_pressure }}">
				<label>Temperature</label>
				<input type="text" name="temperature" placeholder="Temperature" value="{{ $temperature }}">
				<label>Pulse Rate</label>
				<input type="text" name="pulse_rate" placeholder="Pulse Rate" value="{{ $pulse_rate }}">
			</div>
			<div class="large-6 columns">
				<label>Respiration Rate</label>
				<input type="text" name="respiration_rate" placeholder="Respiration Rate" value="{{ $respiration_rate }}">
				<label>Weight</label>
				<input type="text" name="weight" placeholder="Weight" value="{{ $weight }}">
			</div>
		</fieldset>
				
		<fieldset>
			<legend>Opportunistic Infection Diagnosed</legend>
			<fieldset>
				<legend class="sublegend">Tuberculosis Info</legend>
				<div class="row">
					<div class="large-12 columns">
						<label for="tuberculosis"><input type="checkbox" id="tuberculosis" name="tuberculosis" value="1" {{ ($tuberculosis == 1)? 'checked="checked"' : ''}} > Tuberculosis </label>
					<div>
				</div>
				<div class="row">
					<div class="large-4 columns">
						<div class="row">
							<div class="large-1 columns">&nbsp;
							</div>
							<div class="large-11 columns">
								<label> Site:</label>
							</div>
						</div>
						<div class="row">
							<div class="large-2 columns">
							</div>
							<div class="large-10 columns">
								<label for="pulmonary"><input type="radio" id="pulmonary" name="site" value="Pulmonary" {{ ($site == 'Pulmonary')? 'checked="checked"':''}}> Pulmonary </label>
								<label for="extrapulmonary"><input type="radio" id="extrapulmonary" name="site" value="Extrapulmonary" {{ ($site == 'Extrapulmonary')? 'checked="checked"':''}}> Extra Pulmonary </label>
							</div>
						</div>
					</div>
					<div class="large-4 columns">
						<div class="row">
							<div class="large-12 columns">
								<label>TB Regimen:</label>
							</div>
						</div>
						<div class="row">
							<div class="large-1 columns">&nbsp;
							</div>
							<div class="large-11 columns">
								<label for="categoryI"><input type="radio" id="categoryI" name="regimen" value="Category I" {{ ($regimen == "Category I")?'checked="checked"':''}}> Category I </label>
								<label for="categoryIa"><input type="radio" id="categoryIa" name="regimen" value="Category Ia" {{ ($regimen == "Category Ia")?'checked="checked"':''}}> Category Ia </label>
								<label for="categoryII"><input type="radio" id="categoryII" name="regimen" value="Category II" {{ ($regimen == "Category II")?'checked="checked"':''}}> Category II </label>
								<label for="categoryIIa"><input type="radio" id="categoryIIa" name="regimen" value="Category IIa" {{ ($regimen == "Category IIa")?'checked="checked"':''}}> Category IIa </label>
								<label for="srdr"><input type="radio" id="srdr" name="regimen" value="SRDR" {{ ($regimen == "SRDR")?'checked="checked"':''}}> SRDR </label>
								<label for="xdrtb"><input type="radio" id="xdrtb" name="regimen" value="XDR-TB" {{ ($regimen == "XDR-TB")?'checked="checked"':''}}> XDR-TB </label>
							</div>
						</div>
					</div>	
					<div class="large-4 columns">
						<div class="row">
							<div class="large-12 columns">
								<label>Drug Resistance:</label>
							</div>
						</div>
						<div class="row">
							<div class="large-1 columns">&nbsp;
							</div>
							<div class="large-11 columns">
								<label for="susceptible"><input type="radio" id="susceptible" name="drug_resistance_value" value="Susceptible" {{ ($drug_resistance_value == "Susceptible")? 'checked="checked"' : '' }} /> Susceptible</label>
								<label for="mdr_rr"><input type="radio" id="mdr_rr" name="drug_resistance_value" value="MDR/RR" {{ ($drug_resistance_value == "MDR/RR")? 'checked="checked"' : '' }} /> MDR/RR</label>
								<label for="xdr"><input type="radio" id="xdr" name="drug_resistance_value" value="XDR" {{ ($drug_resistance_value == "XDR")? 'checked="checked"' : '' }} /> XDR</label>
								<label for="drug_resistance_other"><input type="radio" id="drug_resistance_other" name="drug_resistance_value" value="Other" /> Other</label>
								<input type="text" id="drug_resistance_value_specify" name="drug_resistance_value_specify" value="{{ $drug_resistance_value_specify }}" readonly="readonly"/>
							</div>
						</div>
					</div>
			</fieldset>
			<fieldset>
				<legend class="sublegend">Others</legend>
				<div class="row">
					<div class="large-4 columns">
						<label for="hepatitis_b"><input type="checkbox" id="hepatitis_b" name="hepatitis_b"  value="1" {{ ($hepatitis_b == 1)? 'checked="checked"' : ''}} > Hepatitis B </label>
						<label for="hepatitis_c"><input type="checkbox" id="hepatitis_c" name="hepatitis_c"  value="1" {{ ($hepatitis_c == 1)? 'checked="checked"' : ''}}> Hepatitis C </label>
						<label for="pneumocystis_pneumonia"><input type="checkbox" id="pneumocystis_pneumonia" name="pneumocystis_pneumonia" value="1" {{ ($pneumocystis_pneumonia == 1)? 'checked="checked"' : ''}}> Pneumocystis Pneumonia </label>
						<label for="oropharyngeal_candidiasis"><input type="checkbox" id="oropharyngeal_candidiasis" name="oropharyngeal_candidiasis"value="1" {{ ($oropharyngeal_candidiasis == 1)? 'checked="checked"' : ''}}> Oropharyngeal Candidiasis </label>
						<label for="syphilis"><input type="checkbox" id="syphilis" name="syphilis" value="1" {{ ($syphilis == 1)? 'checked="checked"' : ''}}> Syphilis </label>
					</div>
					<div class="large-8 columns">
							<label for="stis"><input type="checkbox" id="stis" name="stis" value="1" /> STI's</label>
							<input type="text" placeholder="Specify" id="sti_reason" name="sti_reason" value="" readonly="readonly" />
							<label for="diagnosed_other"><input type="checkbox" id="diagnosed_other" name="diagnosed_other" value="1" {{ ($diagnosed_other == 1)? 'checked="checked"' : '' }} /> Others</label>
							<input type="text" placeholder="Specify" id="diagnosed_other_input" name="diagnosed_other_input" value="{{ $diagnosed_other_input }}" readonly="readonly" />
						</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Recommendation</legend>
				<div class="large-12 column">
					<textarea class="customtext" name="recommendation">{{ $recommendation }}</textarea>
				</div>
			</fieldset><br>
			<div class="row">
					<div class="large-4 columns">&nbsp;</div>
					<div class="large-4 columns">
						<input type="submit" class="button alert expand" value="Submit" name="submit">
					</div>
					<div class="large-4 columns">&nbsp;</div>
					{!! csrf_field() !!}
			</div>
		</form>
	</div>
<script >
<?php
//	Drug Resistance
if($drug_resistance_value == 'Other'){
	echo '$(\'#drug_resistance_other\').attr("checked", true);';
	echo '$(\'#drug_resistance_value_specify\').val(\'' . $drug_resistance_value_specify . '\').attr("readonly", false);';
}else{
	echo '$(\'#drug_resistance_other\').attr("checked", false);';
	echo '$(\'#drug_resistance_value_specify\').val(\'\').attr("readonly", true);';
}
if($stis == 1){
	echo '$(\'#stis\').attr("checked", true);';
	echo '$(\'#sti_reason\').val(\'' . $sti_reason . '\').attr("readonly", false);';
}else{
	echo '$(\'#stis\').attr("checked", false);';
	echo '$(\'#sti_reason\').val(\'\').attr("readonly", true);';
}
//	Other
if($diagnosed_other == 1){
	echo '$(\'#diagnosed_other\').attr("checked", true);';
	echo '$(\'#diagnosed_other_input\').val(\'' . $diagnosed_other_input . '\').attr("readonly", false);';
}else{
	echo '$(\'#diagnosed_other\').attr("checked", false);';
	echo '$(\'#diagnosed_other_input\').val(\'\').attr("readonly", true);';
}
?>

$(function(){
	$('#stis').change(function(){
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
	$('#tuberculosis').change(function(){
        var status = $(this).is(':checked');
        //console.log(status);

        if(status == false)
        {
        	$('input[name=\'regimen\']').attr("checked",false);
        	$('input[name=\'site\']').attr("checked",false);
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
		$('#tuberculosis').prop('checked', true).change();

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
	$('input[name=\'site\']').change(function(){
		$('#tuberculosis').prop('checked', true).change();

		});
	});
$(function(){
	$('input[name=\'regimen\']').change(function(){
		$('#tuberculosis').prop('checked', true).change();

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

</script>
@endsection
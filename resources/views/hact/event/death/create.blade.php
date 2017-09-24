@extends('hact.layouts.layout_admin')

@section('content')

    <div class='row'>
        <div class='large-12 columns'>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('arv_index') }}">Death</a></li>
                <li class="current"><a href="#">New Record</a></li>
            </ul>
        </div>
    </div>

	@include('hact.messages.success')
	@include('hact.messages.error_list')
	
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
                    <div class="large-6 columns">&nbsp;</div>
                </div>
			</fieldset>

			<fieldset>
	    		<legend>Death Information</legend>
	    		<div class="row">
	    			<div class="large-6 columns">
			    		<div class="row">
			    			<div class="large-12 columns">
								<label for="death_date">Date of Death:</label>
								<input type="text" class="fdatepicker" id="death_date" name="death_date" placeholder="Date of Death" value="{{ $death_date }}" readonly />
			    			</div>
			    		</div>
			    		<div class="row">
			    			<div class="large-12 columns">
								<label for="death_cause">Cause of Death:</label>
								<input id="hiv_related" name="death_cause" type="radio" value="HIV" /><label for="hiv_related">HIV Related</label>
								<input id="non_hiv_related" name="death_cause" type="radio" value="Non-HIV" /><label for="non_hiv_related">Non-HIV Related</label>
								<label for="final_diagnosis">Final Diagnosis:</label>
								<input type="text" id="final_diagnosis" name="final_diagnosis" placeholder="Final Diagnosis" value="{{ $final_diagnosis }}" />
			    			</div>
			    		</div>
	    			</div>
	    			<div class="large-6 columns">
			    		<div class="row">
			    			<div class="large-12 columns">
								<label for="opportunistic_infections">Opportunistic Infections present prior to death:</label>
								<label for="tuberculosis">
									<input type="checkbox" id="tuberculosis" name="tuberculosis" value="1" {{ ($tuberculosis == 1)? 'checked' : '' }} /> 
									Tuberculosis
								</label>
								<label for="pneumocystic_pneumonia">
									<input type="checkbox" id="pneumocystic_pneumonia" name="pneumocystic_pneumonia" value="1" {{ ($pneumocystic_pneumonia == 1)? 'checked' : '' }} /> 
									Pneumocystic Pneumonia
								</label>
								<label for="cryptococcal_meningitis">
									<input type="checkbox" id="cryptococcal_meningitis" name="cryptococcal_meningitis" value="1" {{ ($cryptococcal_meningitis == 1)? 'checked' : '' }} /> 
									Cryptococcal Meningitis
								</label>
								<label for="cytomegalovirus">
									<input type="checkbox" id="cytomegalovirus" name="cytomegalovirus" value="1" {{ ($cytomegalovirus == 1)? 'checked' : '' }} /> 
									Cytomegalovirus
								</label>
								<label for="candidiasis">
									<input type="checkbox" id="candidiasis" name="candidiasis" value="1" {{ ($candidiasis == 1)? 'checked' : '' }} /> 
									Candidiasis
								</label>
								<label for="toxoplasmosis">
									<input type="checkbox" id="toxoplasmosis" name="toxoplasmosis" value="1" {{ ($toxoplasmosis == 1)? 'checked' : '' }} /> 
									Toxoplasmosis
								</label>
								<label for="none">
									<input type="checkbox" id="none" name="none" value="1" {{ ($none == 1)? 'checked' : '' }} /> 
									None
								</label>
								<label for="other">Other</label>
								<input type="text" id="other" name="other" placeholder="Specify" value="{{ $other }}" />
			    			</div>
			    		</div>
	    			</div>
	    		</div>

			</fieldset>

			<br />
			<div class="row">
				<div class="large-4 columns">&nbsp;</div>
				<div class="large-4 columns">
					<input type="submit" class="button alert expand" value="Submit">
				</div>
				<div class="large-4 columns">&nbsp;</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>

<script type="text/javascript">

<?php
if($death_cause == 'HIV'){
	echo '$(\'#hiv_related\').prop(\'checked\', true);';
}elseif($death_cause == 'Non-HIV'){
	echo '$(\'#non_hiv_related\').prop(\'checked\', true);';
}
?>

</script>
@endsection
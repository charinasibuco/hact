@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-12 columns'>
			<ul class="breadcrumbs">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li><a href="{{ route('patient') }}">Patient</a></li>
				@if($search_vct)
					<li><a href="{{ route('patient_profile',$patient_id) }}">{{ $search_vct }}</a></li>
				@endif
				<li class="current"><a href="{{ route('patient_profile',$patient_id) . "#tab8" }}">Mortality</a></li>
			</ul>
		</div>
	</div>
<div class="row">
	<div class="large-12 column">
		@include("hact.messages.success")
		@if(count($errors) > 0)
			<div class="alert-box alert ">Error: Highlight fields are required!</div>
			@include("hact.messages.other_error")
		@endif
		{{--@include("hact.messages.error_list")--}}
	</div>
</div>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<div class="custom-panel-heading">
			<span>Mortality</span>
			<div class="right">
				<a href="{{ route('patient') }}" class="alert tiny button right" title="Cancel"><i class="fi fi-x"></i> Cancel</a>
			</div>
		</div>
		<form method="post" action="{{ $action }}" enctype="multipart/form-data">
			<fieldset>
				<div class="row">
					<div class="large-4 columns">
						<label for="search_patient">Patient</label>
						<div class="row collapse">
					    	<div class="small-10 columns">
								<input type="text" id="search_vct" name="search_vct" value="{{ $search_vct }}" @if($search_vct) readonly @endif/>
								<input type="hidden" id="patient_id" name="patient_id" value="{{ $patient_id }}" />
								<input type="hidden" id="search_vct_url" name="search_vct_url" value="{{ route('mortality_search') }}" />
					    	</div>
					    	<div class="small-2 columns">
					      		<span class="postfix"><i class="fa fa-search"></i></span>
					    	</div>
						</div>
					</div>
				</div>
			</fieldset>
		 	<fieldset>
		 		<legend>Circumstances Surrounding Death</legend>
				<div class="row">
					<div class="large-4 columns">
						<label for="date_of_death">Date of Death:</label>
						<input type="text" id="date_of_death" name="date_of_death" value="{{ $date_of_death }}" class="fdatepicker {{ ($errors->has('date_of_death')) ? 'highlight_error' : '' }}" readonly>
					</div>
					<div class="large-8 columns">
						&nbsp;
					</div>
				</div>
				<fieldset>
					<legend>Cause of Death</legend>
					<div class="row">
						<div class="large-3 columns">
							<label for="related_yes">Is HIV Related:</label>
								<div class="{{ ($errors->has('is_hiv_related')) ? 'highlight_error' : '' }}">
									<input type="radio" id="related_yes" value="1" name="is_hiv_related" >
									<label for="related_yes">Yes</label>
									<input type="radio" id="related_no" value="0" name="is_hiv_related" >
									<label for="related_no">No</label>
									<div class="clearfix"></div>
								</div>
						</div>
						<div class="large-6 columns">
							<label for="immediate_cause">Immediate Cause:</label>
							<input type="text" name="immediate_cause" value="{{ $immediate_cause }}" class="{{ ($errors->has('immediate_cause')) ? 'highlight_error' : '' }}">
						</div>
						<div class="large-3 columns">
							<label for="immediate_icd10_code">ICD-10 Code:</label>
							<input type="text" id= "immediate_icd10_code" name="immediate_icd10_code" value="{{ $immediate_icd10_code }}">
						</div>
					</div>
					<div class="row">
						<div class="large-3 columns">
							&nbsp;
						</div>
						<div class="large-6 columns">
							<label for="antecedent_cause">Antecedent Cause:</label>
							<input type="text" name="antecedent_cause" value="{{ $antecedent_cause }}">
						</div>
						<div class="large-3 columns">
							<label for="antecedent_icd10_code">ICD-10 Code:</label>
							<input type="text" id= "antecedent_icd10_code" name="antecedent_icd10_code" value="{{ $antecedent_icd10_code }}">
						</div>
					</div>
					<div class="row">
						<div class="large-3 columns">
							&nbsp;
						</div>
						<div class="large-6 columns">
							<label for="underlying_cause">Underlying Cause:</label>
							<input type="text" name="underlying_cause" value="{{ $underlying_cause }}">
						</div>
						<div class="large-3 columns">
							<label for="underlying_icd10_code">ICD-10 Code:</label>
							<input type="text" id= "underlying_icd10_code" name="underlying_icd10_code" value="{{ $underlying_icd10_code }}">
						</div>
					</div>
				</fieldset>
				<fieldset>
					{{--<legend>Opportunistic infections present prior to death</legend>--}}
					<legend>Concomitant</legend>
					<div class="row">
						<div class="large-3 columns">
							<div class="row">
								<div class="large-1 columns">
									<input type="checkbox" value="1" id="tuberculosis" name="tuberculosis">
								</div>
								<div class="large-11 columns">
									<label for="tuberculosis">Tuberculosis</label>
								</div>
							</div>
							<div class="row">
								<div class="large-1 columns">
									<input type="checkbox" value="1" id="pneumocystis_pneumonia" name="pneumocystis_pneumonia">
								</div>
								<div class="large-11 columns">	
									<label for="pneumocystis_pneumonia">Pneumocystis Pneumonia</label>
								</div>
							</div>
						</div>
						<div class="large-3 columns">
							<div class="row">
								<div class="large-1 columns">
									<input type="checkbox" value="1" id="cryptococcal_meningitis" name="cryptococcal_meningitis">
								</div>
								<div class="large-11 columns">		
									<label for="cryptococcal_meningitis">Cryptococcal Meningitis</label>
								</div>
							</div>
							<div class="row">
								<div class="large-1 columns">
									<input type="checkbox" value="1" id="cytomegalovirus" name="cytomegalovirus">
								</div>
								<div class="large-11 columns">		
									<label for="cytomegalovirus">Cytomegalovirus</label>
								</div>
							</div>
						</div>
						<div class="large-3 columns">
							<div class="row">
								<div class="large-1 columns">
									<input type="checkbox" value="1" id="candidiasis" name="candidiasis">
								</div>
								<div class="large-11 columns">			
									<label for="candidiasis">Candidiasis</label>
								</div>
							</div>
							<div class="row">
								<div class="large-1 columns">
									<input type="checkbox" value="1" id="toxoplasmosis" name="toxoplasmosis">
								</div>
								<div class="large-11 columns">			
									<label for="toxoplasmosis">Toxoplasmosis</label>
								</div>
							</div>
						</div>
						<div class="large-3 columns">
							<div class="row">
								<div class="large-1 columns">
									<input type="checkbox" value="1" id="other_check" name="other_check">
								</div>
								<div class="large-11 columns">
									<label for="other_check">Other:</label>
								</div>
							</div>
							<div class="row">
								<div class="large-12 columns">
									<input type="text" id="other" name="other" value="{{ $other }}">
								</div>
							</div>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>CD4 Count</legend>
					<div class="row">
						<div class="large-6 columns">
							<label for="last_cd4_count">Date of Last CD4 Count:</label>
							<input type="text" id="last_cd4_count" name="last_cd4_count" class="fdatepicker" value="{{ $last_cd4_count }}" placeholder="Leave blank if never done" readonly>
						</div>
						<div class="large-6 columns">
							<label for="cd4_count">CD4 Count:</label>
							<input type="text" id="cd4_count" name="cd4_count" value="{{ $cd4_count }}">
						</div>

					</div>
				</fieldset>
				<fieldset>
					<legend>ARV History</legend>
					<div class="row">
						<div class="large-12 columns">
							<br/>
							<label for="taken_yes">Did patient ever take Anti-Retrovirals (ARV) medication?</label>
							@if($errors->has('have_taken_arv'))
								<div class="highlight_error">
							@endif
							<input type="radio" value="1" name="have_taken_arv" id="taken_yes" ><label for="taken_yes">Yes</label>
							<input type="radio" value="0" name="have_taken_arv" id="taken_no" ><label for="taken_no">No</label>
							@if($errors->has('have_taken_arv'))
								<div class="clearfix"></div>
								</div>
							@endif
						</div>
					</div>
					<div class="row last_arv_regimen">
						<div class="large-12 columns">
							<br/>
							<label for="first_line">Last ARV Regimen:</label>
							<input type="radio" value="1" name="last_arv_regimen" id="first_line"><label for="first_line" >First Line Regimen</label>
							<input type="radio" value="2" name="last_arv_regimen" id="second_line"><label for="second_line" >Second Line Regimen</label>
							<input type="radio" value="0" name="last_arv_regimen" id="not_available"><label for="not_available" >Regimen information not available</label>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<fieldset>
								<legend>Death Certificate Upload</legend>

								<img id='image_preview' src="{{ asset($death_certificate) }}" alt="No Image Selected"><br/>

								Select image to upload:

								<input type="file" class="image death_certificate error {{ ($errors->has('death_certificate')) ? 'highlight_error' : '' }}" name="death_certificate" id="death_certificate" value="{{ $death_certificate }}">
								@if($errors->has('death_certificate'))
										<small class="error">File not in Image Format or  Limit Exceeded (2MB)</small>
								@endif
							</fieldset>
						</div>
					</div>
					<script>
						$(function(){
							$(".death_certificate").change(function(){
								if (typeof (FileReader) != "undefined") {
									var reader = new FileReader();
									reader.onload = function (e) {
										$("#image_preview").attr("src", e.target.result).show();
									}
									reader.readAsDataURL($(this)[0].files[0]);
								} else {
									alert("This browser does not support FileReader.");
								}
							});
						});
					</script>

				</fieldset>
			</fieldset>
			<br/>
			<div class="row">
				<div class="medium-12 columns">
					<div class="right">
						{!! csrf_field() !!}
						<input type="hidden" name="ui_code">
						<button class="button success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
						<a href="{{ route('patient') }}" class="button alert" title="Cancel"><i class="fi fi-x"></i> Cancel</a>
					</div>
				</div>
			</div>
		</form>
		<script>
			$(function(){
				$('#taken_yes').click(function(){
					if($(this).prop('checked') == true)
					{
						$('.last_arv_regimen').show();
						$('input[name=last_arv_regimen]').prop('required',true);
					}
					else
					{
						$('.last_arv_regimen').hide();
						$('input[name=last_arv_regimen]').prop('required',false);
					}
					
				});

				$('#taken_no').click(function(){
					if($(this).prop('checked') == true)
					{
						$('.last_arv_regimen').hide();
						$('input[name=last_arv_regimen]').attr('checked',false).prop('required',false);
					}
					else
					{
						$('.last_arv_regimen').show();
						$('input[name=last_arv_regimen]').attr('checked',true).prop('required',true);
					}
					
				});


				});
			<?php
				if($page=="Edit")
				{
					echo "$('#search_patient').attr('readonly',true);";
				}

				if(is_numeric($is_hiv_related))
				{
					if($is_hiv_related == 1)
					{
					echo "$('#related_yes').attr('checked',true);";
					}
					elseif($is_hiv_related == 0)
					{
					echo "$('#related_no').attr('checked',true);";
					}
				}

				if(is_numeric($last_arv_regimen))
				{
					if($last_arv_regimen == 1)
					{
						echo "$('#first_line').attr('checked',true);";
					}
					elseif($last_arv_regimen == 2)
					{
						echo "$('#second_line').attr('checked',true);";
					}
					elseif($last_arv_regimen == 0)
					{
						echo "$('#not_available').attr('checked',true);";
					}
				}
				

				if($tuberculosis == 1)
				{
					echo "$('#tuberculosis').attr('checked',true);";
				}
				if($pneumocystis_pneumonia == 1)
				{
					echo "$('#pneumocystis_pneumonia').attr('checked',true);";
				}
				if($cryptococcal_meningitis == 1)
				{
					echo "$('#cryptococcal_meningitis').attr('checked',true);";
				}
				if($cytomegalovirus == 1)
				{
					echo "$('#cytomegalovirus').attr('checked',true);";
				}
				if($candidiasis == 1)
				{
					echo "$('#candidiasis').attr('checked',true);";
				}
				if($other)
				{
					echo "$('#other_check').attr('checked',true);";
					echo "$('#other').attr('readonly',false).prop('required',true);";
				}
				else
				{
					echo "$('#other').attr('readonly',true).prop('required',false);";
				}


				if(is_numeric($have_taken_arv))
				{
					if($have_taken_arv == 1)
					{
						echo "$('#taken_yes').attr('checked',true);";
						echo "$('.last_arv_regimen').show();";
						echo "$('input[name=last_arv_regimen]').prop('required',true);";
					}
					elseif($have_taken_arv == 0)
					{
						echo "$('#taken_no').attr('checked',true);";
						echo "$('.last_arv_regimen').hide();";
						echo "$('input[name=last_arv_regimen]').prop('required',false);";
					}
				}
				else{
					echo "$('.last_arv_regimen').hide();";
					echo "$('input[name=last_arv_regimen]').prop('required',false);";
				}
				

			?>

			$('input[name=hiv_cause]').attr('readonly',true);
			$('input[name=hiv_icd10_code]').attr('readonly',true);
			
			$('input[name=not_hiv_cause]').attr('readonly',true);
			$('input[name=not_hiv_icd10_code]').attr('readonly',true);

			$(function()
			{
				$('input[name=is_hiv_related]').change(function()
				{
					if($('#related_yes').is(':checked'))
					{
						$('input[name=hiv_cause]').attr('readonly',false);
						$('input[name=hiv_icd10_code]').attr('readonly',false);
						
						$('input[name=not_hiv_cause]').attr('readonly',true);
						$('input[name=not_hiv_icd10_code]').attr('readonly',true);
						$('input[name=not_hiv_cause]').val('');
						$('input[name=not_hiv_icd10_code]').val('');
					}
					else if($('#related_no').is(':checked'))
					{
						$('input[name=hiv_cause]').attr('readonly',true);
						$('input[name=hiv_icd10_code]').attr('readonly',true);
						$('input[name=hiv_cause]').val('');
						$('input[name=hiv_icd10_code]').val('');

						$('input[name=not_hiv_cause]').attr('readonly',false);
						$('input[name=not_hiv_icd10_code]').attr('readonly',false);
					}
				});
			})

			$(function()
			{
				$('#other_check').change(function()
				{
					if($(this).is(':checked'))
					{
						$('input[name=other]').attr('readonly',false).prop('required',true);
					}
					else
					{
						$('input[name=other]').attr('readonly',true).prop('required',false);
						$('input[name=other]').val('');
					}
				});
			})

			$(function()
			{
				$('input[name=have_cd4_info]').change(function()
				{
					if($('#cd4_yes').is(':checked',true))
					{
						$('input[name=cd4_count]').attr('readonly',false).prop('required',true);
						$('input[name=last_cd4_count]').show();

					}
					else
					{
						
						$('input[name=cd4_count]').attr('readonly',true).prop('required',false);
						$('input[name=last_cd4_count]').hide();
						$('input[name=cd4_count]').val('');
						$('input[name=last_cd4_count]').val('');
					}
				});
			})
		</script>
	</div>
</div>
@endsection
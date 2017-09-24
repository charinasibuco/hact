@extends('hact.layouts.layout_admin')

@section('content')

<div class='row'>
	<div class='large-12 columns'>
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="#">ART</a></li>
			<li><a href="{{ route('checkup') }}">Checkup</a></li>
			<li class="current"><a href="#">{{ $page }}</a></li>
		</ul>
	</div>
</div>
	
	@include("hact.messages.success")
	@include("hact.messages.error_list")

<div class="panel">
	<form action="{{ $action }}" method="post">
       	<div class="row">
   			<div class="large-12 columns">
				<fieldset>
					<legend>Patient</legend>
       				<div class="row">
						<div class="large-3 columns">
							<label for="search_vct">Patient</label>
							<div class="row collapse">
						    	<div class="small-10 columns">
									<input type="text" id="search_vct" name="search_vct" value="{{ $search_vct }}"  readonly/>
									<input type="hidden" id="patient_id" name="patient_id" value="{{ $patient_id }}" />
									<input type="hidden" id="search_vct_url" name="search_vct_url" value="{{ route('vct_search') }}" />
						    	</div>
						    	<div class="small-2 columns">
						      		<span class="postfix"><i class="fa fa-search"></i></span>
						    	</div>
							</div>
						</div>
			            <div class="large-3 columns">
							<label for="checkup_date">Check Up Date</label>
							<input type="text" class="fdatepicker" id="checkup_date" name="checkup_date" placeholder="Check Up Date" value="{{ $checkup_date }}" readonly />
			            </div>
			            <div class="large-3 columns">
							<label for="follow_up_date">Follow Up On</label>
							<input type="text" class="fdatepicker" name="follow_up_date" id="follow_up_date" placeholder="Follow Up On" value="{{ $follow_up_date }}" readonly>
			            </div>
			            <div class="large-3 columns">
							<label for="resident_in_charge">Resident In Charge</label>
							<input type="text" name="resident_in_charge" id="resident_in_charge" value="{{ $resident_in_charge }}" readonly>
			            </div>
		        	</div>
				</fieldset>
   			</div>
    	</div>

		<div class="row">
			<div class="large-3 columns">
				<fieldset>
					<legend>General Summary</legend>
					<label for="weight">Weight (kg)</label>
					<input type="text" class="gen_sum" id="weight" name="weight" placeholder="Weight" value="{{ $weight }}">
					<label for="height">Height (meters)</label>
					<input type="text" class="gen_sum" id="height" name="height" placeholder="Height" value="{{ $height }}">
					<label for="bmi">Body Mass Index</label>
					<input type="text" id="bmi" name="bmi" placeholder="BMI" value="{{ $bmi }}" readonly>
				</fieldset>
			</div>
			<div class="large-3 columns">
				<fieldset>
					<legend>Vital Signs</legend>
					<label>Blood Pressure</label>
					<input type="text" name="blood_pressure" placeholder="Blood Pressure" value="{{ $blood_pressure }}">
					<label>Temperature</label>
					<input type="text" name="temperature" placeholder="Temperature" value="{{ $temperature }}">
					<label>Pulse Rate</label>
					<input type="text" name="pulse_rate" placeholder="Pulse Rate" value="{{ $pulse_rate }}">
					<label>Respiratory Rate</label>
					<input type="text" name="respiration_rate" placeholder="Respiratory Rate" value="{{ $respiration_rate }}">
				</fieldset>
			</div>
			<div class="large-3 columns">
				<fieldset>
					<legend>TB Screening</legend>
					<input type="checkbox" value="1" id="cough" name="cough"><label for="cough">Cough</label>
					<br/><input type="checkbox" value="1" id="fever" name="fever"><label for="fever">Fever</label>
					<br/><input type="checkbox" value="1" id="night_sweat" name="night_sweat"><label for="night_sweat">Night Sweat</label>
					<br/><input type="checkbox" value="1" id="weight_loss" name="weight_loss"><label for="weight_loss">Weight Loss</label>
				</fieldset>
			</div>
			<div class="large-3 columns">
				<fieldset>
					<legend>Immunologic Profile</legend>
					<div class="row">
						<div class="large-12 columns">
						@if(isset($last_cd4_count))
							<input type="hidden" name="last_cd4_count_id" id="last_cd4_count_id" value="{{ $last_cd4_count->id }}" readonly>
							<label for="last_cd4_count">Last CD4 Count</label>
							<input type="text" name="last_cd4_count" id="last_cd4_count" value="{{ $last_cd4_count->result }}" readonly>
							<label for="cd4_result_date">Last CD4 Count Result Date</label>
							<input type="text" name="cd4_result_date" id="cd4_result_date" value="{{ $last_cd4_count->result_date_format }}" readonly>
						@else
							<label for="last_cd4_count">Last CD4 Count</label>
							<input type="text" name="last_cd4_count" id="last_cd4_count" value="" readonly>
							<label for="last_cd4_count">Last CD4 Count Result Date</label>
							<input type="text" name="cd4_result_date" id="cd4_result_date" value="" readonly>
						@endif
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
						@if(isset($viral_load))
							<input type="hidden" name="viral_load_id" id="viral_load_id" value="{{ $viral_load->id }}" readonly>
							<label for="viral_load">Viral Load</label>
							<input type="text" name="viral_load" id="viral_load" value="{{ $viral_load->result }}" readonly>
							<label for="viral_load">Viral Load Result Date</label>
							<input type="text" name="viral_load_result_date" id="viral_load_result_date" value="{{ $viral_load->result_date_format }}" readonly>
						@else
							<label for="viral_load">Viral Load</label>
							<input type="text" name="viral_load" id="viral_load" value="" readonly>
							<label for="viral_load">Viral Load Result Date</label>
							<input type="text" name="viral_load_result_date" id="viral_load_result_date" value="" readonly>
						@endif
						</div>
					</div>
				</fieldset>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<fieldset>
					<legend>S/O</legend>
					<div class="row">
						<div class="large-12 columns">
							<label for="subjective">Subjective:</label>
							<textarea id="subjective" name="subjective" class="customtext">{{ $subjective }}</textarea>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label for="objective">Objective:</label>
							<textarea id="objective" name="objective" class="customtext">{{ $objective }}</textarea>
						</div>
					</div>
				</fieldset>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<fieldset>
					<legend>Assessment</legend>
					<div class="row">
						<div class="large-2 columns">
							<div class="row">
								<div class="large-12 columns">
									<label for="clinical_stage">Clinical Stage</label>
									<input type="text" class="text-center" name="clinical_stage" id="clinical_stage" value="{{ $infections->clinical_stage or '' }}" readonly>
								</div>
							</div>
						</div>
						<div class="large-9 columns">&nbsp;</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							@if($infections)
								<fieldset>
									<legend>Currently Present Infections</legend>
									<ol>
										@if($infections->hepatitis_b == 1)
											<li>Hepatitis B</li>
										@endif

										@if($infections->hepatitis_c == 1)
											<li>Hepatitis C</li>
										@endif

										@if($infections->pneumocystis_pneumonia == 1)
											<li>Pneumocystis Pneumonia</li>
										@endif

										@if($infections->orpharyngeal_candidiasis == 1)
											<li>Orpharyngeal Candidiasis</li>
										@endif

										@if($infections->syphilis == 1)
											<li>Syphilis</li>
										@endif

										@if($infections->stis == 1)
											<li>STIs:{{ $infections->stis }}</li>
										@endif

										@if($infections->others == 1)
											<li>Others:{{ $infections->others }}</li>
										@endif
									</ol>
								</fieldset>

								<fieldset>
									<legend>WHO Classification</legend>
									<table width="100%">
										<tr>
											<th width="5%">Stage</th>
											<th width="95%">Description</th>
										</tr>
										@foreach($infections->infections_clinical_stage as $row)
											<tr>
												<td>{{ $row->stage }}</td>
												<td>{{ $row->details->infection_name }}</td>
											</tr>
										@endforeach
									</table>
								</fieldset>
							@endif
						</div>
					</div>
				</fieldset>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<fieldset>
					<legend>Laboratory Requests</legend>
					<div class="row">
						@foreach($laboratory_types as $row)
							<div class="large-3 columns">
								<label for="lab_{{ $row->id }}"><input type="checkbox" id="lab_{{ $row->id }}" name="lab[{{ $row->id }}]" value="1"> {{ $row->description }}</label>
							</div>
						@endforeach
						<!-- <div class="large-3 columns">
							<input type="checkbox" id="lab_other" name="lab[22]" value="1"><label for="lab_other">Other</label>
						</div> -->
						<!-- <div class="large-6 columns">
							<input type="text" id="other" name="other">
						</div> -->
				</div>
				</fieldset>
			</div>
		</div>

		<div class="row">
			<div class="large-6 columns">
				<fieldset>
					<legend>Referrals</legend>
					<div class="row">
						<div class="large-4 columns">
							<label for="surgeon"><input type="checkbox" id="surgeon" name="surgeon" value="1"> Surgeon</label>
							<label for="ob_gyne"><input type="checkbox" id="ob_gyne" name="ob_gyne" value="1"> OB-Gyne</label>
							<label for="ophthamology"><input type="checkbox" id="ophthamology" name="ophthamology" value="1"> Ophthamology</label>
							<label for="dentis"><input type="checkbox" id="dentis" name="dentis" value="1"> Dentis</label>
							<label for="psychiatrist"><input type="checkbox" id="psychiatrist" name="psychiatrist" value="1"> Psychiatrist</label>
						</div>
						<div class="large-8 columns">
							<label for="reason">Reason</label>
							<textarea id="reason" name="reason" class="customtext">{{ $reason }}</textarea>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="large-6 columns">
				<fieldset>
					<legend for="remarks">Remarks</legend>
					<textarea id="remarks" name="remarks" class="customtext">{{ $remarks }}</textarea>
				</fieldset>
			</div>
		</div>

		<div class="row">
			<div class="large-6 columns">
				<fieldset>
					<legend>ARV Regimen</legend>
					<div class="row">
						<div class="large-12 columns">
							@if(isset($arv))
								<ol>
								@foreach($arv->ARVItems as $row)
									@if($row->Medicine->classification == 1 && $row->specified_medicine == "")
										<li>
											{{ $row->Medicine->name }}
											<div class="row">
												<div class="large-12 columns">
													<table width="100%">
														<thead>
															<tr>
																<th width="30%">Pill</th>
																<th width="40%">Symptoms</th>
																<th width="30%">Monitoring</th>
															</tr>
														</thead>
														<tbody>
														<?php
															$category = explode('+', $row->Medicine->name);
															foreach ($category as $key)
															{
																$meds = strtolower(trim($key));

																$symptoms = App\Symptoms::where('pill', $meds)->first();
																if($symptoms)
																{
																	echo '<tr><td>' . $key . '</td><td>' . $symptoms->symptoms . '</td><td>' . $symptoms->monitoring . '</td></tr>';
																}
															}
														?>
														</tbody>
													</table>
												</div>
											</div>
										</li>
									@endif
								@endforeach
								</ol>
							@endif
						</div>
						<div class="large-6 columns"></div>
					</div>
				</fieldset>
			</div>
			<div class="large-6 columns">
				<fieldset>
					<legend>OI Medicine</legend>
						@if(isset($arv))
							<ol>
							@foreach($arv->ARVItems as $row)
								@if($row->Medicine->classification == 2 && $row->specified_medicine == "")
									<li>
										{{ $row->Medicine->name }}
									</li>
								@endif
							@endforeach
							</ol>
						@endif
				</fieldset>
				<fieldset>
					<legend>Other Medicine</legend>
						<ol>
						@if(isset($arv))
							@foreach($arv->ARVItems as $row)
								@if($row->specified_medicine != "")
									<li>
										{{ $row->specified_medicine }}
									</li>
								@endif
							@endforeach
						@endif
						</ol>
				</fieldset>
			</div>
		</div>

		<div class="row">
			<div class="large-4 columns">&nbsp;</div>
			<div class="large-4 columns">
				<input type="hidden" name="laboratory_id" value="1">
				<input type="hidden" name="infection_id" value="{{ $infection_id }}">
				<input type="hidden" name="arv_id" value="{{ $arv_id }}">
				{!! csrf_field() !!}
				<br />
				<button type="submit" class="button expand">Submit</button>
			</div>
			<div class="large-4 columns">&nbsp;</div>
		</div>
	</form>
</div>

<script>

$('#lab[1]').prop('checked', true);
<?php

if($cough != '')
{
	echo "$('#cough').prop('checked', true);";
}

if($fever != '')
{
	echo "$('#fever').prop('checked', true);";
}

if($night_sweat != '')
{
	echo "$('#night_sweat').prop('checked', true);";
}

if($weight_loss != '')
{
	echo "$('#weight_loss').prop('checked', true);";
}

if($lab)
{
	foreach ($lab as $key => $value)
	{
		echo "$('#lab_" . $key . "').prop('checked', true);";
	}
}

if($surgeon != '')
{
	echo "$('#surgeon').prop('checked', true);";
}

if($ob_gyne != '')
{
	echo "$('#ob_gyne').prop('checked', true);";
}

if($ophthamology != '')
{
	echo "$('#ophthamology').prop('checked', true);";
}

if($dentis != '')
{
	echo "$('#dentis').prop('checked', true);";
}

if($psychiatrist != '')
{
	echo "$('#psychiatrist').prop('checked', true);";
}

?>

$('#other').attr('readonly',true);

$('#lab_other').change(function(){
	console.log('1');
	if($(this).is(':checked') == true)
	{
		$('#other').prop('readonly', false).focus();
	}else
	{
		$('#other').prop('readonly', true);
	}
});

$(function(){
	$('.gen_sum').keyup(function(){
		var weight = parseFloat($('#weight').val());
		var height = parseFloat($('#height').val());

		var bmi = weight / (height * height);

		if(isNaN(bmi))
		{
			$('#bmi').val('0');
		}
		else
		{
			$('#bmi').val(bmi.toFixed(2));
		}
	});
})

</script>
@endsection
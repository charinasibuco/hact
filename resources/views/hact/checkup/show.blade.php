@extends('hact.layouts.print_layout')

@section('content')
<br/>
<input id="print" type="button" value="Print">
<script>
	$('#print').click(function(){
		$(this).hide();
		window.print();
		$(this).show();
	});
	$(document).ready(function(){
		$(".checkup-table span").css("font-weight","bold");
		$(".checkup-table td").css("vertical-align","top");
	});
</script>
<br/>
<br/>
<fieldset>
	<legend>Checkup Form</legend>
	<table width="100%" class="checkup-table" role="grid">
		<tr>
			<td>
				<label><span>Patient:</span>
					{{ $checkup->Patient->code_name }}
				</label>
			</td>
			<td>
				<label><span>Age:</span>
					{{ $checkup->Patient->age }}
				</label>
			</td>
			<td>
				<label><span>Sex:</span>
					{{ $checkup->Patient->gender_format }}
				</label>
			</td>
			<td>
				<label><span>SACCL Code:</span>
					{{ $checkup->Patient->saccl_code }}
				</label>
			</td>
		</tr>
		<tr>
			<td>
				<label><span>Phil Health Number:</span>
					{{ $checkup->Patient->phil_health_number }}
				</label>
			</td>
			<td>
				<label><span>UIC:</span>
					{{ $checkup->Patient->ui_code }}
				</label>
			</td>
			<td>
				<label><span>Consultation Date:</span>
					{{ $checkup->checkup_date->format('m/d/Y') }}
				</label>
			</td>
			<td>
				<label><span>Follow-up On:</span>
					{{ $checkup->follow_up_date->format('m/d/Y') }}
				</label>
			</td>
		</tr>
		<tr>
			<td>
				<label><span>Patient Type:</span>
					{{ $checkup->patient_type }}
				</label>
			</td>
			<td>
				<label><span>Attending Physician:</span>
					{{ $checkup->User->name }}
				</label>
			</td>
		</tr>
		<tr>
			<td>
				<label><span>General Summary:</span>
					<ul>
						<li>Weight: {{ $checkup->weight }}kg</li>
						<li>Height: {{ $checkup->height }}meters</li>
						<li>BMI: {{ $checkup->bmi }}</li>
					</ul>
				</label>
			</td>
			<td>
				<label><span>Vital Signs:</span>
					<ul>
						<li>BP: {{ $checkup->blood_pressure }}</li>
						<li>PR: {{ $checkup->pulse_rate }}</li>
						<li>RR: {{ $checkup->respiration_rate }}</li>
						<li>Temp: {{ $checkup->temperature }}</li>
					</ul>
				</label>
			</td>
			<td>
				<label><span>TB Screening:</span>
					<ul>
						{!! ($checkup->cough == 1) ? '<li>Cough</li>' : '' !!}
						{!! ($checkup->fever == 1) ? '<li>Fever</li>' : '' !!}
						{!! ($checkup->night_sweat == 1) ? '<li>Night Sweat</li>' : '' !!}
						{!! ($checkup->weight_loss == 1) ? '<li>Weight Loss</li>' : '' !!}
					</ul>
				</label>
			</td>
			<td>
				<label><span>Immunologic Profile:</span>
					<ul>
						@if($checkup->CheckupLaboratory->count() > 0)
							@foreach($checkup->CheckupLaboratory as $row)
								@if($row->Laboratory)
									<li>Last {{$row->Laboratory->laboratory_type->description}}:{{  $row->Laboratory->result }}</li>
									<li>Result Date:{{ $row->Laboratory->result_date->format('m/d/Y')  }}</li>
								@endif
							@endforeach
						@else
							None
						@endif
					</ul>
				</label>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<label><span>Chief Complaints:</span>
					<pre>{{ $checkup->patient_complaints }}</pre>
				</label>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<label><span>Subjective:</span>
					<pre>{{ $checkup->subjective }}</pre>
				</label>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<label><span>Objective:</span>
					@if($checkup->PhysicalExam)
						<fieldset>
							<legend>Physical Exam</legend>
							<table class="checkup-table" width="100%">
								<thead>
									<tr>
										<th width="25%">Description</th>
										<th width="35%">Result</th>
										<th width="40%">Remarks</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>General Survey</td>
										<td>
											<ol class="inline-list">
												@if($checkup->PhysicalExam->jsonConvert('general_survey'))
													@foreach($checkup->PhysicalExam->jsonConvert('general_survey') as $key => $value)
														<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
										<td>{{ $checkup->PhysicalExam->general_survey_remarks }}</td>
									</tr>
									<tr>
										<td>Skin</td>
										<td>
											<ol class="inline-list">
												@if($checkup->PhysicalExam->jsonConvert('skin'))
													@foreach($checkup->PhysicalExam->jsonConvert('skin') as $key => $value)
														<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
										<td>{{ $checkup->PhysicalExam->skin_remarks }}</td>
									</tr>
									<tr>
										<td>HEENT</td>
										<td>
											<ol class="inline-list">
												@if($checkup->PhysicalExam->jsonConvert('heent'))
													@foreach($checkup->PhysicalExam->jsonConvert('heent') as $key => $value)
														<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
										<td>{{ $checkup->PhysicalExam->heent_remarks }}</td>
									</tr>
									<tr>
										<td>Lips/Buccal Mucosa</td>
										<td colspan="2">
											<ol class="inline-list">
												@if($checkup->PhysicalExam->jsonConvert('lips_buccal_mucosa'))
													@foreach($checkup->PhysicalExam->jsonConvert('lips_buccal_mucosa') as $key => $value)
														<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
									</tr>
									<tr>
										<td>sclerae</td>
										<td colspan="2">
											<ol class="inline-list">
												@if($checkup->PhysicalExam->jsonConvert('sclerae'))
													@foreach($checkup->PhysicalExam->jsonConvert('sclerae') as $key => $value)
														<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
									</tr>
									<tr>
										<td>Conjunctivae</td>
										<td colspan="2">
											<ol class="inline-list">
												@if($checkup->PhysicalExam->jsonConvert('conjunctivae'))
													@foreach($checkup->PhysicalExam->jsonConvert('conjunctivae') as $key => $value)
														<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
									</tr>
									<tr>
										<td>Chest and Lungs</td>
										<td>
											<ol class="inline-list">
												@if($checkup->PhysicalExam->jsonConvert('chest_and_lungs'))
													@foreach($checkup->PhysicalExam->jsonConvert('chest_and_lungs') as $key => $value)
														<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
										<td>{{ $checkup->PhysicalExam->chest_and_lungs_remarks }}</td>
									</tr>
									<tr>
										<td>Cardiovascular</td>
										<td>
											<ol class="inline-list">
												@if($checkup->PhysicalExam->jsonConvert('cardial'))
													@foreach($checkup->PhysicalExam->jsonConvert('cardial') as $key => $value)
														<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
										<td>{{ $checkup->PhysicalExam->cardial_remarks }}</td>
									</tr>
									<tr>
										<td>Abdomen</td>
										<td>
											<ol class="inline-list">
												@if($checkup->PhysicalExam->jsonConvert('abdomen'))
													@foreach($checkup->PhysicalExam->jsonConvert('abdomen') as $key => $value)
														<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
										<td>{{ $checkup->PhysicalExam->abdomen_remarks }}</td>
									</tr>
									<tr>
										<td>Extremities</td>
										<td>
											<ol class="inline-list">
												@if($checkup->PhysicalExam->jsonConvert('extremities'))
													@foreach($checkup->PhysicalExam->jsonConvert('extremities') as $key => $value)
														<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
										<td>{{ $checkup->PhysicalExam->extremities_remarks }}</td>
									</tr>
								</tbody>
							</table>
						</fieldset>
					@endif
					<br/>
					@if($checkup->NeuroExam)
						<fieldset>
							<legend>Neurologic Exam</legend>
							<table class="checkup-table" width="100%">
								<thead>
									<tr>
										<th width="30%">Description</th>
										<th width="70%">Result</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th colspan="2">MENTAL STATUS EXAM</th>
									</tr>
									<tr>
										<td>Level of Consciousness</td>
										<td>{{ $checkup->NeuroExam->level_of_consciousness }}</td>
									</tr>
									<tr>
										<td>Orientation</td>
										<td>
											<ol class="inline-list">
												@if($checkup->NeuroExam->jsonConvert('orientation'))
													@foreach(($checkup->NeuroExam->jsonConvert('orientation')) as $key => $value)
														<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
									</tr>
									<tr>
										<td>Mood and Behavior</td>
										<td>
											{{ $checkup->NeuroExam->mood_and_behaviour }}
										</td>
									</tr>
									<tr>
										<td>Memory</td>
										<td>
											<ol class="inline-list">
												@if($checkup->NeuroExam->jsonConvert('memory'))
													@foreach(($checkup->NeuroExam->jsonConvert('memory')) as $key => $value)
														<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
									</tr>
									<tr>
										<td>Cognitive Function</td>
										<td>
											{{ $checkup->NeuroExam->cognitive_function }}
										</td>
									</tr>
									<tr>
										<th colspan="2">CRANIAL NERVE</th>
									</tr>
									<tr>
										<td>I</td>
										<td>{{ $checkup->NeuroExam->able_to_smell  }}</td>
									</tr>
									<tr>
										<td>II Visual Acuity</td>
										<td>{{ $checkup->NeuroExam->visual_acuity  }}</td>
									</tr>
									<tr>
										<td>Visual Fields</td>
										<td>{{ $checkup->NeuroExam->pupils  }}</td>
									</tr>
									<tr>
										<td>Funduscopy</td>
										<td>
											<ol class="inline-list">
												@if($checkup->NeuroExam->jsonConvert('funduscopy'))
													@foreach(($checkup->NeuroExam->jsonConvert('funduscopy')) as $key => $value)
														<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
									</tr>
									<tr>
										<td>II, III</td>
										<td>
											<ol class="inline-list">
												@if($checkup->NeuroExam->jsonConvert('2_3'))
													@foreach(($checkup->NeuroExam->jsonConvert('2_3')) as $key => $value)
														<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
									</tr>
									<tr>
										<td>III, IV, VI EOMs</td>
										<td>{{ $checkup->NeuroExam['attributes']['3_4_6_eoms']  }}</td>
									</tr>
									<tr>
										<td>Primary Gaze</td>
										<td>{{ $checkup->NeuroExam['attributes']['lateralizing_gaze']  }}</td>
									</tr>
									<tr>
										<td>V Temporal Strength</td>
										<td>{{ $checkup->NeuroExam->temporal_strength  }}</td>
									</tr>
									<tr>
										<td>Masseter Strength</td>
										<td>{{ $checkup->NeuroExam->able_to_clench_teeth  }}</td>
									</tr>
									<tr>
										<td>Facial Sensation</td>
										<td>{{ $checkup->NeuroExam->able_to_feel_pain_in_facial_area  }}</td>
									</tr>
									<tr>
										<td>Corneal Reflex</td>
										<td>{{ $checkup->NeuroExam->corneal_reflex  }}</td>
									</tr>
									<tr>
										<td>VII</td>
										<td>
											<ol class="inline-list">
												@if($checkup->NeuroExam->jsonConvert('vii'))
													@foreach(($checkup->NeuroExam->jsonConvert('vii')) as $key => $value)
															<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
									</tr>
									<tr>
										<td>Taste</td>
										<td>{{ $checkup->NeuroExam->taste  }}</td>
									</tr>
									<tr>
										<td>VIII Response to Whispered Voice</td>
										<td>{{ $checkup->NeuroExam->response_to_whispered_voice  }}</td>
									</tr>
									<tr>
										<td>IX, X</td>
										<td>
											<ol class="inline-list">
												{{ $checkup->NeuroExam->gag_reflex  }}
											</ol>
										</td>
									</tr>
									<tr>
										<td>XI</td>
										<td>
											<ol class="inline-list">
												@if($checkup->NeuroExam->jsonConvert('xi'))
													@foreach(($checkup->NeuroExam->jsonConvert('xi')) as $key => $value)
														<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
									</tr>
									<tr>
										<td>XII</td>
										<td>
											<ol class="inline-list">
												@if($checkup->NeuroExam->jsonConvert('xii'))
													@foreach(($checkup->NeuroExam->jsonConvert('xii')) as $key => $value)
														<li>{{ $key }}</li>
													@endforeach
												@endif
											</ol>
										</td>
									</tr>
									<tr>
										<th colspan="2">MOTOR EXAM</th>
									</tr>
									<tr>
										<td>Muscle Bulk</td>
										<td>{{ $checkup->NeuroExam->muscle_bulk  }}</td>
									</tr>
									<tr>
										<td>Muscle Tone</td>
										<td>{{ $checkup->NeuroExam->muscle_tone }}</td>
									</tr>
									<tr>
										<td>Muscle Tone</td>
										<td>{{ $checkup->NeuroExam->muscle_tone }}</td>
									</tr>
									<tr>
										<td>Muscle Strength</td>
										<td>
											<table>
												<tr>
													<td>{{ $checkup->NeuroExam->jsonConvert('muscle_strength')['left_arm'] or "" }}</td>
													<td rowspan="2">
														<img class="img-responsive" style="height:100%; width:100%" src="{{ asset('frontend/images/neuro_diagram.png') }}">
													</td>
													<td>{{ $checkup->NeuroExam->jsonConvert('muscle_strength')['right_arm'] or "" }}</td>
												</tr>
												<tr>
													<td>{{ $checkup->NeuroExam->jsonConvert('muscle_strength')['left_leg'] or "" }}</td>
													<td>{{ $checkup->NeuroExam->jsonConvert('muscle_strength')['right_leg'] or "" }}</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>Sensory</td>
										<td>
											<table>
												<tr>
													<td>{{ $checkup->NeuroExam->jsonConvert('sensory')['left_arm'] or "" }}</td>
													<td rowspan="2">
														<img class="img-responsive" style="height:100%; width:100%" src="{{ asset('frontend/images/neuro_diagram.png') }}">
													</td>
													<td>{{ $checkup->NeuroExam->jsonConvert('sensory')['right_arm'] or "" }}</td>
												</tr>
												<tr>
													<td>{{ $checkup->NeuroExam->jsonConvert('sensory')['left_leg'] or "" }}</td>
													<td>{{ $checkup->NeuroExam->jsonConvert('sensory')['right_leg'] or "" }}</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>Reflexes</td>
										<td>
											<table>
												<tr>
													<td>{{ $checkup->NeuroExam->jsonConvert('reflexes')['left_arm'] or "" }}</td>
													<td rowspan="2">
														<img class="img-responsive" style="height:100%; width:100%" src="{{ asset('frontend/images/neuro_diagram.png') }}">
													</td>
													<td>{{ $checkup->NeuroExam->jsonConvert('reflexes')['right_arm'] or "" }}</td>
												</tr>
												<tr>
													<td>{{ $checkup->NeuroExam->jsonConvert('reflexes')['left_leg'] or "" }}</td>
													<td>{{ $checkup->NeuroExam->jsonConvert('reflexes')['right_leg'] or "" }}</td>
												</tr>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</fieldset>
					@endif
				</label>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<fieldset>
					<legend>Assessment</legend>
					<label for="general_assessment">
						General Assessment:
						<pre>{{ $checkup->remarks }}</pre>
					</label>
					@if($checkup->CheckupInfections)
						<label for="">Infections Record:
							<table width="100%">
									<tr>
										<th colspan="2">
											Clinical Stage: {{ $checkup->CheckupInfections->Infections->clinical_stage }}
										</th>
									</tr>
									@foreach($checkup->CheckupInfections->Infections->infections_clinical_stage as $ics)
										<tr>
											<td colspan="2">
												{{ $ics->details->infection_name }}
											</td>
										</tr>
									@endforeach
									<tr>
										<td colspan="2">
											<ul>
												{!! ($checkup->CheckupInfections->Infections->hepatitis_b == 1) ? "<li>Hepatitis B</li>": "" !!}
												{!! ($checkup->CheckupInfections->Infections->hepatitis_c == 1) ? "<li>Hepatitis C</li>": "" !!}
												{!! ($checkup->CheckupInfections->Infections->pneumocystis_pneumonia == 1) ? "<li>Pneumocystis Pneumonia</li>": "" !!}
												{!! ($checkup->CheckupInfections->Infections->oropharyngeal_candidiasis == 1) ? "<li>Oropharyngeal Candidiasis</li>": "" !!}
												{!! ($checkup->CheckupInfections->Infections->syphilis == 1) ? "<li>Syphilis</li>": "" !!}
												{!! ($checkup->CheckupInfections->Infections->stis != "") ? "<li>STIs:".$checkup->stis."</li>": "" !!}
												{!! ($checkup->CheckupInfections->Infections->others != "") ? "<li>Others:".$checkup->others."</li>": "" !!}
											</ul>
										</td>
									</tr>
							</table>
						</label>
					@endif
				</fieldset>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<label><span>Laboratory Requests:</span>
					@if($lab_request)
						<ul>
							@foreach($lab_request as $row)
								<li>{{ $row->LaboratoryTest->description }}</li>
							@endforeach
						</ul>
					@endif
				</label>
			</td>
			<td colspan="2">
				<label><span>Referrals:</span>
					@if($checkup->Referrals)
						<ul>
							{!! (($checkup->Referrals->surgeon == 1) ? "<li>Surg</li>" : "") !!}
							{!! (($checkup->Referrals->ob_gyne == 1) ? "<li>OB Gyne</li>" : "") !!}
							{!! (($checkup->Referrals->opthamology == 1) ? "<li>Opthal</li>" : "") !!}
							{!! (($checkup->Referrals->dentis == 1) ? "<li>Dentist</li>" : "") !!}
							{!! (($checkup->Referrals->psychiatrist == 1) ? "<li>Psych</li>" : "") !!}
							{!! (($checkup->Referrals->tb_dots == 1) ? "<li>TB Dots</li>" : "") !!}
							{!! (($checkup->Referrals->others != "") ? "<li>Others:".$checkup->Referrals->others."</li>" : "") !!}
							{!! (($checkup->Referrals->reason) ? "<li>Reason:".$checkup->Referrals->reason."</li>" : "") !!}
						</ul>
					@endif
				</label>
			</td>
		</tr>
		@if($checkup->CheckupARV && $checkup->CheckupARV->ARV)
			<tr>
				<td colspan="4">
					<fieldset>
						<legend>ARV Regimen</legend>
						<div class="row">
							<div id="arv_regimen" class="medium-12 columns">

								<table id="prescriptions" width="100%">
									<thead>
									<tr>
										<th width="45%">Medicine</th>
										<th width="5%">Pills/Day</th>
										<th width="20%"><center>Date Started</center></th>
										<th width="30%"><center>Date Discontinued</center></th>
									</tr>
									</thead>
									<tbody>
										@foreach($checkup->CheckupARV->ARV->ARVItems as $item)
											@if($item->prescription_type == 'arv')
												<tr>
													<td>{{ $item->Medicine->name }}</td>
													<td><center>{{ $item->pills_per_day }}</center></td>
													<td><center>{{ $item->date_started->format('F d, Y') }}</center></td>
													<td><center>{{ ($item->date_discontinue != null) ? $item->date_discontinue->format('F d, Y') : '' }}</center></td>
												</tr>
												<tr>
													<td colspan="4">
														<table width="100%">
															<tr>
																<td>Pill</td>
																<td>Symptoms</td>
																<td>Monitoring</td>
															</tr>
															@foreach($item->medicine_data as $dataitem)
																<tr>
																	<td>{{ $dataitem['key'] }}</td>
																	<td>{{ $dataitem['symptom'] }}</td>
																	<td>{{ $dataitem['monitoring'] }}</td>
																</tr>
															@endforeach
														</table>
													</td>
												</tr>
											@endif
										@endforeach
									</tbody>
								</table>
							</div>
							<div class="medium-6 columns"></div>
						</div>
					</fieldset>
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<fieldset>
						<legend>OI Medicine</legend>
						<table width="100%">
							<thead>
							<th width="15%"></th>
							<th width="25%">Name</th>
							<th width="20%">Pills/Day</th>
							<th width="40%">Suggested Dosage</th>
							</thead>
							<tbody id="oi_medicine">
							@if($checkup->CheckupARV->ARV->ARVItems->count() > 0)
								@foreach($checkup->CheckupARV->ARV->ARVItems as $item)
									@if($item->prescription_type == 'oi')
										<td></td>
										<td>{{ $item->specified_medicine  }}</td>
										<td>{{ $item->pills_per_day }}</td>
										<td>{{ $item->suggested_dosage }}</td>
									@endif
								@endforeach
							@endif
							</tbody>
						</table>
					</fieldset>
				</td>
				<td colspan="2">
					<fieldset>
						<legend>Other Medicine</legend>
						<table width="100%">
							<thead>
							<th width="15%"></th>
							<th width="25%">Name</th>
							<th width="20%">Pills/Day</th>
							<th width="40%">Suggested Dosage</th>
							</thead>
							<tbody id="other_medicine">
							@if($checkup->CheckupARV->ARV->ARVItems->count() > 0)
								@foreach($checkup->CheckupARV->ARV->ARVItems as $item)
									@if($item->prescription_type == 'others')
										<td></td>
										<td>{{ $item->specified_medicine  }}</td>
										<td>{{ $item->pills_per_day }}</td>
										<td>{{ $item->suggested_dosage }}</td>
									@endif
								@endforeach
							@endif
							</tbody>
						</table>
					</fieldset>
				</td>
			</tr>
		@endif
		<tr>
			<td colspan="2">
				&nbsp;
			</td>
			<td colspan="2">
				<div>Generated By:<br/>
					Name: {{ Auth::user()->name }}<br/>
					Email: {{ Auth::user()->email }}
				</div>
			</td>
		</tr>
	</table>
</fieldset>


@endsection
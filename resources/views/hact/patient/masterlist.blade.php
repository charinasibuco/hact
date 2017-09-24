@extends('hact.layouts.layout_admin')

@section('content')

<div class="row">
	<div class="large-12 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('patient') }}">Patient</a></li>
			<li><a href="{{ route('patient_profile', $patient->id) }}">{{ $patient->code_name }}</a></li>
			<li class="current"><a href="#">Masterlist</a></li>
		</ul>
	</div>
</div>

<div class="row">
	<div class="large-12 columns">

		<div class="panel">
			<a href="{{ route('patient_masterlist_print',[$patient->id]) }}" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
			<div class="row">
				<div class="large-5 columns text-right"><label>Code Name</label></div>
				<div class="large-7 columns">{{ $patient->code_name }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>UI Code</label></div>
				<div class="large-7 columns">{{ $patient->ui_code }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Phil Health No.</label></div>
				<div class="large-7 columns">{{ $patient->phil_health_number }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Date of Enrolment</label></div>
				<div class="large-7 columns">{{ $patient->enrolment_date_format }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Birth Date</label></div>
				<div class="large-7 columns">{{ $patient->birth_date_format }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>No. of Children</label></div>
				<div class="large-7 columns">{{ $patient->dependents }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Gender</label></div>
				<div class="large-7 columns">{{ $patient->gender_format }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Nationality</label></div>
				<div class="large-7 columns">{{ $patient->nationality }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Civil Status</label></div>
				<div class="large-7 columns">{{ $patient->civil_status_format }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Permanent Address</label></div>
				<div class="large-7 columns">{{ $patient->permanent_address }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Current City</label></div>
				<div class="large-7 columns">{{ $patient->current_city }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Current Province</label></div>
				<div class="large-7 columns">{{ $patient->current_province }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Place of Birth City</label></div>
				<div class="large-7 columns">{{ $patient->birth_place_city }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Place of Birth Province</label></div>
				<div class="large-7 columns">{{ $patient->birth_place_province }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Contact Number</label></div>
				<div class="large-7 columns">{{ $patient->contact_number }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Email</label></div>
				<div class="large-7 columns">{{ $patient->email }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Highest Educational Attainment</label></div>
				<div class="large-7 columns">{{ $patient->highest_educational_attainment_format }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Are you living with a partner?</label></div>
				<div class="large-7 columns">{{ $patient->is_living_with_partner_format }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Currently Working?</label></div>
				<div class="large-7 columns">{{ $patient->is_working_format }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Current Occupation</label></div>
				<div class="large-7 columns">{{ $patient->current_occupation }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Previous Occupation</label></div>
				<div class="large-7 columns">{{ $patient->previous_occupation }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Do you work overseas/abroad in the past 5 years?</label></div>
				<div class="large-7 columns">{{ $patient->is_work_abroad_in_past_5years_format }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>When did you return from your last contract?</label></div>
				<div class="large-7 columns">{{ $patient->last_contract_format }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>Where were you based?</label></div>
				<div class="large-7 columns">{{ $patient->is_based_format }}</div>
			</div>

			<div class="row">
				<div class="large-5 columns text-right"><label>What country did you last work in?</label></div>
				<div class="large-7 columns">{{ $patient->last_work_country }}</div>
			</div>
			
			<!-- VCT Records -->
			@if( $vct->count() > 0)
				<div class="row">
					<div class="large-12 columns text-center"><h4>VCT (Voluntary Counselling Testing) Records</h4></div>
				</div>

				<div class="row">
					<div class="large-12 columns text-center">
						<table width="100%">
							<thead>
								<tr>
									<th width="10%"></th>
									<th width="20%"><a href="#">VCT Date</a></th>
									<th width="15%"><a href="#">Result</a></th>
									<th width="25%"><a href="#">Facilitator</a></th>
									<th width="30%"><a href="#">Date Created</a></th>
								</tr>
							</thead>
							<tbody>
							@foreach($vct as $row)
							<tr>
								<td>
									@if(Auth::user()->access == 1)
										<a href="{{ route('vct_edit', $row->id) }}" title="Edit VCT"><i class="fa fa-edit fa-lg"></i></a>
									@endif
									@if($row->result == 1 && Auth::user()->access != 2)
									<a href="{{ route('vct_doctor', $row->id) }}" title="Assign Doctor"><i class="fa fa-user-md fa-lg"></i></a>
									@endif
								</td>
								<td>{{ $row->vct_date_format }}</td>
								<td>{{ $row->result_format }}</td>
								<td>{{ $row->User->name }}</td>
								<td>{{ $row->created_at_format }}</td>
							</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			@endif

			<!-- Laboratory Records -->
			@if( $laboratories->count() > 0)
				<div class="row">
					<div class="large-12 columns text-center"><h4>Laboratory Records</h4></div>
				</div>

				<div class='row'>
					<div class='large-12 columns'>
						@include('hact.messages.success')
						@include('hact.messages.error_list')

						<ul class="accordion" data-accordion>
							@foreach($laboratory_tests as $test)
								@if($laboratories->where('laboratory_test_id',$test->id)->count() > 0)
									<li class="accordion-navigation">
										<a href="#panel{{$test->id}}">
											{{ $test->description }}
										</a>
										<div id="panel{{$test->id}}" class="content active">
											<table class="responsive" width="100%">
												<thead>
												<tr>
													<th width="10%"><a href="{{ route('laboratory_chart', [$patient->id,$test->id,'']) }}"><i class="fa fa-line-chart fa-lg"></i></a></th>
													@if($laboratories->where('laboratory_test_id', $test->id)->first()->laboratory_type->description != $test->description)
														<th width="30%">Laboratory Name</th>
													@endif
													<th width="20%">Laboratory Result</th>
													<th class="main-column" width="20%">Result Date</th>
													<th width="20%">Image</th>
												</tr>
												</thead>
												<tbody>
												@foreach($laboratories->where('laboratory_test_id', $test->id) as $row)
													<tr>
														<td>{{-->@if(Auth::user()->access == 1)--}}
															<a href="{{ route('laboratory_edit', $row->id) }}" title="Edit Laboratory">
																<i class="fa fa-edit fa-lg"></i></a>
															<a href="{{ route('laboratory_destroy', $row->id) }}" title="Delete Laboratory">
																<i class="fa fa-times fa-lg"></i></a>
															{{--@endif--}}
														</td>
														@if($row->laboratory_type->description != $test->description)
															<td>{{ $row->laboratory_type->description }}</td>
														@endif
														<td>{{ $row->result }}</td>
														<td class="main-column">{{ $row->result_date_format }}</td>
														<td>
															@if($row->image != "")
																<a href="#" data-reveal-id="modal{{ $row->id }}">View Image <i class="fa fa-file-image-o"></i></a>
															@else
																<span style = "font-style:italic">No Image Available</span>
															@endif
														</td>

														<div style = "text-align:center" id="modal{{ $row->id }}" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
															<img src="{{ asset($row->image) }}" >
															<a class="close-reveal-modal" aria-label="Close">&#215;</a>
														</div>
													</tr>
												@endforeach
												</tbody>
											</table>
										</div>
									</li>
								@endif
							@endforeach
							@foreach($other_laboratories as $other)
								@if($laboratories->where('other', $other->other)->count() > 0)
									<li class="accordion-navigation">
										<a href="#panel{{$other->id}}">
											{{ $other->other }}
										</a>
										<div id="panel{{$other->id}}" class="content active">
											<table width="100%">
												<thead>
												<tr>
													<th width="10%"><a href="{{ route('laboratory_chart', [$laboratories->where('other', $other->other)->first()->patient_id,16,$other->other]) }}"><i class="fa fa-line-chart fa-lg"></i></a>
													</th>
													<th width="30%">Laboratory Result</th>
													<th width="30%">Result Date</th>
													<th width="30%">Image</th>
												</tr>
												</thead>
												<tbody>
												@foreach($laboratories->where('other', $other->other) as $row)
													<tr>
														<td>
															{{--@if(Auth::user()->access == 1)--}}
															<a href="{{ route('laboratory_edit', $row->id) }}" title="Edit Laboratory">
																<i class="fa fa-edit fa-lg"></i></a>
															<a href="{{ route('laboratory_destroy', $row->id) }}" title="Delete Laboratory">
																<i class="fa fa-times fa-lg"></i></a>
															{{--@endif--}}
														</td>
														<td>{{ $row->result }}</td>
														<td>{{ $row->result_date_format }}</td>
														<td>
															@if($row->image != "")
																<a href="#" data-reveal-id="modal{{ $row->id }}">View Image <i class="fa fa-file-image-o"></i></a>
															@else
																<span style = "font-style:italic">No Image Available</span>
															@endif
														</td>

														<div style = "text-align:center" id="modal{{ $row->id }}" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
															<img src="{{ asset($row->image) }}" >
															<a class="close-reveal-modal" aria-label="Close">&#215;</a>
														</div>
													</tr>
												@endforeach
												</tbody>
											</table>
										</div>
									</li>
								@endif
							@endforeach
						</ul>
					</div>
				</div>
			@endif

			<!-- Tuberculosis Records -->
			@if( $tuberculosis->count() > 0)
				<div class="row">
					<div class="large-12 columns text-center"><h4>Tuberculosis Records</h4></div>
				</div>

				<div class='row'>
					<div class='large-12 columns'>
						@include('hact.messages.success')
						@include('hact.messages.error_list')
						<table width="100%" align="center">
							<thead>
								<tr>
									<th style="width:5%;"><a href="#">Symptoms Screening</a></th>
									<th style="width:10%;"><a href="#">TB Status</a></th>
									<th style="width:15%;"><a href="#">Site</a></th>
									<th style="width:15%;"><a href="#">TB Regimen</a></th>
									<th style="width:10%;"><a href="#">Date Started</a></th>
									<th style="width:10%;"><a href="#">IPT</a></th>
									<th style="width:15%;"><a href="#">Drug Resistance</a></th>
									<th style="width:15%;"><a href="#">Tx Outcome</a></th>
								</tr>
							</thead>
							<tbody>
								@foreach($tuberculosis as $tb)
								<tr>
									 <td><a href="{{ route('tuberculosis_edit',$tb->id) }}" title="Edit Tuberculosis"><i class="fa fa-lg fa-pencil-square-o"></i></a></td>
									<td>{{ $tb->presence_format }}</td>
									<td>{{ $tb->tb_status_format }}</td>
									<td>{{ $tb->site_format }} {{ $tb->site_extrapulmonary }}</td>
									<td>{{ $tb->current_tb_regimen_format }}</td>
									<td>{{ $tb->date_started }}</td>
									{{-- <td>{{ $tb->on_ipt }}</td> --}}
									<td>{{ $tb->ipt_outcome_format }} {{ $tb->ipt_outcome_other }}</td>
									<td>{{ $tb->drug_resistance_format }} {{ $tb->drug_resistance_other }}</td>
									<td>{{ $tb->tx_outcome_format }} {{ $tb->tx_outcome_other }}</td>
								</tr>
								@endforeach
								<tr></tr>
							</tbody>
						</table>
					</div>
				</div>
			@endif

			<!-- CheckUp Records -->

			@if( $checkups->count() > 0 )
				<div class="row">
					<div class="large-12 columns text-center"><h4>Consultation Records</h4></div>
				</div>
				<div class='row'>
					<div class='large-12 columns'>
						@include('hact.messages.success')
						@include('hact.messages.error_list')

						<table width="100%">
							<tr>
								<th width="10%"></th>
								<th class="main-column" scope="column" width="15%"><a href="#">Consultation Date</a></th>
								<th scope="column" width="15%"><a href="#">Follow up Date</a></th>
								<th width="20%"><a href="#">Chief Complaints</a></th>
								<th width="25%"><a href="#">General Assessments</a></th>
								<th width="25%"><a href="#">Medicine Prescribed</a></th>
								{{--<th width="30%"><a href="#">TB Screening</a></th>--}}
							</tr>
							@foreach($checkups as $row)
								<tr>
									<td>
										<a href="{{ route('checkup_edit', $row->id) }}" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
										<a href="{{ route('checkup_show', $row->id) }}" target="_blank" title="Show Full Form"><i class="fa fa-file-text fa-lg"></i></a>
										{{--<!-- <a href="{{ route('checkup_show', $row->id) }}" title="Show Check Up Form"><i class="fa fa-newspaper-o fa-lg"></i></a> -->--}}
									</td>

									<td class="main-column">{{ $row->checkup_date->format('m/d/Y') }}</td>
									<td>{{ $row->follow_up_date->format('m/d/Y') }}</td>
									<td>{{ $row->patient_complaints }}</td>
									<td>{{ $row->remarks }}</td>
									<td>
										@if($row->prescriptions && count($row->prescriptions) > 0)
											<table width="100%">
												<thead>
												<tr>
													<td>Medicine</td>
													<td>Pills/Day</td>
													<td>Dosage</td>
												</tr>
												</thead>
												<tbody>
												@foreach($row->prescriptions as $prescription)
													<tr>
														@if($prescription->prescription_type == 'arv')
															<td>{{ ($prescription->Medicine ) ?  $prescription->Medicine->name : '' }}</td>

														@elseif($prescription->prescription_type == 'oi' || $prescription->prescription_type == 'others')
															<td>{{ $prescription->specified_medicine }}</td>
														@endif
														<td>{{ $prescription->pills_per_day }}</td>
														<td>{{ $prescription->suggested_dosage }}</td>
													</tr>
												@endforeach
												</tbody>
											</table>

										@endif
									</td>
									{{--<td>--}}
									{{--<ul>--}}
									{{--{!! ($row->cough == 1) ? '<li>Cough</li>' : '' !!}--}}
									{{--{!! ($row->fever == 1) ? '<li>Fever</li>' : '' !!}--}}
									{{--{!! ($row->night_sweat == 1) ? '<li>Night Sweat</li>' : '' !!}--}}
									{{--{!! ($row->weight_loss == 1) ? '<li>Weight Loss</li>' : '' !!}--}}
									{{--</ul>--}}
									{{--</td>--}}
								</tr>
							@endforeach

						</table>
					</div>
				</div>
			@endif

			<!-- arv Records -->
			@if( $arv->count() > 0 )
				<div class="row">
					<div class="large-12 columns text-center"><h4>Prescription</h4></div>
				</div>
				<table width="100%">
					<thead>
						<tr>
							<th width="10%"></th>
							<th width="50%"><a href="#">Medicines</a></th>
							<th width="20%"><a href="#">Doctor</a></th>
							<th width="20%"><a href="#">Date Issued</a></th>
						</tr>
					</thead>
					<tbody>
						@foreach($arv as $row)
							<tr>
								<td>
									@if($row->arv_count == 0)
										<a href="{{ route('arv_edit', [$row->id]) }}"><i class="fa fa-lg fa-edit"></i></a>
									@else
										<i class="fa fa-lg fa-edit"></i>
									@endif
									<a href="{{ route('prescription_create', $row->id) }}" title="Dispense"><i class="fa fa-lg fa-sticky-note-o"></i></a>
									<a href="{{ route('prescription_details', $row->id) }}" title="Dispense Details"><i class="fa fa-lg fa-file-text-o"></i></a>
								</td>
								<td>
									@foreach($row->ARVItems as $item)
										@if($item->arv_item_count != 0)
											@if($item->specified_medicine == '')
												<span class="line-through" title="Already Dispense">{{ $item->Medicine->name }} ( {{ $item->infection_format }} )</span>
											@else
												<span class="line-through" title="Already Dispense">{{ $item->specified_medicine }} ( {{ $item->infection_format }} )</span>
											@endif
										@else
											@if($item->specified_medicine == '')
												{{ $item->Medicine->name }} ( {{ $item->infection_format }} )
											@else
												{{ $item->specified_medicine }} ( {{ $item->infection_format }} )
											@endif
										@endif
										<br />
									@endforeach
								</td>
								<td>{{ $row->User->name }}</td>
								<td>{{ $row->created_at_format }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif

			<!-- Infections Records -->
			@if( $patient->Checkup->count() > 0)
				<div class="row">
					<div class="large-12 columns text-center"><h4>Infection Records</h4></div>
				</div>

				<div class='row'>
					<div class='large-12 columns'>
						<table width="100%">
							<thead>
								<tr>
									<th width="10%">

									</th>
									<th>
										Date
									</th>
									<th>
										Clinical Stage
									</th>
									<th>
										WHO Classifications
									</th>
									<th>
										Currently Present Infections
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach($patient->Checkup as $infections)
									<tr>
										<td>

										</td>
										<td>{{ $infections->CheckupInfections->Checkup->checkup_date->format('m/d/Y') }}</td>
										<td>
											{{ $infections->CheckupInfections->Infections->clinical_stage }}
										</td>
										<td>
											<a href="#" data-reveal-id="modal{{ $infections->CheckupInfections->Infections->id }}">View Clinical Staging <i class="fa fa-hospital-o"></i></a>
											<div style = "text-align:center" id="modal{{ $infections->CheckupInfections->Infections->id }}" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
											<table width="100%">
												<thead>
													<tr>
														<td width="5%">
															Stage
														</td>
														<td width="95%">
															Infection Description
														</td>
													</tr>
												</thead>
												<tbody>
													@foreach($infections->CheckupInfections->Infections->infections_clinical_stage as $ics)
														<tr>
															<td>
																{{ $ics->details->stage }}
															</td>
															<td>
																{{ $ics->details->infection_name }}
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>
											<a class="close-reveal-modal" aria-label="Close">&#215;</a>
										</div>
										</td>
										<td>
											<ul>
												{!! ($infections->CheckupInfections->Infections->hepatitis_b == 1) ? "<li>Hepatitis B</li>": "" !!}
												{!! ($infections->CheckupInfections->Infections->hepatitis_c == 1) ? "<li>Hepatitis C</li>": "" !!}
												{!! ($infections->CheckupInfections->Infections->pneumocystis_pneumonia == 1) ? "<li>Pneumocystis Pneumonia</li>": "" !!}
												{!! ($infections->CheckupInfections->Infections->oropharyngeal_candidiasis == 1) ? "<li>Oropharyngeal Candidiasis</li>": "" !!}
												{!! ($infections->CheckupInfections->Infections->syphilis == 1) ? "<li>Syphilis</li>": "" !!}
												{!! ($infections->CheckupInfections->Infections->stis != "") ? "<li>STIs:".$infections->CheckupInfections->Infections->stis."</li>": "" !!}
												{!! ($infections->CheckupInfections->Infections->others != "") ? "<li>Others:".$infections->CheckupInfections->Infections->others."</li>": "" !!}
											</ul>
										</td>
									</tr>
								@endforeach	
							</tbody>
						</table>
					</div>
				</div>
			@endif

			<!-- Obgyne Records -->
			@if( $ob->count() > 0)
				<div class="row">
					<div class="large-12 columns text-center"><h4>Obgyne Records</h4></div>
				</div>

				<div class="row">
					<div class="large-12 columns text-center">
						<table width="100%">
								<thead>
								<tr>
										<th width="7%">

										</th>
										<th width="20%"><a href="#">Currently Pregnant</a></th>
										<th width="20%"><a href="#">Age Gestation</a></th>
										<th width="20%"><a href="#">Delivery Date</a></th>
										<th width="33%"><a href="#">Type of Infant Feeding</a></th>
								</tr>
								</thead>
								<tbody>
								@foreach($ob as $obgyne)
										<tr>
												<td>
													@if(Auth::user()->access == 1)
														<a href="{{ route('ob_gyne_edit',['id' => $obgyne->patient_id, 'ob_id' => $obgyne->id]) }}" title="Edit OB-Gyne"><i class="fa fa-edit fa-lg"></i></a>
													@endif
												</td>
												<td>{{$obgyne->currently_pregnant}}</td>
												<td>{{$obgyne->currently_pregnant_if_yes_gestation_age}}</td>
												<td>{{($obgyne->if_delivered_date != NULL) ? $obgyne->if_delivered_date->format('M j Y') : ''}}</td>
												<td>{{$obgyne->infant_type}}</td>
										</tr>
								@endforeach

								</tbody>
						</table>
						{!! $ob->render() !!}
					</div>
				</div>
			@endif

			<!-- Mortality Records -->
			@if(!is_null($mortality))
				<div class="row">
					<div class="large-12 columns text-center"><h4>Mortality</h4></div>
				</div>

				<div class="row">
					<div class="large-12 columns text-center">
						<div class="row">
							<div class="large-12 columns">
								<table width="100%">
									<thead>
										<tr>
											<td colspan="3" style="width:40%;"><a href="#">Date of Death</a></td>
										</tr>
									</thead>

									<tbody>
										<tr>
											<td colspan="3">{{ $mortality->date_of_death_format }}</td>
										</tr>
									</tbody>

									<thead>
										<tr>
											<td colspan="3"><a href="#">Cause of Death</a></td>
										</tr>
									</thead>

									<tbody>
										<tr>
											<td style="width:40%;">
												<div class="row">
													<div class="large-6 columns text-right">
														<strong>HIV Related</strong>
													</div>
													<div class="large-6 columns">
														{{ $mortality->is_hiv_related_format }}
													</div>
												</div>
											</td>
											<td style="width:35%;">
												<div class="row">
													<div class="large-6 columns text-right">
														<strong>Immediate Cause</strong>
													</div>
													<div class="large-6 columns">
														{{ $mortality->immediate_cause }}
													</div>
												</div>
												<div class="row">
													<div class="large-6 columns text-right">
														<strong>Antecedent Cause</strong>
													</div>
													<div class="large-6 columns">
														{{ $mortality->antecedent_cause }}
													</div>
												</div>
												<div class="row">
													<div class="large-6 columns text-right">
														<strong>Underlying Cause</strong>
													</div>
													<div class="large-6 columns">
														{{ $mortality->underlying_cause }}
													</div>
												</div>
											</td>
											<td style="width:25%;">
												<div class="row">
													<div class="large-6 columns text-right">
														<strong>ICD-10 Code</strong>
													</div>
													<div class="large-6 columns">
														{{ $mortality->immediate_icd10_code }}
													</div>
												</div>
												<div class="row">
													<div class="large-6 columns text-right">
														<strong>ICD-10 Code</strong>
													</div>
													<div class="large-6 columns">
														{{ $mortality->antecedent_icd10_code }}
													</div>
												</div>
												<div class="row">
													<div class="large-6 columns text-right">
														<strong>ICD-10 Code</strong>
													</div>
													<div class="large-6 columns">
														{{ $mortality->underlying_icd10_code }}
													</div>
												</div>
											</td>
										</tr>
									</tbody>

									<thead>
										<tr>
											<td>
												<div class="row">
													<div class="large-12 columns">
														<a href="#">Opportunistic infections present prior to death</a>
													</div>
												</div>
											</td>
											<td colspan="2">
												<div class="row">
													<div class="large-12 columns">
														<a href="#">CD4 Count</a>
													</div>
												</div>
											</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="row">
													<div class="large-12 columns text-center">
														@if($mortality->tuberculosis == 1)
															Tuberculosis<br/>
														@endif

														@if($mortality->pneumocystis_pneumonia == 1)
															Pneumocystis Pneumonia<br/>
														@endif

														@if($mortality->cryptococcal_meningitis == 1)
															Cryptococcal Meningitis<br/>
														@endif

														@if($mortality->cytomegalovirus == 1)
															Cytomegalovirus<br/>
														@endif

														@if($mortality->candidiasis == 1)
															Candidiasis<br/>
														@endif

														@if($mortality->other)
															Other: {{ $mortality->other }}<br/>
														@endif
													</div>
												</div>
											</td>
											<td>
												<div class="row">
													<div class="large-6 columns text-right">
														<strong>Have CD4 Record</strong>
													</div>
													<div class="large-6 columns">
														{{ $mortality->have_cd4_info_format }}
													</div>
												</div>
												@if($mortality->have_cd4_info == 1)
												<div class="row">
													<div class="large-6 columns text-right">
														<strong>Last CD4 Count</strong>
													</div>
													<div class="large-6 columns">
														{{ $mortality->last_cd4_count_format }}
													</div>
												</div>
												<div class="row">
													<div class="large-6 columns text-right">
														<strong>CD4 Count</strong>
													</div>
													<div class="large-6 columns">
														{{ $mortality->cd4_count }}
													</div>
												</div>
												@endif
												<div class="row">
													<div class="large-6 columns text-right">
														<strong>Have Taken ARVs</strong>
													</div>
													<div class="large-6 columns">
														{{ $mortality->have_taken_arv_format }}
													</div>
												</div>
											<td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			@endif
			@if($medical_abstracts->count()>0)
				<div class="row">
					<div class="large-12 columns text-center"><h4>Medical Abstracts</h4></div>
				</div>
				<div class="row">
					<div class="large-12 columns text-center">
						<ul class="accordion" data-accordion>
							@foreach($medical_abstracts as $row)
								<li class="accordion-navigation">
									<a href="#panel{{$row->id}}a">{{$row->date->format('F d, Y')}} </a>
									<div id="panel{{$row->id}}a" class="content active">
										<pre style="text-align: left">{{ $row->body }}</pre>
									</div>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			@endif
		</div>
	</div>
</div>
<script>
	$(".collapse_report").hide();
	$('#search_patient').attr('readonly',true);
</script>


@endsection

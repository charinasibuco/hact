@extends('hact.layouts.layout_admin')

@section('content')


	<div class='row'>
		<div class='large-12 columns'>
			<ul class="breadcrumbs">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li><a href="{{ route('patient') }}">Patient</a></li>
				<li><a href="{{ route('patient_profile', $patient_id)}}">{{ App\Patient::find($patient_id)->code_name }}</a></li>
				<li><a href="{{ route('patient_profile', $patient_id) . "#tab2" }}">Consultation</a></li>
				<li class="current"><a href="#">{{ $page }}</a></li>
			</ul>
		</div>
	</div>
	<div class='row'>
		<div class='large-12 columns'>
			@include("hact.messages.success")
			@if(count($errors) > 0)
				<div class="alert-box alert ">Error: Highlight fields are required!</div>
				@include("hact.messages.other_error")
			@endif
		</div>
	</div>
	<div class='row'>
		<div class='large-12 columns'>
			<div class="large-12 medium-12 small-12 columns">
				<div class="custom-panel-heading">
					<span>{{ $page }} Consultation</span>
					<a href="{{ route('patient_profile',$patient_id) }}" class="alert tiny button right" title="Cancel Consultation"><i class="fi fi-x"></i> Cancel</a>
				</div>
				<div class="custom-panel-details">

					<form action="{{ $action }}" method="post">
						<input type="hidden" id="session_checker" name="session_checker" value="1" />
						<div class="row">
							<div class="medium-12 columns">
								<fieldset>
									<legend>Patient</legend>
									<div class="row">
										<div class="medium-3 columns">
											<label for="search_vct">Patient</label>
											<div class="row collapse">
												<div class="medium-10 columns">
													<input type="text" id="search_vct" name="search_vct" value="{{ $search_vct }}"  readonly/>
													<input type="hidden" id="patient_id" name="patient_id" value="{{ $patient_id }}" />
												</div>
												<div class="medium-2 columns">
													<span class="postfix"><i class="fa fa-search"></i></span>
												</div>
											</div>
										</div>
										<div class="medium-3 columns">
											<label for="age">Age</label>
											<input type="text" id="age" name="age" value="{{ $age }}" readonly />
										</div>
										<div class="medium-3 columns">
											<label for="gender">Gender</label>
											<input type="text" id="gender" name="gender" value="{{ $gender }}" readonly />
										</div>
										<div class="medium-3 columns">
											<label for="saccl_code">SACCL Code</label>
											<input type="text" id="saccl_code" name="saccl_code" value="{{ $saccl_code }}" readonly />
										</div>
									</div>
									<div class="row">
										<div class="medium-3 columns">
											<label for="checkup_date">Consultation Date</label>
											<input type="text" class="fdatepicker {{ ($errors->has('checkup_date')) ? 'highlight_error' : '' }}" id="checkup_date" name="checkup_date" placeholder="Consultation Date" value="{{ $checkup_date }}" readonly />
										</div>
										<div class="large-3 columns">
											<label for="resident_in_charge">Attending Physician</label>
											<input type="text" name="resident_in_charge" id="resident_in_charge" value="{{ $resident_in_charge }}" readonly>
										</div>
										<div class="large-6 columns">
											<fieldset>
												<legend>Patient Type</legend>
												<div class="row">
													<div class="small-1 columns"><input type="radio" name="patient_type" id="inpatient" value="InPatient" ></div>
													<div class="small-3 columns"><label for="inpatient">InPatient</label></div>
													<div class="small-1 columns"><input type="radio" name="patient_type" id="outpatient" value="OutPatient" checked></div>
													<div class="small-3 columns"><label for="outpatient">OutPatient</label></div>
													<div class="small-4 columns">&nbsp;</div>
												</div>
											</fieldset>
										</div>
									</div>
								</fieldset>
							</div>
						</div>

						<div class="row">
							<div class="medium-3 columns">
								<fieldset>
									<legend>General Summary</legend>
									<label for="weight">Weight (kg)</label>
									<input type="text" class="gen_sum {{ ($errors->has('weight')) ? 'highlight_error' : '' }}" id="weight" name="weight" placeholder="Weight" value="{{ $weight }}">
									<label for="height">Height (meters)</label>
									<input type="text" class="gen_sum {{ ($errors->has('height')) ? 'highlight_error' : '' }}" id="height" name="height" placeholder="Height" value="{{ $height }}">
									<label for="bmi">Body Mass Index</label>
									<input type="text" id="bmi" name="bmi" placeholder="BMI" value="{{ $bmi }}" readonly>
								</fieldset>
							</div>
							<div class="medium-3 columns">
								<fieldset>
									<legend>Vital Signs</legend>
									<label>Blood Pressure</label>
									<input type="text" class="{{ ($errors->has('blood_pressure')) ? 'highlight_error' : '' }}" name="blood_pressure" placeholder="Blood Pressure" value="{{ $blood_pressure }}">
									<label>Pulse Rate</label>
									<input type="text" class="{{ ($errors->has('pulse_rate')) ? 'highlight_error' : '' }}" name="pulse_rate" placeholder="Pulse Rate" value="{{ $pulse_rate }}">
									<label>Respiratory Rate</label>
									<input type="text" class="{{ ($errors->has('respiration_rate')) ? 'highlight_error' : '' }}" name="respiration_rate" placeholder="Respiratory Rate" value="{{ $respiration_rate }}">
									<label>Temperature</label>
									<input type="text" class="{{ ($errors->has('temperature')) ? 'highlight_error' : '' }}" name="temperature" placeholder="Temperature" value="{{ $temperature }}">

								</fieldset>
							</div>
							<div class="medium-3 columns">
								<fieldset>
									<legend>TB Screening</legend>
									<input type="radio" name="cough" value="1" id="cough-plus"><label for="cough-plus">(+)</label>
									<input type="radio" name="cough" value="0" id="cough-min" checked><label for="cough-min">(-)</label>&nbsp;<span>Cough</span><br>
									<input type="radio" name="fever" value="1" id="fever-plus"><label for="fever-plus">(+)</label>
									<input type="radio" name="fever" value="0" id="fever-min" checked><label for="fever-min">(-)</label>&nbsp;<span>Fever</span><br>
									<input type="radio" name="night_sweat" value="1" id="night_sweat-plus"><label for="night_sweat-plus">(+)</label>
									<input type="radio" name="night_sweat" value="0" id="night_sweat-min" checked><label for="night_sweat-min">(-)</label>&nbsp;<span>Night Sweat</span><br>
									<input type="radio" name="weight_loss" value="1" id="weight_loss-plus"><label for="weight_loss-plus">(+)</label>
									<input type="radio" name="weight_loss" value="0" id="weight_loss-min" checked><label for="weight_loss-min">(-)</label>&nbsp;<span>Weight Loss</span>

									{{--<input type="checkbox" value="1" id="cough" name="cough"><label for="cough">Cough</label>--}}
									{{--<br/><input type="checkbox" value="1" id="fever" name="fever"><label for="fever">Fever</label>--}}
									{{--<br/><input type="checkbox" value="1" id="night_sweat" name="night_sweat"><label for="night_sweat">Night Sweat</label>--}}
									{{--<br/><input type="checkbox" value="1" id="weight_loss" name="weight_loss"><label for="weight_loss">Weight Loss</label>--}}
								</fieldset>
							</div>
							<div class="medium-3 columns">
								<fieldset>
									<legend>Immunologic Profile</legend>
									<div class="row">
										<div class="medium-12 columns">
											<label for="last_cd4_count">
												Last CD4 Count:
												<select name="last_cd4_count" id="last_cd4_count">
													@if($cd4->count() > 0)
														<option value="" @if($laboratory['last_cd4_count'] == "") selected @endif disabled>Select CD4 Count record</option>
														@foreach($cd4 as $row)
															<option value="{{ $row->id }}" @if($laboratory['last_cd4_count'] == $row->id) selected @endif> Date:{{ $row->result_date->format('m/d/Y') }}; Result: {{ $row->result }}</option>
														@endforeach
													@else
														<option value="" selected disabled>No CD4 Count found</option>
													@endif
												</select>
											</label>
										</div>
									</div>
									<div class="row">
										<div class="medium-12 columns">
											<label for="last_viral_load">
												Last Viral Load:
												<select name="viral_load" id="viral_load">
													@if($viral_load->count() > 0)
														<option value="" selected disabled>Select Viral Load record</option>
														@foreach($viral_load as $row)
															<option value="{{ $row->id }}" @if($laboratory['viral_load'] == $row->id) selected @endif> Date:{{ $row->result_date->format('m/d/Y') }}; Result: {{ $row->result }}</option>
														@endforeach
													@else
														<option value="" selected disabled>No Viral Load found</option>
													@endif
												</select>
											</label>
										</div>
									</div>
								</fieldset>
							</div>
						</div>

						<div class="row">
							<div class="medium-12 columns">
								<fieldset>
									<legend>Chief Complaints</legend>
									<div class="row">
										<div class="medium-12 columns">
											<textarea id="patient_complaints" name="patient_complaints" class="customtext" rows="6">{{ $patient_complaints }}</textarea>
										</div>
									</div>
								</fieldset>
								<fieldset>
									<legend>Subjective</legend>
									<div class="row">
										<div class="medium-12 columns">
											<label for="subjective">Subjective</label>
											<textarea id="subjective" rows="10" name="subjective" class="customtext {{ ($errors->has('subjective')) ? 'highlight_error' : '' }}">{{ $subjective }}</textarea>
										</div>
									</div>
								</fieldset>
								<fieldset>
									<legend>Objective</legend>
									<div class="row">
										<div class="medium-12 columns">
											@include('hact.checkup.physical_exam')
										</div>
										<div class="medium-12 columns">
											@include('hact.checkup.neuro_exam')
										</div>
									</div>
								</fieldset>
								<fieldset>
									<legend>Assessment</legend>
									<fieldset>
										<legend>General Assessment</legend>
										<div class="row">
											<div class="medium-12 columns">
												<textarea id="remarks" name="remarks" class="customtext" rows="6">{{ $remarks }}</textarea>
											</div>
										</div>
									</fieldset>

									@include('hact.checkup.infections')
								</fieldset>

								<fieldset>
									<legend>Laboratory Requests</legend>
									<div class="row">
										@foreach($laboratory_tests as $row)
											<div class="medium-3 columns">
												<label for="lab_{{ $row->id }}"><input type="checkbox" id="lab_{{ $row->id }}" name="lab[{{ $row->id }}]" value="1"> {{ $row->description }}</label>
											</div>
										@endforeach
										<div class="medium-3 columns">&nbsp;</div>
									</div>
									<div class="row">
										<div class="medium-3 columns">
											<label for="lab_0"><input type="checkbox" id="lab_0" name="lab[0]" value="1"> Others</label>
										</div>
										<div class="medium-9 columns">
											<input type="text" name="lab_other_specify" class="{{ ($errors->has('lab_other_specify')) ? 'highlight_error' : '' }}" id="lab_other_specify" value="" placeholder="Specify" readonly>
										</div>
									</div>
								</fieldset>

								<fieldset>
									<legend>Referrals</legend>
									<div class="row">
										<div class="medium-4 columns">
											<label for="surgeon"><input type="checkbox" id="surgeon" name="surgeon" value="1"> Surgeon</label>
											<label for="ob_gyne"><input type="checkbox" id="ob_gyne" name="ob_gyne" value="1"> OB-Gyne</label>
											<label for="ophthamology"><input type="checkbox" id="ophthamology" name="ophthamology" value="1"> Ophthamology</label>
											<label for="dentis"><input type="checkbox" id="dentis" name="dentis" value="1"> Dentist</label>
											<label for="psychiatrist"><input type="checkbox" id="psychiatrist" name="psychiatrist" value="1"> Psychiatrist</label>
											<label for="tb_dots"><input type="checkbox" id="tb_dots" name="tb_dots" value="1"> TB DOTS</label>
											<label for="others_status"><input type="checkbox" id="others_status" name="others_status" value="1"> Others:</label>
											<label for="others_referral"><input type="text" class="{{ ($errors->has('others_referral')) ? 'highlight_error' : '' }}" name="others_referral" value="{{ $others_referral }}" id="others_referral" placeholder="Others Specify" @if(is_null($others_status)) readonly @endif></label>
										</div>
										<div class="medium-8 columns">
											<label for="reason">Reason</label>
											<textarea id="reason" name="reason" class="customtext" rows="5">{{ $reason }}</textarea>
										</div>
									</div>
								</fieldset>

								<fieldset>
									<legend><a href="#arv_regimen" id="btn-arvRegimenModal"><i class="fa fa-lg fa-plus"></i></a> ARV Regimen</legend>
									<div class="row">
										<div id="arv_regimen" class="medium-12 columns">

											<table id="prescriptions" width="100%">
												<thead>
												<tr>

													<th width="10%"></th>
													{{--<th width="15%"><center>Infections</center></th>--}}
													<th width="30%"><center>Medicine</center></th>
													<th width="5%"><center>Pills/Day</center></th>
													<th width="20%"><center>Date Started</center></th>
													<th width="30%"><center>Date Discontinued</center></th>

												</tr>
												</thead>
												<tbody></tbody>
											</table>

										</div>
										<div class="medium-6 columns"></div>
									</div>

								</fieldset>

								<div class="row" id="oi-other">
									<div class="large-6 columns">
										<fieldset>
											<legend><a href="#oi-other" id="btn-oiModal"><i class="fa fa-lg fa-plus"></i></a> OI Medicine</legend>
											<table width="100%">
												<thead>
												<th width="15%"></th>
												<th width="25%">Name</th>
												<th width="20%">Frequency</th>
												<th width="40%">Suggested Dosage</th>
												</thead>
												<tbody id="oi_medicine">
												</tbody>
											</table>
										</fieldset>
									</div>
									<div class="medium-6 columns">
										<fieldset>
											<legend><a href="#oi-other" id="btn-otherMedModal"><i class="fa fa-lg fa-plus"></i></a> Other Medicine</legend>
											<table width="100%">
												<thead>
												<th width="15%"></th>
												<th width="25%">Name</th>
												<th width="20%">Frequency</th>
												<th width="40%">Suggested Dosage</th>
												</thead>
												<tbody id="other_medicine">
												</tbody>
											</table>
											{{--<ul id="other_medicine"></ul>--}}
										</fieldset>
									</div>
								</div>
								<fieldset style="margin-top:20px;padding:10px 30px">
									<div class="row">
										<div class="large-4 columns">
											<label for="follow_up_date">Follow Up On</label>
											<input type="text" class="fdatepicker {{ ($errors->has('follow_up_date')) ? 'highlight_error' : '' }}" name="follow_up_date" id="follow_up_date" placeholder="Follow Up On" value="{{ $follow_up_date }}" readonly >
										</div>
										<div class="large-4 columns"></div>
										<div class="large-4 columns"><a href="{{ route('immunization_guidelines') }}" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> View Immunization Guidelines</a></div>
									</div>
								</fieldset><br />
								<div class="row">
									<div class="medium-12 columns">
										<div class="right">
											<input type="hidden" name="infection_id" value="{{ $infection_id }}">
											<input type="hidden" name="arv_id" value="{{ $arv_id }}">
											<button class="button success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
											{!! csrf_field() !!}
											<a href="{{ route('patient_profile',$patient_id) }}" class="button alert" title="Cancel"><i class="fi fi-x"></i> Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
	@include('hact.checkup.prescriptionmodal')
	@include('hact.checkup.oi')
	@include('hact.checkup.other-med')
	<script>

		$('#btn-arvRegimenModal').on('click', function(e){
			$('#arv_regimen_form #infection option[value=""]').prop('selected', true);
			$('#arv_regimen_form #pills_per_day').val('');
			$('#arv_regimen_form #search_medicine').val('');
			$('#arv_regimen_form #specified_medicine').val('')
			$('#arv_regimen_form #pills_missed_in_30_days').val('');
			$('#arv_regimen_form #pills_left').val('');
			$('#arv_regimen_form #date_started').val('');
			$('#arv_regimen_form #date_discontinued').val('');
			$('#arv_regimen_form #prescription_reason option[value=""]').prop('selected', true);

			$('#arv_regimen_form').attr('action', '{{ route('checkup_store_session') }}');
			$('#add_arv').text('Add');
			$('#arvRegimenModal').foundation('reveal', 'open');
		})


		$('#btn-oiModal').on('click', function(e){
			$('#oiModal').foundation('reveal', 'open');
		});

		$('#btn-otherMedModal').on('click', function(e){
			$('#otherMedModal').foundation('reveal', 'open');
		});

		<?php

        /*if($last_cd4)
        {
            echo '$(\'#last_cd4_count_id\').val(\'' . $last_cd4->id . '\');';
            echo '$(\'#last_cd4_count\').val(\'' . $last_cd4->result . '\');';
            echo '$(\'#cd4_result_date\').val(\'' . $last_cd4->result_date_format . '\');';
        }

        if($viral_load)
        {
            echo '$(\'#viral_load_id\').val(\'' . $viral_load->id . '\');';
            echo '$(\'#viral_load\').val(\'' . $viral_load->result . '\');';
            echo '$(\'#viral_load_result_date\').val(\'' . $viral_load->result_date_format . '\');';
        }*/

//        if($cough != '' || $cough != 0)
//        {
            echo "$('input[name=\"cough\"').filter('[value=\"".$cough."\"]').prop('checked', true);";
//        }

			echo "$('input[name=\"fever\"]').filter('[value=\"".$fever."\"]').prop('checked', true);";
			echo "$('input[name=\"night_sweat\"]').filter('[value=\"".$night_sweat."\"]').prop('checked', true);";
			echo "$('input[name=\"weight_loss\"]').filter('[value=\"".$weight_loss."\"]').prop('checked', true);";

//        if($fever != '' || $cough != 0)
//        {
//            echo "$('#fever').prop('checked', true);";
//        }
//
//        if($night_sweat != '' || $cough != 0)
//        {
//            echo "$('#night_sweat').prop('checked', true);";
//        }
//
//        if($weight_loss != '' || $cough != 0)
//        {
//            echo "$('#weight_loss').prop('checked', true);";
//        }

        /*if($my_laboratory)
        {
            foreach ($my_laboratory as $row)
            {
                if($row->laboratory_type_id == 1 && $row->other != '')
                {
                    echo "$('#lab_0').prop('checked', true);";
                    echo "$('#lab_other_specify').attr('readonly', false).val('" . $row->other . "');";
                }
                else
                {
                    echo "$('#lab_" . $row->laboratory_type_id . "').prop('checked', true);";
                }
            }
        }*/

        if($lab)
        {
            foreach ($lab as $key => $value)
            {
                echo "$('#lab_" . $key . "').prop('checked', true);";

                if($key == 0)
                {
                    echo '$("#lab_other_specify").attr(\'readonly\', false).val(\'' . $lab_other_specify . '\');';
                }
            }
        }

        echo "$('input:radio[name=\"patient_type\"]').filter('[value=\"". $patient_type ."\"]').prop('checked', true);";

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

        if(Session::has('checkup.arv_regimen'))
        {
            echo 'prescriptions();';
        }
        ?>

        $('#other').attr('readonly',true);

		$('#add_arv').click(function(){
			$('#specified_medicine').prop('readonly',false);
		});

		$('#lab_other').change(function(){
			if($(this).is(':checked') == true)
			{
				$('#other').prop('readonly', false).focus();
			}else
			{
				$('#other').prop('readonly', true);
			}
		});

		$('#others_status').change(function()
		{
			if($(this).is(':checked') == true)
			{
				$('#others_referral').prop('readonly', false);
			}
			else
			{
				$("#others_referral").prop('readonly', true);
				$("#others_referral").val('');
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


		var xhr_search_medicine = null;
		$(function(){
			$("#search_medicine").autocomplete({
				source: function (request, response)
				{
					xhr_search_medicine = $.ajax({
						type : 'get',
						url : $("#search_item_url").val(),
						data : 'search=' + request.term,
						cache : false,
						dataType : "json",
						beforeSend: function(xhr)
						{
							if (xhr_search_medicine != null)
							{
								xhr_search_medicine.abort();
							}
						}
					}).done(function(data)
					{
						response($.map( data, function(value, key)
						{
							return { label: value, value: key }
						}));

					}).fail(function(jqXHR, textStatus)
					{
						//console.log('Request failed: ' + textStatus);
					});
				},
				minLength: 2,
				autoFocus: true,
				appendTo: "#arvRegimenModal",
				select: function(a, b)
				{
					var id = b.item.value;
					var medicine_name = b.item.label;

					$('#medicine_id').val(id);
					$('#search_medicine').val(medicine_name).focus();
					return false;
				}
			});
		});

		$(function(){
			$('#lab_0').change(function(){

				var value = $(this).is(':checked');

				if(value == true)
				{
					$('#lab_other_specify').attr('readonly', false).focus();
				}
				else
				{
					$('#lab_other_specify').attr('readonly', true).focus();
				}

			});
		});

		//	scripts
		$(function(){
			$('#prescription_reason').change(function(){

				var value = $(this).val();

				if(value == 6 || value == 7)
				{
					$('#prescription_specify').attr('readonly', false).focus();
				}
				else
				{
					$('#prescription_specify').attr('readonly', true);
				}

			});
		});

		$(function(){
			$('#search_medicine').change(function(){

				var value = $(this).val();

				if(value != '')
				{
					$('#specified_medicine').val('').attr('readonly', true);
				}
				else
				{
					$('#specified_medicine').attr('readonly', false).focus();
				}

			});
		});

		$(function(){
			$('#specified_medicine').change(function(){

				var value = $(this).val();

				if(value != '')
				{
					$('#search_medicine').val('');
					$('#medicine_id').val('');
				}

			});
		});

		var xhr_arv_regimen_form = null;
		$(function(){
			$('#arv_regimen_form').submit(function(e){
				xhr_arv_regimen_form = $.ajax({
					url : $(this).attr('action'),
					data : $(this).serialize(),
					type: $(this).attr('method'),
					cache : false,
					dataType : "json",
					beforeSend: function(xhr)
					{
						if (xhr_arv_regimen_form != null)
						{
							xhr_arv_regimen_form.abort();
						}
					}
				}).done(function(data)
				{
					if(data.status == 0){
						alert(data.message)
					}else{
						alert(data.message)
						prescriptions();
					}
				}).fail(function(jqXHR, textStatus)
				{
					console.log('Request failed: ' + textStatus);
				});

				e.preventDefault();
			});

			$('#oi_form').submit(function(e){
				xhr_arv_regimen_form = $.ajax({
					url : $(this).attr('action'),
					data : $(this).serialize(),
					type: $(this).attr('method'),
					cache : false,
					dataType : "json",
					beforeSend: function(xhr)
					{
						if (xhr_arv_regimen_form != null)
						{
							xhr_arv_regimen_form.abort();
						}
					}
				}).done(function(data)
				{
					if(data.status == 0){
						alert(data.message)
					}else{
						alert(data.message)
						oi_medicine();
					}

				}).fail(function(jqXHR, textStatus)
				{
					console.log('Request failed: ' + textStatus);
				});

				e.preventDefault();
			});

			$('#other_med_form').submit(function(e){
				xhr_arv_regimen_form = $.ajax({
					url : $(this).attr('action'),
					data : $(this).serialize(),
					type: $(this).attr('method'),
					cache : false,
					dataType : "json",
					beforeSend: function(xhr)
					{
						if (xhr_arv_regimen_form != null)
						{
							xhr_arv_regimen_form.abort();
						}
					}
				}).done(function(data)
				{
					if(data.status == 0){
						alert(data.message)
					}else{
						alert(data.message)
						other_medicine();
					}

				}).fail(function(jqXHR, textStatus)
				{
					console.log('Request failed: ' + textStatus);
				});

				e.preventDefault();
			});
		});

		var xhr_prescriptions_remove = null;
		function prescriptions_remove(key)
		{
			xhr_prescriptions_remove = $.ajax({
				type : 'get',
				url : '<?php echo route("checkup_destroy_session") ?>/' + key,
				cache : false,
				dataType : "json",
				beforeSend: function(xhr)
				{
					if (xhr_prescriptions_remove != null)
					{
						xhr_prescriptions_remove.abort();
					}
				}
			}).done(function(data)
			{
				//				$('#prescriptions tbody').html(data);
			}).fail(function(jqXHR, textStatus)
			{
				console.log('Request failed: ' + textStatus);
			});
		}



		var xhr_prescriptions = null;
		function prescriptions()
		{
			xhr_prescriptions = $.ajax({
				type : 'get',
				url : '<?php echo route("checkup_list_session") ?>',
				cache : false,
				dataType : "json",
				beforeSend: function(xhr)
				{
					if (xhr_prescriptions != null)
					{
						xhr_prescriptions.abort();
					}
				}
			}).done(function(data)
			{
				var html = '';
				if(data.status == 1){
					$.each(data.results, function(key, r) {
						//						console.log(r.name);
						html+= '<tr>';
						html+= '<td><a href="#prescriptions" class="remove" title="Remove" data-idkey="' + r.key + '"><i class="fa fa-lg fa-times"></i></a>&nbsp;'
								+'<a href="javascript:;" onclick="" title="Edit Perscription" class="edit_reveal" data-ptype="arv" data-key="' + r.key + '"><i class="fa fa-edit fa-lg"></i></a>'
								+'</td>'
//						html+= '<td>' + r.infection + '</td>'
						html+= '<td>' + r.name + '</td>'
						html+= '<td class="text-center" id="col-pills_per_day">' + r.qty + '</td>'
						html+= '<td class="text-center" id="col-pills_per_day">' + r.date_started + '</td>'
						html+= '</tr>';
						html+= '<tr><td></td><td colspan="5">'
						html+= '<table width="100%">'
								+'<tr><th width="30%">Pill</th><th width="40%">Symptoms</th><th width="30%">Monitoring</th></tr>';
						$.each(r.medicine_data, function(mkey, m) {
							html+= '<tr><td>' + m.key + '</td><td>' + m.symptom + '</td><td>' + m.monitoring + '</td></tr>';
						});
						html+= '</table>'

						html+= '</tr></td>'
					});
				}
				$('#prescriptions tbody').html(html);
				prescription_click();
				removeItem();
				// $(document).foundation();


			}).fail(function(jqXHR, textStatus)
			{
				console.log('Request failed: ' + textStatus);
			});
		}


		var xhr_oi_medicine = null;
		function oi_medicine()
		{
			xhr_prescriptions = $.ajax({
				type : 'get',
				url : '<?php echo route("checkup_oi_meds_session") ?>',
				cache : false,
				dataType : "json",
				beforeSend: function(xhr)
				{
					if (xhr_oi_medicine != null)
					{
						xhr_oi_medicine.abort();
					}
				}
			}).done(function(data)
			{
				var html = '';
				if(data.status == 1){
					$.each(data.results, function(key, r) {
						html+= '<tr>';
						html+= '<td>';
						html+= '<a href="javascript:;" onclick="" title="Edit OI" class="edit_reveal" data-ptype="oi" data-key="' + r.key + '"><i class="fa fa-edit fa-lg"></i></a>';
						html+= '&nbsp;<a href="#prescriptions" title="Remove" class="remove" data-idkey="' + r.key + '"><i class="fa fa-lg fa-times"></i></a>';
						html+= '</td>';
						html+= '<td>' + r.name + '</td>';
						html+= '<td>' + r.qty + '</td>';
						html+= '<td>' + r.dosage + '</td>';
						html+= '</tr>';
					});
				}
				$('#oi_medicine').html(html);
				prescription_click();
				removeItem();
			}).fail(function(jqXHR, textStatus)
			{
				console.log('Request failed: ' + textStatus);
			});
		}

		var xhr_other_medicine = null;
		function other_medicine()
		{
			xhr_prescriptions = $.ajax({
				type : 'get',
				url : '<?php echo route("checkup_other_meds_session") ?>',
				cache : false,
				dataType : "json",
				beforeSend: function(xhr)
				{
					if (xhr_other_medicine != null)
					{
						xhr_other_medicine.abort();
					}
				}
			}).done(function(data)
			{
				var html = '';
				if(data.status == 1){
					$.each(data.results, function(key, r) {
						html+= '<tr>';
						html+= '<td>';
						html+= '<a href="javascript:;" onclick="" title="Edit OI" class="edit_reveal" data-ptype="oi" data-key="' + r.key + '"><i class="fa fa-edit fa-lg"></i></a>';
						html+= '&nbsp;<a href="#prescriptions" title="Remove" class="remove" data-idkey="' + r.key + '"><i class="fa fa-lg fa-times"></i></a>';
						html+= '</td>';
						html+= '<td>' + r.name + '</td>';
						html+= '<td>' + r.qty + '</td>';
						html+= '<td>' + r.dosage + '</td>';
						html+= '</tr>';
					});
				}
				$('#other_medicine').html(html);
				prescription_click();
				removeItem();

			}).fail(function(jqXHR, textStatus)
			{
				console.log('Request failed: ' + textStatus);
			});
		}

		function prescription_click(){
			$('.edit_reveal').click(function(e){
				var obj = $(this);

				//console.log("this should log");
				$.ajax({
					type : 'get',
					url : '<?php echo route("checkup_edit_session") ?>',
					data: { key:  obj.data('key')},
					cache : false,
					dataType : "json",
					beforeSend: function(xhr)
					{
						if (xhr_prescriptions != null)
						{
							xhr_prescriptions.abort();
						}
					}
				}).done(function(data)
				{

					if(data.status == 1){
						if(obj.data('ptype') == 'arv') {
							$('#arv_regimen_form #ses_key').val(obj.data('key'));
							$('#arv_regimen_form #infection option[value="'+data.results.infection+'"]').prop('selected', true);
							$('#arv_regimen_form #pills_per_day').val(data.results.qty);
							$('#arv_regimen_form #search_medicine').val(data.results.search_medicine);
							$('#arv_regimen_form #specified_medicine').val(data.results.specified_medicine)
							$('#arv_regimen_form #pills_missed_in_30_days').val(data.results.pills_missed_in_30_days);
							$('#arv_regimen_form #pills_left').val(data.results.pills_left);
							$('#arv_regimen_form #date_started').val(data.results.date_started);
							$('#arv_regimen_form #medicine_id').val(data.results.medicine_id);
							if(data.date_discontinued != null ){
								$('#arv_regimen_form #date_discontinued').val(data.results.date_discontinued);
							}


							$('#arv_regimen_form #prescription_reason option[value="'+data.results.reason+'"]').prop('selected', true);
							$('#add_arv').text('Update');
							$('#arv_regimen_form').attr('action', "{{ route('checkup_update_session') }}");
							$('#arvRegimenModal').foundation('reveal', 'open');

							$('#arvRegimenModal').on('close.fndtn.reveal', '[data-reveal]', function () {
								var modal = $(this);
								$("#arv_regimen_form").trigger('reset')
							});
						}else if(obj.data('ptype') == 'oi'){
							$('#oiModal #ses_key').val(obj.data('key'));
							$('#oiModal #specified_medicine').val(data.results.specified_medicine);
							$('#oiModal #suggested_dosage').val(data.results.suggested_dosage);
							$('#oiModal #date_started').val(data.results.date_started);
							$('#oiModal #pills_per_day').val(data.results.qty);
							$('#add_oi').text('Update');
							$('#oi_form').attr('action', "{{ route('checkup_update_session') }}");
							$('#oiModal').foundation('reveal', 'open');
							$('#oiModal').on('close.fndtn.reveal', '[data-reveal]', function () {
								var modal = $(this);
								$("#oi_form").trigger('reset')
							});
						}else if(obj.data('ptype') == 'others'){
							$('#otherMedModal #ses_key').val(obj.data('key'));
							$('#otherMedModal #specified_medicine').val(data.results.specified_medicine);
							$('#otherMedModal #suggested_dosage').val(data.results.suggested_dosage);
							$('#otherMedModal #date_started').val(data.results.date_started);
							$('#otherMedModal #pills_per_day').val(data.results.qty);

							$('#add_other').text('Update');
							$('#other_med_form').attr('action', "{{ route('checkup_update_session') }}");
							$('#otherMedModal').foundation('reveal', 'open');
							$('#otherMedModal').on('close.fndtn.reveal', '[data-reveal]', function () {
								var modal = $(this);
								$("#other_med_form").trigger('reset')
							});
						}
					}
				});

			});
		}

		function removeItem(){

			$('.remove').on('click',function(e){
				var obj = $(this);
				prescriptions_remove(obj.data('idkey'));
				obj.parent().parent().fadeOut(function(){
					obj.parent().parent().remove();
				})
			})
		}
		prescriptions();
		oi_medicine();
		other_medicine();
	</script>
	<script>

		$('#search_patient').attr('readonly',true);
		<?php
            if(is_array($infections))
            {
                //$row_num = 1;
                for($x=0;$x<=4; $x++)
                {
                    if(isset($infections[$x]))
                    {
                        foreach($infections[$x] as $column)
                        { ?>
                            $('#infection<?php echo $x; ?>_<?php echo $column; ?>').prop('checked', true);

		<?php
				}
				}
				}
				}

		if($stis)
		{
			echo "$('input[name=stis]').attr('disabled',false).prop('required','true');" ;
			echo "$('input[name=stis_checkbox]').prop('checked',true);" ;
		}
		else
		{
			echo "$('input[name=stis]').attr('disabled',true);" ;
			echo "$('input[name=stis_checkbox]').prop('checked',false);" ;
		}

		if($others)
		{
			echo "$('input[name=others]').attr('disabled',false).prop('required','true');" ;
			echo "$('input[name=others_checkbox]').prop('checked',true);" ;
		}
		else
		{
			echo "$('input[name=others]').attr('disabled',true);" ;
			echo "$('input[name=others_checkbox]').prop('checked',false);" ;
		}

		if($hepatitis_b)
		{
			echo "$('input[name=hepatitis_b]').prop('checked',true);" ;
		}
		else
		{
			echo "$('input[name=hepatitis_b]').prop('checked',false);" ;
		}

		if($hepatitis_c)
		{
			echo "$('input[name=hepatitis_c]').prop('checked',true);" ;
		}
		else
		{
			echo "$('input[name=hepatitis_c]').prop('checked',false);" ;
		}

		if($syphilis)
		{
			echo "$('input[name=syphilis]').prop('checked',true);" ;
		}
		else
		{
			echo "$('input[name=syphilis]').prop('checked',false);" ;
		}

		if($pneumocystis_pneumonia)
		{
			echo "$('input[name=pneumocystis_pneumonia]').prop('checked',true);" ;
		}
		else
		{
			echo "$('input[name=pneumocystis_pneumonia]').prop('checked',false);" ;
		}

		if($orpharyngeal_candidiasis)
		{
			echo "$('input[name=orpharyngeal_candidiasis]').prop('checked',true);" ;
		}
		else
		{
			echo "$('input[name=orpharyngeal_candidiasis]').prop('checked',false);" ;
		}

		?>

		$(function()
		{
			$('#order_number').change(function()
			{
				$("#dd_patient_id").val({{ $patient_id }});
				$("#dd_order_number").val($('#order_number').val());
				{{--if($("#dd_order_number").val()=={{ @$next_order_number }})--}}
				{{--{--}}
				{{--window.location.replace("{{ route('infections_create',$patient_id) }}");--}}
				{{--}--}}
				{{--else--}}
				{{--{--}}
				{{--$("#dropdown").submit();--}}
				{{--}--}}
			});

		});


		$(function(){
			$('#stis_checkbox').click(function()
			{
				if($(this).is(':checked'))
				{
					$('input[name=stis]').prop('required',true).attr('disabled',false);
				}
				else
				{
					$('input[name=stis]').prop('required',false).attr('disabled',true);
					$('input[name=stis]').val('');
				}
			});

			$('#others_checkbox').click(function(){
				if($(this).is(':checked'))
				{
					$('input[name=others]').prop('required',true).attr('disabled',false);
				}
				else
				{
					$('input[name=others]').prop('required',false).attr('disabled',true);
					$('input[name=others]').val('');
				}
			});

		});

		$(function(){
			$(".infection").change(function()
			{
				clinical_stage();
			});
		});

		function clinical_stage()
		{
			if($(".in_4").is(":checked"))
			{
				$("#clinical_stage").val(4);
			}
			else if($(".in_3").is(":checked"))
			{
				$("#clinical_stage").val(3);
			}
			else if($(".in_2").is(":checked"))
			{
				$("#clinical_stage").val(2);
			}
			else if($(".in_1").is(":checked"))
			{
				$("#clinical_stage").val(1);
			}
			else
			{
				$("#clinical_stage").val('');
			}
		}
	</script>
@endsection
@extends('hact.layouts.layout_admin')

@section('content')
<div class='row'>
	<div class='large-12 columns'>
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('patient') }}">Patient</a></li>
			<li><a href="{{ route('patient_profile',$patient_id) }}">{{ $search_patient }}</a></li>
			<li><a href="{{ route('patient_profile',$patient_id) . "#tab6" }}">Tuberculosis</a></li>
			<li class="current"><a href="#">{{ $action_name }}</a></li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="large-12 column">
		@include("hact.messages.success")
		@if(count($errors) > 0)
			<div class="alert-box alert ">Error: Highlight fields are required!</div>
		@endif
		{{--@include("hact.messages.error_list")--}}
	</div>
</div>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<div class="custom-panel-heading">
			<span>{{ $action_name }} Tuberculosis</span>
			<a href="{{ route('patient_profile',$patient_id) }}" class="alert tiny button right" title="Tuberculosis"><i class="fi fi-x"></i> Cancel</a>
		</div>
		<div class="custom-panel-details">
			<form method="post" action=" {{ $action }}">
				<fieldset>
					<div class="row">
						<div class="large-4 columns">
							<label for="search_patient">Patient</label>
							<div class="row collapse">
								<div class="small-10 columns">
									<input type="text" id="search_patient" name="search_patient" value="{{ $search_patient }}" readonly/>
									<input type="hidden" id="search_patient_url" name="search_patient_url" value="" />
									<input type="hidden" id="patient_id" name="patient_id" value="{{ $patient_id }}" />
								</div>
								<div class="small-2 columns">
									<span class="postfix"><i class="fa fa-search"></i></span>
								</div>
							</div>
						</div>
						<div class="large-8 columns">
							<input type="hidden" name="order_number" value="{{ $next_order_number }}">
							<label for="date_started">Date Started</label>
							<input type="text" name="date_started" id="date_started" value="{{ $date_started or '' }}" class="fdatepicker {{ ($errors->has('date_started')) ? 'highlight_error' : '' }}" placeholder="Date Started" readonly>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>TB Information</legend>
					<div class="row ">
						<div class="large-12 columns">
							<div class="row">

								<div class="large-7 columns"><label>Presence of at least one of the following: weight loss, cough, night sweats, fever?</label></div>
								<div class="large-5 columns">
									<div class="row">
										@if($errors->has('presence'))
										<div class="highlight_error">
										@endif
											<div class="large-4 columns">
												<label><input type="radio" name="presence" value="1" {{ ($presence == 1)? 'checked="checked"' : ''}}/>&nbsp;Yes</label>
											</div>
											<div class="large-4 columns">
												<label><input type="radio" name="presence" value="2" {{ ($presence == 2)? 'checked="checked"' : ''}}/>&nbsp;No</label>
											</div>
										@if($errors->has('presence'))
										<div class="clearfix"></div>
										</div>
										@endif
										<div class=" large-4 columns"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="large-2 columns">
							<label class="inline">TB Status:</label>
						</div>
						<div class="large-4 columns">
							<label>
								<select id="tb_status" name="tb_status" class="{{ ($errors->has('tb_status')) ? 'highlight_error' : '' }}" onchange="tbStatus(this);">
									<option value="" selected="selected">--Select Status--</option>
									<option value="2" {{ ($tb_status == 2)? 'selected="selected"' :'' }}>With Active TB</option>
									<option value="1" {{ ($tb_status == 1)? 'selected="selected"' :'' }} >No Active TB</option>
								</select>
							</label>
						</div>
						<div class="large-6 columns">
							&nbsp;
						</div>
					</div>
					<div class="row" style="display:none" id="on_ipt">
						<div class="large-2 columns">
							<label class="inline">On IPT?</label>
						</div>
						<div class="large-4 columns">
							<div class="row">
								@if($errors->has('on_ipt'))
									<div class="highlight_error">
								@endif
								<div class="large-2 columns">
									<label class="inline">
										<input type="radio" class="no_tb" name="on_ipt" id= "yes" value="1" {{ ($on_ipt == 1)? 'checked="checked"' : '' }} />&nbsp;Yes
									</label>
								</div>
								<div class="large-2 columns">
									<label class="inline">
										<input type="radio" class="no_tb" name="on_ipt" id="no" value="2" {{ ($on_ipt == 2)? 'checked="checked"' : '' }} />&nbsp;No
									</label>
								</div>
								<div class="large-10 columns">
									&nbsp;
								</div>
								@if($errors->has('on_ipt'))
								<div class="clearfix"></div>
								</div>
								@endif
							</div>
						</div>
						<div class="large-6 columns"></div>
					</div>
					<div class="row" style="display:none" id="ipt_outcome">
						<div class="large-2 columns">
							<label class="inline">IPT Outcome?</label>
						</div>
						<div class="large-4 columns">
							<label>
								<select name="ipt_outcome" class="no_tb {{ ($errors->has('ipt_outcome')) ? 'highlight_error' : '' }}" id="ipt_outcome_id" onchange="ipt_outcome_isother(this);">
									<option value="" selected="selected">--Select IPT Outcome--</option>
									<option value="1" {{ ($ipt_outcome == 1)? 'selected="selected"' : '' }} >Completed</option>
									<option value="2" {{ ($ipt_outcome == 2)? 'selected="selected"' : '' }}>Failed</option>
									<option value="4" {{ ($tx_outcome == 4)? 'selected="selected"' : ''}}>Ongoing</option>
									<option value="3" {{ ($ipt_outcome == 3)? 'selected="selected"' : '' }}>Other</option>
								</select>
							</label>
						</div>
						<div class="large-2 columns">
							<label class="inline" id="ipt_outcome_specify" style="display:{{ ($ipt_outcome == 3)? 'block' : 'none' }}">Please Specify:</label>
						</div>
						<div class="large-4 columns">
							<input type="text" class="no_tb {{ ($errors->has('ipt_outcome_other')) ? 'highlight_error' : '' }}" id="ipt_outcome_specify_input" style="display:{{ ($ipt_outcome == 3)? 'block' : 'none' }}" name="ipt_outcome_other" value="{{ $ipt_outcome_other }}">
						</div>
					</div>
					<div class="row" style="display:none" id="site">
						<div class="large-2 columns">
							<label class="inline">Site:</label>
						</div>
						<div class="large-4 columns {{ ($errors->has('site')) ? 'highlight_error' : '' }}">
							<div class="large-6 columns">
								<label class="inline">
									<input onchange="if_extrapulmonary(this);" type="radio" name="site" id="pulmonary" value="1" {{ ($site == 1)? 'checked="checked"': ''}} /> Pulmonary
								</label>
							</div>
							<div class="large-6 columns">
								<label class="inline">
									<input onchange="if_extrapulmonary(this);" type="radio" name="site" id="extrapulmonary" value="2" {{ ($site == 2)? 'checked="checked"' : '' }} /> Extrapulmonary
								</label>
							</div>
						</div>
						<div class="large-2 columns">
							<label class="inline" id="site_of_infection" style="display:{{ ($site == 2)? 'block' : 'none' }}">Site of infection</label>
						</div>
						<div class="large-4 columns">
							<label class="inline">
								<input type="text" id="site_of_infection_field"  class="{{ ($errors->has('site_extrapulmonary')) ? 'highlight_error' : '' }}" style="display:{{ ($site == 2)? 'block' : 'none' }}" name="site_extrapulmonary"  id="site_extrapulmonary" value="{{ $site_extrapulmonary }}"/>
							</label>
						</div>
					</div>
					<div class="row" style="display:none" id="drug_resistance">
						<div class="large-2 columns">
							<label class="inline">Drug Resistance:</label>
						</div>
						<div class="large-4 columns">
							<label>
								<select class="{{ ($errors->has('drug_resistance')) ? 'highlight_error' : '' }}" name="drug_resistance" id="drug_resistance" onchange="if_other_drug_resistance(this);">
									<option value="" selected="selected">--Please Select--</option>
									<option value="1" {{ ($drug_resistance == 1)? 'selected="selected"' : ''}} >Susceptible</option>
									<option value="2" {{ ($drug_resistance == 2)? 'selected="selected"' : ''}} >XDR</option>
									<option value="3" {{ ($drug_resistance == 3)? 'selected="selected"' : ''}}>MDR/RR</option>
									<option value="4" {{ ($drug_resistance == 4)? 'selected="selected"' : ''}}>Other</option>
								</select>
							</label>
						</div>
						<div class="large-2 columns">
							<label class="inline" id="please_specify" style="display:{{ ($drug_resistance == 4)? 'block' : 'none' }}">Please Specify:</label>
						</div>
						<div class="large-4 columns">
							<input type="text" class="{{ ($errors->has('drug_resistance_other')) ? 'highlight_error' : '' }}" name="drug_resistance_other" id="please_specify_input" style="display:{{ ($drug_resistance == 4)? 'block' : 'none' }}" value="{{ $drug_resistance_other }}">
						</div>
					</div>
					<div class="row" style="display:none" id="current_tb_regimen">
						<div class="large-2 column">
							<label>Current TB Regimen:</label>
						</div>
						<div class="large-4 column">
							<label>
								<select class="{{ ($errors->has('current_tb_regimen')) ? 'highlight_error' : '' }}" name="current_tb_regimen">
									<option value="" selected="selected">--Please Select--</option>
									<option value="1" {{ ($current_tb_regimen == 1)? 'selected="selected"' : ''}}>Category I</option>
									<option value="2" {{ ($current_tb_regimen == 2)? 'selected="selected"' : ''}}>Category Ia</option>
									<option value="3" {{ ($current_tb_regimen == 3)? 'selected="selected"' : ''}}>Category II</option>
									<option value="4" {{ ($current_tb_regimen == 4)? 'selected="selected"' : ''}}>Category IIa</option>
									<option value="5" {{ ($current_tb_regimen == 5)? 'selected="selected"' : ''}}>SRDR</option>
									<option value="6" {{ ($current_tb_regimen == 6)? 'selected="selected"' : ''}}>XDR-TB regimen</option>
								</select>
							</label>
						</div>
						<div class="large-6 column">
						</div>
					</div>
				</br>
					<div class="row" style="display:none" id="tx_outcome">
						<div class="large-2 column">
							<label class="inline">Tx outcome:</label>
						</div>
						<div class="large-4 column">
							<label>
								<select  class="{{ ($errors->has('tx_outcome')) ? 'highlight_error' : '' }}"  name="tx_outcome" id="tx_outcome" onchange="tx_outcome_is(this);">
									<option value="" selected="selected">--Please Select--</option>
									<option value="1" {{ ($tx_outcome == 1)? 'selected="selected"' : ''}} >Cured</option>
									<option value="2" {{ ($tx_outcome == 2)? 'selected="selected"' : ''}}>Failed</option>
									<option value="5" {{ ($tx_outcome == 5)? 'selected="selected"' : ''}}>Ongoing</option>
									<option value="3" {{ ($tx_outcome == 3)? 'selected="selected"' : ''}}>Completed</option>
									<option value="4" {{ ($tx_outcome == 4)? 'selected="selected"' : ''}}>Other</option>
								</select>
							</label>
						</div>
						<div class="large-2 columns">
							<label class="inline" id="tx_facility">Tx Facility:</label>
						</div>
						<div class="large-4 columns">
							<input class="{{ ($errors->has('tx_facility')) ? 'highlight_error' : '' }}" type="text" name="tx_facility" id="tx_facility" value="{{ $tx_facility }}">
						</div>

					</div>
					<div class="row" id="tx_date_outcome_row" style="display:none">
						<div class="large-6 columns">&nbsp;</div>
						<div class="large-2 columns">
							<label class="inline">Tx Date:</label>
						</div>
						<div class="large-4 columns">
							<input type="text" class=" fdatepicker {{ ($errors->has('tx_date_outcome')) ? 'highlight_error' : '' }}" name="tx_date_outcome" value="{{ $tx_date_outcome }}" class="fdatepicker" placeholder="Date Started" readonly>
						</div>
					</div>
					<div class="row" id="tx_other_row" style="display:none">
						<div class="large-6 columns">&nbsp;</div>
						<div class="large-2 columns">
							<label class="inline">Please Specify:</label>
							<label class="inline">Please Specify:</label>
						</div>
						<div class="large-4 columns">
							<input type="text"  class="{{ ($errors->has('tx_outcome_other')) ? 'highlight_error' : '' }}" name="tx_outcome_other" value="{{ $tx_outcome_other}}">
						</div>
					</div>
				</fieldset><br>
				<div class="row">
					<div class="medium-12 columns">
						<div class="right">
							{!! csrf_field() !!}
							<button class="button success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
							<a href="{{ route('patient_profile', $patient_id) }}" class="button alert" title="Cancel"><i class="fi fi-x"></i> Cancel</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

</div>

<script type="text/javascript">
// TB Status selected

{!! ($tb_status > 0)? '$("#tb_status").trigger("change"); ' : '' !!}
{!! ($ipt_outcome == 3)? '$("select#ipt_outcome").trigger("change"); ' : '' !!}
{!! ($drug_resistance == 4)? '$("select#drug_resistance").trigger("change"); ' : '' !!}
{!! ($tx_outcome == 1)? '$("select#tx_outcome").trigger("change"); ' : '' !!}
{!! ($tx_outcome == 3)? '$("select#tx_outcome").trigger("change"); ' : '' !!}
{!! ($tx_outcome == 4)? '$("select#tx_outcome").trigger("change"); ' : '' !!}
{!! ($site == 2)? '$("#extrapulmonary").trigger("change"); ' : '$("#pulmonary").trigger("change");' !!}

$(function()
{
	$('#order_number').change(function()
	{
		window.location.assign($('option:selected', this).attr('data-url'));
	});
});


function tbStatus(that){
	if (that.value == "1"){
		document.getElementById("on_ipt").style.display="block";
		document.getElementById("ipt_outcome").style.display="block";
		document.getElementById("site").style.display="none";
		document.getElementById("drug_resistance").style.display="none";
		document.getElementById("current_tb_regimen").style.display="none";
		document.getElementById("tx_outcome").style.display="none";
		$(".site_infection").css({'visibility':'hidden'});
	}
	else if (that.value == "2"){
		document.getElementById("on_ipt").style.display="none";
		document.getElementById("ipt_outcome").style.display="none";
		document.getElementById("site").style.display="block";
		document.getElementById("drug_resistance").style.display="block";
		document.getElementById("current_tb_regimen").style.display="block";
		document.getElementById("tx_outcome").style.display="block";
		$(".site_infection").css({'visibility':'hidden'});
	}
	else{
		document.getElementById("on_ipt").style.display="none";
		document.getElementById("ipt_outcome").style.display="none";
		document.getElementById("site").style.display="none";
		document.getElementById("drug_resistance").style.display="none";
		document.getElementById("current_tb_regimen").style.display="none";
		document.getElementById("tx_outcome").style.display="none";
		$(".site_infection").css({'visibility':'hidden'});
	}
}

function if_other_drug_resistance(that){
	if (that.value == "4"){
		document.getElementById("please_specify_input").style.display="block";
		document.getElementById("please_specify").style.display="block";
	}
	else{
		document.getElementById("please_specify_input").style.display="none";
		document.getElementById("please_specify").style.display="none";
	}
}

function tx_outcome_is(that){
	if (that.value == 4)
	{
		document.getElementById("tx_other_row").style.display="block";
	}
	else if( that.value == 1 || that.value == 3)
	{
		document.getElementById("tx_date_outcome_row").style.display="block";
	}
	else
	{
		document.getElementById("tx_date_outcome_row").style.display="none";
		document.getElementById("tx_other_row").style.display="none";
	}
}

function ipt_outcome_isother(that){
	if (that.value == "3"){
		document.getElementById("ipt_outcome_specify").style.display="block";
		document.getElementById("ipt_outcome_specify_input").style.display="block";
	}
	else{
		document.getElementById("ipt_outcome_specify").style.display="none";
		document.getElementById("ipt_outcome_specify_input").style.display="none";
	}
}

function if_extrapulmonary(that){
	if (that.value == "2"){
		document.getElementById("site_of_infection").style.display="block";
		document.getElementById("site_of_infection_field").style.display="block";
	}
	else{
		document.getElementById("site_of_infection").style.display="none";
		document.getElementById("site_of_infection_field").style.display="none";
	}
}

function if_site(that){
	if (that.value == "2"){
		document.getElementById("site_of_infection").style.display="block";
		document.getElementById("site_of_infection_field").style.display="block";
	}
	else{
		document.getElementById("site_of_infection").style.display="none";
		document.getElementById("site_of_infection_field").style.display="none";
	}
}

var update_select = function () {
    $('#ipt_outcome_id').attr('disabled', $('#no').is(':checked'));
};

$(update_select);
$('#no').change(update_select);
$('#yes').change(update_select);

</script>

@endsection

@extends('hact.layouts.layout_admin')
<style>
	ul.f-dropdown{
		z-index: 1;
	}
</style>
<div class="row sticky-search">
	<form>
		<div class="row collapse">
			<div class="small-9 columns">
				<input name="search" type="text" placeholder="Search" value="{{ $search }}">
			</div>
			<div class="small-3 columns">
				<button type="submit" class="button alert postfix"><i class="fa fa-search"></i></button>
			</div>
		</div>
	</form>
</div>
@section('content')
<div class="row">
	<div class="large-7 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li class="current"><a href="javascript:void(0)">Patient</a></li>
		</ul>
	</div>
	<div class="large-5 columns">
		<form>
			<div class="row search-bar">
				<div class="large-12 columns">
					<div class="row collapse">
						<div class="small-9 columns">
							<input name="search" type="text" placeholder="Search" value="{{ $search }}">
						</div>
				    	<div class="small-3 columns">
								<button type="submit" class="button alert postfix"><i class="fa fa-search"></i></button>
				    	</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class='row overflow'>
	<div class='large-12 columns overflow-profile'>
		@include('hact.messages.success')
		@include('hact.messages.error_list')
		<div class="row">
			@if(Auth::user()->access == 1)
			<div class="medium-4 columns"><a href="{{ route('patient_create') }}" class="button small" title="Add New Patient"><i class="fa fa-plus fa-lg"></i> Add New Patient</a></div>
			@endif
			<div class="medium-8 columns">{!! str_replace('/?', '?', $patients->appends($pagination)->render()) !!}</div>
		</div>
		<br/>

		<table width="100%" class="responsive">
			<thead>
				<tr>
					<th width="13%" style="min-width:120px">Action</th>
					<th class="main-column" width="11%" nowrap><a href="{{ $code_name_sort }}">Code Name</a></th>
					<th width="3%"><a href="{{ $birth_date_sort }}">Age</a></th>
					<th width="4%"><a href="{{ $gender_sort }}">Sex</a></th>
					<th width="16%"><a href="{{ $saccl_code_sort }}">SACCL</a></th>
					<th width="20%"><a href="{{ $ui_code_sort }}">UIC</a></th>
					<th width="3%"><a href="javascript:void(0)">Result</a></th>
					<th width="15%"><a href="javascript:void(0)">Physician</a></th>
					<th width="15%"><a href="javascript:void(0)">Transfer Status</a></th>
				</tr>
			</thead>
			<tbody>

			@foreach($patients as $row)
			<tr class="{{ ($row->is_mortality == 0) ? '' : 'mortality' }}">
				<td>
					<button href="javascript:void(0)" data-dropdown="drop{{ $row->id }}" aria-controls="drop1" aria-expanded="false" class="tiny button secondary dropdown">Options</button><br>
					<ul id="drop{{ $row->id }}" data-dropdown-content class="f-dropdown" aria-hidden="true" role="menu" style="min-width:100px">
						<li>
							<a class="dock-icon" href="{{ route('patient_profile', $row->id) . "#tab1" }}" title="View Profile">&nbsp;&nbsp;&nbsp;<i class="fa fa-user fa-lg"></i> View Profile</a>
						</li>
						@if(Auth::user()->access == 1)
							<li><a class="dock-icon" href="{{ route('patient_edit', $row->id) }}" title="Edit Patient"><i class="fa fa-edit fa-lg"></i>  Edit</a></li>
							<li><a data-confirm href="{{ route('patient_destroy', $row->id) }}" title="Delete Patient"><i class="fa fa-times fa-lg"></i> Delete</a></li>
							@if($row->last_vct_record)
								<li><a class="dock-icon" href="javascript:void(0)" title="Patient’s Results" onclick="VCTResultSettings('{{ $row->last_vct_record->id }}', '{{ $row->id }}', '{{ $row->last_vct_record->result }}', '{{ $row->saccl_code }}','{{ $row->ConfirmatoryDate->confirmatory_date_format or '' }}')"><i class="fa fa-calendar-check-o fa-lg"></i> HIV Result</a></li>
								@if($row->last_vct_record->result == 2)
									<li><a class="dock-icon" href="{{ route('vct_doctor', $row->id) }}" title="Attending Physician"><i class="fa fa-user-md fa-lg"></i>  Attending Physicians</a></li>
								@endif
							@endif
							<li>
								<a class="dock-icon" href="javascript:void(0)" data-reveal-id="modal{{ $row->id }}" title="Transfer Status">
									<i class="fa fa-sign-in fa-lg"></i> Transfer Status
								</a>
							</li>
						@endif
					</ul>

					{{-------------------------- Modal for Transfer Status ---------------------------------------}}
					<div style = "text-align:center" id="modal{{ $row->id }}" class="reveal-modal tiny" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
						<h4 id="modalTitle">Transfer Status</h4>
						<form action="{{ route('patient_transfer') }}" method="post">
							<div class="row">
								<div class="large-12 columns">
									<label for="transfer">Current Status:</label>
									<label> {{ $row->PatientTransfer->transfer_format_2 or "None"  }}</label>
									<br/>
									<select name="transfer" id="transfer" class="transfer" required>
										<option value="" selected disabled>Assign Transfer Status</option>
										<option value="0"></option>
										<option value="1">Transferred In</option>
										<option value="2">Transferred Out</option>
									</select>
								</div>
							</div>
							<br/>
							<div class="row">
								<div class="large-12 columns">
									<div class="transfer_date">
										<label for="transfer_date">Transferred Out Date:</label>
										<input type="text" id="transfer_date" name="transfer_date" class="fdatepicker" readonly>
									</div>
								</div>
							</div>
							<br/>
							<div class="row">
								<div class="large-4 columns">
									{!! csrf_field() !!}
									<input type="hidden" id="patient_id" name="patient_id" value="{{ $row->id }}"/>
									<button type="submit" class="button expand">Submit</button>
								</div>
							</div>
						</form>
						<a class="close-reveal-modal" aria-label="Close">&#215;</a>
					</div>
					{{---------------------------------------------------------------------------------------------}}
				</td>
				</td>
				<td class="main-column">
					{{ $row->code_name }}
					@if($row->Mortality)
						<i class="fi-alert fa-lg" title="Deceased"></i>
					@endif
				</td>
				<td>{{ $row->age }}</td>
				<td>{{ $row->gender_format }}</td>
				<td>{{ $row->saccl_code }}</td>
				<td>{{ $row->ui_code }}</td>
				<td>{{ $row->last_vct_record->result_format or "" }}</td>
				<td>{{ App\User::where('id',$row->last_assigned_doctor)->first()?App\User::where('id',$row->last_assigned_doctor)->first()->name:""  }}
				</td>
				<td>{{ $row->PatientTransfer->transfer_format or "" }}</td>

			</tr>
			@endforeach
			</tbody>
		</table>
		{!! str_replace('/?', '?', $patients->appends($pagination)->render()) !!}
	</div>
</div>

<script>
	$(document).confirmWithReveal({
		body: "This action cannot be undone."
	});
	$('.transfer_date').hide();
	$('.close-reveal-modal').click(function(){
		$('.transfer_date').hide();
	});
	$('.transfer').change(function(){
		if($(this).val()==2)
			{
				$('.transfer_date').show();
			}
			else
			{
				$('.transfer_date').hide();
			}
		}
	);

</script>


<div id="VCTResultSettings" class="reveal-modal tiny" data-reveal aria-labelledby="VCTResultSettings" aria-hidden="true" role="dialog">
	<a class="close-reveal-modal" aria-label="Close">&#215;</a>
	<h4 id="modalTitle">VCT Result</h4>
	<form action="{{ route('vct_result') }}" method="post">
		<div class="row">
			<div class="large-12 columns">
				<label for="result">Result</label>
				<select name="result" id="result" required>
					<option value=""></option>
					<option value="0" class="optionGroup"><strong>Non Reactive</strong></option>
					<optgroup label="Reactive" style="margin-left:3px;">
						<option value="1">Negative</option>
						<option value="2">Positive</option>
						<option value="3">Indeterminate</option>
					</optgroup>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<label for="saccl_code">SACCL Code</label>
				<input type="text" name="saccl_code" id="saccl_code" value="">
			</div>
		</div>
		<div class="confirmatory_date row">
			<div class="large-12 columns">
				<label for="confirmatory_date">Confirmatory Date</label>
				<input type="text" name="confirmatory_date" id="confirmatory_date" class="fdatepicker" value="" readonly>
			</div>
		</div>
		<div class="row">
			<div class="large-4 columns">
				{!! csrf_field() !!}
				<input type="hidden" id="vct_id" name="vct_id" />
				<input type="hidden" id="patient_id" name="patient_id" />
				<button type="submit" class="button expand">Submit</button>
			</div>
		</div>
	</form>
</div>


<script type="text/javascript">
	$(".reveal-modal").on("open", function () {
		$("body").css({'overflow':'hidden'});
	});

	$(".reveal-modal").on("close", function () {
		$("body").css({'overflow': 'scroll'});
	});

	$('#result').change(function(){
		if($(this).val()==2){
			$('.confirmatory_date').show();
		}
		else
		{
			$('.confirmatory_date').hide();
		}
	});

	function VCTResultSettings(vct_id, patient_id, result, saccl_code, confirmatory_date)
	{
		$('#vct_id').val(vct_id);
		$('#patient_id').val(patient_id);

		$('#result').val(result);
		$('#saccl_code').val(saccl_code);

		$('#confirmatory_date').val(confirmatory_date);

		if($('#result').val()==2)
		{
			$('.confirmatory_date').show();
		}
		else
		{
			$('.confirmatory_date').hide();
		}


		$('#VCTResultSettings').foundation('reveal', 'open');
	}

	function DoctorSettings(patient_id, doctor_id)
	{
		var doctor_id = (doctor_id == '' || doctor_id == null)? '' : doctor_id;

		$('#assign_doctor_patient_id').val(patient_id);
		$('#user_id').val(doctor_id);

		$('#DoctorSettings').foundation('reveal', 'open');
	}

</script>


@endsection

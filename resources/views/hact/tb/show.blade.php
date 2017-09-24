@extends('hact.layouts.layout_admin')

@section('content')

<div class="row">
	<div class="large-7 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('patient') }}">Patient</a></li>
			<li><a href="{{ route('patient_profile',$patient_id) }}">{{ $search_patient }}</a></li>
			<li><a href="{{ route('patient_profile',$patient_id) }}">Tuberculosis</a></li>
			<li class="current"><a href="#">{{ $page }}</a></li>
		</ul>
	</div>
	<div class="large-5 columns" style="visibility:hidden;">
		<div class="row collapse">
            <div class="small-10 columns">
                <input type="text" id="search_patient" name="search_patient" value="{{ $search_patient }}" />
                <input type="hidden" id="search_patient_url" name="search_patient_url" value="" />
                <input type="hidden" id="patient_id" name="patient_id" value="{{ $patient_id }}" />
            </div>
            <div class="small-2 columns">
                <span class="postfix"><i class="fa fa-search"></i></span>
            </div>
        </div>
	</div>
</div>

<div class='row'>
	<div class='large-12 columns'>
		@include('hact.messages.success')
		@include('hact.messages.error_list')
		<table width="100%" align="center">
			<thead>
				<tr>
					<th style="width:5%;"><a title="Add Tuberculosis Record" href="{{ route('tuberculosis_create',$patient_id) }}"><i class="fa fa-plus fa-lg"></i></a></th>
					<th style="width:5%;"><a href="#">Symptoms Screening</a></th>
					<th style="width:10%;"><a href="#">TB Status</a></th>
					<th style="width:10%;"><a href="#">Site</a></th>
					<th style="width:15%;"><a href="#">TB Regimen</a></th>
					<th style="width:12%;"><a href="#">Date Started</a></th>
					<th style="width:10%;"><a href="#">IPT</a></th>
					<th style="width:13%;"><a href="#">Drug Resistance</a></th>
					<th style="width:13%;"><a href="#">Tx Outcome</a></th>
					<th style="width:13%;"><a href="#">Tx Facility</a></th>
				</tr>
			</thead>
			<tbody>
				@foreach($tuberculosis as $tb)
				<tr>
					<td><a title="Edit Record" href="{{ route('tuberculosis_edit', [$tb->patient_id, $tb->order_number]) }}"><i class="fa fa-pencil-square-o fa-lg"></i></a></td>
					<td>{{ $tb->presence_format }}</td>
					<td>{{ $tb->tb_status_format }}</td>
					<td>{{ $tb->site_format }} {{ $tb->site_extrapulmonary }}</td>
					<td>{{ $tb->current_tb_regimen_format }}</td>
					<td>{{ $tb->date_started }}</td>
					{{-- <td>{{ $tb->on_ipt }}</td> --}}
					<td>{{ $tb->ipt_outcome_format }} {{ $tb->ipt_outcome_other }}</td>
					<td>{{ $tb->drug_resistance_format }} {{ $tb->drug_resistance_other }}</td>
					<td>{{ $tb->tx_outcome_format }} {{ $tb->tx_outcome_other }}</td>
					<td>{{ $tb->tx_facility_format }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		<style type="text/css">
			table tr th, table tr td{
				text-align: center;
			}
		</style>

		<!-- <table width="100%">
			<thead>
				<tr>
					<th width="100%">
						<a href="{{ route('tuberculosis_create',$patient_id) }}">
              <i class="fa fa-plus fa-lg"></i>
              &nbsp; Tuberculosis Reports
            </a>
					</th>
				</tr>
			</thead>
			<tbody>
					@foreach($tuberculosis as $tb)
						<script>
							$(function(){
								$("a.{{$tb->order_number }}").click(function(){
									if($(this).children("input").val()==0)
									{
										$(this).children("input").val(1);
										$(this).children("i").attr("class","fa fa fa-caret-down");
										$(this).attr("title","Hide Tuberculosis Tests");
									}
									else if($(this).children("input").val()==1)
									{
										$(this).children("input").val(0);
										$(this).children("i").attr("class","fa fa-caret-right");
										$(this).attr("title","Collapse Tuberculosis Tests");
									}
									$("tr.{{$tb->order_number }}").toggle();
								});
							})
						</script>
						<tr>
							<td>
								<h6>
									&nbsp;
									<a href="{{ route('tuberculosis_edit', [$tb->patient_id, $tb->order_number]) }}" title="Edit Tuberculosis">
										<i class="fa fa-edit fa-lg"></i>
									</a>
									&nbsp;
									<a title="Collapse Tuberculosis Tests" class="{{ $tb->order_number }}" href="#">
										<input type="hidden" value="0">
										{{ $tb->order_number_format }}
										&nbsp;<i class="fa fa-caret-right"></i>
									</a>
								</h6>
							</td>
						</tr>
						<tr class="{{ $tb->order_number }} collapse_lab_test">
							<td>
								<table style="width:100%;">
									<tbody>
										<tr style="border:1px solid #dddddd;">
											<td style="width:70%; background:#eee;">Presence of at least one of the following: weight loss, cough, night sweats, fever?</td>
											<td style="width:10%;">{{ ($tb->presence == 2) ? 'No' : 'Yes' }}</td>
											<td style="width:10%; background:#eee;">Status</td>
											<td style="width:10%;">{{ ($tb->tb_status == 2) ? 'Active' : 'Inactive' }}</td>
										</tr>
										@if($tb->tb_status == 2)
											<tr>
												<td colspan="4">
													<div class="tbViewTitle">Site</div>
													@if($tb->site == 1)
														Pulmonary
													@else
														Extrapulmonary - {{ $tb->site_extrapulmonary }}
													@endif
												</td>
											</tr>
											<tr>
												<td colspan="4">
													<div class="tbViewTitle">Drug Resistance</div>
													@if($tb->drug_resistance == 1)
														Susceptible
													@elseif($tb->drug_resistance == 2)
														XDR
													@elseif($tb->drug_resistance == 3)
														MDR/RR
													@else
														Other - {{ $tb->drug_resistance_other }}
													@endif
												</td>
											</tr>
											<tr>
												<td colspan="4">
														<div class="tbViewTitle">Current TB Regimen</div>
														@if($tb->current_tb_regimen == 1)
															Category I
														@elseif($tb->current_tb_regimen == 2)
															Category Ia
														@elseif($tb->current_tb_regimen == 3)
															Category II
														@elseif($tb->current_tb_regimen == 4)
															Category IIa
														@elseif($tb->current_tb_regimen == 5)
															SRDR
														@else
															XDR-TB regimen
														@endif
												</td>
											</tr>
											<tr>
												<td colspan="4">
													<div class="tbViewTitle">TX Outcome</div>
													@if($tb->tx_outcome == 1)
														Cured
													@elseif($tb->tx_outcome == 2)
														Failed
													@elseif($tb->tx_outcome == 3)
														Completed
													@else
														Other - {{ $tb->tx_outcome_other }}
													@endif
												</td>
											</tr>
										@else
											<tr>
												<td colspan="4">
													<div class="tbViewTitle">On IPT</div>
													@if($tb->on_ipt == 1)
														Yes
													@else
														No
													@endif
												</td>
											</tr>
											<tr>
												<td colspan="4">
													<div class="tbViewTitle">IPT Outcome</div>
													@if($tb->ipt_outcome == 1)
														Completed
													@elseif($tb->ipt_outcome == 2)
														Failed
													@else
														Other - {{ $tb->ipt_outcome_other }}
													@endif
												</td>
											</tr>
										@endif
									</tbody>
								</table>
							</td>
						</tr>
					@endforeach
			</tbody>
		</table> -->
	</div>
</div>
<script>
	$(".collapse_lab_test").hide();
</script>

@endsection

@extends('hact.layouts.layout_admin')

@section('content')

<div class="row">
	<div class="large-12 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('patient') }}">Patient</a></li>
			<li class="current"><a href="{{ route('infections_show', $patient_id) }}">{{ $page }}</a></li>
		</ul>
	</div>
</div>

<div class='row'>
	<div class='large-12 columns'>
		@include('hact.messages.success')
		@include('hact.messages.error_list')
		
		<table width="100%">
			<thead>
				<tr>
					<th width="10%">
						<a href="{{ route('infections_create',$patient_id) }}"><i class="fa fa-plus fa-lg"></i></a>	
					</th>
					<th>Date</th>
					<th>Clinical Stage</th>
					<th>WHO Classifications</th>
					<th>Previous Diagnosed Infections</th>
				</tr>
			</thead>
			<tbody>
				@foreach($infections_report as $infections)
					<tr>
						<td>
							<a href="{{ route('infections_edit', [$infections->patient_id, $infections->order_number]) }}" title="Edit Infections Report">
								<i class="fa fa-edit fa-lg"></i>
							</a>
						</td>
						<td>{{ $infections->result_date_format }}</td>
						<td>
							{{ $infections->clinical_stage }}
						</td>
						<td>
							<a href="#" data-reveal-id="modal{{ $infections->id }}">View Clinical Staging <i class="fa fa-hospital-o"></i></a>
							<div style = "text-align:center" id="modal{{ $infections->id }}" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
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
									@foreach($infections->infections_clinical_stage as $ics)
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
								{!! ($infections->hepatitis_b == 1) ? "<li>Hepatitis B</li>": "" !!}
								{!! ($infections->hepatitis_c == 1) ? "<li>Hepatitis C</li>": "" !!}
								{!! ($infections->pneumocystis_pneumonia == 1) ? "<li>Pneumocystis Pneumonia</li>": "" !!}
								{!! ($infections->oropharyngeal_candidiasis == 1) ? "<li>Oropharyngeal Candidiasis</li>": "" !!}
								{!! ($infections->syphilis == 1) ? "<li>Syphilis</li>": "" !!}
								{!! ($infections->stis != "") ? "<li>STIs:".$infections->stis."</li>": "" !!}
								{!! ($infections->others != "") ? "<li>Others:".$infections->others."</li>": "" !!}
							</ul>
						</td>
					</tr>
				@endforeach	
			</tbody>
		</table>
	</div>
</div>

@endsection
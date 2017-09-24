@extends("hact.layouts.print_layout")

@section("content")

<form class="print" method="get" action="{{ route('reports_patient_print_master_list') }}">
	<input id="print" type="button" value="Print">
	<input type="submit" name="excel" value="Excel">
</form>

<script>
	$('#print').click(function(){
		$('.print').hide();
		window.print();
		$('.print').show();
	});
</script>
<br/>
<br/>
<div class="row">
	<div class="large-12 column text-center">
		MASTERLIST OF PATIENTS </br>
		CORAZON LOCSIN MONTELIBANO MEMORIAL REGIONAL HOSPITAL
	</div>
</div>
<br />
<div class="row">
	<div class="large-12 column list">
		<table width="100%">
			<thead>
				<tr class="head">
					<th></th>
					<th>Code Name</th>
					<th>SACCL Code</th>
					<th>UI Code</th>
					<th>Date of Birth</th>
					<th>Sex</th>
					<th>Age</th>
					<th>PhilHealth Number</th>
					<th>Attending Physician</th>
					<th>Address</th>
					<th>Date of Initial Contact</th>
					<th>Date of Western BLOT</th>
					<th>Date of Enrolment</th>
					<th>ARV Regimen</th>
					<th>ARV Start Date</th>
					<th>ARV Stop Date</th>
					<th>Reason for Discontinuing ARV</th>
					<th>Outcome</th>
					<th>Date of Last Follow-up</th>
					<th>Date of Next Pick Up</th>
				</tr>
			</thead>
			<tbody>
			@foreach($patients as $row)
				<tr class="{{ ($row->is_mortality == 0) ? '' : 'mortality' }}">
					<td>{{ $patient_number}}</td>
					<td>{{ $row->code_name }}</td>
					<td>{{ $row->saccl_code }}</td>
					<td>{{ $row->ui_code }}</td>
					<td>{{ Carbon\Carbon::parse($row->birth_date)->format('m/d/Y') }}</td>
					<td>{{ ($row->gender == 1)?'Male':'Female'}}</td>
					<td>{{ $row->age }}</td>
					<td>{{ $row->phil_health_number}}</td>
					<td>{{ $row->VCT->first()->last_assigned_doctor_name or '-' }}</td>
					<td>{{ $row->permanent_address }}</td>
					{{--<td>{{ (@$row->VCT->first()) ?  Carbon\Carbon::parse($row->VCT->first()->vct_date)->format('m/d/Y') :  '-' }}</td>--}}
					{{--<td></td>--}}
					{{--<td>{{ (@$row->ConfirmatoryDate) ?  Carbon\Carbon::parse($row->ConfirmatoryDate->confirmatory_date)->format('m/d/Y') : '-' }}</td>--}}
					{{--<td>{{ ($row->VCT->where('result',2)->reverse()->first()->vct_date) ? \Carbon\Carbon::parse($row->VCT->where('result',2)->reverse()->first()->vct_date)->format('m/d/Y') :  '-' }}</td>--}}
					{{--<td>--}}
					<td>{{ ($row->VCT->first()) ? Carbon\Carbon::parse($row->VCT->first()->vct_date)->format('m/d/Y') : '-' }}</td>
					<td>{{ ($row->ConfirmatoryDate) ? Carbon\Carbon::parse($row->ConfirmatoryDate->confirmatory_date)->format('m/d/Y') : '-' }}</td>
					<td>{{ ($row->VCT->where('result',2)->reverse()->first()) ? Carbon\Carbon::parse($row->VCT->where('result',2)->reverse()->first()->vct_date)->format('m/d/Y') : '-' }}</td>
					<td>
				@if($row->ARV)
							<ol>
								@foreach($row->ARV as $row_2)
									@foreach($row_2->ARVItems as $row_3)
										@if($row_3->specified_medicine == "")
											<li>{{ $row_3->Medicine->name }}</li>
										@else
											<li>{{ $row_3->specified_medicine }}</li>
										@endif
									@endforeach
								@endforeach
							</ol>
						@else
							-
						@endif
					</td>
					<td>
						@if($row->ARV)
							<ol>
								@foreach($row->ARV as $row_2)
									@foreach($row_2->ARVItems as $row_3)
										<li>{{ Carbon\Carbon::parse($row_3->date_started)->format('m/d/Y') }}</li>
									@endforeach
								@endforeach
							</ol>
						@else
							-
						@endif
					</td>
					<td>
						@if($row->ARV)
							<ol>
								@foreach($row->ARV as $row_2)
									@foreach($row_2->ARVItems as $row_3)
										<li>{{ ($row_3->date_discontinued != null ) ?  Carbon\Carbon::parse($row_3->date_discontinued)->format('m/d/Y') : '-' }}</li>
									@endforeach
								@endforeach
							</ol>
						@else
							-
						@endif
					</td>
					<td>
						@if($row->ARV)
							<ol>
								@foreach($row->ARV as $row_2)
									@foreach($row_2->ARVItems as $row_3)
										<li>{{ $row_3->reason_format or '-' }}</li>
									@endforeach
								@endforeach
							</ol>
						@else
							-
						@endif
					</td>
					<td>{{ $row->outcome }}</td>
					<td>{{ ($row->VCT->reverse()->take(2)->reverse()->first()) ? Carbon\Carbon::parse($row->VCT->reverse()->take(2)->reverse()->first()->vct_date)->format('m/d/Y'):  '-' }}</td>
					<td>
					{{ ($row->Checkup->reverse()->first()) ? Carbon\Carbon::parse($row->Checkup->reverse()->first()->follow_up_date)->format('m/d/Y') : '-'}}
					</td>

				</tr>
				<?php $patient_number++; ?>
			@endforeach
			<tr>
				<td colspan="10">
					&nbsp;
				</td>
				<td colspan="10">
					<div>Generated By:<br/>
						Name: {{ Auth::user()->name }}<br/>
						Email: {{ Auth::user()->email }}
					</div>
				</td>
			</tr>

			</tbody>
		</table>
	</div>
</div>
<style type="text/css">
.row{
	max-width:none;
}


</style>
@endsection
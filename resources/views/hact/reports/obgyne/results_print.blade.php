
@extends("hact.layouts.print_layout")

@section("content")
<br/>
<input id="print" type="button" value="Print">
<script>
	$('#print').click(function(){
		$(this).hide();
		window.print();
		$(this).show();
	});
</script>
<br/>
<br/>
<div class="row">
	<div class="large-12 column">
		@if($to == 'Later')
		<h4>OBGyne Childbirth Report</h4>
		@else
		<h4 class="header-report">OBGyne Summary Report</h4>
		@endif
	</div>
</div>
<div class="row">
	<div class="large-6 column">
		<strong>Currently Pregnant: </strong> {{ $result }}
	</div>
	<div class="large-6 column">
		<strong>Date :</strong> {{ $from }} - {{ $to }}
	</div>
</div>

<br />
<div class="row">
	<div class="large-12 column">
		<table width="100%">
			<tbody>
				<th width="25%">UI Code</th>
				<th width="25%">SACCL</th>
				<th width="20%">Code Name</th>
				<th width="20%">Infant Type</th>
				<th width="10%">Delivery Date</th>
			</tbody>
			<tbody>
			@foreach($obgyne as $row)
				<tr>
					<td>{{ ($row->Patient) ?  $row->Patient->ui_code : '' }}</td>
					<td>{{ ($row->Patient) ? $row->Patient->saccl_code : ''}}</td>
					<td>{{ ($row->Patient) ? $row->Patient->code_name : '' }}</td>
					<td>{{ ($row->Patient) ? $row->infant_type : '' }}</td>
					<td>{{ ($row->Patient) ? $row->if_delivered_date : ''}}</td>
				</tr>
			@endforeach
			<tr>
				<td colspan="2">
					&nbsp;
				</td>
				<td colspan="3">
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

@endsection
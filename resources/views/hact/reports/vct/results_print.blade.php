
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
		<strong>VCT Result List</strong>
	</div>
</div>
<div class="row">
	<div class="large-1 column">
		Date:
	</div>
	<div class="large-11 column">
		<strong>{{ $from }} - {{ $to }}</strong>
	</div>
</div>

<div class="row">
	<div class="large-1 column">
		Result:
	</div>
	<div class="large-11 column">
		<strong>
		{{ $result }}
		</strong>
	</div>
</div>
<br />
<div class="row">
	<div class="large-12 column">
		<table width="100%">
			<thead>
				<th width="20%">Code Name</th>
				<th width="10%">Age</th>
				<th width="10%">Sex</th>
				<th width="15%">SACCL</th>
				<th width="25%">UIC</th>
				<th width="20%">VCT Date</th>
			</thead>
			<tbody>
			@if(@$vct)
			@foreach($vct as $row)
				<tr>
					<td>{{ ($row->Patient) ? $row->Patient->code_name : 'Name not available' }}</td>
					<td>{{ ($row->Patient) ?  $row->Patient->age : 'Age not available' }}</td>
					<td>{{ ($row->Patient) ?  $row->Patient->gender_format : '' }}</td>
					<td>{{ ($row->Patient) ?  $row->Patient->saccl_code : 'SACCL Code Not available'}}</td>
					<td>{{ ($row->Patient) ? $row->Patient->ui_code : 'UI Code not available' }}</td>
					<td>{{ $row->vct_date }}</td>
				</tr>
			@endforeach
			@endif
			<tr>
				<td colspan="3">
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
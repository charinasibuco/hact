
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
	<div class="large-1 column">
		Result
	</div>
	<div class="large-11 column">
		<strong>
		@if($gender == 0)
			Female
		@elseif($gender == 1)
			Male
		@else
			All
		@endif
		</strong>
	</div>
</div>
<br />
<div class="row">
	<div class="large-12 column">
		<table width="100%">
			<thead>
				<tr class="head">
					<th width="20%">UI Code</th>
					<th width="20%">SACCL</th>
					<th width="20%">Code Name</th>
					<th width="15%">Nationality</th>
					<th width="10%">Gender</th>
					<th width="15%">VCT Status</th>
				</tr>
			</thead>
			<tbody>
			@foreach($patients as $row)
				<tr>
					<td>{{ $row->ui_code }}</td>
					<td>{{ $row->saccl_code }}</td>
					<td>{{ $row->code_name }}</td>
					<td>{{ $row->nationality }}</td>
					<td>{{ $row->gender_format }}</td>
					<td>{{ $row->last_vct_record->result_format }}</td>
				</tr>
			@endforeach
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

<script type="text/javascript">
	$(function(){
		var head = $('table thead tr');
		$( "tbody tr:nth-child(20n+20)" ).after(head.clone());
	});
</script>

<style type="text/css">
	tbody tr.thead {
		border-top: 1px solid #ddd;
        page-break-before: always;
        page-break-inside: avoid;
	}	

	tbody .head{
		display: none;
	}
</style>


@endsection
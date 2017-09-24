
@extends("hact.layouts.print_layout")

@section("content")

<div class="row">
	<div class="large-12 column text-center top">
		<strong>Corazon Locsin Montelibano Memorial Regional Hospital</strong>
		</br>
		Death List From:{{ $from }} to {{ $to}}
	</div>
</div>
<br />
<div class="row">
	<div class="large-12 column">
		<table width="100%">
			<thead>
				<tr class="head">
					<th width="25%">UI Code</th>
					<th width="25%">SACCL</th>
					<th width="20%">Code Name</th>
					<th width="20%">Nationality</th>
					<th width="10%">Gender</th>
				</tr>
			</thead>
			<tbody>
				@foreach($patients as $row)
				<tr>
					<td>{{ $row->ui_code }}</td>
					<td>{{ $row->saccl_code }}</td>
					<td>{{ $row->code_name }}</td>
					<td>{{ $row->nationality }}</td>
					<td>{{ ($row->gender == 1)? 'Male' : 'Female' }}</td>
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

<script type="text/javascript">
	$(function(){
		var head = $('table thead tr');
		$( "tbody tr:nth-child(20n+20)" ).after(head.clone());
	});
</script>

<style type="text/css">

	.top{
		margin-top: 50px;
	}
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
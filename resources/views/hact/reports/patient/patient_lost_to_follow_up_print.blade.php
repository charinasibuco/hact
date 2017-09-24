
@extends("hact.layouts.print_layout")

@section("content")

<div class="row">
	<div class="large-12 column text-center top">
		<strong>Corazon Locsin Montelibano Memorial Regional Hospital</strong>
		</br>
		Patient Lost to follow Up From:{{ $from }} to {{ $to}}
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
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
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
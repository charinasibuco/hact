
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
		Patient:
	</div>
	<div class="large-11 column">
		<strong>{{ $search_patient }}</strong>
	</div>
</div>

<br />
<div class="row">
	<div class="large-12 column">
		<table width="100%">
			<thead>
					<tr>
						@foreach($laboratory_types as $row)
							<th colspan="2">
								{{ is_object($row) ? $row->test_description.' - '.$row->description:$row['description'] }}
							</th>
						@endforeach
					</tr>
					<tr>
						@foreach($laboratory_types as $row)
							<th>Result</th>
							<th>Result Date</th>
						@endforeach
					</tr>
					
			</thead>
			<tbody>
			<?php 
				$lab_count=0;
				$limit_check = true;
			 ?>
				@while($limit_check)	
					<?php

					 $blank_check = count($laboratories);
					 foreach($laboratories as $column)
					 {
					 	if(!isset($column[$lab_count]))
					 	{
					 		$blank_check--;
					 	}
					 }
					?>
					@if($blank_check != 0)
						<tr>
							@foreach($laboratories as $column)
								@if(isset($column[$lab_count]))
									<td>{{ $column[$lab_count]->result }}</td>
									<td>{{ $column[$lab_count]->result_date_format }}</td>
								@else
									<td></td>
									<td></td>
								@endif
							@endforeach
						</tr>
					@endif
					<?php $lab_count++; ?>	
					@if($blank_check==0)
						<?php $limit_check = false ?>
					@endif
				@endwhile
			</tbody>
		</table>
	</div>
</div>

@endsection
@extends('hact.layouts.layout_admin')

@section('content')

<div class="row">
	<div class="large-12 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('patient') }}">Patient</a></li>
			<li><a href="{{ route('patient_profile',$patient_id) }}">{{ $search_patient }}</a></li>
			<li class="current">Laboratory</li>
			@if(isset($action_name))
				<li class="current"><a href="#">{{ $action_name }}</a></li>
			@endif
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
					<th width="100%">
						<a href="{{ route('laboratory_create',$patient_id) }}"><i class="fa fa-plus fa-lg"></i></a>
						<a href="">&nbsp;Laboratory Reports</a>
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach($laboratory_tests as $test)
					@if($laboratories->where('laboratory_test_id',$test->id)->count() > 0)
						<script>
							$(function(){
								$("a.{{$test->id }}").click(function(){
									if($(this).children("input").val()==0)
									{
										$(this).children("input").val(1);
										$(this).children("i").attr("class","fa fa fa-caret-down");
										$(this).attr("title","Hide Laboratories");
									}
									else if($(this).children("input").val()==1)
									{
										$(this).children("input").val(0);
										$(this).children("i").attr("class","fa fa-caret-right");
										$(this).attr("title","Collapse Laboratories");
									}
									$("tr.{{$test->id }}").toggle();
								});
							})
						</script>
						<tr>
							<td>
								<h6>
									<a href="{{ route('laboratory_chart', [$patient_id,$test->id,'']) }}"><i class="fa fa-line-chart fa-lg"></i></a>
									&nbsp;
									<a title="Collapse Laboratories" class="{{ $test->id }}" href="#">
										<input type="hidden" value="0">
										{{ $test->description }}
										&nbsp;<i class="fa fa-caret-right"></i>
									</a>
								</h6>
							</td>
						</tr>
						<tr class="{{ $test->id }} collapse_lab">
							<td>
								<table width="100%">
									<thead>
										<tr>
											<th width="10%"></th>
											<th width="25%">Laboratory Name</th>
											<th width="25%">Laboratory Result</th>
											<th width="20%">Result Date</th>
											<th width="20%">Image</th>
										</tr>
									</thead>
									<tbody>
										@foreach($laboratories->where('laboratory_test_id', $test->id) as $row)

											<tr>
												<td><a href="{{ route('laboratory_edit', $row->id) }}" title="Edit Laboratory">
													<i class="fa fa-edit fa-lg"></i></a>
													<a href="{{ route('laboratory_destroy', $row->id) }}" title="Delete Laboratory">
													<i class="fa fa-times fa-lg"></i></a>
												</td>
												<td>{{ $row->laboratory_type->description }}</td>
												<td>{{ $row->result }}</td>
												<td>{{ $row->result_date_format }}</td>
												<td>
													@if($row->image != "")
														<a href="#" data-reveal-id="modal{{ $row->id }}">View Image <i class="fa fa-file-image-o"></i></a>
													@else
														<span style = "font-style:italic">No Image Available</span>
													@endif
												</td>

												<div style = "text-align:center" id="modal{{ $row->id }}" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
												 		<img src="{{ asset($row->image) }}" >
												  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
												</div>

											</tr>
										@endforeach
										<!-- <tr class="none"><td class="lab_name">Hemoglobin</td><td></td><td></td></tr> -->
									</tbody>
								</table>
							</td>
						</tr>
					@endif
				@endforeach


				@foreach($other_laboratories as $other)
					@if($laboratories->where('other', $other->other)->count() > 0)
						<script>
							$(function(){
								$("a.other{{$other->id }}").click(function(){
									if($(this).children("input").val()==0)
									{
										$(this).children("input").val(1);
										$(this).children("i").attr("class","fa fa fa-caret-down");
										$(this).attr("title","Hide Laboratories");
									}
									else if($(this).children("input").val()==1)
									{
										$(this).children("input").val(0);
										$(this).children("i").attr("class","fa fa-caret-right");
										$(this).attr("title","Collapse Laboratories");
									}
									$("tr.other{{$other->id }}").toggle();
								});
							})
						</script>
						<tr>
							<td>
								<h6>
									<a href="{{ route('laboratory_chart', [$patient_id,16,$other->other]) }}"><i class="fa fa-line-chart fa-lg"></i></a>
										&nbsp;
									<a title="Collapse Laboratories" class="other{{ $other->id }}" href="#">
										<input type="hidden" value="0">
										{{ $other->other }}
										&nbsp;<i class="fa fa-caret-right"></i>
									</a>
								</h6>
							</td>
						</tr>
						<tr class="other{{ $other->id }} collapse_lab">
							<td>
								<table width="100%">
									<thead>
										<tr>
											<th width="10%"></th>
											<th width="30%">Laboratory Result</th>
											<th width="30%">Result Date</th>
											<th width="30%">Image</th>
										</tr>
									</thead>
									<tbody>

										@foreach($laboratories->where('other', $other->other) as $row)

											<tr>
												<td><a href="{{ route('laboratory_edit', $row->id) }}" title="Edit Laboratory">
													<i class="fa fa-edit fa-lg"></i></a>
													<a href="{{ route('laboratory_destroy', $row->id) }}" title="Delete Laboratory">
													<i class="fa fa-times fa-lg"></i></a>
												</td>
												<td>{{ $row->result }}</td>
												<td>{{ $row->result_date_format }}</td>
												<td>
													@if($row->image != "")
														<a href="#" data-reveal-id="modal{{ $row->id }}">View Image <i class="fa fa-file-image-o"></i></a>
													@else
														<span style = "font-style:italic">No Image Available</span>
													@endif
												</td>

												<div style = "text-align:center" id="modal{{ $row->id }}" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
														<img src="{{ asset($row->image) }}" >
												  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
												</div>

											</tr>

										@endforeach
									</tbody>
								</table>
							</td>
						</tr>
					@endif
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<script>
	$(".collapse_lab").hide();
	$(function(){
		$(".none").children("td").css("color","#B8B8B8");
		$(".lab_name").siblings("td").html("----------");
		$('#search_patient').attr('readonly',true);
	});
</script>

@endsection

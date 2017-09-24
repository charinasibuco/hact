@extends("hact.layouts.layout_admin")

@section("content")

<div class='row'>
    <div class='large-12 columns'>
        <ul class="breadcrumbs">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Patient</a></li>
            <li class="current"><a href="#">Patient Lost to Follow-up</a></li>
        </ul>
    </div>
</div>

@include("hact.messages.success")
@include("hact.messages.error_list")
			
<div class="panel">
	<div class="row">
		<div class="large-6 columns">
			<form method="get" action="{{ route('patient_lost_to_follow_up_print') }}">
				<fieldset>
					<legend>Generate Patients Lost to Follow-up</legend>
					<div class="row">
						<div class="large-12 columns">
							<label>From:</label>
							<input type="text" id="from" class="fdatepicker" name="from" placeholder="MM dd,yyyy" value="" readonly>	
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label>To:</label>
							<input type="text" id="to" class="fdatepicker" name="to" placeholder="MM dd,yyyy" value="" readonly>	
						</div>
					</div>
					<div class="row">	
						<div class="large-12 columns">
							<button type="submit" class="button small alert">Generate</button>
                            <input type="submit" class="button small alert" name="excel" value="Excel" />
							{!! csrf_field() !!}
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>

@endsection
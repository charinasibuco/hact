@extends("hact.layouts.layout_admin")

@section("content")

<div class='row'>
    <div class='large-12 columns'>
        <ul class="breadcrumbs">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Pharmacy</a></li>
            <li class="current"><a href="#">Dispense</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="large-12 medium-12 small-12 columns">
        @include("hact.messages.success")
        @if(count($errors) > 0)
            <div class="alert-box alert ">Error: Highlight fields are required!</div>
        @endif
        <div class="custom-panel-heading">
            <span>Dispense on Patient Report</span>
        </div>
        <div class="custom-panel-details">
			<div class="row">
				<div class="large-6 columns">
					<form method="get" action="{{ route('patient_dispense_print') }}">
						<fieldset>
							<legend>Generate</legend>
							<div class="row">
								<div class="large-12 columns">
									<label for="search_vct">Patient</label>
									<div class="row collapse">
								    	<div class="small-10 columns">
											<input type="text" id="search_patient" name="search_patient" value="{{ @$search_patient }}" class="{{ ($errors->has('patient_id')) ? 'highlight_error' : '' }}" />
											<input type="hidden" id="patient_id" name="patient_id" value="" />
											<input type="hidden" id="search_patient_url" name="search_patient_url" value="{{ route('patient_search') }}" />
											<input type="hidden" id="patient_record_url" name="patient_record_url" value="{{ route('patient_record') }}" />
								    	</div>
								    	<div class="small-2 columns">
								      		<span class="postfix"><i class="fa fa-search"></i></span>
								    	</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="large-12 columns">
									<label>From:</label>
									<input type="text" id="from" class="fdatepicker {{ ($errors->has('from')) ? 'highlight_error' : '' }}" name="from" placeholder="MM dd,yyyy" value="" readonly>	
								</div>
							</div>
							<div class="row">
								<div class="large-12 columns">
									<label>To:</label>
									<input type="text" id="to" class="fdatepicker {{ ($errors->has('to')) ? 'highlight_error' : '' }}" name="to" placeholder="MM dd,yyyy" value="" readonly>	
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
	</div>
</div>

@endsection
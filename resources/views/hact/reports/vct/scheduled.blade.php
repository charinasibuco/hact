@extends("hact.layouts.layout_admin")

@section("content")

<div class='row'>
    <div class='large-12 columns'>
        <ul class="breadcrumbs">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">VCT</a></li>
            <li class="current"><a href="#">Scheduled</a></li>
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
            <span>Scheduled Patient</span>
        </div>
        <div class="custom-panel-details">
			<div class="row">
				<div class="large-6 columns">
					<form method="get" action="{{ route('reports_print_vct_scheduled') }}">
						<fieldset>
							<legend>Generate</legend>
							<div class="row">
								<div class="large-12 columns">
									<label>From:</label>
									<input type="text" id="from" class="fdatepicker {{ ($errors->has('from')) ? 'highlight_error' : '' }}" name="from" placeholder="MM dd,yyyy" value="{{ old('from') }}" readonly>	
								</div>
							</div>
							<div class="row">
								<div class="large-12 columns">
									<label>To:</label>
									<input type="text" id="to" class="fdatepicker {{ ($errors->has('to')) ? 'highlight_error' : '' }}" name="to" placeholder="MM dd,yyyy" value="{{ old('to') }}" readonly>	
								</div>
							</div>
							<div class="row">	
								<div class="large-12 columns">
									<button type="submit" class="button small alert">Generate</button>
		                            {{--<input type="submit" class="button small alert" name="excel" value="Excel" />--}}
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
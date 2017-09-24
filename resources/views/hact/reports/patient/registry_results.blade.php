@extends("hact.layouts.layout_admin")

@section("content")

<div class='row'>
    <div class='large-12 columns'>
        <ul class="breadcrumbs">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li class="current"><a href="#">Patients</a></li>
            <li class="current"><a href="#">Registry</a></li>
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
            <span>HIV VCT Registry Report</span>
        </div>
        <div class="custom-panel-details">
            <div class="row">
                <div class="large-6 columns">
                    <form method="get" action="{{ route('reports_patient_registry') }}">
                        <fieldset>
                            <legend>Registry of Patients</legend>
                            <div class="row">
                                <div class="large-12 columns">
                                    <label>From:</label>
                                    <input type="text" id="from" class="fdatepicker  {{ ($errors->has('from')) ? 'highlight_error' : '' }}" name="from" placeholder="MM dd,yyyy" value="{{ old('from')}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 columns">
                                    <label>To:</label>
                                    <input type="text" id="to" class="fdatepicker  {{ ($errors->has('to')) ? 'highlight_error' : '' }}" name="to" placeholder="MM dd,yyyy" value="{{ old('to')}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 columns">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="button tiny alert">Generate</button>
                                    <input type="submit" class="button tiny alert" name="excel" value="Excel" />
                                    {!! csrf_field() !!}
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="large-6 columns">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

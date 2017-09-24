@extends("hact.layouts.layout_admin")

@section("content")

<div class='row'>
    <div class='large-12 columns'>
        <ul class="breadcrumbs">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li class="current"><a href="#">Laboratory</a></li>
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
            <span>Laboratory Report</span>
        </div>
        <div class="custom-panel-details">
            <div class="row">
                <div class="large-12 columns">
                    <form id="report" method="get" action="{{ route('laboratory_results_print') }}">
                        <fieldset>
                            <legend>Immunologic Profile</legend>
                            <div class="row">
                                <div class="large-12 columns">
                                    <label for="search_patient">Patient</label>
                                    <div class="row collapse">
                                        <div class="small-4 columns">
                                            <input type="text" id="search_patient" name="search_patient" value="{{ @$search_patient }}" class="{{ ($errors->has('patient_id')) ? 'highlight_error' : '' }}" />
                                            <input type="hidden" id="patient_id" name="patient_id" value="" />
                                            <input type="hidden" id="search_patient_url" name="search_patient_url" value="{{ route('patient_search') }}" />
                                            <input type="hidden" id="patient_record_url" name="patient_record_url" value="{{ route('patient_record') }}" />
                                        </div>
                                        <div class="small-2 columns">
                                            <span class="postfix"><i class="fa fa-search"></i></span>
                                        </div>
                                        <div class="small-6 columns">
                                           &nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-3 columns">
                                    <fieldset class="{{ ($errors->has('labs')) ? 'highlight_error' : '' }}">
                                        <legend>HIV Diagnosis</legend>
                                        @if($tests)
                                            @foreach($tests as $test)
                                                @if($test->group == 1)
                                                    <input type="checkbox" value="{{ $test->id }}" id="labs[{{ $test->id }}]" name="labs[{{ $test->id }}]" @if(in_array($test->id, $labs)) checked @endif c><label for="labs[{{ $test->id }}]">{{ $test->description }}</label><br/>
                                                @endif
                                            @endforeach
                                        @endif
                                    </fieldset>
                                    <fieldset class="{{ ($errors->has('labs')) ? 'highlight_error' : '' }}">
                                        <legend>CBC</legend>
                                        @foreach($tests as $test)
                                            @if($test->group == 2)
                                                <input type="checkbox" value="{{ $test->id }}" id="labs[{{ $test->id }}]" name="labs[{{ $test->id }}]" @if(in_array($test->id, $labs)) checked @endif><label for="labs[{{ $test->id }}]">{{ $test->description }}</label><br/>
                                            @endif
                                        @endforeach
                                    </fieldset>
                                    <fieldset class="{{ ($errors->has('labs')) ? 'highlight_error' : '' }}">
                                        <legend>Others</legend>
                                        <input type="checkbox" value="16" id="labs[16]" name="labs[16]" @if(in_array(16, $labs)) checked @endif><label for="labs[16]">Others</label><br/>
                                    </fieldset>
                                </div>
                                <div class="large-3 columns">
                                    <fieldset class="{{ ($errors->has('labs')) ? 'highlight_error' : '' }}">
                                        <legend>Blood Tests</legend>
                                        @foreach($tests as $test)
                                            @if($test->group == 3)
                                                <input type="checkbox" value="{{ $test->id }}" id="labs[{{ $test->id }}]" name="labs[{{ $test->id }}]" @if(in_array($test->id, $labs)) checked @endif><label for="labs[{{ $test->id }}]">{{ $test->description }}</label><br/>
                                            @endif
                                        @endforeach
                                    </fieldset>
                                </div>
                                <div class="large-3 columns">
                                    <fieldset class="{{ ($errors->has('labs')) ? 'highlight_error' : '' }}">
                                        <legend>Infectious Disease Test</legend>
                                        @foreach($tests as $test)
                                            @if($test->group == 4)
                                                <input type="checkbox" value="{{ $test->id }}" id="labs[{{ $test->id }}]" name="labs[{{ $test->id }}]" @if(in_array($test->id, $labs)) checked @endif><label for="labs[{{ $test->id }}]">{{ $test->description }}</label><br/>
                                            @endif
                                        @endforeach
                                    </fieldset>
                                    <fieldset class="{{ ($errors->has('labs')) ? 'highlight_error' : '' }}">
                                        <legend>Excrement Test</legend>
                                        @foreach($tests as $test)
                                            @if($test->group == 5)
                                                <input type="checkbox" value="{{ $test->id }}" id="labs[{{ $test->id }}]" name="labs[{{ $test->id }}]" @if(in_array($test->id, $labs)) checked @endif><label for="labs[{{ $test->id }}]">{{ $test->description }}</label><br/>
                                            @endif
                                        @endforeach
                                    </fieldset>
                                </div>
                                <div class="large-3 columns">
                                    <fieldset class="{{ ($errors->has('labs')) ? 'highlight_error' : '' }}">
                                        <legend>TB Diagnosis</legend>
                                        @foreach($tests as $test)
                                            @if($test->group == 6)
                                                <input type="checkbox" value="{{ $test->id }}" id="labs[{{ $test->id }}]" name="labs[{{ $test->id }}]" @if(in_array($test->id, $labs)) checked @endif><label for="labs[{{ $test->id }}]">{{ $test->description }}</label><br/>
                                            @endif
                                        @endforeach
                                    </fieldset>
                                </div>
                            </div>
                            <br />
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
            <div class="row">
                <div class="large-12 columns">
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

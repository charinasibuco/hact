@extends('hact.layouts.layout_admin')

@section('content')
    <div class='row'>
        <div class='large-12 columns'>
            <ul class="breadcrumbs">
                <li><a href="{{ route('home') }}">Home</a></li>

                <li><a href="{{ route('patient') }}">Patients</a></li>
                <li><a href="{{ route('patient_profile',$patient_id) }}">{{ (isset($search_patient)?$search_patient:'') }}</a></li>
                <li><a href="{{ route('patient_profile',$patient_id) . "#tab10" }}">Medical Abstract</a></li>
                <li class="current"><a href="#">{{ $action_name }}</a></li>
            </ul>
        </div>
    </div>
<div class="row">
    <div class="large-12 medium-12 small-12 columns">
        @include("hact.messages.success")
        @if(count($errors) > 0)
            <div class="alert-box alert ">Error: Highlight fields are required!</div>
            @include("hact.messages.other_error")
        @endif
        <div class="custom-panel-heading">
            <span>Medical Abstract</span>
        </div>
        <div class="custom-panel-details">
            <div class="row">
                <div class="large-12 columns">
                    <fieldset>
                        <form action="{{ $action }}" method="post">
                            <div class="row">
                                <div class="medium-4 columns">
                                    <label for="search_patient">Patient</label>
                                    <input type="text" id="search_patient" name="search_patient" value="{{ $search_patient }}" readonly />
                                    <input type="hidden" id="patient_id" name="patient_id" value="{{ $patient_id }}" readonly />
                                </div>
                                <div class="medium-4 columns">
                                    <label for="date">Date:</label>
                                    <input type="text" id="date" name="date" placeholder="Medical Abstract Date" class="fdatepicker {{ ($errors->has('date')) ? 'highlight_error' : '' }}" value="{{ ($action_name == 'Create')?$date:$date->format('F d, Y')  }}" readonly>
                                </div>
                                <div class="medium-4 columns">&nbsp</div>
                            </div>
                            <div class="row">
                                <div class="medium-12 columns">
                                    <textarea name="body" id="body" rows="17" class="{{ ($errors->has('body')) ? 'highlight_error' : '' }}" placeholder="Medical Abstract...">{{ $body }}</textarea>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="medium-12 columns">
                                    {!! csrf_field() !!}
                                    <button class="button success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                    <a href="{{ route('patient_profile',$patient_id) }}" class="button alert" title="Cancel"><i class="fi fi-x"></i> Cancel</a>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
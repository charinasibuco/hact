@extends('hact.layouts.layout_admin')

@section('content')
    <div class='row'>
        <div class='large-12 columns'>
            <ul class="breadcrumbs">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('patient') }}">Patient</a></li>
                <li><a href="{{ route('patient_profile',$patient_id) }}">{{ $search_vct }}</a></li>
                <li><a href="{{ route('patient_profile',$patient_id) . "#tab7" }}">OB Gyne</a></li>
                <li class="current"><a href="#">{{ $action_name }}</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="large-12 column">
            @include("hact.messages.success")
        @if(count($errors) > 0)
            <div class="alert-box alert ">Error: Highlight fields are required!</div>
            @include("hact.messages.other_error")
        @endif
        {{--@include("hact.messages.error_list")--}}
        </div>
    </div>
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <div class="custom-panel-heading">
                <span>{{ $action_name }} OB-Gyne</span>
                <a href="{{ route('patient_profile',$patient_id) }}" class="alert tiny button right" title="Cancel Checkup"><i class="fi fi-x"></i> Cancel</a>
            </div>
            <div class="custom-panel-details">
                <fieldset>
                    <div class="row">
                        <div class="large-4 columns">
                            <label for="search_patient">Patient</label>
                            <div class="row collapse">
                                <div class="small-10 columns">
                                    <input type="text" id="search_vct" class="{{ ($errors->has('patient_id')) ? 'highlight_error' : '' }}" name="search_vct" value="{{ $search_vct }}" @if($search_vct) readonly @endif />
                                    {{--<input type="hidden" id="patient_id" name="patient_id" value="{{ $patient_id }}" />--}}
                                    <input type="hidden" id="search_vct_url" name="search_ob_url" value="{{ route('ob_gyne_search') }}" />
                                </div>
                                <div class="small-2 columns">
                                    <span class="postfix"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <form action="{{ $action }}" method="post">
                    <input id="patient_id" type="hidden" value="{{$patient_id}}" name="patient_id">
                    <fieldset>
                        <legend>OB-Gyne</legend>
                        <div class="row">
                            <div class="large-3 column">
                                <label class="inline">Currently Pregnant:</label>
                            </div>
                            <div class="large-1 column">
                                <label class="inline"><input type="radio" class="{{ ($errors->has('currently_pregnant')) ? 'highlight_error' : '' }}" name="currently_pregnant"  id="currently_pregnant_no" value="0" @if(isset($currently_pregnant) || $currently_pregnant != 1) checked @endif>No</label>
                            </div>
                            <div class="large-1 column">
                                <label class="inline"><input type="radio" class="{{ ($errors->has('currently_pregnant')) ? 'highlight_error' : '' }}" name="currently_pregnant"  id="currently_pregnant_yes" value="1" @if(isset($currently_pregnant) && $currently_pregnant == 1 ) checked @endif>Yes</label>
                            </div>
                            <div class="large-8 column">
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-3 column">
                                <label class="inline">Current Age of Gestation:</label>
                            </div>
                            <div class="large-4 column">
                                <input type="text" name="gestation_age" id="gestation_age" class="{{ ($errors->has('gestation_age')) ? 'highlight_error' : '' }}" value="{{ @$gestation_age }}">
                            </div>
                            <div class="large-6 column">
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-3 column">
                                <label class="inline">If delivered, date of delivery:</label>
                            </div>
                            <div class="large-4 column">
                                <input type="text" name="delivery_date" class="fdatepicker" id="date_of_delivery" value="{{ ($delivery_date != "-0001-11-30 00:00:00" || $delivery_date != "")? Carbon\Carbon::parse($delivery_date)->format('m/d/Y'):"" }}">
                            </div>
                            <div class="large-6 column">
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-3 column">
                                <label class="inline">Type of Infant feeding:</label>
                            </div>
                            <div class="large-4 column">
                                <label>
                                    <select name="feeding_type" id="feeding_type">
                                        <option selected disabled>--Please Select--</option>
                                        <option value="1" {{ ($feeding_type == 1)? 'selected="selected"' : '' }} >Breastfeeding</option>
                                        <option value="2" {{ ($feeding_type == 2)? 'selected="selected"' : '' }} >Formula Feeding</option>
                                        <option value="3" {{ ($feeding_type == 3)? 'selected="selected"' : '' }} >Mixed Feeding</option>
                                    </select>
                                </label>
                            </div>
                            <div class="large-6 column">
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 column">
                                <legend>Pap Smear</legend>
                                <textarea name="pap_smear" rows="5">{{ $pap_smear }}</textarea>
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <div class="row">
                        <div class="medium-12 columns">
                            <div class="right">
                                {!! csrf_field() !!}
                                <button class="button success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                <a href="{{ route('patient_profile', $patient_id) }}" class="button alert" title="Cancel"><i class="fi fi-x"></i> Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script type="text/javascript">
var update_select = function () {
    if($('#currently_pregnant_no').is(':checked'))
        {
            $('#gestation_age').val('');
            $('#date_of_delivery').val('');
            $('#feeding_type').val('');
        }
        $('#gestation_age').attr('readonly', $('#currently_pregnant_no').is(':checked'));
        $('#date_of_delivery').attr('disabled', $('#currently_pregnant_no').is(':checked'));
        $('#feeding_type').attr('disabled', $('#currently_pregnant_no').is(':checked'));
    };

$(update_select);
$('#currently_pregnant_no').change(update_select);
$('#currently_pregnant_yes').change(update_select);


</script>



@endsection

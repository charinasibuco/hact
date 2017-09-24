@extends('hact.layouts.layout_admin')

@section('content')
    <div class='row'>
        <div class='large-12 columns'>
            <ul class="breadcrumbs">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('patient_profile',$patient_id) }}">{{ $patient->code_name }}</a></li>
                <li class="current">OB Gyne</li>
                <li class="current"><a href="#">Edit</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="large-12 column">
            @include("hact.messages.success")
            @include("hact.messages.error_list")
        </div>
    </div>
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <div class="custom-panel-heading">
                <span>Edit OB-Gyne</span>
                <a href="{{ route('patient_profile',$patient_id) }}" class="alert tiny button right" title="Cancel Checkup"><i class="fi fi-x"></i> Cancel</a>
            </div>
            <div class="custom-panel-details">
                <fieldset>
                    <div class="row">
                        <div class="large-4 columns">
                            <label for="search_patient">Patient</label>
                            <div class="row collapse">
                                <div class="small-10 columns">
                                    <input type="text" id="search_vct" name="search_vct" value="{{ $patient->code_name }}" readonly />
                                    {{--<input type="hidden" id="patient_id" name="patient_id" value="{{ $patient_id }}" />--}}
                                    <input type="hidden" id="search_vct_url" name="search_vct_url" value="{{ route('ob_gyne_search') }}" />
                                </div>
                                <div class="small-2 columns">
                                    <span class="postfix"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <form action="{{ route('ob_gyne_update',$obgyne->id) }}" method="post">
                    <input id="patient_id" type="hidden" value="{{$patient->id}}" name="patient_id">
                    <fieldset>
                        <legend>OB-Gyne</legend>
                        <div class="row">
                            <div class="large-3 column">
                                <label class="inline">Currently Pregnant:</label>
                            </div>
                            <div class="large-1 column">
                                <label class="inline"><input type="radio" name="currently_pregnant"  id="currently_pregnant_no" value="0" {{ ($obgyne->currently_pregnant == 'No')? 'checked="checked"':''}}>No</label>
                            </div>
                            <div class="large-1 column">
                                <label class="inline"><input type="radio" name="currently_pregnant"  id="currently_pregnant_yes" value="1" {{ ($obgyne->currently_pregnant == 'Yes')? 'checked="checked"':''}}>Yes</label>
                            </div>
                            <div class="large-8 column">
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-3 column">
                                <label class="inline">Current Age of Gestation:</label>
                            </div>
                            <div class="large-4 column">
                                <input type="text" name="gestation_age" id="gestation_age" value="{{ $obgyne->currently_pregnant_if_yes_gestation_age }}">
                            </div>
                            <div class="large-6 column">
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-3 column">
                                <label class="inline">If delivered, date of delivery:</label>
                            </div>
                            <div class="large-4 column">
                                <input type="text" name="delivery_date" class="fdatepicker" id="date_of_delivery" value="{{ ($obgyne->if_delivered_date != NULL) ?$obgyne->if_delivered_date->format('M j Y') :''}}">
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
                                        <option>--Please Select--</option>
                                        <option value="1" {{ ($obgyne->infant_type == 'Breastfeeding')? 'selected="selected"' : '' }} >Breastfeeding</option>
                                        <option value="2" {{ ($obgyne->infant_type == 'Formula Feeding')? 'selected="selected"' : '' }} >Formula Feeding</option>
                                        <option value="3" {{ ($obgyne->infant_type == 'Mixed Feeding')? 'selected="selected"' : '' }} >Mixed Feeding</option>
                                    </select>
                                </label>
                            </div>
                            <div class="large-6 column">
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 column">
                                <legend>Pap Smear</legend>
                                <textarea id="pap_smear" name="pap_smear" rows="5">{{ $obgyne->pap_smear }}</textarea>
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
        $('#date_of_delivery').attr('readonly', true);
        var update_select = function () {
            if($('#currently_pregnant_no').is(':checked'))
            {
                $('#gestation_age').val('');
                $('#date_of_delivery').val('');
                $('#feeding_type').val('');
                $('#pap_smear').html('');
            }
            $('#gestation_age').attr('readonly', $('#currently_pregnant_no').is(':checked'));
            $('#date_of_delivery').attr('disabled', $('#currently_pregnant_no').is(':checked'));
            $('#feeding_type').attr('disabled', $('#currently_pregnant_no').is(':checked'));
            $('#pap_smear').attr('readonly', $('#pap_smear').is(':checked'));
            
        };

        $(update_select);
        $('#currently_pregnant_no').change(update_select);
        $('#currently_pregnant_yes').change(update_select);


    </script>



@endsection

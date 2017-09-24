<fieldset>
    <div class="row">
        <div class="large-4 columns">
            <label for="enrolment_date">Enrolment Date: </label><input type="text" id="enrolment_date" name="enrolment_date" value="{{ ($patient->enrolment_date)?($patient->enrolment_date->format('m/d/Y') != "11/30/-0001"?$patient->enrolment_date->format('m/d/Y'):""):"" }}" placeholder="Date of Enrolment" readonly>
           </div>
        <div class="large-8 columns right-align">
            <label for="phil_health_number">Phil Health Number: </label><input type="text" id="phil_health_number" name="phil_health_number" value="{{ $patient->phil_health_number }}" placeholder="Phil Health Number" readonly>
        </div>
        </div>

    <div class="row">
        <div class="large-8 columns">
            <label for="code_name">Code Name</label><input type="text" id="code_name" name="code_name" value="{{  $patient->code_name }} " placeholder="Code Name" readonly>
        </div>
        <div class="large-4 columns">&nbsp;</div>
    </div>

    <div class="row">
        <div class="large-4 columns">
            <label for="nationality">Nationality: </label>
            <input type="text" id="nationality" name="nationality" value="{{ $patient->nationality }}" readonly />
        </div>
        <div class="large-4 columns">
            <label for="birth_date">Birth Date </label>
            <input type="text" id="birth_date" name="birth_date" value="{{ $patient->birth_date->format('m/d/Y') }}" placeholder="Birth Date" readonly />
        </div>
        <div class="large-2 columns">
            <label for="age">Age</label>
            <div class="row">
                <div class="large-8 columns">
                    <input type="text" id="age" name="age" value="" readonly>
                </div>
                <div class="large-4 columns">&nbsp;</div>
            </div>
        </div>
        <div class="large-2 columns">
            <label for="dependents"> Number of Children</label>
            <div class="row">
                <div class="large-8 columns">
                    <input type="text" id="dependents" name="dependents" value="{{ $patient->dependents }}" readonly />
                </div>
                <div class="large-4 columns">&nbsp;</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="large-4 columns">
            <label for="gender">Gender</label>
            {{ $patient->gender_format }}
        </div>
        <div class="large-8 columns">
            <label for="single">Civil Status </label>
            {{$patient->civil_status_format}}
        </div>
    </div>
    <div class="row">
        <div class="large-4 columns">
            <label for="partner_no">Are you living with a partner? </label>
            <label>{{$patient->is_living_with_partner_format}}</label>
        </div>
        <div class="large-4 columns is_presently_pregnant_div">
            <label for="pregnant_no">Are you presently pregnant?</label>
            <label>{{ $patient->is_presently_pregnant_format}}</label>
        </div>
        <div class="large-4 columns">&nbsp;</div>
    </div>
</fieldset>

<fieldset>
    <legend>Unique Identifier Code</legend>
    <div class="row">
        <div class="large-4 columns">
            <div class="row">
                <div class="large-12 columns text-center">
                    <label for="ui_code1">First 2 letters of mother's real name</label>
                </div>
            </div>
            <div class="row">
                <div class="large-4 columns">&nbsp;</div>
                <div class="large-4 columns">
                    <input type="text" id="ui_code1" name="ui_code1" value="{{ $ui_code1 }}" placeholder="" maxlength="2" class="text-center" readonly>
                </div>
                <div class="large-4 columns">&nbsp;</div>
            </div>
        </div>
        <div class="large-4 columns">
            <div class="row">
                <div class="large-12 columns text-center">
                    <label for="ui_code2">First 2 letters of father's real name</label>
                </div>
            </div>
            <div class="row">
                <div class="large-4 columns">&nbsp;</div>
                <div class="large-4 columns">
                    <input type="text" id="ui_code2" name="ui_code2" value="{{ $ui_code2 }}" placeholder="" maxlength="2" class="text-center" readonly>
                </div>
                <div class="large-4 columns">&nbsp;</div>
            </div>
        </div>
        <div class="large-4 columns">
            <div class="row">
                <div class="large-12 columns text-center">
                    <label for="ui_code3">Birth Order</label>
                </div>
            </div>
            <div class="row">
                <div class="large-4 columns">&nbsp;</div>
                <div class="large-4 columns">
                    <input type="text" id="ui_code3" name="ui_code3" value="{{  $ui_code3 }}" placeholder="" maxlength="2" class="text-center" readonly>
                </div>
                <div class="large-4 columns">&nbsp;</div>
            </div>

        </div>
    </div>
</fieldset>

<fieldset>
    <legend>Address</legend>
    <div class="row">
        <div class="large-12 columns">
            <label for="permanent_address">Permanent Address: </label><input type="text" id="permanent_address" name="permanent_address" value="{{ $patient->permanent_address }}" placeholder="Permanent Address" readonly>
        </div>
    </div>
    <div class="row">
        <div class="large-6 columns">
            <label for="current_city">Current Municipality/City: </label><input type="text" id="current_city" name="current_city" value="{{ $patient->current_city }}" placeholder="Current Municipality/City" readonly>
        </div>
        <div class="large-6 columns">
            <label for="current_province">Current Province: </label><input type="text" id="current_province" name="current_province" value="{{ $patient->current_province }}" placeholder="Current Province" readonly>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend>Place of Birth</legend>
    <div class="row">
        <div class="large-6 columns">
            <label for="birth_place_city">Municipality/City: </label>
            <input type="text" id="birth_place_city" name="birth_place_city" value="{{ $patient->birth_place_city }}" placeholder="Municipality/City of Birth" readonly>
        </div>
        <div class="large-6 columns">
            <label for="birth_place_province">Province: </label>
            <input type="text" id="birth_place_province" name="birth_place_province" value="{{ $patient->birth_place_province }}" placeholder="Province of Birth" readonly>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend>Contact Details</legend>
    <div class="row">
        <div class="large-4 columns">
            <label for="contact_number">Contact Number: </label><input type="text" id="contact_number" name="contact_number" value="{{$patient->contact_number }}" placeholder="Contact Number" readonly>
        </div>
        <div class="large-4 columns">
            <label for="email">Email: </label><input type="email" id="email" name="email" value="{{ $patient->email }}" placeholder="Email" readonly>
        </div>
        <div class="large-4 columns">&nbsp;</div>
    </div>
</fieldset>


<fieldset>
    <legend>Highest Educational Attaintment</legend>
    <div class="row">
        <div class="large-4 columns">
            {{$patient->highest_educational_attainment_format}}
        </div>

    </div>
</fieldset>

<fieldset>
    <legend>Employment</legend>
    <div class="row">
        <div class="large-2 columns">
            <label for="working_yes">Currently Working? </label>
            <label>{{$patient->is_working_format}}</label>
        </div>
        <div class="large-5 columns current_occupation">
            <label for="current_occupation">Current Occupation: </label>
            <input type="text" id="current_occupation" name="current_occupation" value="{{ $patient->current_occupation }}" placeholder="Current Occupation" readonly>
        </div>
        <div class="large-5 columns previous_occupation">
            <label for="previous occupation">Previous Occupation: </label>
            <input type="text" id="previous_occupation" name="previous_occupation" value="{{ $patient->previous_occupation }}" placeholder="leave blank if never been employed" readonly>
        </div>
    </div>
    <div class="row">
        <div class="large-7 columns">
            <label for="abroad_no">Do you work overseas/abroad in the past 5 years? </label>
            <label>{{$patient->is_work_abroad_in_past_5years_format}}</label>
        </div>
        <div class="large-5 columns work_abroad">
            <label for="last_contract">When did you return from your last contract? </label>
            <input type="text" id="last_contract" name="last_contract" value="{{ ($patient->last_contract != null) ? $patient->last_contract->format('m/d/Y') : '' }}"  readonly>
        </div>
    </div>
    <div class="row work_abroad">
        <div class="large-7 columns">
            <label for="ship">Where were you based? </label>
            <label>{{$patient->is_based_format}}</label>
        </div>
        <div class="large-5 columns">
            <label for="last_work_country">What country did you last work in?</label>
            <input type="text" id="last_work_country" name="last_work_country" value="{{$patient->last_work_country}}" readonly>
        </div>
    </div>
</fieldset>

<script>
<?php
$work_abroad         = $patient->is_work_abroad_in_past_5years_format;
$working             = $patient->is_working_format;
$previous_occupation = $patient->previous_occupation;
if($work_abroad == 'No')
echo '$(\'.work_abroad\').hide();';
else
echo '$(\'.work_abroad\').show();';

if($working == 'No')
echo '$(\'.current_occupation\').hide();';
else
echo '$(\'.current_occupation\').show();';

if($previous_occupation == null)
echo '$(\'.previous_occupation\').hide();';
else
echo '$(\'.previous_occupation\').show();';    

?>
</script>

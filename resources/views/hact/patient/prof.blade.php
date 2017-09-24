
    <div class="row">
        <div class="large-12 columns">
            <div class="panel">
                <div class="row">
                    <div class="large-5 columns text-right"><label>Code Name</label></div>
                    <div class="large-7 columns">{{ $patient->code_name }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>UI Code</label></div>
                    <div class="large-7 columns">{{ $patient->ui_code }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Phil Health No.</label></div>
                    <div class="large-7 columns">{{ $patient->phil_health_number }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Birth Date</label></div>
                    <div class="large-7 columns">{{ $patient->birth_date_format }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>No. of Children</label></div>
                    <div class="large-7 columns">{{ $patient->dependents }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Gender</label></div>
                    <div class="large-7 columns">{{ $patient->gender_format }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Nationality</label></div>
                    <div class="large-7 columns">{{ $patient->nationality }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Civil Status</label></div>
                    <div class="large-7 columns">{{ $patient->civil_status_format }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Permanent Address</label></div>
                    <div class="large-7 columns">{{ $patient->permanent_address }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Current City</label></div>
                    <div class="large-7 columns">{{ $patient->current_city }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Current Province</label></div>
                    <div class="large-7 columns">{{ $patient->current_province }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Birth of Place City</label></div>
                    <div class="large-7 columns">{{ $patient->birth_place_city }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Birth of Place Province</label></div>
                    <div class="large-7 columns">{{ $patient->birth_place_province }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Contact Number</label></div>
                    <div class="large-7 columns">{{ $patient->contact_number }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>EMail</label></div>
                    <div class="large-7 columns">{{ $patient->email }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Highest Educational Attainment</label></div>
                    <div class="large-7 columns">{{ $patient->highest_educational_attainment_format }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Are you living with a partner?</label></div>
                    <div class="large-7 columns">{{ $patient->is_living_with_partner_format }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Currently Working?</label></div>
                    <div class="large-7 columns">{{ $patient->is_working_format }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Current Occupation</label></div>
                    <div class="large-7 columns">{{ $patient->current_occupation }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Previous Occupation</label></div>
                    <div class="large-7 columns">{{ $patient->previous_occupation }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Do you work overseas/abroad in the past 5 years?</label></div>
                    <div class="large-7 columns">{{ $patient->is_work_abroad_in_past_5years_format }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>When did you return from your last contract?</label></div>
                    <div class="large-7 columns">{{ $patient->last_contract_format }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>Where were you based?</label></div>
                    <div class="large-7 columns">{{ $patient->is_based_format }}</div>
                </div>

                <div class="row">
                    <div class="large-5 columns text-right"><label>What country did you last work in?</label></div>
                    <div class="large-7 columns">{{ $patient->last_work_country }}</div>
                </div>
            </div>
        </div>
    </div>




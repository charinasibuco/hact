<!-- Mortality Records -->
@if(!is_null($mortality))
    <br/>
    <div class="row">
        <div class="large-2 columns"><a href="{{ route('mortality_edit',$patient->id) }}" class="small expand alert button"><i class="fa fa-pencil-square-o fa-lg"></i> Edit</a></div>
        <div class="large-2 columns"><a href="{{ route('mortality_destroy',$patient->id) }}" class="small expand alert button"><i class="fa fa-times fa-lg"></i> Delete</a></div>
         <div class="large-4 columns text-center"><h4 class="profile-heading">Mortality Record</h4></div>
        <div class="large-4 columns"></div>
    </div>

    <div class="row overflow">
        <div class="large-12 columns text-center overflow-profile">
            <div class="row">
                <div class="large-12 columns">
                    <table width="100%">
                        <thead>
                        <tr>
                            <td colspan="3" style="width:40%;"><a href="#">Date of Death</a></td>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td colspan="3">{{ $mortality->date_of_death->format('m/d/Y') }}</td>
                        </tr>
                        </tbody>

                        <thead>
                        <tr>
                            <td colspan="3"><a href="#">Cause of Death</a></td>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td style="width:40%;">
                                <div class="row">
                                    <div class="large-6 columns text-right">
                                        <strong>HIV Related</strong>
                                    </div>
                                    <div class="large-6 columns">
                                        {{ $mortality->is_hiv_related_format }}
                                    </div>
                                </div>
                            </td>
                            <td style="width:35%;">
                                <div class="row">
                                    <div class="large-6 columns text-right">
                                        <strong>Immediate Cause</strong>
                                    </div>
                                    <div class="large-6 columns">
                                        {{ $mortality->immediate_cause }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="large-6 columns text-right">
                                        <strong>Antecedent Cause</strong>
                                    </div>
                                    <div class="large-6 columns">
                                        {{ $mortality->antecedent_cause }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="large-6 columns text-right">
                                        <strong>Underlying Cause</strong>
                                    </div>
                                    <div class="large-6 columns">
                                        {{ $mortality->underlying_cause }}
                                    </div>
                                </div>
                            </td>
                            <td style="width:25%;">
                                <div class="row">
                                    <div class="large-6 columns text-right">
                                        <strong>ICD-10 Code</strong>
                                    </div>
                                    <div class="large-6 columns">
                                        {{ $mortality->immediate_icd10_code }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="large-6 columns text-right">
                                        <strong>ICD-10 Code</strong>
                                    </div>
                                    <div class="large-6 columns">
                                        {{ $mortality->antecedent_icd10_code }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="large-6 columns text-right">
                                        <strong>ICD-10 Code</strong>
                                    </div>
                                    <div class="large-6 columns">
                                        {{ $mortality->underlying_icd10_code }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>

                        <thead>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="large-12 columns">
                                        {{--<a href="#">Opportunistic infections present prior to death</a>--}}
                                        <a href="#">Concomitant</a>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="row">
                                    <div class="large-12 columns">
                                        <a href="#">CD4 Count</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td >
                                <div class="row">
                                    <div class="large-12 columns text-center">
                                        @if($mortality->tuberculosis == 1)
                                            Tuberculosis<br/>
                                        @endif

                                        @if($mortality->pneumocystis_pneumonia == 1)
                                            Pneumocystis Pneumonia<br/>
                                        @endif

                                        @if($mortality->cryptococcal_meningitis == 1)
                                            Cryptococcal Meningitis<br/>
                                        @endif

                                        @if($mortality->cytomegalovirus == 1)
                                            Cytomegalovirus<br/>
                                        @endif

                                        @if($mortality->candidiasis == 1)
                                            Candidiasis<br/>
                                        @endif

                                        @if($mortality->other)
                                            Other: {{ $mortality->other }}<br/>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="large-6 columns text-right">
                                        <strong>Have CD4 Record</strong>
                                    </div>
                                    <div class="large-6 columns">
                                        {{ $mortality->have_cd4_info_format }}
                                    </div>
                                </div>
                                @if($mortality->have_cd4_info == 1)
                                    <div class="row">
                                        <div class="large-6 columns text-right">
                                            <strong>Last CD4 Count</strong>
                                        </div>
                                        <div class="large-6 columns">
                                            {{ $mortality->last_cd4_count_format }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="large-6 columns text-right">
                                            <strong>CD4 Count</strong>
                                        </div>
                                        <div class="large-6 columns">
                                            {{ $mortality->cd4_count }}
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="large-6 columns text-right">
                                        <strong>Have Taken ARVs</strong>
                                    </div>
                                    <div class="large-6 columns">
                                        {{ $mortality->have_taken_arv_format }}
                                    </div>
                                </div>
                            <td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <ul data-accordion="" class="accordion">
                        <li class="accordion-navigation"><a href="#panel1a">Death Certificate</a>
                            <div id="panel1a" class="content">
                                <img src="{{ asset($mortality->death_certificate) }}" alt="no image available">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
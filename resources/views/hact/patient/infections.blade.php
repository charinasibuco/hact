<!-- Infections Records -->
@if( count($infections_report) > 0)
    <div class="row">
        <div class="large-12 columns text-center"><h4 class="profile-heading">Infection Records</h4></div>
    </div>

    <div class='row overflow'>
        <div class='large-12 columns overflow-profile'>
            <table class="responsive" width="100%">
                <thead>
                <tr>
                    <th width="10%">
                        {{--@if(Auth::user()->access == 1)
                            <a href="{{ route('infections_create',$patient->id) }}"><i class="fa fa-plus fa-lg"></i></a>
                        @endif--}}
                    </th>
                    <th class="main-column">Date</th>
                    <th>Clinical Stage</th>
                    <th>WHO Classifications</th>
                    <th>Previous Diagnosed Infections</th>
                </tr>
                </thead>
                <tbody>
                @foreach($infections_report as $infections)
                    <tr>
                        <td>
                            {{--@if(Auth::user()->access == 1)
                                <a href="{{ route('infections_edit', [$infections->patient_id, $infections->order_number]) }}" title="Edit Infections Report">
                                    <i class="fa fa-edit fa-lg"></i>
                                </a>
                            @endif--}}
                        </td>
                        <td class="main-column">{{ $infections->result_date->format('m/d/Y') }}</td>
                        <td>
                            {{ $infections->clinical_stage }}
                        </td>
                        <td>
                            <a href="#" data-reveal-id="modal{{ $infections->id }}">View Clinical Staging <i class="fa fa-hospital-o"></i></a>
                            <div style = "text-align:center" id="modal{{ $infections->id }}" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                                <table width="100%">
                                    <thead>
                                    <tr>
                                        <td width="5%">
                                            Stage
                                        </td>
                                        <td width="95%">
                                            Infection Description
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($infections->infections_clinical_stage as $ics)
                                        <tr>
                                            <td>
                                                {{ $ics->details->stage }}
                                            </td>
                                            <td>
                                                {{ $ics->details->infection_name }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                            </div>
                        </td>
                        <td>
                            <ul>
                                {!! ($infections->hepatitis_b == 1) ? "<li>Hepatitis B</li>": "" !!}
                                {!! ($infections->hepatitis_c == 1) ? "<li>Hepatitis C</li>": "" !!}
                                {!! ($infections->pneumocystis_pneumonia == 1) ? "<li>Pneumocystis Pneumonia</li>": "" !!}
                                {!! ($infections->orpharyngeal_candidiasis == 1) ? "<li>Oropharyngeal Candidiasis</li>": "" !!}
                                {!! ($infections->syphilis == 1) ? "<li>Syphilis</li>": "" !!}
                                {!! ($infections->stis != "") ? "<li>STIs:".$infections->stis."</li>": "" !!}
                                {!! ($infections->others != "") ? "<li>Others:".$infections->others."</li>": "" !!}
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
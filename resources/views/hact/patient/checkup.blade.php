<!-- CheckUp Records -->

@if( count($checkups) > 0 )
    <div class="row">
        <div class="large-12 columns text-center"><h4 class="profile-heading">Consultation Records</h4></div>
    </div>
    <div class='row overflow'>
        <div class='large-12 columns overflow-profile'>
            {{--@include('hact.messages.success')
            @include('hact.messages.error_list')--}}
            <button href="javascript:void(0)" data-dropdown="dropdown_consultation_history" aria-controls="drop1" aria-expanded="false" class="small button secondary dropdown">Printable Consultation History</button>
            <br/><br/>
            <ul id="dropdown_consultation_history" data-dropdown-content class="f-dropdown" aria-hidden="true" role="menu" style="min-width:100px">
                <li>
                    <a href="{{ route('checkup_history', $patient->id) }}" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Full Details</a>
                </li>
                <li>
                    <a href="{{ route('checkup_history_small', $patient->id) }}" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Simple</a>
                </li>
            </ul>
            <table width="100%" class="responsive">
                <tr>
                    <th width="10%"></th>
                    <th class="main-column" scope="column" width="15%"><a href="#">Consultation Date</a></th>
                    <th scope="column" width="15%"><a href="#">Follow up Date</a></th>
                    <th width="20%"><a href="#">Chief Complaints</a></th>
                    <th width="25%"><a href="#">General Assessments</a></th>
                    <th width="25%"><a href="#">Medicine Prescribed</a></th>
                    {{--<th width="30%"><a href="#">TB Screening</a></th>--}}
                </tr>
                @foreach($checkups as $row)
                    <tr>
                        <td>
                            <a href="{{ route('checkup_edit', $row->id) }}" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
                            <a href="{{ route('checkup_show', $row->id) }}" target="_blank" title="Show Full Form"><i class="fa fa-file-text fa-lg"></i></a>
                            <a data-confirm href="{{ route('checkup_destroy', $row->id) }}" title="Delete Consultation Record"><i class="fa fa-times fa-lg"></i></a>
                        </td>

                        <td class="main-column">{{ $row->checkup_date->format('m/d/Y') }}</td>
                        <td>{{ $row->follow_up_date->format('m/d/Y') }}</td>
                        <td>{{ $row->patient_complaints }}</td>
                        <td>{{ $row->remarks }}</td>
                        <td>
                            @if($row->prescriptions && count($row->prescriptions) > 0)
                                <table width="100%">
                                    <thead>
                                    <tr>
                                        <td>Medicine</td>
                                        <td>Pills/Day</td>
                                        <td>Dosage</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($row->prescriptions as $prescription)
                                        <tr>
                                            @if($prescription->prescription_type == 'arv')
                                                <td>{{ ($prescription->Medicine ) ?  $prescription->Medicine->name : '' }}</td>

                                            @elseif($prescription->prescription_type == 'oi' || $prescription->prescription_type == 'others')
                                                <td>{{ $prescription->specified_medicine }}</td>
                                            @endif
                                            <td>{{ $prescription->pills_per_day }}</td>
                                            <td>{{ $prescription->suggested_dosage }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            @endif
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
    <script>
        $(document).confirmWithReveal({
            body: "This action cannot be undone."
        });
    </script>
@endif
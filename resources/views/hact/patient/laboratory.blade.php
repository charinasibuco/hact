<!-- Laboratory Records -->
@if( count($laboratories) > 0)
    <br/>
<div class="row">
    <div class="large-12 columns text-center"><h4 class="profile-heading">Laboratory Records</h4></div>
</div>

<div class="row overflow">
    <div class='large-12 columns overflow-profile'>
        <ul class="accordion" data-accordion>
            @foreach($laboratory_tests as $test)
                @if($laboratories->where('laboratory_test_id',$test->id)->count() > 0)
                    <li class="accordion-navigation">
                        <a href="#panel{{$test->id}}">
                            {{ $test->description }}
                        </a>
                        <div id="panel{{$test->id}}" class="content">
                            <table class="responsive" width="100%">
                                <thead>
                                <tr>
                                    <th width="10%">
                                        @if($test->id < 8)
                                            <a href="{{ route('laboratory_chart', [$patient->id,$test->id,'']) }}"><i class="fa fa-line-chart fa-lg"></i></a>
                                        @endif
                                    </th>
                                    @if($laboratories->where('laboratory_test_id', $test->id)->first()->LaboratoryType->description != $test->description)
                                    <th width="30%">Laboratory Name</th>
                                   @endif
                                    <th width="20%">Laboratory Result</th>
                                    <th class="main-column" width="20%">Result Date</th>
                                    <th width="20%">Image</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($laboratories->where('laboratory_test_id', $test->id) as $row)

                                    <tr>
                                        <td>{{-->@if(Auth::user()->access == 1)--}}
                                            @if($row->laboratory_type_id == $row->LaboratoryType->LaboratoryTest->LaboratoryType()->first()->id)
                                                <a href="{{ route('laboratory_edit', $row->id) }}" title="Edit Laboratory">
                                                    <i class="fa fa-edit fa-lg"></i></a>
                                                <a href="{{ route('laboratory_destroy', $row->id) }}" title="Delete Laboratory">
                                                    <i class="fa fa-times fa-lg"></i></a>
                                            @endif
                                            {{--@endif--}}
                                        </td>
                                        @if($row->LaboratoryType->description != $test->description)
                                            <td>{{ $row->LaboratoryType->description }}</td>
                                        @endif
                                        <td>{{ $row->result }}</td>
                                        <td class="main-column">{{ $row->result_date_format }}</td>
                                        <td>
                                            @if($row->laboratory_type_id == $row->LaboratoryType->LaboratoryTest->LaboratoryType()->first()->id)
                                                @if($row->image != "")
                                                    <a href="#" data-reveal-id="modal{{ $row->id }}">View Image <i class="fa fa-file-image-o"></i></a>
                                                @else
                                                    <span style = "font-style:italic">No Image Available</span>
                                                @endif
                                            @endif
                                        </td>

                                        <div style = "text-align:center" id="modal{{ $row->id }}" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                                            <img src="{{ asset($row->image) }}" >
                                            <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                                        </div>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </li>
                @endif
            @endforeach
            @foreach($other_laboratories as $other)
                @if($laboratories->where('other', $other->other)->count() > 0)
                    <li class="accordion-navigation">
                        <a href="#panel{{$other->slugOther()}}">
                            {{ $other->other }}
                        </a>
                        <div id="panel{{$other->slugOther()}}" class="content">
                            <table width="100%">
                                <thead>
                                <tr>
                                    <th width="10%">
                                        {{--<a href="{{ route('laboratory_chart', [$laboratories->where('other', $other->other)->first()->patient_id,16,$other->other]) }}"><i class="fa fa-line-chart fa-lg"></i></a>--}}
                                    </th>
                                    <th width="30%">Laboratory Result</th>
                                    <th width="30%">Result Date</th>
                                    <th width="30%">Image</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($laboratories->where('other', $other->other) as $row)
                                        <tr>
                                            <td>
                                                {{--@if(Auth::user()->access == 1)--}}
                                                    <a href="{{ route('laboratory_edit', $row->id) }}" title="Edit Laboratory">
                                                        <i class="fa fa-edit fa-lg"></i></a>
                                                    <a href="{{ route('laboratory_destroy', $row->id) }}" title="Delete Laboratory">
                                                        <i class="fa fa-times fa-lg"></i></a>
                                                {{--@endif--}}
                                            </td>
                                            <td>{{ $row->result }}</td>
                                            <td>{{ $row->result_date_format }}</td>
                                            <td>
                                                @if($row->image != "")
                                                    <a href="javascript:void(0);" data-reveal-id="modal{{ $row->id }}">View Image <i class="fa fa-file-image-o"></i></a>
                                                @else
                                                    <span style = "font-style:italic">No Image Available</span>
                                                @endif
                                            </td>

                                            <div style = "text-align:center" id="modal{{ $row->id }}" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                                                <img src="{{ asset($row->image) }}" >
                                                <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                                            </div>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
@endif
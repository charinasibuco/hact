@extends('hact.layouts.layout_admin')

@section('content')
<div class="row">
    <div class="large-12 columns">
        @include("hact.messages.success")
        @include("hact.messages.error_list")
    </div>
</div>
<div class="row">
	<div class="large-12 columns">
		<ul class="breadcrumbs">
			<li class="current"><a href="#">Dashboard</a></li>
		</ul>
	</div>
</div>
<div id="intro-dashboard">
    <div class="row">
        <div class="large-3 columns">
            <div class="stats">
                <div class="stats-title">
                    <span>Medicine(s)</span> <span class="label radius default right">Items In stock</span>
                    {{-- <span class="label radius alert right">Patients</span>--}}
                </div>
                <div class="stats-body">
                    <span> {{ $instock_medicine }}</span> <i class="fi-arrow-up"></i>
                </div>
            </div>
        </div>
        <div class="large-3 columns">
            <div class="stats">
                <div class="stats-title">
                    <span>Medicine(s)</span>
                    <span class="label radius warning right">Warning (less than 100 bottles)</span>
                    {{--<span class="label radius success right">Total</span>--}}
                </div>
                <div class="stats-body">
                    <span> {{ $warning_stock_medicine }} </span> <i class="fi-arrow-down"></i>
                </div>
            </div>
        </div>
        <div class="large-3 columns">
            <div class="stats">
                <div class="stats-title">
                    <span>Medicine(s)</span>
                    <span class="label radius alert right">Critical (less than 20 bottles)</span>
                </div>
                <div class="stats-body">
                    <span>{{ $critical_stock_medicine }}</span> <i class="fi-arrow-down"></i>
                </div>
            </div>
        </div>
        <div class="large-3 columns">
            <div class="stats">
                <div class="stats-title">
                    <span>Medicine(s)</span> <span class="label radius alert right">Out of Stock</span>
                </div>
                <div class="stats-body">
                    <span>{{ $out_of_stock }}</span>
                </div>
            </div>
        </div>

    </div>
</div>
<div id="dashboard-body">

    <div class="row">
        <div class="small-12 medium-6 large-8 columns">
            <div class="row">
                <div class="large-12">
                    <div class="custom-panel-heading">
                        <h5 class="white">CHART</h5>
                    </div>
                    <div class="custom-panel-details">
                        {{--<div id="morris-area-chart"></div>--}}
                        <form id="chart" action="#" method="get">
                            <div class="row">
                                <div class="large-4 columns">
                                    <label for="chart_type">Type</label>
                                    <select id="chart_type" name="chart_type">
                                        <optgroup label="Patient">
                                            <option value="patient_male_and_female">Male and Female</option>
                                        </optgroup>
                                        <optgroup label="VCT">
                                            <option value="vct_result">Results</option>
                                        </optgroup>
                                        <optgroup label="Infections">
                                            <option value="infections_result">Results</option>
                                            <option value="infections_hiv_stages_result">HIV Stages Results</option>
                                        </optgroup>
                                        <optgroup label="Tuberculosis">
                                            <option value="tuberculosis_result">Records</option>
                                        </optgroup>
                                        <optgroup label="Mortality">
                                            <option value="mortality_result">Records</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="large-3 columns">
                                    <label for="type">Type</label>
                                    <select id="type" name="type">
                                        <option value="all">All</option>
                                        <option value="year">Year</option>
                                    </select>
                                </div>
                                <div class="large-3 columns">
                                    <label for="year">Year</label>
                                    <select id="year" name="year" disabled></select>
                                </div>
                                <div class="large-2 columns">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="button tiny alert expand">Generate</button>
                                </div>
                            </div>

                        </form>
                        <br />
                        <div id="chart_area"></div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="large-12">
                    <div class="custom-panel-heading">
                        <h5 class="white">PHARMACY</h5>
                    </div>
                    <div class="custom-panel-details">
                        <p>Re-stocking schedule</p>
                        @foreach($medicines as $row)
                            @if($row->current_stock <= 100)
                                <div class="row">
                                    <div class="small-12 columns">{{ $row->name }}</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="large-12">
                    <div class="row">
                        <div class="large-6 columns">
                            <div class="custom-panel-heading">
                                <h5 class="white">OB-GYNE</h5>
                            </div>
                            <div class="custom-panel-details">
                                <p>This month delivery date</p>
                                <div class="notif-list">
                                    @foreach($ob as $row)
                                        <div class="row">
                                            <div class="small-12 columns"><a href="{{ route("patient_profile",$row->patient->id) }}">{{ $row->patient->code_name }} ( {{ $row->if_delivered_date }} )</a></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="large-6 columns">
                            <div class="custom-panel-heading">
                                <h5 class="white">Mortality</h5>
                            </div>
                            <div class="custom-panel-details">
                                <p>Latest Deceased Patient</p>
                                <div class="notif-list">
                                    @foreach($mortality as $row)
                                        <div class="row">
                                            <div class="small-12 columns"><a href="{{ route("patient_profile",$row->patient->id) }}">{{ $row->patient->code_name }} ( {{ $row->date_of_death_format }} )</a></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="small-12 medium-6 large-4 columns">
            <div class="row">
                <div class="medium-12 column">
                    <div class="custom-panel-heading">
                        <h5 class="white">VCT (Voluntary Counseling and Testing)</h5>
                    </div>
                    <div class="custom-panel-details">
{{--                         <p>VCT Follow-ups</p> --}}
                         <div class="row">
                            <div class="medium-7 column">
                                <p>Patients</p>
                            </div>
                            <div class="medium-5 column">
                                <p>Follow-Up Date</p>
                            </div>
                         </div>
                        <div class="notification notif-list">
                            @foreach($vct_follow_up as $row)
                                @if($row->last_vct_record->result != 2 || $row->last_vct_record->result != 3)
                                    @if($row->total_vct_record == 1)
                                            <!-- 2nd Visit -->
                                    <?php $next_vct = date('m/d/Y', strtotime("+90 days", strtotime($row->last_vct_record->vct_date))); ?>
                                        <div class="notification-details">
                                            <a href="{{ route("vct_create",$row->id) }}"> <i class="fi-alert"></i></a>
                                            <a href="{{ route("patient_profile",$row->id) }}"><span>{{ $row->code_name }}</span></a>
                                            <a href="{{ route("vct_create",$row->id) }}"><span class="label radius alert right">{{ $next_vct }}</span></a>
                                        </div>

                                        @else
                                                <!-- 3rd Visit and so on -->
                                    <?php $next_vct = date('m/d/Y', strtotime("+180 days", strtotime($row->last_vct_record->vct_date))); ?>
                                        <div class="notification-details">
                                            <i class="fi-alert"></i><span>{{ $row->code_name }}</span> <span class="label radius alert right">{{ $next_vct }}</span>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 column">
                    <div class="custom-panel-heading"><h5 class="white">CHECKUP LAB REQUESTS</h5></div>
                    <div class="custom-panel-details">
                        <p>Laboratory Requests to be Performed</p>
                        <div class="notif-list">
                            @foreach($checkup_request as $row)
                                @if($row->LaboratoryRequests->where('status',0)->count() > 0)
                                    <div class="row">
                                        <div class="small-12 columns">
                                            <a href="{{ route("patient_profile",$row->id) }}">{{ $row->patient->code_name }}</a><br />
                                            @foreach($row->LaboratoryRequests as $row_2)
                                                @if($row_2->status != 1)
                                                    <a class="block" data-confirm href="{{ route('lab_requests_complete',[$row_2->id, 2]) }}"><span class="label alert"><i class="fa fa-times fa-sm"></i> {{ $row_2->LaboratoryTest->description or $row_2->other_specify }}</span></a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 column">
                    <div class="custom-panel-heading"><h5 class="white">CHECKUP REFERRALS</h5></div>
                    <div class="custom-panel-details">
                        <p>Pending Checkup Referrals</p>
                        <div class="notif-list">
                            @foreach($checkup_request as $row)
                                @if($row->Referrals && !($row->Referrals->surgeon!=1 && $row->Referrals->ob_gyne!=1 && $row->Referrals->opthalmology!=1 &&$row->Referrals->dentis!=1 && $row->Referrals->psychiatrist!=1 && $row->Referrals->others_status != 1))
                                    <div class="row">
                                        <div class="small-12 columns">
                                            <a href="{{ route("patient_profile",$row->patient->id) }}">{{ $row->patient->code_name }}</a><br />
                                            Reason: {{ $row->Referrals->reason }}<br/>
                                            @if($row->Referrals->surgeon==1)
                                                <a class="block" data-confirm href="{{ route('referrals_complete', [$row->id, 1, 2]) }}"><span class="label alert"><i class="fa fa-times fa-sm"></i> Surgery</span></a>
                                            @endif
                                            @if($row->Referrals->ob_gyne==1)
                                                <a class="block" data-confirm href="{{ route('referrals_complete', [$row->id, 2, 2]) }}"><span class="label alert"><i class="fa fa-times fa-sm"></i> OB-Gyne</span></a>
                                            @endif
                                            @if($row->Referrals->opthalmology==1)
                                                <a class="block" data-confirm href="{{ route('referrals_complete', [$row->id, 3, 2]) }}"><span class="label alert"><i class="fa fa-times fa-sm"></i> Opthal</span></a>
                                            @endif
                                            @if($row->Referrals->dentis==1)
                                                <a class="block" data-confirm href="{{ route('referrals_complete', [$row->id, 4, 2]) }}"><span class="label alert"><i class="fa fa-times fa-sm"></i> Dentist</span></a>
                                            @endif
                                            @if($row->Referrals->psychiatrist==1)
                                                <a class="block" data-confirm href="{{ route('referrals_complete', [$row->id, 5, 2]) }}"><span class="label alert"><i class="fa fa-times fa-sm"></i> Psych</span></a>
                                            @endif
                                            @if($row->Referrals->others != '' && $row->Referrals->others_status != 2)
                                                <a class="block" data-confirm href="{{ route('referrals_complete', [$row->id, 6, 2]) }}"><span class="label alert"><i class="fa fa-times fa-sm"></i> {{ $row->Referrals->others }}</span></a>
                                            @endif
                                            <br/><br/>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    $('a.block').css('color', 'white');
    $(document).confirmWithReveal({
        body: "Are you sure you want to declare the referral/request as completed?"
    });
    $(".notif-list").css({"max-height":"190px","overflow":"auto","max-width":"100%","overflow-x":"hidden"});
</script>

@include('hact.home_chart_inc')

@endsection

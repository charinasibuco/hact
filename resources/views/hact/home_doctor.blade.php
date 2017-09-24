@extends('hact.layouts.layout_admin')

@section('content')

<div class="row">
	<div class="large-12 columns">
		<ul class="breadcrumbs">
			<li class="current"><a href="#">Home</a></li>
		</ul>
	</div>
</div>
<div id="dashboard-body">
    <div class="row">
        <div class="small-12 medium-6 large-8 columns">
            <div class="row">
                <div class="large-8 columns charts">
                    @include("hact.messages.success")
                    @include("hact.messages.error_list")
                </div>
            </div>
            <div class="row">
                <div class="large-12">
                    <div class="custom-panel-heading">
                        <h5 class="white">CHART</h5>
                    </div>
                    <div class="custom-panel-details">
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
                    <div class="row">
                        <div class="large-6 columns">
                            <div class="custom-panel-heading">
                                <h5 class="white">OB-GYNE</h5>
                            </div>
                            <div class="custom-panel-details">
                                <p>This month delivery date</p>
                                @foreach($ob as $row)
                                    <div class="row">
                                        <div class="small-12 columns">{{ $row->patient->code_name }} ( {{ $row->if_delivered_date }} )</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="large-6 columns">
                            <div class="custom-panel-heading">
                                <h5 class="white">Mortality</h5>
                            </div>
                            <div class="custom-panel-details">
                                <p>Latest dead patient</p>
                                @foreach($mortality as $row)
                                    <div class="row">
                                        <div class="small-12 columns">{{ $row->patient->code_name }} ( {{ $row->date_of_death_forma }} )</div>
                                    </div>
                                @endforeach
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
                        <p>Scheduled follow-up for this month</p>
                        <div class="notification">
                            @foreach($vct_follow_up as $row)
                            @if($row->total_vct_record == 1)
                                    <!-- 2nd Visit -->
                            <?php $next_vct = date('m/d/Y', strtotime("+90 days", strtotime($row->last_vct_record->vct_date))); ?>
                            @if($next_vct >= date('Y-m-01') && $next_vct <= date('Y-m-t'))
                                <div class="notification-details">
                                    <i class="fi-alert"></i><span>{{ $row->code_name }}</span> <span class="label radius alert right">{{ $next_vct }}</span>
                                </div>
                                @endif
                                @else
                                        <!-- 3rd Visit and so on -->
                                <?php $next_vct = date('Y-m-d', strtotime("+180 days", strtotime($row->last_vct_record->vct_date))); ?>
                                @if($next_vct >= date('Y-m-01') && $next_vct <= date('Y-m-t'))
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
                    <div class="custom-panel-heading"><h5 class="white">CHECKUP</h5></div>
                    <div class="custom-panel-details">
                        <p>Scheduled for checkup this month</p>
                        @foreach($checkup as $row)
                            <div class="row">
                                <div class="small-12 columns">
                                    <div class="message-desc">
                                        <b>{{ $row->patient->code_name }}</b> <span class="label radius warning right">{{ $row->follow_up_date }}</span>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 column">
                    <div class="custom-panel-heading"><h5 class="white">CHECKUP LAB REQUESTS</h5></div>
                    <div class="custom-panel-details">
                        <p>Laboratory Requests to be Performed</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 column">
                    <div class="custom-panel-heading"><h5 class="white">CHECKUP REFERRALS</h5></div>
                    <div class="custom-panel-details">
                        <p>Pending Checkup Referrals</p>
                        @foreach($checkup_request as $row)
                            @if($row->Referrals && !($row->Referrals->surgeon!=1 && $row->Referrals->ob_gyne!=1 && $row->Referrals->opthalmology!=1 &&$row->Referrals->dentis!=1 && $row->Referrals->psychiatrist!=1 && $row->Referrals->others_status != 1))
                                <div class="row">
                                    <div class="small-12 columns">
                                        {{ $row->patient->code_name }}
                                        @if($row->Referrals->surgeon==1)
                                            <span class="label alert"><a class="block" href="{{ route('referrals_complete', [$row->id, 1, 2]) }}"><i class="fa fa-times fa-sm"></i> Surgery</a></span>
                                        @endif
                                        @if($row->Referrals->ob_gyne==1)
                                            <span class="label alert"><a class="block" href="{{ route('referrals_complete', [$row->id, 2, 2]) }}"><i class="fa fa-times fa-sm"></i> OB-Gyne</a></span>
                                        @endif
                                        @if($row->Referrals->opthalmology==1)
                                            <span class="label alert"><a class="block" href="{{ route('referrals_complete', [$row->id, 3, 2]) }}"><i class="fa fa-times fa-sm"></i> Opthal</a></span>
                                        @endif
                                        @if($row->Referrals->dentis==1)
                                            <span class="label alert"><a class="block" href="{{ route('referrals_complete', [$row->id, 4, 2]) }}"><i class="fa fa-times fa-sm"></i> Dentist</a></span>
                                        @endif
                                        @if($row->Referrals->psychiatrist==1)
                                            <span class="label alert"><a class="block" href="{{ route('referrals_complete', [$row->id, 5, 2]) }}"><i class="fa fa-times fa-sm"></i> Psych</a></span>
                                        @endif
                                        @if($row->Referrals->others != '' && $row->Referrals->others_status != 2)
                                            <span class="label alert"><a class="block" href="{{ route('referrals_complete', [$row->id, 6, 2]) }}"><i class="fa fa-times fa-sm"></i> {{ $row->Referrals->others }}</a></span>
                                        @endif
                                        <br/><br/>
                                        Reason: {{ $row->Referrals->reason }}
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

<script>
    $('a.block').css('color', 'white');
    $('a.block').on('click',function(){
        return confirm('Are you sure you want to declare the referral/request as completed (this action cannot be undone)?');
    });

    $(".notif-list").css({"max-height":"150px","overflow":"auto"});
</script>


@include('hact.home_chart_inc')

@endsection

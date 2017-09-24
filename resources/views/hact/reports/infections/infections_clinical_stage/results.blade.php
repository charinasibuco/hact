@extends("hact.layouts.layout_admin")

@section("content")

<div class='row'>
    <div class='large-12 columns'>
        <ul class="breadcrumbs">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li class="current"><a href="#">Infections</a></li>
            <li class="current"><a href="#">WHO Classification</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="large-12 medium-12 small-12 columns">
        @include("hact.messages.success")
        @if(count($errors) > 0)
            <div class="alert-box alert ">Error: Highlight fields are required!</div>
        @endif
        <div class="custom-panel-heading">
            <span>Clinical Stages Report</span>
        </div>
        <div class="custom-panel-details">
            <div class="row">
                <div class="large-12 columns">
                    <form id="report" method="get" action="{{ route('infections_cs_results_print') }}">
                        <fieldset>
                            <legend>Generate</legend>
                            <div class="row">
                                <div class="large-3 columns">
                                    <label>Clinical Stage:</label>
                                    <select id="clinical_stage" name="clinical_stage">
                                        <option value="1" @if($clinical_stage == 1) selected @endif>Clinical Stage #1</option>
                                        <option value="2" @if($clinical_stage == 2) selected @endif>Clinical Stage #2</option>
                                        <option value="3" @if($clinical_stage == 3) selected @endif>Clinical Stage #3</option>
                                        <option value="4" @if($clinical_stage == 4) selected @endif>Clinical Stage #4</option>
                                    </select>
                                </div>
                                <div class="large-3 columns">
                                    <label>From:</label>
                                    <input type="text" id="from" class="fdatepicker {{ ($errors->has('from')) ? 'highlight_error' : '' }}" name="from" placeholder="MM dd,yyyy" value="{{ $from }}" readonly>
                                </div>
                                <div class="large-3 columns">
                                    <label>To:</label>
                                    <input type="text" id="to" class="fdatepicker {{ ($errors->has('to')) ? 'highlight_error' : '' }}" name="to" placeholder="MM dd,yyyy" value="{{ $to }}" readonly>
                                </div>
                                <div class="large-3 columns">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="button tiny alert">Generate</button>
                                    <input type="submit" class="button tiny alert" name="excel" value="Excel" />
                                    {!! csrf_field() !!}
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <script>
                        $('#report').on('submit',function(){
                            if($('#from').val() && $('#to').val() && $('#clinical_stage').val()){
                                $('#report').attr('target','_blank');
                            }
                        });
                    </script>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="large-12 columns">
                    <fieldset>  
                        <legend>Chart</legend>
                        <form action="#" method="get" id="chart">
                            <div class="row">
                                <div class="large-3 columns">
                                    <label for="type">Type</label>
                                    <select name="type" id="type">
                                        <option value="all">All</option>
                                        <option value="year">Year</option>
                                    </select>
                                </div>
                                <div class="large-3 columns">
                                    <label for="year">Year</label>
                                    <select name="year" id="year" disabled>
        {{--                                 @foreach($years as $key => $value)
                                            <option value="{{ $value }}">$value</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="large-3 columns">
                                    <label for="">&nbsp;</label>
                                    <button type="submit" class="button tiny alert">Generate</button>
                                </div>
                                <div class="large-3 columns">&nbsp;</div>
                            </div>
                        </form>
                        <br />
                        <div id="chart_clinical_stages" style=""></div>
                    </fieldset>
                </div>
            </div>
        </div>
            <script type="text/javascript">
        var chart_clinical_stages_xhr;
        chart_clinical_stages();

        function chart_clinical_stages()
        {
            chart_clinical_stages_xhr = $.ajax({
                cache : false,
                url : "<?php echo route('chart_clinical_stages'); ?>",
                dataType : "json",
                beforeSend: function(xhr)
                {
                    if (chart_clinical_stages_xhr != null){
                        chart_clinical_stages_xhr.abort();
                    }
                }
            }).done(function(data) {

                $('#chart_clinical_stages').highcharts({
                    chart: {
                        type: 'area'
                    },
                    credits: false,
                    title: {
                        text: 'Current Year Infection(by Clinical Stage) Cases'
                    },
                    subtitle: {
                        text: data['year']
                    },
                    xAxis: {
                        categories: data['categories'],
                        tickmarkPlacement: 'on',
                        title: {
                            enabled: false
                        }
                    },
                    yAxis: {
                        title: {
                            text: ''
                        },
                        labels: {
                             formatter: function () {
                                 return this.value;
                            }
                        }
                    },
                    tooltip: {
                        shared: true,
                        valueSuffix: ''
                    },
                    plotOptions: {
                        area: {
                            stacking: 'normal',
                            lineColor: '#666666',
                            lineWidth: 1,
                            marker: {
                                lineWidth: 1,
                                lineColor: '#666666'
                            }
                        }
                    },
                    series: [
                    {
                        name: 'Clinical Stage 1',
                        data: data['clinical_stage_1']
                    },
                    {
                        name: 'Clinical Stage 2',
                        data: data['clinical_stage_2']
                    },
                    {
                        name: 'Clinical Stage 3',
                        data: data['clinical_stage_3']
                    },
                    {
                        name: 'Clinical Stage 4',
                        data: data['clinical_stage_4']
                    },
                    ]
                });
            }).fail(function(jqXHR, textStatus) {
                console.log('Pls. refresh your page.');
            });
        }
    </script>
    </div>
</div>


@endsection

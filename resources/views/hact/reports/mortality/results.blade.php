@extends("hact.layouts.layout_admin")

@section("content")

<div class='row'>
    <div class='large-12 columns'>
        <ul class="breadcrumbs">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li class="current"><a href="#">Mortality</a></li>
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
            <span>Mortality Report</span>
        </div>
        <div class="custom-panel-details">
            <div class="row">
                <div class="large-12 columns">
                    <form id="report" method="get" action="{{ route('mortality_results_print') }}">
                        <fieldset>
                        <legend>Generate</legend>
                            <div class="row">
                                <div class="large-5 columns">
                                    <div class="row">
                                        <div class="large-12 columns">
                                            <label>Cause Type:</label>
                                            <select id="cause_type" name="cause_type" style="margin-bottom:16px;" class="{{ ($errors->has('cause_type')) ? 'highlight_error' : '' }}">
                                                <option value="" disabled selected>Select Cause Type</option>
                                                <option value="immediate_cause" {{($cause_type == 'immediate_cause') ? 'selected="selected"' : ''}}>Immediate Cause</option>
                                                <option value="antecedent_cause" {{($cause_type == 'antecedent_cause') ? 'selected="selected"' : ''}}>Antecedent Cause</option>
                                                <option value="underlying_cause" {{($cause_type == 'underlying_cause') ? 'selected="selected"' : ''}}>Underlying Cause</option>
                                            </select>   
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="large-12 columns">
                                            <label>Cause Description:</label>
                                            <select id="cause_description" name="cause_description" class="{{ ($errors->has('cause_description')) ? 'highlight_error' : '' }}">
                                                <option value="" disabled selected>Select Description</option>
                                                @foreach($immediate_cause as $row)
                                                    <option class="immediate_cause" value="{{ $row->immediate_cause }}">{{ $row->immediate_cause }}</option>
                                                @endforeach
                                                @foreach($antecedent_cause as $row)
                                                    <option class="antecedent_cause" value="{{ $row->antecedent_cause }}">{{ $row->antecedent_cause }}</option>
                                                @endforeach
                                                @foreach($underlying_cause as $row)
                                                    <option class="underlying_cause" value="{{ $row->underlying_cause }}">{{ $row->underlying_cause }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="large-5 columns">
                                    <div class="row">
                                        <div class="large-12 columns">
                                            <label>From:</label>
                                            <input type="text" id="from" class="fdatepicker {{ ($errors->has('from')) ? 'highlight_error' : '' }}" name="from" placeholder="MM dd,yyyy" value="{{ $from }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="large-12 columns">
                                            <label>To:</label>
                                            <input type="text" id="to" class="fdatepicker {{ ($errors->has('to')) ? 'highlight_error' : '' }}" name="to" placeholder="MM dd,yyyy" value="{{ $to }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="large-2 columns">  
                                    <div class="row">
                                        <div class="large-12 columns">
                                            <label>&nbsp;</label>
                                              <label>&nbsp;</label>
                                            <button type="submit" class="button tiny expand alert">Generate</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="large-12 columns">
                                            <input type="submit" class="button tiny expand alert" name="excel" value="Excel" />
                                            {!! csrf_field() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>                   
                        </fieldset>
                    </form>
                    <script>
                        $('#report').on('submit',function(){
                            if($('#from').val() && $('#to').val() && $('#cause_type').val()){
                                $('#report').attr('target','_blank');
                            }
                        });
                    </script>
                </div>
            </div>
            <br>
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
                                         @foreach($years as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
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
                        <div id="chart_mortality" style=""></div>
                    </fieldset>
                </div>
            </div> 
        </div>
    </div>   
</div>

 <script type="text/javascript">
        $('.immediate_cause').hide();
        $('.antecedent_cause').hide();
        $('.underlying_cause').hide();
    $(function(){
        $('#cause_type').change(function(){
            if($(this).val()=='immediate_cause')
            {
                $('.immediate_cause').show();
            }
            else
            {
                $('.immediate_cause').hide();
            }
            if($(this).val()=='antecedent_cause')
            {
                $('.antecedent_cause').show();
            }
            else
            {
                $('.antecedent_cause').hide();
            }
            if($(this).val()=='underlying_cause')
            {
                $('.underlying_cause').show();
            }
            else
            {
                $('.underlying_cause').hide();
            }
        });
    });

    var chart_mortality_xhr;
    chart_mortality();

    function chart_mortality()
    {
        chart_mortality_xhr = $.ajax({
            cache : false,
            url : "<?php echo route('chart_mortality'); ?>",
            dataType : "json",
            beforeSend: function(xhr)
            {
                if (chart_mortality_xhr != null){
                    chart_mortality_xhr.abort();
                }
            }
        }).done(function(data) {

            $('#chart_mortality').highcharts({
                chart: {
                    type: 'area'
                },
                credits: false,
                title: {
                    text: 'Mortality Cases'
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
                series: [{
                    name: 'Cases',
                    data: data['mortality']
                }]
            });
        }).fail(function(jqXHR, textStatus) {
            console.log('Pls. refresh your page.');
        });
    }
</script>


@endsection

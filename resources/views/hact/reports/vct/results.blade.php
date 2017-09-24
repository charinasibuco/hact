
@extends("hact.layouts.layout_admin")

@section("content")

<div class='row'>
    <div class='large-12 columns'>
        <ul class="breadcrumbs">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">VCT</a></li>
            <li class="current"><a href="#">Results</a></li>
        </ul>
    </div>
</div>


<div class="row">
    <div class="large-12 medium-12 small-12 columns">
        @include("hact.messages.success")
        @include("hact.messages.error_list")
        <div class="custom-panel-heading">
            <span>VCT Result</span>
        </div>
        <div class="custom-panel-details">
        	<div class="row">
          		<div class="large-12 columns">
          			<form method="get" action="{{ route('reports_print_vct_results') }}">
          				<fieldset>
          					<legend>Generate</legend>
          					<div class="row">
          						<div class="large-3 columns">
          							<label for="result">Result</label>
          							<select id="result" name="result">
                                        <option value="">All</option>
                                        <option value="0" class="optionGroup"><strong>Non Reactive</strong></option>
                                        <optgroup label="Reactive" style="margin-left:3px;">
                                            <option value="1">Negative</option>
                                            <option value="2">Positive</option>
                                            <option value="3">Indeterminate</option>
                                        </optgroup>
          							</select>
          						</div>

          						<div class="large-3 columns">
          							<label for="from_date">From</label>
          							<input type="text" id="from_date" class="fdatepicker" name="from_date" placeholder="MM dd,yyyy" value="" readonly>
          						</div>

          						<div class="large-3 columns">
          							<label for="to_date">To</label>
          							<input type="text" id="to_date" class="fdatepicker" name="to_date" placeholder="MM dd,yyyy" value="" readonly>
          						</div>

          						<div class="large-3 columns">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="button tiny alert">Generate</button>
                                    {{--<button type="submit" class="button tiny alert" name="excel">Excel</button>--}}
          							{!! csrf_field() !!}
          						</div>
          					</div>
          				</fieldset>
          			</form>
          		</div>
            </div>
            <br />
            <div class="row">
                <div class="large-12 columns">
                    <fieldset>
                        <legend>Chart</legend>
                        <form id="chart" action="#" method="get">
                            <div class="row">
                                <div class="large-3 columns">
                                    <label for="type">Type</label>
                                    <select id="type" name="type">
                                        <option value="all">All</option>
                                        <option value="year">Year</option>
                                    </select>
                                </div>
                                <div class="large-3 columns">
                                    <label for="year">Year</label>
                                    <select id="year" name="year" disabled>
                                        @foreach($years as $key => $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="large-3 columns">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="button tiny alert">Generate</button>
                                </div>
                                <div class="large-3 columns">&nbsp;</div>
                            </div>

                        </form>
                        <br />
                        <div id="hiv_records_summary"></div>
                     </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var hiv_records_summary_xhr = null;
hiv_records_summary();
//hiv_records_per_year(2011);

$(function(){
    $('#type').change(function(){
        var value = $(this).val();

        if(value == 'year')
        {
            $('#year').attr('disabled', false);
        }
        else
        {
            $('#year').attr('disabled', true);
        }
    });
});

$(function(){
    $('#chart').submit(function(e){
        var type = $('#type').val();
        var year = $('#year').val();

        if(type == 'year')
        {
            $('#year').attr('disabled', false);
            hiv_records_per_year(year);
            //$('#hiv_records_summary').text('');
        }
        else
        {
            hiv_records_summary();
        }
        e.preventDefault();
        return false;
    });
});

/**
HIV Record Summary
**/
function hiv_records_per_year(year)
{
    hiv_records_summary_xhr = $.ajax({
        cache : false,
        url : "<?php echo route('chart_hiv_record_summary'); ?>/" + year,
        dataType : "json",
        beforeSend: function(xhr)
        {
            if (hiv_records_summary_xhr != null){
                hiv_records_summary_xhr.abort();
            }
        }
    }).done(function(data) {
        //console.log(data);
        $('#hiv_records_summary').highcharts({
            chart: {
                type: 'line'
            },
            credits: false,
            title: {
                text: 'HIV Record Summary'
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
            legend: {
                enabled: false
            },
            series: [{
                name: 'Reactive',
                data: data['reactive']
            }, {
                name: 'Non Reactive',
                data: data['nonreactive']
            }]
            // series: [
            //     {
            //         name: 'Year',
            //         data: data['yearly_record']
            //     }
            // ]
        });
    }).fail(function(jqXHR, textStatus) {
        console.log('Pls. refresh your page.');
    });
}

function hiv_records_summary()
{
    hiv_records_summary_xhr = $.ajax({
        cache : false,
        url : "<?php echo route('chart_hiv_record_summary'); ?>",
        dataType : "json",
        beforeSend: function(xhr)
        {
            if (hiv_records_summary_xhr != null){
                hiv_records_summary_xhr.abort();
            }
        }
    }).done(function(data) {
        //console.log(data);
        $('#hiv_records_summary').highcharts({
            chart: {
                type: 'line'
            },
            credits: false,
            title: {
                text: 'HIV Record Summary'
            },
            subtitle: {
                text: data['start_year'] + ' - ' + data['last_year']
            },
            xAxis: {
                categories: data['yearly_record'],
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
            legend: {
                enabled: false
            },
            series: [{
                name: 'Reactive',
                data: data['reactive']
            }, {
                name: 'Non Reactive',
                data: data['nonreactive']
            }]
            // series: [
            //     {
            //         name: 'Year',
            //         data: data['yearly_record']
            //     }
            // ]
        });
    }).fail(function(jqXHR, textStatus) {
        console.log('Pls. refresh your page.');
    });
}

/**
HIV Record Summary
**/
function chart_hiv_stages()
{
    chart_hiv_stages_xhr = $.ajax({
        cache : false,
        url : "<?php echo route('chart_hiv_stages'); ?>",
        dataType : "json",
        beforeSend: function(xhr)
        {
            if (chart_hiv_stages_xhr != null){
                chart_hiv_stages_xhr.abort();
            }
        }
    }).done(function(data) {
        //console.log(data);
        $('#chart_hiv_stages').highcharts({
            chart: {
                type: 'area'
            },
            title: {
                text: 'HIV Stages Summary'
            },
            subtitle: {
                //text: data['start_year'] + ' - ' + data['last_year']
                text: data['start_year'] + ' - ' + data['last_year']
            },
            xAxis: {
                categories: ['Stage 1', 'Stage 2', 'Stage 3', 'Stage 4'],
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
                    name: 'Stage 1',
                    data: data['stage_1']
                }, {
                    name: 'Stage 2',
                    data: data['stage_2']
                }, {
                    name: 'Stage 3',
                    data: data['stage_3']
                }, {
                    name: 'Stage 4',
                    data: data['stage_4']
                }
            ]
        });
    }).fail(function(jqXHR, textStatus) {
        console.log('Pls. refresh your page.');
    });
}
</script>

@endsection

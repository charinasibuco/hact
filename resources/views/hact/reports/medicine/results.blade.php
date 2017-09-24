
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

@include("hact.messages.success")
@include("hact.messages.error_list")

<div class="panel">
	<div class="row">
  		<div class="large-6 columns">
  			<form method="get" action="{{ route('reports_print_vct_results') }}">
  				<fieldset>
  					<legend>Generate</legend>
  					<div class="row">
  						<div class="large-12 columns">
  							<label>Result</label>
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
  					</div>
  					<div class="row">
  						<div class="large-12 columns">
  							<label>From</label>
  							<input type="text" id="from_date" class="fdatepicker" name="from_date" placeholder="MM dd,yyyy" value="" readonly>
  						</div>
  					</div>
  					<div class="row">
  						<div class="large-12 columns">
  							<label>To</label>
  							<input type="text" id="to_date" class="fdatepicker" name="to_date" placeholder="MM dd,yyyy" value="" readonly>
  						</div>
  					</div>
  					<div class="row">
  						<div class="large-12 columns">
  							<button type="submit" class="button small alert">Generate</button>
                            <input type="submit" class="button small alert" name="excel" value="Excel" />
  							{!! csrf_field() !!}
  						</div>
  					</div>
  				</fieldset>
  			</form>
  		</div>
    <div class="large-6 columns">
        <div id="hiv_records_summary"></div>
    </div>
  </div>
</div>

<script type="text/javascript">
var hiv_records_summary_xhr = null;
hiv_records_summary();

function current_year_record()
{
    current_year_record_xhr = $.ajax({
        cache : false,
        url : "<?php echo route('chart_current_year_record'); ?>",
        dataType : "json",
        beforeSend: function(xhr)
        {
            if (current_year_record_xhr != null){
                current_year_record_xhr.abort();
            }
        }
    }).done(function(data) {

        $('#current_year_record').highcharts({
            /*chart: {
                type: 'area'
            },*/
            title: {
                text: 'Current year HIV Cases'
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
                name: 'Male',
                data: data['male']
            }, {
                name: 'Female',
                data: data['female']
            }]
        });
    }).fail(function(jqXHR, textStatus) {
        console.log('Pls. refresh your page.');
    });
}

/**
HIV Record Summary
**/
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

@extends("hact.layouts.layout_admin")

@section("content")

<div class='row'>
    <div class='large-12 columns'>
        <ul class="breadcrumbs">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li class="current"><a href="#">Patient</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="large-12 medium-12 small-12 columns">
        @include("hact.messages.success")
        @include("hact.messages.error_list")
        <div class="custom-panel-heading">
            <span>Patient Report</span>
        </div>
        <div class="custom-panel-details">
        	<div class="row">
        		<div class="large-6 columns">
        			<form method="get" action="{{ route('reports_patient_print') }}">
        				<fieldset>
        					<legend>Generate</legend>
                            <div class="row">
                                <div class="large-12 columns">
                                    <label for="gender">Gender</label>
                                    <select id="gender" name="gender">
                                        <option value="2">All</option>
                                        <option value="0">Female</option>
                                        <option value="1">Male</option>
                                    </select>
                                </div>
                            </div>
                            <br />
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
                <div class="large-6 columns">&nbsp;</div>
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
                        <div id="current_year_record"></div>
                     </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

var hiv_records_summary_xhr = null;
//patient_yearly_record();
current_year_record();

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
            patient_yearly_record(year);
        }
        else
        {
            current_year_record();
        }
        e.preventDefault();
        return false;
    });
});

function patient_yearly_record(year)
{
    hiv_records_summary_xhr = $.ajax({
        cache : false,
        url : "<?php echo route('chart_current_year_record'); ?>/" + year,
        dataType : "json",
        beforeSend: function(xhr)
        {
            if (hiv_records_summary_xhr != null){
                hiv_records_summary_xhr.abort();
            }
        }
    }).done(function(data) {
        //console.log(data);
        $('#current_year_record').highcharts({
            chart: {
                type: 'line'
            },
            credits: false,
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
            legend: {
                enabled: false
            },
            series: [{
                name: 'Female',
                data: data['female']
            }, {
                name: 'Male',
                data: data['male']
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

function current_year_record()
{
    hiv_records_summary_xhr = $.ajax({
        cache : false,
        url : "<?php echo route('chart_current_year_record'); ?>",
        dataType : "json",
        beforeSend: function(xhr)
        {
            if (hiv_records_summary_xhr != null){
                hiv_records_summary_xhr.abort();
            }
        }
    }).done(function(data) {
        //console.log(data);
        $('#current_year_record').highcharts({
            chart: {
                type: 'line'
            },
            credits: false,
            title: {
                text: 'Current year HIV Cases'
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
                name: 'Female',
                data: data['female']
            }, {
                name: 'Male',
                data: data['male']
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
</script>

@endsection
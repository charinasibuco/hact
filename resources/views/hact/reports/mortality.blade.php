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

<div class="panel">
	<div class="row">
		<div class="large-6 columns">
			@include("hact.messages.success")
			@include("hact.messages.error_list")
			<form method="post" action="{{ $action }}">
				<fieldset>
					<legend>Generate</legend>
					<div class="row">
						<div class="large-12 columns">
							<label>From:</label>
							<input type="text" id="from_date" class="fdatepicker" name="from_date" placeholder="MM dd,yyyy" value="" readonly>	
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<label>To:</label>
							<input type="text" id="to_date" class="fdatepicker" name="to_date" placeholder="MM dd,yyyy" value="" readonly>	
						</div>
					</div>
					<div class="row">	
						<div class="large-12 columns">
							<button type="submit" class="button small alert">Generate</button>
							{!! csrf_field() !!}
						</div>
					</div>
				</fieldset>
			</form>
		</div>	
		<div class="large-6 columns">
			<div id="container" style=""></div>
		</div>	
	</div>
</div>

<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'area'
        },
        title: {
            text: 'Historic and Estimated CLMMRC Mortality Graph'
        },
        subtitle: {
            text: 'Source: CLMMRC Records'
        },
        xAxis: {
            categories: ['2008', '2009', '2010', '2011', '2012', '2013', '2014'],
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
                    return this.value / 1;
                }
            }
        },
        tooltip: {
            shared: true,
            //valueSuffix: ' Thousands'
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
            data: [20, 30, 25, 100, 62, 32, 53]
        }, {
            name: 'Female',
            data: [10, 5, 111, 78, 21, 45, 2]
        }]
    });
});
</script>

@endsection
@extends("hact.layouts.layout_admin")

@section("content")

<div class='row'>
    <div class='large-12 columns'>
        <ul class="breadcrumbs">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li class="current"><a href="#">Client</a></li>
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
            text: 'Number of Clients by Type'
        },
        subtitle: {
            text: 'Range: January 2010 - January 2015'
        },
        xAxis: {
            categories: ['2010', '2011', '2012', '2013', '2014', '2015'],
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: 'Hundreds'
            },
            labels: {
                 formatter: function () {
                     return this.value / 100;
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
            name: 'MARP',
            data: [200, 300, 100, 400, 300, 100]
        }, {
            name: 'MW',
            data: [152, 357, 120, 390, 357, 120]
        }, {
            name: 'HCW with OE',
            data: [175, 143, 200, 287,143, 200]
        }, {
            name: 'Pregnant',
            data: [150, 175, 167, 184,175, 167]
        }, {
            name: 'Children',
            data: [200, 198, 75, 200, 198, 200]
        }, {
            name: 'Others',
            data: [230, 270, 90, 210, 270, 210]
        }
        ]
    });
});
</script>

@endsection
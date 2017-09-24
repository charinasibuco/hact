@extends("hact.layouts.layout_admin")

@section("content")

<div class='row'>
    <div class='large-12 columns'>
        <ul class="breadcrumbs">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li class="current"><a href="#">People</a></li>
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
            text: 'Rate of Recorded HIV Cases'
        },
        subtitle: {
            text: 'Range: January 2015 - April 2015'
        },
        xAxis: {
            categories: ['January', 'February', 'March', 'April'],
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: 'by Tens'
            },
            labels: {
                 formatter: function () {
                     return this.value / 10;
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
            data: [20, 18, 12, 30]
        }, {
            name: 'Female',
            data: [19, 57, 16, 36]
        }]
    });
});
</script>

@endsection
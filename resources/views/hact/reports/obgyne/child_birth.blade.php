
@extends("hact.layouts.layout_admin")

@section("content")

<div class='row'>
    <div class='large-12 columns'>
        <ul class="breadcrumbs">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">OB Gyne</a></li>
            <li class="current"><a href="#">Child Birth</a></li>
        </ul>
    </div>
</div>

@include("hact.messages.success")
@include("hact.messages.error_list")

<div class="panel">
	<div class="row">
		<div class="large-6 columns">
			<form method="get" action="{{ route('reports_get_obgyne_childbirth_generate') }}">
				<fieldset>
					<legend>Generate Child Birth</legend>
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
            <div id="current_year_record"></div>
        </div>
	</div>
    <div class="row">
        <div class="large-6 columns">
            <div id="container1"></div>
        </div>
        <div class="large-6 columns">
            <div id="container2"></div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var current_year_record_xhr = null;
    current_year_record();

    function current_year_record()
    {
        current_year_record_xhr = $.ajax({
            cache : false,
            url : "{{route('reports_get_obgyne_chart')}}",
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
                credits: false,
                title: {
                    text: 'Current Year OB-Gyne Patients'
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
                    name: 'Pregnant',
                    data: data['pregnant']
                }, {
                    name: 'Non-pregnant',
                    data: data['nonpregnant']
                }]
            });
        }).fail(function(jqXHR, textStatus) {
            console.log('Pls. refresh your page.');
        });
    }
</script>

@endsection

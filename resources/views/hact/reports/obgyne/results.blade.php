
@extends("hact.layouts.layout_admin")

@section("content")

<div class='row'>
    <div class='large-12 columns'>
        <ul class="breadcrumbs">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">OB Gyne</a></li>
            <li class="current"><a href="#">Results</a></li>
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
            <span>Ob Gyne Report</span>
        </div>
        <div class="custom-panel-details">
        	<div class="row">
        		<div class="large-6 columns">
        			<form id="report" method="get" action="{{ route('reports_print_obgyne_results') }}">
        				<fieldset>
        					<legend>Generate</legend>
        					<div class="row">
        						<div class="large-12 columns">
        							<label>Currently Pregnant</label>
        							<select id="result" name="result">
        								<option value="1" @if($result==1) selected @endif>Yes</option>
        								<option value="0" @if($result==0) selected @endif>No</option>
        							</select>
        						</div>
        					</div>
        					<div class="row">
        						<div class="large-12 columns">
        							<label>From</label>
        							<input type="text" id="from_date" class="fdatepicker {{ ($errors->has('from_date')) ? 'highlight_error' : '' }}" name="from_date" placeholder="MM dd,yyyy" value="{{ $from_date }}" readonly>
        						</div>
        					</div>
        					<div class="row">
        						<div class="large-12 columns">
        							<label>To</label>
        							<input type="text" id="to_date" class="fdatepicker {{ ($errors->has('to_date')) ? 'highlight_error' : '' }}" name="to_date" placeholder="MM dd,yyyy" value="{{ $to_date }}" readonly>
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
                    <script>
                        $('#report').on('submit',function(){
                            if($('#from_date').val() && $('#to_date').val()){
                                $('#report').attr('target','_blank');
                            }
                        });
                    </script>
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

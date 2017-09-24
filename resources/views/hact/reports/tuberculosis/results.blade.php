
@extends("hact.layouts.layout_admin")

@section("content")

<div class='row'>
    <div class='large-12 columns'>
        <ul class="breadcrumbs">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Tuberculosis</a></li>
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
            <span>Tuberculosis Report</span>
        </div>
        <div class="custom-panel-details">
        	<div class="row">
        		<div class="large-6 columns">
        			<form id="report" method="get" action="{{ route('reports_print_tb_results') }}">
        				<fieldset>
        					<legend>Generate</legend>
        					<div class="row">
        						<div class="large-12 columns">
        							<label>Result</label>
        							<select id="result" name="result" onchange="tbStatus(this);" class="{{ ($errors->has('result')) ? 'highlight_error' : '' }}">
                                        <option value="" @if(!$result) selected @endif>-- Please Select --</option>
        								<option value="2" @if($result==2) selected @endif>With Active TB</option>
        								<option value="1" @if($result==1) selected @endif>No Active TB</option>
        							</select>
        						</div>
        					</div>
                            <div class="row" id="tx_outcome">
                                <div class="large-12 columns">
                                    <label>Tx Outcome</label>
                                    <select id="tx_outcome" name="tx_outcome">
                                        <option value="0" @if(!$tx_outcome || $tx_outcome==0) selected @endif>All</option>
                                        <option value="1" @if($tx_outcome==1) selected @endif>Cured</option>
                                        <option value="2" @if($tx_outcome==2) selected @endif>Failed</option>
                                        <option value="5" @if($tx_outcome==5) selected @endif>Ongoing</option>
                                        <option value="3" @if($tx_outcome==3) selected @endif>Completed</option>
                                        <option value="4" @if($tx_outcome==4) selected @endif>Other</option>
                                    </select>
                                </div>
                            </div>
        					<div class="row">
        						<div class="large-12 columns">
        							<label>From</label>
        							<input type="text" id="from" class="fdatepicker {{ ($errors->has('from')) ? 'highlight_error' : '' }}" name="from" placeholder="MM dd,yyyy" value="{{ $from }}" readonly>
        						</div>
        					</div>
        					<div class="row">
        						<div class="large-12 columns">
        							<label>To</label>
        							<input type="text" id="to" class="fdatepicker {{ ($errors->has('to')) ? 'highlight_error' : '' }}" name="to" placeholder="MM dd,yyyy" value="{{ $to }}" readonly>
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
                            if($('#from').val() && $('#to').val() && $('#result').val()){
                                $('#report').attr('target','_blank');
                            }
                        });
                    </script>
        		</div>
        		<div class="large-6 columns">
                    <div id="current_year_record" style=""></div>
                </div>
        	</div>
        </div>
    </div>
</div>

<script type="text/javascript">
//var current_year_record_xhr;
//current_year_record();



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
            chart: {
                type: 'area'
            },
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
<?php
    if($result==2){
        echo "$('#tx_outcome').show();";
    }else{
        echo "$('#tx_outcome').hide();";
    }
?>

function tbStatus(that){
    if (that.value == "1"){
        $('#tx_outcome').hide();
    }
    else if (that.value == "2"){
        $('#tx_outcome').show();
    }
    else{
        $('#tx_outcome').hide();
    }
}
</script>

@endsection

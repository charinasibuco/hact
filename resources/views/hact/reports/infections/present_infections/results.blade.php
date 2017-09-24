@extends("hact.layouts.layout_admin")

@section("content")

<div class='row'>
    <div class='large-12 columns'>
        <ul class="breadcrumbs">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li class="current"><a href="#">Infections</a></li>
            <li class="current"><a href="#">Present Infections</a></li>
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
            <span>Present Infections Report</span>
        </div>
        <div class="custom-panel-details">
            <div class="row">
                <div class="large-12 columns">
                    <form id="report" method="get" action="{{ route('infections_results_print') }}">
                    <fieldset>
                    <legend>Generate</legend>
                        <div class="row">   
                            <div class="large-6 columns">
                                <fieldset>
                                <legend>Present Infections</legend>
                                    <div class="row">
                                        <div class="large-7 columns">
                                            <input type="checkbox" name="present_infections[]" id="hepatitis_b" value="hepatitis_b" @if(in_array('hepatitis_b',$present_infections)) checked @endif>
                                            <label for="hepatitis_b">Hepatitis B</label><br/>
                                            <input type="checkbox" name="present_infections[]" id="hepatitis_c" value="hepatitis_c" @if(in_array('hepatitis_c',$present_infections)) checked @endif>
                                            <label for="hepatitis_c">Hepatitis C</label><br/>
                                            <input type="checkbox" name="present_infections[]" id="pneumocystis_pneumonia" value="pneumocystis_pneumonia" @if(in_array('pneumocystis_pneumonia',$present_infections)) checked @endif>
                                            <label for="pneumocystis_pneumonia">Pneumocystis Pneumonia</label><br/>
                                            <input type="checkbox" name="present_infections[]" id="orpharyngeal_candidiasis" value="orpharyngeal_candidiasis" @if(in_array('orpharyngeal_candidiasis',$present_infections)) checked @endif>
                                            <label for="orpharyngeal_candidiasis">Orpharyngeal Candidiasis</label><br/>
                                        </div>
                                        <div class="large-5 columns">
                                            <input type="checkbox" name="present_infections[]" id="syphilis" value="syphilis" @if(in_array('syphilis',$present_infections)) checked @endif>
                                            <label for="syphilis">Syphilis</label><br/>
                                            <input type="checkbox" name="present_infections[]" id="stis" value="stis" @if(in_array('stis',$present_infections)) checked @endif>
                                            <label for="stis">STIs</label><br/>
                                            <input type="checkbox" name="present_infections[]" id="others" value="others" @if(in_array('others',$present_infections)) checked @endif>
                                            <label for="others">Others</label><br/>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="large-6 columns">
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
                                <div class="row">
                                    <div class="large-12 columns">
                                        <button type="submit" class="button tiny alert">Generate</button>
                                        <input type="submit" class="button tiny alert" name="excel" value="Excel" />
                                        {!! csrf_field() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    </form>
                    <script>
                        $('#report').on('submit',function(){
                            if($('#from').val() && $('#to').val()){
                                $('#report').attr('target','_blank');
                            }
                        });
                    </script>
                </div>
            </div>
            <br>    
            <div class="row">  
                <div class="large-12 columns">
                    <fieldset class="large-12 medium-12 small-12 columns">  
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
                                            @foreach($years  as $key => $value)
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
                         <div id="chart_present_infections" style=""></div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
 <script type="text/javascript">
    var chart_present_infections_xhr;
    chart_present_infections();

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
                if(year == '' || year == null)
                {
                    alert("Year required!");
                    return false;
                }
                else
                {
                    chart_present_infections_yearly(year);
                }
            }
            else
            {
                chart_present_infections();
            }
            
            e.preventDefault();
            return false;
        });
    });

    function chart_present_infections_yearly(year)
    {
        chart_present_infections_xhr = $.ajax({
            cache : false,
            url : "<?php echo route('chart_present_infections'); ?>/" + year,
            dataType : "json",
            beforeSend: function(xhr)
            {
                if (chart_present_infections_xhr != null){
                    chart_present_infections_xhr.abort();
                }
            }
        }).done(function(data) {

            $('#chart_present_infections').highcharts({
                chart: {
                    type: 'area'
                },
                credits: false,
                title: {
                    text: 'Current Year Infection Cases'
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
                series: [
                {
                    name: 'Hepa B',
                    data: data['hepatitis_b']
                },
                {
                    name: 'Hepa C',
                    data: data['hepatitis_c']
                },
                {
                    name: 'Pneumocystis Pneumonia',
                    data: data['pneumocystis_pneumonia']
                },
                {
                    name: 'Orpharyngeal Candidiasis',
                    data: data['orpharyngeal_candidiasis']
                },
                {
                    name: 'Syphilis',
                    data: data['syphilis']
                },
                {
                    name: 'STIs',
                    data: data['stis']
                },
                {
                    name: 'Others',
                    data: data['others']
                }
                ]
            });
        }).fail(function(jqXHR, textStatus) {
            console.log('Pls. refresh your page.');
        });
    }

    function chart_present_infections()
    {
        chart_present_infections_xhr = $.ajax({
            cache : false,
            url : "<?php echo route('chart_present_infections'); ?>",
            dataType : "json",
            beforeSend: function(xhr)
            {
                if (chart_present_infections_xhr != null){
                    chart_present_infections_xhr.abort();
                }
            }
        }).done(function(data) {

            $('#chart_present_infections').highcharts({
                chart: {
                    type: 'area'
                },
                credits: false,
                title: {
                    text: 'Current Year Infection Cases'
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
                series: [
                {
                    name: 'Hepa B',
                    data: data['hepatitis_b']
                },
                {
                    name: 'Hepa C',
                    data: data['hepatitis_c']
                },
                {
                    name: 'Pneumocystis Pneumonia',
                    data: data['pneumocystis_pneumonia']
                },
                {
                    name: 'Orpharyngeal Candidiasis',
                    data: data['orpharyngeal_candidiasis']
                },
                {
                    name: 'Syphilis',
                    data: data['syphilis']
                },
                {
                    name: 'STIs',
                    data: data['stis']
                },
                {
                    name: 'Others',
                    data: data['others']
                }
                ]
            });
        }).fail(function(jqXHR, textStatus) {
            console.log('Pls. refresh your page.');
        });
    }
</script>

@endsection

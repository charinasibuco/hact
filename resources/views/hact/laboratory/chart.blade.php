@extends('hact.layouts.layout_admin')

@section('content')

<div class='row'>
	<div class='large-12 columns'>
		<ul class="breadcrumbs">

			<li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('patient') }}">Patient</a></li>
			@if(isset($page))
				<li><a href="{{ route('patient_profile', $patient_id) }}">{{ $page }}</a></li>
			@endif
            <li><a href="{{ route('patient_profile',$patient_id) . "#tab4" }}">Laboratory</a></li>
			<li class="current"><a href="#">{{ $action_name }}</a></li>
		</ul>
	</div>
</div>

	@include("hact.messages.success")
	@include("hact.messages.error_list")

<div class="panel">
	 <div id="chart_laboratory" style=""></div>
</div>
       
<script type="text/javascript">
    var chart_laboratory_xhr;
    chart_laboratory();

   function chart_laboratory()
{
    chart_laboratory_xhr = $.ajax({
        cache : false,
        url : "<?php echo route('laboratory_generate_chart', [$patient_id, $laboratory_test_id, $other]); ?>",
        dataType : "json",
        beforeSend: function(xhr)
        {
            if (chart_laboratory_xhr != null){
                chart_laboratory_xhr.abort();
            }
        }
    }).done(function(data) {

        var categories_array = [];
        <?php foreach($array['laboratory_order'] as $row){ ?>
            categories_array.push('<?php echo $row; ?>');
        <?php } ?>


        var results_array = [];
        <?php
            foreach($array['laboratory_results'] as $row)
            { 
        ?>
            var temp_results = [];
        <?php
            foreach($row['data'] as $key => $row_2)
            {
        ?>
            temp_results.push('<?php print_r($row_2) ?>');
        <?php
                }
        ?>
            var insert = {name:"<?php echo $row['name'] ?>", data: temp_results };
            results_array.push(insert);
        <?php
            }
        ?>

        //console.log(data);
        var categories_array = [];
        <?php foreach($array['laboratory_order'] as $row){ ?>
            categories_array.push('<?php echo $row; ?>');
        <?php } ?>


        var results_array = [];
        <?php
            foreach($array['laboratory_results'] as $row)
            { 
        ?>
            var temp_results = [];
        <?php
            foreach($row['data'] as $key => $row_2)
            {
        ?>
            temp_results.push(parseInt('<?php echo $row_2 ?>'));
        <?php
                }
        ?>
            var insert = {name:"<?php echo $row['name'] ?>", data: temp_results };
            results_array.push(insert);
        <?php
            }
        ?>

        $('#chart_laboratory').highcharts({
            chart: {
                type: 'line'
            },
            credits: false,
            title: {
                text: "<?php echo $laboratory_name; ?> Trend"
            },
            subtitle: {
                text: "<?php echo $array['start_year'].' - '.$array['last_year']; ?>"
            },
            xAxis: {
                categories:[<?php foreach($array['laboratory_order'] as $row){ 
                    echo '\''.$row.'\',';
                 } ?>],
                tickmarkPlacement: 'on',
                title: {
                    enabled: true
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
                enabled: true
            },
            series: results_array
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

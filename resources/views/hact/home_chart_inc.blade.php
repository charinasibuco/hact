
<script type="text/javascript">

current_year_record();
years('patient_male_and_female');

$(function(){
    $('#chart_type').change(function(){
        var value = $(this).val();

        years(value);
    });
});

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
        var chart_type  = $('#chart_type').val();
        var type        = $('#type').val();
        var year        = $('#year').val();

        if(chart_type == 'patient_male_and_female')
        {
            if(type == 'year')
            {
                $('#year').attr('disabled', false);
                patient_yearly_record(year);
            }
            else
            {
                current_year_record();
            }
        }
        else if(chart_type == 'vct_result')
        {
            if(type == 'year')
            {
                $('#year').attr('disabled', false);
                hiv_records_per_year(year);
            }
            else
            {
                hiv_records_summary();
            }
        }
        else if(chart_type == 'infections_result')
        {
            if(type == 'year')
            {
                $('#year').attr('disabled', false);
                chart_present_infections_yearly(year);
            }
            else
            {
                chart_present_infections();
            }
        }
        else if(chart_type == 'infections_hiv_stages_result')
        {
            if(type == 'year')
            {
                $('#year').attr('disabled', false);
                chart_clinical_stages_yearly(year);
            }
            else
            {
                chart_clinical_stages();
            }
        }
        else if(chart_type == 'tuberculosis_result')
        {
            if(type == 'year')
            {
                $('#year').attr('disabled', false);
                chart_tuberculosis_yearly(year);
            }
            else
            {
                chart_tuberculosis();
            }
        }
        else if(chart_type == 'mortality_result')
        {
            if(type == 'year')
            {
                $('#year').attr('disabled', false);
                chart_mortality_yearly(year);
            }
            else
            {
                chart_mortality();
            }
        }

        e.preventDefault();
        return false;
    });
});

var years_xhr = null;
function years(chart_type)
{
    years_xhr = $.ajax({
        cache : false,
        url : "<?php echo route('chart_years'); ?>/" + chart_type,
        dataType : "json",
        beforeSend: function(xhr)
        {
            if (years_xhr != null){
                years_xhr.abort();
            }
        }
    }).done(function(data) {
        
        var list = '';

        if(data.length != 0)
        {
            for (var i = 0; i <= data['years'].length - 1; i++)
            {
                //console.log(data['years'][i]);
                list += '<option value="' + data['years'][i] + '">' + data['years'][i] + '</option>';
            };

            $('#year').attr('disabled', false);
            $('#year').html(list);

            if($('#type').val() == 'all')
            {
                $('#year').attr('disabled', true);
            }
        }
        else
        {
            $('#year').html(list);
        }

    }).fail(function(jqXHR, textStatus) {
        console.log('Pls. refresh your page.');
    });
}
/**
    Patient
**/
//var hiv_records_summary_xhr = null;
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
        $('#chart_area').highcharts({
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
        $('#chart_area').highcharts({
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
        });
    }).fail(function(jqXHR, textStatus) {
        console.log('Pls. refresh your page.');
    });
}

/**
    VCT
**/
var hiv_records_summary_xhr = null;
function hiv_records_per_year(year)
{
    hiv_records_summary_xhr = $.ajax({
        cache : false,
        url : "<?php echo route('chart_hiv_record_summary'); ?>/" + year,
        dataType : "json",
        beforeSend: function(xhr)
        {
            if (hiv_records_summary_xhr != null){
                hiv_records_summary_xhr.abort();
            }
        }
    }).done(function(data) {
        //console.log(data);
        $('#chart_area').highcharts({
            chart: {
                type: 'line'
            },
            credits: false,
            title: {
                text: 'HIV Record Summary'
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
        $('#chart_area').highcharts({
            chart: {
                type: 'line'
            },
            credits: false,
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
        });
    }).fail(function(jqXHR, textStatus) {
        console.log('Pls. refresh your page.');
    });
}

/**
    Infections
**/
var chart_present_infections_xhr = null;
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

        $('#chart_area').highcharts({
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

        $('#chart_area').highcharts({
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
                name: 'Hepatitis B',
                data: data['hepatitis_b']
            },
            {
                name: 'Hepatitis C',
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

/**
    HIV Stages 
**/
var chart_clinical_stages_xhr;
function chart_clinical_stages_yearly(year)
{
    chart_clinical_stages_xhr = $.ajax({
        cache : false,
        url : "<?php echo route('chart_clinical_stages'); ?>/" + year,
        dataType : "json",
        beforeSend: function(xhr)
        {
            if (chart_clinical_stages_xhr != null){
                chart_clinical_stages_xhr.abort();
            }
        }
    }).done(function(data) {

        $('#chart_area').highcharts({
            chart: {
                type: 'area'
            },
            credits: false,
            title: {
                text: 'Current Year Infection(by Clinical Stage) Cases'
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
                name: 'Stage 1',
                data: data['clinical_stage_1']
            },
            {
                name: 'Stage 2',
                data: data['clinical_stage_2']
                },
                {
                    name: 'Stage 3',
                    data: data['clinical_stage_3']
                },
                {
                    name: 'Stage 4',
                    data: data['clinical_stage_4']
                },
                {
                    name: 'None',
                    data: data['none']
                }
                ]
            });
    }).fail(function(jqXHR, textStatus) {
        console.log('Pls. refresh your page.');
    });
}

function chart_clinical_stages()
{
    chart_clinical_stages_xhr = $.ajax({
        cache : false,
        url : "<?php echo route('chart_clinical_stages'); ?>",
        dataType : "json",
        beforeSend: function(xhr)
        {
            if (chart_clinical_stages_xhr != null){
                chart_clinical_stages_xhr.abort();
            }
        }
    }).done(function(data) {

        $('#chart_area').highcharts({
            chart: {
                type: 'area'
            },
            credits: false,
            title: {
                text: 'Current Year Infection(by Clinical Stage) Cases'
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
                name: 'Clinical Stage 1',
                data: data['clinical_stage_1']
            },
            {
                name: 'Clinical Stage 2',
                data: data['clinical_stage_2']
                },
                {
                    name: 'Clinical Stage 3',
                    data: data['clinical_stage_3']
                },
                {
                    name: 'Clinical Stage 4',
                    data: data['clinical_stage_4']
                },
                {
                    name: 'None',
                    data: data['none']
                }
                ]
            });
    }).fail(function(jqXHR, textStatus) {
        console.log('Pls. refresh your page.');
    });
}

/**
    Tuberculosis 
**/
var chart_tuberculosis_xhr;
function chart_tuberculosis_yearly(year)
{
    chart_tuberculosis_xhr = $.ajax({
        cache : false,
        url : "<?php echo route('chart_tuberculosis'); ?>/" + year,
        dataType : "json",
        beforeSend: function(xhr)
        {
            if (chart_tuberculosis_xhr != null){
                chart_tuberculosis_xhr.abort();
            }
        }
    }).done(function(data) {

        $('#chart_area').highcharts({
            chart: {
                type: 'area'
            },
            credits: false,
            title: {
                text: data['title']
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
                    name: 'With Active TB',
                    data: data['records']['active']
                },
                {
                    name: 'No Active TB',
                    data: data['records']['no_active']
                }
            ]
            });
    }).fail(function(jqXHR, textStatus) {
        console.log('Pls. refresh your page.');
    });
}

function chart_tuberculosis()
{
    chart_tuberculosis_xhr = $.ajax({
        cache : false,
        url : "<?php echo route('chart_tuberculosis'); ?>",
        dataType : "json",
        beforeSend: function(xhr)
        {
            if (chart_tuberculosis_xhr != null){
                chart_tuberculosis_xhr.abort();
            }
        }
    }).done(function(data) {

        $('#chart_area').highcharts({
            chart: {
                type: 'area'
            },
            credits: false,
            title: {
                text: data['title']
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
                    name: 'With Active TB',
                    data: data['records']['active']
                },
                {
                name: 'No Active TB',
                data: data['records']['no_active']
                }
            ]
            });
    }).fail(function(jqXHR, textStatus) {
        console.log('Pls. refresh your page.');
    });
}

/**
    Mortality 
**/
var chart_mortality_xhr;
function chart_mortality_yearly(year)
{
    chart_mortality_xhr = $.ajax({
        cache : false,
        url : "<?php echo route('chart_mortality_result'); ?>/" + year,
        dataType : "json",
        beforeSend: function(xhr)
        {
            if (chart_mortality_xhr != null){
                chart_mortality_xhr.abort();
            }
        }
    }).done(function(data) {

        $('#chart_area').highcharts({
            chart: {
                type: 'area'
            },
            credits: false,
            title: {
                text: data['title']
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
                    name: '', // 'With Active TB',
                    data: data['records']
                }
            ]
            });
    }).fail(function(jqXHR, textStatus) {
        console.log('Pls. refresh your page.');
    });
}

function chart_mortality()
{
    chart_mortality_xhr = $.ajax({
        cache : false,
        url : "<?php echo route('chart_mortality_result'); ?>",
        dataType : "json",
        beforeSend: function(xhr)
        {
            if (chart_mortality_xhr != null){
                chart_mortality_xhr.abort();
            }
        }
    }).done(function(data) {

        $('#chart_area').highcharts({
            chart: {
                type: 'area'
            },
            credits: false,
            title: {
                text: data['title']
            },
            subtitle: {
                text: '' //data['year']
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
                    name:  '',//'With Active TB'
                    data: data['records']
                }
            ]
            });
    }).fail(function(jqXHR, textStatus) {
        console.log('Pls. refresh your page.');
    });
}
</script>
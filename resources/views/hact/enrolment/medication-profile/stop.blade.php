@extends('hact.layouts.layout_admin')

@section('content')

    <div class='row'>
        <div class='large-12 columns'>
            <h3>Medication Discontinuation</h3>
            <hr />
        </div>
    </div>

	@include('hact.messages.success')
	@include('hact.messages.error_list')

	<form action="{{ $action }}" method="post">

		<fieldset>
    		<legend>Medications Profile</legend><br/>
            <div class="row">
                <div class="large-5 columns">
                    <label for="search_patient">Patient:</label>
                    <input type="text" id="search_patient" name="search_patient" placeholder="Search Patient" value="{{ $search_patient }}" readonly="readonly" />
                    <input type="hidden" id="demographics_id" name="demographics_id" value="{{ $demographics_id }}" />
                    <input type="hidden" id="search_patient_url" name="search_patient_url" value="{{ route('search_demographics_patient') }}" />
                </div>
                <div class="large-7 columns">
                    <label for="medication_name">Name of Medication:</label>
                    <input type="text" id="item_search" name="search_item" placeholder="Search Medication" value="{{ $search_item }}" readonly="readonly" />
                    <input type="hidden" id="item_id" name="item_id" value="{{ $item_id }}" />
                    <input type="hidden" id="search_item_url" name="search_item_url" value="{{ route('search_item') }}" />
                </div>
            </div>
            <div class="row">
                <div class="large-5 columns">
                    <label for="dosage">Dosage:</label>
                    <input type="text" id="dosage" name="dosage" placeholder="Dosage" value="{{ $dosage }}" class="fdatepicker" readonly="readonly" />
                </div>
                <div class="large-7 columns">
                    <label for="frequency">Frequency:</label>
                    <input type="text" id="frequency" name="frequency" placeholder="Frequency" value="{{ $frequency }}" readonly="readonly" />
                </div>
            </div>
            <div class="row">
                <div class="large-5 columns">
                    <label for="date_started">Date Started:</label>
                    <input type="text" id="date_started" name="date_started" placeholder="Date Started" value="{{ $date_started }}" readonly="readonly" />
                </div>
                <div class="large-7 columns">&nbsp;</div>
            </div>
            <div class="row">
                <div class="large-5 columns">
                    <label for="date_discontinued">Date Discontinued:</label>
                    <input type="text" id="date_discontinued" name="date_discontinued" placeholder="Date Discontinued" value="{{ $date_discontinued }}" class="fdatepicker" readonly="readonly" />
                </div>
                <div class="large-7 columns">
                    <label for="discontinuation_reason">Reason for Discontinuation:</label>
                    <input type="text" id="discontinuation_reason" name="discontinuation_reason" placeholder="Reason for Discontinuation" value="{{ $discontinuation_reason }}" />
                </div>
            </div>
		</fieldset><br/>

		<div class="row">
			<div class="large-4 columns">&nbsp;</div>
			<div class="large-4 columns">
				<input type="submit" class="button expand" value="Submit">
			</div>
			<div class="large-4 columns">&nbsp;</div>
		</div>
		{!! csrf_field() !!}
	</form>

<script type="text/javascript">

var xhr_patient_search = null;
var xhr_patient_record = null;
$(function(){
    $("#search_patient").autocomplete({
        source: function (request, response) 
        {
            xhr_patient_search = $.ajax({
                type : 'get',
                url : $("#search_patient_url").val(),
                data : 'search_patient=' + request.term,
                cache : false,
                dataType : "json",
                beforeSend: function(xhr) 
                {
                    if (xhr_patient_search != null)
                    {
                        xhr_patient_search.abort();
                    }
                }
            }).done(function(data){
                response($.map( data, function(value, key) 
                {
                    return { label: value, value: key }
                }));

            }).fail(function(jqXHR, textStatus){
                //console.log('Request failed: ' + textStatus);
            });
        }, 
        minLength: 2,
        autoFocus: true,
        select: function(a, b)
        {
            var id = b.item.value;
            var name = b.item.label;

            $('#demographics_id').val(id);
            $('#search_patient').val(name).focus();

            return false;
        }
    });
});
</script>

@endsection
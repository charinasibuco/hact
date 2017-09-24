var xhr_user_reset_password = null;
$(function(){
    //$('a').attr('data-tooltip','').attr('aria-haspopup',true);
    //$('.f-dropdown .open').css("z-index","9999");
	$('#user_password_reset').click(function(e){
        $('#generated_password').val('');
        $('.reset_value').hide();
        $('.loader').show();
        xhr_user_reset_password = $.ajax({
            cache : false,
            url : $('#user_password_reset_url').val(),
            dataType : "json",
            beforeSend: function(xhr)
            {
                if (xhr_user_reset_password != null){
                    xhr_user_reset_password.abort();
                }
            }
        }).done(function(data) {
            $('.loader').hide();
            $('.reset_value').show();
        	$('#generated_password').val(data['password']);
        }).fail(function(jqXHR, textStatus) {
            //console.log("Fail");
            alert('Pls. refresh your browser!');
        });

		e.preventDefault();
	});
});

var xhr_search_patient = null;
$(function(){
    jQuery(function($){
        var windowWidth = $(window).width();

        $(window).resize(function() {
            if(windowWidth != $(window).width()){
                location.reload();
                return;
            }
        });
    });
    $("#search_patient").autocomplete({
        source: function (request, response)
        {
            xhr_search_patient = $.ajax({
                type : 'get',
                url : $("#search_patient_url").val(),
                data : 'patient_search=' + request.term,
                cache : false,
                dataType : "json",
                beforeSend: function(xhr)
                {
                    if (xhr_search_patient != null)
                    {
                        xhr_search_patient.abort();
                    }
                }
            }).done(function(data)
            {
                response($.map( data, function(value, key)
                {
                    return { label: value, value: key }
                }));

            }).fail(function(jqXHR, textStatus)
            {
                //console.log('Request failed: ' + textStatus);
            });
        },
        minLength: 2,
        autoFocus: true,
        select: function(a, b)
        {
            var id = b.item.value;
            var name = b.item.label;

            $('#patient_id').val(id);
            $('#search_patient').val(name).focus();
            getPatientRecord(id);

            return false;
        }
    });
});

var xhr_search_vct = null;
$(function(){
    autocomplete_search = function(){
        $.post()
    };
    $("#search_vct").autocomplete({
        source: function (request, response)
        {
            xhr_search_vct = $.ajax({
                type : 'get',
                url : $("#search_vct_url").val(),
                data : 'search=' + request.term,
                cache : false,
                dataType : "json",
                beforeSend: function(xhr)
                {
                    if (xhr_search_vct != null)
                    {
                        xhr_search_vct.abort();
                    }
                }
            }).done(function(data)
            {
                response($.map( data, function(value, key)
                {
                    return { label: value, value: key }
                }));

            }).fail(function(jqXHR, textStatus)
            {
                //console.log('Request failed: ' + textStatus);
            });
        },
        minLength: 2,
        autoFocus: true,
        select: function(a, b)
        {
            var id = b.item.value;
            var name = b.item.label;

            $('#patient_id').val(id);
            $('#search_vct').val(name).focus();
            return false;
        }
    });
});

var xhr_item_search = null;
$(function(){
    $("#search_item").autocomplete({
        source: function (request, response) 
        {
            xhr_item_search = $.ajax({
                type : 'get',
                url : $("#search_item_url").val(),
                data : 'search=' + request.term,
                cache : false,
                dataType : "json",
                beforeSend: function(xhr) 
                {
                    if (xhr_item_search != null)
                    {
                        xhr_item_search.abort();
                    }
                }
            }).done(function(data) 
            {
                response($.map( data, function(value, key) 
                {
                    return { label: value, value: key }
                }));

            }).fail(function(jqXHR, textStatus) 
            {
                //console.log('Request failed: ' + textStatus);
            });
        }, 
        minLength: 2,
        autoFocus: true,
        select: function(a, b)
        {
            var id = b.item.value;
            var medicine_name = b.item.label;

            $('#medicine_id').val(id);
            $('#search_item').val(medicine_name).focus();
            return false;
        }
    });
});

var xhr_item_search = null;
$(function(){
    $("#search_physician").autocomplete({
        source: function (request, response) 
        {
            xhr_item_search = $.ajax({
                type : 'get',
                url : $("#search_physician_url").val(),
                data : 'search_physician=' + request.term,
                cache : false,
                dataType : "json",
                beforeSend: function(xhr) 
                {
                    if (xhr_item_search != null)
                    {
                        xhr_item_search.abort();
                    }
                }
            }).done(function(data) 
            {
                response($.map( data, function(value, key) 
                {
                    return { label: value, value: key }
                }));

            }).fail(function(jqXHR, textStatus) 
            {
                //console.log('Request failed: ' + textStatus);
            });
        }, 
        minLength: 2,
        autoFocus: true,
        select: function(a, b)
        {
            var id = b.item.value;
            var name = b.item.label;

            $('#attending_physician').val(id);
            $(this).val(name).focus();
            return false;
        }
    });
});

$(function(){
    $(document).foundation({
        "magellan-expedition": {
            active_class: 'active', // specify the class used for active sections
            threshold: 0, // how many pixels until the magellan bar sticks, 0 = auto
            destination_threshold: 20, // pixels from the top of destination for it to be considered active
            throttle_delay: 50, // calculation throttling to increase framerate
            fixed_top: 0, // top distance in pixels assigend to the fixed element on scroll
            offset_by_height: true // whether to offset the destination by the expedition height. Usually you want this to be true, unless your expedition is on the side.
        }
    });
});

$(function(){
    $(".fdatepicker").fdatepicker({
        //format: 'MM dd, yyyy',
        format: 'mm/dd/yyyy',
         startDate: '',
        disableDblClickSelection: true
    });
});

$(function(){
    $(".monthyearpicker").fdatepicker({
        format: 'yyyy',
        disableDblClickSelection: true
    });
});

$(function(){
    $(".yearpicker").fdatepicker({
        format: 'yyyy',
        disableDblClickSelection: true
    });
});

$(function(){
    $("input[name='birth_date']").on('change', function(){
        var date    = $(this).val();
        var age     = getAge(date);
        $("input[name='age']").val(age);
    });
});

function getAge(getDate)
{
    dob = new Date(getDate);
    var today   = new Date();
    var age     = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
    return age;
}

var xhr_patient_record = null;
function getPatientRecord(id)
{
    xhr_patient_record = $.ajax({
        type : 'get',
        url : $("#patient_record_url").val(),
        data : 'id=' + id,
        cache : false,
        dataType : "json",
        beforeSend: function(xhr) 
        {
            if (xhr_patient_record != null)
            {
                xhr_patient_record.abort();
            }
        }
    }).done(function(data){

        var age = getAge(data['birth_date']);

        $('#gender').val(data['gender']);
        $('#age').val(age);
        $('#is_pregnant').val(data['is_presently_pregnant']);

        if(data['is_presently_pregnant'] == 1)
        {
            $('.pregnancy_history').show();
        }
        else
        {
            $('.pregnancy_history').hide();
        }

        if(age < 18)
        {
            $('.mother_hiv_history').show();
        }
        else
        {
            $('.mother_hiv_history').hide();
        }

    }).fail(function(jqXHR, textStatus){
        //console.log('Request failed: ' + textStatus);
    });
}
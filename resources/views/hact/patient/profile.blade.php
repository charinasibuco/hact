@extends('hact.layouts.layout_admin')

@section('content')

<div class="row">
	<div class="large-12 columns">
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('patient') }}">Patient</a></li>
			<li class="current"><a href="#">{{ $patient->code_name }}</a></li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="large-12 columns">
		@include('hact.messages.success')
		@include('hact.messages.error_list')
	</div>
</div>
<div class="row">
	<div class="large-12 columns top-bar-profile-column">
		<nav class="top-bar-profile" data-topbar role="navigation">
			<section class="top-bar-section">
				<!-- Right Nav Section -->
				<ul class="left" style="list-style:none">
					<li class="has-dropdown">
						<a href="#"><i class="fa fa-plus fa-lg"></i> Add </a>
						<ul class="dropdown" style="list-style:none">
							<li><a href="{{ route('checkup_create', $patient->id) }}" title="Schedule a Consultation"><i class="fa fa-user-md fa-lg"></i> Consultation</a></li>
							@if(Auth::user()->access == 1)
								<li><a href="{{ route('vct_create', $patient->id) }}" ><i class="fa fa-hand-stop-o fa-lg"></i> VCT</a></li>
							@endif
							<li><a href="{{ route('medical_abstract_create', $patient->id) }}" ><i class="fa fa-file-text-o fa-lg"></i> Medical Abstract</a></li>
							<li><a href="{{ route('laboratory_create', $patient->id) }}" ><i class="fa fa-eyedropper fa-lg"></i> Laboratory</a></li>
							{{--<li><a href="{{ route('infections_create', $patient->id) }}" ><i class="fa fa-heartbeat fa-lg"></i> Infections</a></li>--}}
							<li><a href="{{ route('tuberculosis_create', $patient->id) }}" ><i class="fa fa-stethoscope fa-lg"></i> Tuberculosis</a></li>
							@if($patient->gender == '0')
								<li><a href="{{ route('ob_gyne_patient_create', $patient->id) }}" ><i class="fa fa-venus fa-lg"></i> OB Gyne</a></li>
							@endif
							@if(!$mortality || $mortality->count() == 0)
								<li><a href="{{ route('mortality_create', $patient->id) }}" ><i class="fa fa-bed fa-lg"></i> Mortality</a></li>
							@endif
						</ul>
					</li>
					<li><a href="{{ route('patient_masterlist', $patient->id) }}" title="Show Masterlist" ><i class="fa fa-list-alt fa-lg"></i> Masterlist</a></li>
					@if(Auth::user()->access == 1)
						<li><a href="{{ route('patient_edit', $patient->id) }}" title="Edit Patient" ><i class="fa fa-edit fa-lg"></i> Edit</a></li>
					@endif
				</ul>
				<a href="{{ route('patient') }}" class="alert small button right" title="Cancel new patient"><i class="fi fi-x"></i> Cancel</a>
			</section>
		</nav>
	</div>
</div>
<div class="row">
	<div class="large-12 columns">
		{{--<div class="panel">--}}
			<div id="horizontalTab" class="r-tabs">
				<ul class='tabs nav nav-tabs'>
					<li><a href='#tab1' class="tab-link"><i class="fa fa-user fa-lg"></i> Patient's Information</a></li>
					@if( count($patient->VCT) > 0)
						<li><a href='#tab3' class="tab-link"><i class="fa fa-hand-stop-o fa-lg"></i> VCT</a></li>
					@endif
					@if( $checkups && count($checkups) > 0 )
						<li><a href='#tab2' class="tab-link"><i class="fa  fa-user-md fa-lg"></i> Consultation</a></li>
					@endif
					@if( $arv && count($arv) > 0 )
						<li><a href='#tab9' class="tab-link"><i class="fa fa-bed fa-lg"></i> Medication</a></li>
					@endif
					@if( $medical_abstract && count($medical_abstract) > 0 )
						<li><a href='#tab10' class="tab-link"><i class="fa fa-bed fa-lg"></i> Medical Abstract</a></li>
					@endif
					@if( $laboratories && count($laboratories) > 0)
					<li><a href='#tab4' class="tab-link"><i class="fa fa-eyedropper fa-lg"></i> Laboratory</a></li>
					@endif
					{{--@if( $infections_report && count($infections_report) > 0)
					<li><a href='#tab5' class="tab-link"><i class="fa fa-heartbeat fa-lg"></i> Infections</a></li>
					@endif--}}
					@if( $tuberculosis && count($tuberculosis) > 0)
					<li><a href='#tab6' class="tab-link"><i class="fa fa-stethoscope fa-lg"></i> Tuberculosis</a></li>
					@endif
					@if($patient->gender == '0')
						@if( $ob && count($ob) > 0)
							<li><a href='#tab7' class="tab-link"><i class="fa fa-venus fa-lg"></i> OB Gyne</a></li>
						@endif
					@endif
					@if( $mortality && count($mortality) > 0)
					<li><a href='#tab8' class="tab-link"><i class="fa fa-bed fa-lg"></i> Mortality</a></li>
					@endif

				</ul>

				<div id='tab1' class="tab_content">
					@include('hact.patient.patientinfo')
				</div>
				@if( count($patient->VCT) > 0 )
					<div id='tab3' class="tab_content">
						@include('hact.patient.vct')
					</div>
				@endif
				@if( $checkups && count($checkups) > 0 )
					<div id='tab2' class="tab_content">
						@include('hact.patient.checkup')
					</div>
				@endif
				@if( $arv && count($arv) > 0 )
					<div id="tab9" class="tab_content">
						@include('hact.patient.arv')
					</div>
				@endif
				@if( $medical_abstract && count($medical_abstract) > 0 )
					<div id='tab2' class="tab_content">
						@include('hact.patient.medical_abstract')
					</div>
				@endif

				@if( $laboratories && count($laboratories) > 0)
				<div id="tab4" class="tab_content">
					@include('hact.patient.laboratory')
				</div>
				@endif
				{{--@if( $infections_report && count($infections_report) > 0)
				<div id="tab5" class="tab_content">
					@include('hact.patient.infections')
				</div>
				@endif--}}
				@if( $tuberculosis && count($tuberculosis) > 0)
				<div id="tab6" class="tab_content">
					@include('hact.patient.tuberculosis')
				</div>
				@endif
				@if( $ob && count($ob) > 0)
				<div id="tab7" class="tab_content">
					@include('hact.patient.obgyne')
				</div>
				@endif
				@if($mortality)
				<div id="tab8" class="tab_content">
					@include('hact.patient.mortality')
				</div>
				@endif

			</div>
		{{--</div>--}}
	</div>
</div>
<script>
	$(".collapse_report").hide();
	$('#search_patient').attr('readonly',true);
	jQuery.jQueryTab({
		responsive:true,							// enable accordian on smaller screens
		collapsible:true,							// allow all accordions to collapse
		useCookie: false,							// remember last active tab using cookie
		openOnhover: false,						// open tab on hover
		initialTab:1 ,								// tab to open initially; start count at 1 not 0

		cookieName: 'active-tab',			// name of the cookie set to remember last active tab
		cookieExpires: 4,							// when it expires in days or standard UTC time
		cookiePath: '/',							// path on which cookie is accessible
		cookieDomain:'',							// domain of the cookie
		cookieSecure: false,					// enable secure cookie - requires https connection to transfer

		tabClass:'tabs',							// class of the tabs
		headerClass:'accordion_tabs',	// class of the header of accordion on smaller screens
		contentClass:'tab_content',		// class of container
		activeClass:'active',					// name of the class used for active tab

		tabTransition: 'fade',				// transitions to use - normal or fade
		tabIntime:500,								// time for animation IN (1000 = 1s)
		tabOuttime:0,									// time for animation OUT (1000 = 1s)

		accordionTransition: 'slide',	// transitions to use - normal or slide
		accordionIntime:500,					// time for animation IN (1000 = 1s)
		accordionOuttime:400,					// time for animation OUT (1000 = 1s)

		before: function(){},					// function to call before tab is opened
		after: function(){}						// function to call after tab is opened
	});

//	$( '#nav li:has(ul)' ).doubleTapToGo();
//	$('ul.tabs  li.dropdown a.dropdown-toggle').click(function(){
//		//console.log('Link Clicked')
//		$('ul.dropdown-menu').show();
//	});
//	$('ul.dropdown-menu').mouseleave(function(){
//		$(this).hide();
//	}).blur(function(){
//			$(this).hide();
//			})
//
//	$('ul.tabs').each(function(){
//		// For each set of tabs, we want to keep track of
//		// which tab is active and its associated content
//		var $active, $content, $links = $(this).find('a.tab-link');
//
//		// If the location.hash matches one of the links, use that as the active tab.
//		// If no match is found, use the first link as the initial active tab.
//		$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
//		$active.addClass('active');
//
//		$content = $($active[0].hash);
//
//		// Hide the remaining content
//		$links.not($active).each(function () {
//			$(this.hash).hide();
//		});
//
//		// Bind the click event handler
//		$(this).on('click', 'a.tab-link', function(e){
//			// Make the old tab inactive.
//			$active.removeClass('active');
//			$content.hide();
//			$content.removeClass('active');
//			// Update the variables with the new link and content
//			$active = $(this);
//			$content = $(this.hash);
//
//			// Make the tab active.
//			$active.addClass('active');
//			$content.show().addClass('active');
//
//			// Prevent the anchor's default click action
//			e.preventDefault();
//		});
//	});
</script>
<script>

	<?php
        if($patient->birth_date_format)
        {
            echo '$(\'#age\').val(getAge(\''.$patient->birth_date_format.'\'));';
        }
    ?>
    $(function(){
		$('#birth_date').change(function(){
			var value = $(this).val();
			var age = getAge(value);

			$('#age').val();
		});
	});

	$(function(){
		$('input[name=gender]').change(function(){
			var value = $(this).val();
			//var value = $(this).is(':checked');
			//$('#female').is(':checked')

			if(value == 1)
			{
				$('.is_presently_pregnant_div').hide();
				$('#pregnant_no').prop('disabled', true);
				$('#pregnant_yes').prop('disabled', true);
				$('#pregnant_no').prop('checked', false);
				$('#pregnant_yes').prop('checked', false);
			}
			else
			{
				$('.is_presently_pregnant_div').show();
				$('#pregnant_no').prop('disabled', false);
				$('#pregnant_yes').prop('disabled', false);
			}
		});
	});

	$(function(){
		$('input[name=is_working]').change(function(){
			var value = $(this).val();

			if(value == 1)
			{
				$('#current_occupation').attr('readonly', false).focus();
			}
			else
			{
				$('#current_occupation').attr('readonly', true);
			}
		});
	});

	$(function(){
		$('input[name=is_work_abroad_in_past_5years]').change(function(){
			var value = $(this).val();

			if(value == 1)
			{

				$('.work_abroad').show();
				//$('#last_contract').show();
				//$('#last_work_country').show();
			}
			else
			{
				$('.work_abroad').hide();
				$('#last_contract, #last_work_country').val('');

				$('input[name=is_based]').prop('checked', false);
				/*$('#last_contract').hide();
				 $('#last_work_country').hide();

				 $('#last_contract').val('');
				 $('#last_work_country').val('');*/
			}
		});
	});
	$(function(){
		$('input[name=is_working]').change(function(){
			var value = $(this).val();

			if(value == 0)
			{
				$('#current_occupation').val('');
			}
		});
	});
</script>

@endsection

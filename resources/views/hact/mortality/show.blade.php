@extends('hact.layouts.layout_admin')

@section('content')

	<div class='row'>
		<div class='large-12 columns'>
			<ul class="breadcrumbs">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li><a href="{{ route('mortality') }}">Mortality</a></li>
				<li class="current">{{ $patient->code_name }}</li>
			</ul>
		</div>
	</div>
	@include("hact.messages.success")
	@include("hact.messages.error_list")
	<div class="panel">


		<div class="row">
			<div class="large-4 columns">
				<b>Date of Death: </b> {{ $mortality->date_of_death->format('m/d/Y') }}
			</div>
			<div class="large-8 columns">
				&nbsp;
			</div>
		</div>
		<br/>
		<fieldset>
			<legend>Cause of Death</legend>
			<div class="row">
				<div class="large-3 columns">
					HIV Related: {{ $mortality->is_hiv_related_format }}
				</div>
				<div class="large-6 columns">
					Immediate Cause: {{ $mortality->immediate_cause }}
				</div>
				<div class="large-3 columns">
					ICD-10 Code: {{ $mortality->immediate_icd10_code }}
				</div>
			</div>
			<div class="row">
				<div class="large-3 columns">
					&nbsp;
				</div>
				<div class="large-6 columns">
					Antecedent Cause: {{ $mortality->antecedent_cause }}
				</div>
				<div class="large-3 columns">
					ICD-10 Code: {{ $mortality->antecedent_icd10_code }}		
				</div>
			</div>
			<div class="row">
				<div class="large-3 columns">
					&nbsp;
				</div>
				<div class="large-6 columns">
					Underlying Cause: {{ $mortality->underlying_cause }}
				</div>
				<div class="large-3 columns">
					ICD-10 Code: {{ $mortality->underlying_icd10_code }}
				</div>
			</div>
		</fieldset>
		<div class="row">
		<div class="large-6 columns">
			<fieldset>
				<legend>Opportunistic infections present prior to death</legend>
				@if($mortality->tuberculosis == 1)
					Tuberculosis<br/>
				@endif

				@if($mortality->pneumocystis_pneumonia == 1)
					Pneumocystis Pneumonia<br/>
				@endif

				@if($mortality->cryptococcal_meningitis == 1)
					Cryptococcal Meningitis<br/>
				@endif

				@if($mortality->cytomegalovirus == 1)
					Cytomegalovirus<br/>
				@endif

				@if($mortality->candidiasis == 1)
					Candidiasis<br/>
				@endif

				@if($mortality->other)
					Other: {{ $mortality->other }}<br/>
				@endif


			</fieldset>
		</div>
		<div class="large-6 columns">
			<fieldset>
				<legend>CD4 Count</legend>
						Last CD4 Count: {{ $mortality->last_cd4_count_format or "None" }}<br/>
						CD4 Count: {{ $mortality->cd4_count or "None" }}<br/>
						Have Taken ARVs: {{ $mortality->have_taken_arv_format }}<br/>
			</fieldset>
			<fieldset>
				<legend>ARV History</legend>
						Have Taken ARVs: {{ $mortality->have_taken_arv_format }}<br/>
						Last ARV Regimen: {{ $mortality->last_arv_regimen_format }}
			</fieldset>
		</div>

	</div>
		<div class="row">
			<div class="large-12 columns">
				<ul data-accordion="" class="accordion">
					<li class="accordion-navigation"><a href="#panel1a">Death Certificate</a>
						<div id="panel1a" class="content">
							<img src="{{ asset($mortality->death_certificate) }}" alt="no image available">
						</div>
					</li>
				</ul>
			</div>
		</div>

@endsection
@extends('hact.layouts.layout_admin')

@section('content')

    <div class='row'>
        <div class='large-12 columns'>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('medication_index') }}">Medication</a></li>
                <li class="current"><a href="#">{{ $patient->full_name or '' }}</a></li>
            </ul>
        </div>
    </div>	

	<div class='row'>
		<div class='large-4 columns'>
			<label>Patient Name</label>
		</div>
		<div class='large-8 columns'>
			&nbsp;aw
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Started with IPT</label>
		</div>
		<div class='large-8 columns'>
			&nbsp;
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Hepatitis B</label>
		</div>
		<div class='large-8 columns'>
			&nbsp;
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Hepatitis C</label>
		</div>
		<div class='large-8 columns'>
			&nbsp;
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Pneumocystis Pneumonia</label>
		</div>
		<div class='large-8 columns'>
			&nbsp;
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Oropharyngeal Candidiasis</label>
		</div>
		<div class='large-8 columns'>
			&nbsp;
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Syphilis</label>
		</div>
		<div class='large-8 columns'>
			&nbsp;
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
			<label>STI's</label>
		</div>
		<div class='large-8 columns'>
			&nbsp;
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Others</label>
		</div>
		<div class='large-8 columns'>
			&nbsp;
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Site</label>
		</div>
		<div class='large-8 columns'>
			&nbsp;
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
			<label>TB Regimen</label>
		</div>
		<div class='large-8 columns'>
			&nbsp;
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Drug Resistance</label>
		</div>
		<div class='large-8 columns'>
			&nbsp;
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Treatment Outcome</label>
		</div>
		<div class='large-8 columns'>
			&nbsp;
		</div>
	</div>

@endsection
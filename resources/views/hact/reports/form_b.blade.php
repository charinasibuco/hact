@extends('hact.layouts.layout_admin')

@section('content')
<div class="row">
	<div class='large-12 columns'>
		<ul class="breadcrumbs">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li class="current"><a href="#">Form-B</a></li>
		</ul>
	</div>
</div>
<div class="panel">
<!-- <div class="row box">
	<div class="large-11 columns text-center">ASSESSMENT FOR ART ELIGIBILITY</div>
	<div class="large-1 column text-center">B</div>
</div>

<div class="row box">
	<div class="large-12 columns text-center">The law on Reporting Disease (R.A. 3573) & the Philippine AIDS Prevention and Control Act (R.A. 8504) requires phycisians to report all diagnosed HIVinfections to the HIV & AIDS Registrar at the Epidermiology Bureau, DOH Please write in CAPITAL LETTERS and CHECKS the appropriate boxes.</div>
</div> -->
<fieldset>
	<legend>Fill Up</legend>
	<div class="row">
		<div class="large-6 columns">
			<div class="row">
				<div class="large-4 columns">
					<label for="date_of_visit" class="inline">Date of Visit:</label>
				</div>
				<div class="large-8 columns"><input type="text" class="fdatepicker" name="date_of_visit" id="date_of_visit"></div>
			</div>
			<fieldset style="margin-bottom:20px;">
				<legend><small>Visit Type:</small></legend>
				<div class="row">
					<div class="large-6 columns">
						<div class="row">
							<div class="large-12 columns">
								<label for="first_consult">
									<input type="radio" id="first_consult"  name="visit_type" value="first_consult" /> First consult at this facility
								</label>
							</div>
						</div>
						<div class="row">
							<div class="large-12 columns">
								<label for="follow_up">
									<input type="radio" id="follow_up" name="visit_type" value="follow_up"/> Follow-up
								</label>
							</div>
						</div>
					</div>
					<div class="large-6 columns">
						<div class="row">
							<div class="large-12 columns">
								<label for="referred_by">Referred by:</label>
							</div>
						</div>
						<div class="row">
							<div class="large-12 columns">					
									<input style="margin-bottom:5px !important;" type="text" id="referred_by" name="referred_by">
							</div>
						</div>
					</div>
				</div>
			</fieldset>	
			<div class="row">
				<div class="large-4 columns">
					<label for="phycisians_name" class="inline">Phycisian's Name:
					</label>
				</div>
				<div class="large-8 columns">
					<input type="text" id="phycisians_name" name="phycisians_name">
				</div>
			</div>		
		</div>	
		<div class="large-6 columns">			
			<div class="row">
				<div class="large-2 columns">
					<label for="facility_name">Facility Name:</label>
				</div>
				<div class="large-9 columns">
					<input type="text" id="facility_name" name="facility_name">
				</div>
			</div>
			<div class="row" style="margin-bottom:18px;">
				<div class="large-3 columns">
					<label for="address">Address:</label>
				</div>
				<div class="large-9 columns">
					<textarea id="address" rows="3" name="address"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="large-3 columns">
					<label for="contact">Contact #:</label>
				</div>
				<div class="large-9 columns">
					<input type="text" id="contact" name="contact">
				</div>
			</div>
		</div>
	</div>
</fieldset>
<!-- Patient Info -->
<fieldset>
	<legend>PATIENT INFO</legend>
	<div class="row">
		<div class="large-12 columns">
			<div class="row top">
				<div class="large-3 columns">
					<label for="saccl_confirmatory_code" class="inline">SACCL Confirmatory Code:</label>
				</div>
				<div class="large-3 columns">
					<input type="text" id="saccl_confirmatory_code" name="saccl_confirmatory_code" >
				</div>
				<div class="large-2 columns">
					<label for="patient_code" class="inline">Patient Code:</label>
				</div>
				<div class="large-4 columns">
					<input type="text" id="patient_code" name="patient_code">
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns">
					<fieldset>
						<legend><small>If first visit, please fill out this section</small></legend>
						<div class="row">
							<div class="large-5 columns">
								<div class="row">
									<div class="large-2 columns">
										<label class="inline" for="uic">UIC:</label>
									</div>
									<div class="large-10 columns">
										<input type="text" id="uic" name="uic">
									</div>
								</div>
							</div>
							<div class="large-7 columns">
								<div class="row">
									<div class="large-4 columns">
										<label for="patients_full_name">Patient's Full Name:</label>
									</div>
									<div class="large-8 columns">
										<input type="text" id="patients_full_name" name="patients_full_name">
									</div>	
								</div>
							</div>
						</div>
						<div class="row">
<!-- <<<<<<< HEAD
							<div class="large-12 columns smalltext">
								<small>*UIC: First two letters of mother's name, first two letters of father's name, two-digit birth order, birthdate(MM-DD-YYYY)</small>
							</div>
======= -->
							<div class="large-5 columns"><em>*UIC: First two letters of mother's name, first two letters of father's name, two-digit birth order, birthdate(MM-DD-YYYY)</em></div>
							<div class="large-7 columns">
								<div class="row">
									<div class="large-4 columns">
										<label for="philhealth_no" class="inline">Philhealth No.:</label>
									</div>
									<div class="large-8 columns">
										<input type="text" id="philhealth_no" name="philhealth_no">
									</div>
								</div>
							</div>								
						</div>
						<div class="row">	
							<div class="large-5 columns">&nbsp;</div>	
							<div class="large-8 columns">
								<div class="large-3 columns">
									<label for="sex" class="inline right">Sex:</label>
								</div>
								<div class="large-1 columns">
									<label for="male"class="inline"><input type="radio" id="male" name="male"/> M</label>
								</div>
								<div class="large-1 columns">
									<label for="female" class="inline"><input type="radio" id="female" name="female"/> F</label>
								</div>
														<div class="large-2 columns">
								<label for="age" class="inline right">Age:</label>
							</div>
							<div class="large-3 columns">
								<input type="text" id="age" name="age">
							</div>				
							
						</div>

					</fieldset>
					<div class="row">&nbsp;</div>
				</div>
			</div>
		</div>
	</div>
</fieldset>
<!-- LABORATORY TEST -->
<fieldset>
	<legend>LABORATORY TEST</legend>
	<div class="row ">
		<div class="large-12 columns">
			<div class="row">
				<div class="large-4 columns text-center">Latest laboratory results</div>
				<div class="large-4 columns text-center">Date Done</div>
				<div class="large-4 columns text-center">Results</div>
				
			</div>
			<div class="row">
				<div class="large-4 column">
					<div class="row">
						<div class="large-2 column"></div>
						<div class="large-8 column"><label for="hemoglobin" class="inline">Hemoglobin</label></div>
					</div>
					<div class="row">
						<div class="large-2 column"></div>
						<div class="large-8 column"><label for="cd4_test" class="inline">CD4 Test</label></div>
					</div>
					<div class="row">
						<div class="large-2 column"></div>
						<div class="large-8 column"><label for="viral_load" class="inline">Viral Load</label></div>
					</div>
					<div class="row">
						<div class="large-2 column"></div>
						<div class="large-8 column"><label for="chest_x_ray" class="inline">Chest X-Ray</label></div>
					</div>
					<div class="row">
						<div class="large-2 column"></div>
						<div class="large-8 column"><label for="gene_xpert" class="inline">Gene Xpert</label></div>
					</div>
					<div class="row">
						<div class="large-2 column"></div>
						<div class="large-8 column"><label for="dssm_dst" class="inline">DSSM/DST</label></div>
					</div>
					<div class="row">
						<div class="large-2 column"></div>
						<div class="large-8 column"><label for="hivdr_and_genotype">HIVDR & Genotype</label></div>
					</div>
				</div>
				<div class="large-4 column">
					<div class="row">
						<div class="large-12 column"><input type="text" id="hemoglobin" name="hemoglobin" class="fdatepicker"></div>
					</div>
					<div class="row">
						<div class="large-12 column"><input type="text" id="cd4_test" name="cd4_test" class="fdatepicker"></div>
					</div>
					<div class="row">
						<div class="large-12 column"><input type="text" id="viral_load" name="viral_load" class="fdatepicker"></div>
					</div>
					<div class="row">
						<div class="large-12 column"><input type="text" id="chest_x_ray" name="chest_x_ray" class="fdatepicker"></div>
					</div>
					<div class="row">
						<div class="large-12 column"><input type="text" id="gene_xpert" name="gene_xpert" class="fdatepicker"></div>
					</div>
					<div class="row">
						<div class="large-12 column"><input type="text" id="dssm_dst" name="dssm_dst" class="fdatepicker"></div>
					</div>
					<div class="row">
						<div class="large-12 column"><input type="text" id="hivdr_and_genotype" name="hivdr_and_genotype" class="fdatepicker"></div>
					</div>
				</div>
				<div class="large-4 column">
					<div class="row">
						<div class="large-6 column"><input type="text"></div>
						<div class="large-6 column">g/L</div>
					</div>
					<div class="row">
						<div class="large-6 column"><input type="text"></div>
						<div class="large-6 column">cells/uL</div>
					</div>
					<div class="row">
						<div class="large-6 column"><input type="text"></div>
						<div class="large-6 column">copies/mL</div>
					</div>
					<div class="row">
						<div class="large-12 column"><input type="text"></div>
					</div>
					<div class="row">
						<div class="large-12 column"><input type="text"></div>
					</div>
					<div class="row">
						<div class="large-12 column"><input type="text"></div>
					</div>
					<div class="row">
						<div class="large-12 column"><input type="text"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</fieldset>

<fieldset>
<legend>WHO Classification</legend>
	<div class="large-6 columns">
		<div class="row" id="stage_one">
				<label for="stage_1">
					<input type="radio" id="stage_1" name="stage" value=1> 
					Clinical Stage 1
				</label>

			<div class="large-12 columns">
				<label for="asymptomatic">
					<input  type="checkbox" id="asymptomatic" name="disease"> Asymptomatic
				</label>
			</div>
			<div class="large-12 columns">
				<label for="persistent">
					<input  type="checkbox" id="persistent" name="disease" > Persistent generalized lymphadenopathy (PGL)
				</label>
			</div>
		</div>
		<div class="row">
			<label for="stage_2">
				<input type="radio" id="stage_2" name="stage" value=2>
				Clinical Stage 2
			</label>
			<div class="large-12 columns">
				<label for="moderate">
					<input type="checkbox" id="moderate" name="disease" >
				Moderate unexplained weight loss (<10% of presumed or measured body weight)
				</label>
			</div>
			<div class="large-12 columns">
				<label for="recurrent">
					<input type="checkbox" id="recurrent" name="disease" >
				Recurrent respiratory tract infections (RTI\'s, sinusitis, bronchitis, otitis media, pharyngitis)
				</label>
			</div>
			<div class="large-12 columns">
				<label for="herpes">
					<input type="checkbox" id="herpes" name="disease" >
				Herpes zoster
				</label>
			</div>
			<div class="large-12 columns">
				<label for="angular">
					<input type="checkbox" id="angular" name="disease" >
				Angular cheilitis
				</label>
			</div>
			<div class="large-12 columns">
				<label for="recurrent_oral">
					<input type="checkbox" id="recurrent_oral" name="disease" >
				Recurrent oral ulcerations
				</label>
			</div>
			<div class="large-12 columns">
				<label for="papular">
					<input type="checkbox" id="papular" name="disease" >
				Papular pruritic eruptions
				</label>
			</div>
			<div class="large-12 columns">
				<label for="seborrhoeic">
					<input type="checkbox" id="seborrhoeic" name="disease" >
				Seborrhoeic dermatitis
				</label>
			</div>
			<div class="large-12 columns">
				<label for="fungal">
					<input type="checkbox" id="fungal" name="disease" >
				Fungal nail infections of fingers
				</label>
			</div>
		</div>
		<div class="row">
			<label for="stage_3">
				<input type="radio" id="stage_3" name="stage">
				Clinical Stage 3
			</label>
			<label class="smalltext">Conditions where a presumptive diagnosis can be made of the basis of clinical signs or simple investigations</label>
			<div class="large-12 columns">
				<label for="severe_weight">
					<input type="checkbox" id="severe_weight" name="disease" >
				Severe weight loss (>10% of presumed or measured bodyweight)
				</label>
			</div>
			<div class="large-12 columns">
				<label for="unexplained_chronic">
					<input type="checkbox" id="unexplained" name="disease" >
				Unexplained chronic diarrhoea for longer than one month
				</label>
			</div>
			<div class="large-12 columns">
				<label for="unexplained_persistent">
					<input type="checkbox" id="unexplained_persistent" name="disease">
				Unexplained persistent fever (intermittent or constant for longer than one month)
				</label>
			</div>
			<div class="large-12 columns">
				<label for="oral_candidiasis">
					<input type="checkbox" id="oral_candidiasis" name="disease" >
				Oral candidiasis
				</label>
			</div>
			<div class="large-12 columns">
				<label for="oral_hairy">
					<input type="checkbox" id="oral_hairy" name="disease" >
				Oral hairy leukoplakia
				</label>
			</div>
			<div class="large-12 columns">
				<label for="pulmonary_tuberculosis">
					<input type="checkbox" id="pulmonary_tuberculosis" name="disease" >
				Pulmonary tuberculosis (TB) diagnosed inlast two years
				</label>
			</div>
			<div class="large-12 columns">
				<label for="severe_presumed">
					<input type="checkbox" id="severe_presumed"  name="disease" >
				Severe presumed bacterial infections (e.g. pneumonia, empyema, pyomyositis, bone or joint infections, meningitis, bacteraemia)
				</label>
			</div>
			<div class="large-12 columns">
				<label for="acute">
					<input type="checkbox" id="acute" name="disease" >
				Acute necrotizing ulcerative stomatitis, gingivitis or periodontitis
				</label>
			</div>
			<label class="smalltext">Conditions where confirmatory diagnostic testing is necessary</label>
			<div class="large-12 columns">
				<label for="unexplained_anaemia">
					<input type="checkbox" id="unexplained_anaemia" name="disease" >
				Unexplained anaemia (<8 g/dl), and or neutropenia (<500/mm3) and or thrombocytopenia (<50 000/mm3) for more than one month
				</label>
			</div>
		</div>
	</div>
	<div class="large-6 columns">
		<div class="row">
			<label for="stage_4">
				<input type="radio" id="stage_4" name="stage">
			Clinical Stage 4
			</label>
			<label class="smalltext">Conditions where a presumptive diagnosis can be made on the basis of clinical signs or simple investigations</label>
			<div class="large-12 columns">
				<label for="hiv_wasting">
					<input type="checkbox" id="hiv_wasting" name="disease" >
				HIV wasting syndrome
				</label>
			</div>
			<div class="large-12 columns">
				<label for="pneumocystis_pneumonia">
					<input type="checkbox" name="disease" >
				Pneumocystis pneumonia
				</label>
			</div>
			<div class="large-12 columns" >
				<label for="recurrent_severe">
					<input type="checkbox" id="recurrent_severe" name="disease" >
				Recurrent severe or radiological bacteria; pneumonia
				</label>
			</div>
			<div class="large-12 columns">
				<label for="chronic_herpes">
					<input type="checkbox" id="chronic_herpes" name="disease" >
				Chronic herpes simplex infection (orolabial, genital or anorectal of more than one month\'s duration)
				</label>
			</div>
			<div class="large-12 columns">
				<label for="oesophageal">
					<input type="checkbox" id="oesophageal" name="disease" >
				Oesophageal candidiasis
				</label>
			</div>
			<div class="large-12 columns" name="disease">
				<label for="extrapulmonary_tb">
					<input type="checkbox" id="extrapulmonary_tb" name="disease">
				Extrapulmonary TB
				</label>
			</div>
			<div class="large-12 columns" name="disease">
				<label for="kaposi">
					<input type="checkbox" id="kaposi" name="disease" >
				Kaposi's sarcoma
				</label>
			</div>
			<div class="large-12 columns" name="disease">
				<label for="central_nervous">
					<input type="checkbox" id="central_nervous" name="disease" >
				Central nervous system (CNS) toxoplasmosis
				</label>
			</div>
			<div class="large-12 columns" name="disease">
				<label for="hiv_encephalopathy">
					<input type="checkbox" id="hiv_encephalopathy" name="disease" >
				HIV encephalopathy
				</label>
			</div>
			<label>Conditions where confirmatory diagnostic testing is necessary:</label>
			<div class="large-12 columns">
				<label for="extrapulmonary_cryptococcosis">
					<input type="checkbox" id="extrapulmonary_cryptococcosis" name="disease" >
				Extrapulmonary cryptococcosis including meningitis
				</label>
			</div>
			<div class="large-12 columns">
				<label for="disseminated">
					<input type="checkbox" id="disseminated" name="disease" >
				Disseminated non-tuberculous mycobacteria infection
				</label>
			</div>
			<div class="large-12 columns">
				<label for="progressive_multifocal">
					<input type="checkbox" id="progressive_multifocal" name="disease" >
				Progressive multifocal leukoencephalopathy (PML)
				</label>
			</div>
			<div class="large-12 columns">
				<label for="candida">
					<input type="checkbox" id="candida" name="disease" >
				Candida of trachea, bronchi or lungs
				</label>
			</div>
			<div class="large-12 columns">
				<label>
					<input type="checkbox" name="disease">
				Cryptosporidiosis
				</label>
			</div>
			<div class="large-12 columns">
				<label>
					<input type="checkbox" name="disease">
				Isosporiasis
				</label>
			</div>
			<div class="large-12 columns">
				<label>
					<input type="checkbox" name="disease">
				Visceral herpes simplex infection
				</label>
			</div>
			<div class="large-12 columns">
				<label>
					<input type="checkbox" name="disease">
				Cytomegalovirus (CMV) infection (retinitis or of an organ other than liver, spleen or lymph nodes)
				</label>
			</div>
			<div class="large-12 columns">
				<label>
					<input type="checkbox" name="disease">
				Any disseminated mycosis (e.g. histoplasmosis, coccidiomycosis, penicilliosis)
				</label>
			</div>
			<div class="large-12 columns">
				<label>
					<input type="checkbox" name="disease">
				Recurrent non-typhoidal salmonella septicaemia
				</label>
			</div>
			<div class="large-12 columns">
				<label>
					<input type="checkbox" name="disease">
				Lymphoma (cerebral or B cell non-Hodgkin)
				</label>
			</div>
			<div class="large-12 columns">
				<label>
					<input type="checkbox" name="disease">
				Invasive cervical carcinoma
				</label>
			</div>
			<div class="large-12 columns">
				<label>
					<input type="checkbox" name="disease">
				Visceral leishmaniasis
				</label>
			</div>
		</div>
	</div>
</fieldset>
<fieldset>
<legend>INFECTIONS</legend>
	<div class="row">
		<div class="large-12 column ">
			<div class="large-6 column"> 
				<div class="row">
					<div class="large-12 column">Infection Currently present (check all that apply):</div>
					<div class="large-12 column"><label for="hepatitis_b"><input type="checkbox" id="hepatitis_b" name="hepatitis_b"> Hepatitis B</label></div>
					<div class="large-12 column"><label for="hepatitis_c"><input type="checkbox" id="hepatitis_c" name="hepatitis_c"> Hepatitis C</label></div>
					<div class="large-12 column"><label for="pneumocystis_pneumonia"><input type="checkbox" id="pneumocystis_pneumonia" name="pneumocystis_pneumonia"> Pneumocystis pneumonia</label></div>
					<div class="large-12 column"><label for="oropharyngeal_candidiasis"><input type="checkbox" id="oropharyngeal_candidiasis" name="oropharyngeal_candidiasis"> Oropharyngeal candidiasis</label></div>
				</div>
			</div>
			<div class="large-6 column"> 
				<div class="row">
					<div class="large-12 column">&nbsp;</div>
				</div>
				<div class="row">
					<div class="large-12 column"><label for="syphilis"><input type="checkbox" id="syphilis" name="syphilis"> Syphilis</label></div>
					<div class="large-12 column"><label for="stis"><input type="checkbox" id="stis" name="stis"> STIs (specify)</label></div>
					<div class="large-12 column"><label for="others"><input type="checkbox" id="others" name="others"> Other (specify)</label></div>
				</div>
			</div>
		</div>
	</div>
</fieldset>
<fieldset>
<legend>OB</legend>
	<div class="row">
		<div class="large-12 column">
				<div class="large-6 column">
					<div class="row">
						<div class="large-12 column"><label>Currently Pregnant:</label></div>
						<div class="large-2 column"><label for="no"><input type="checkbox" id="no" name="currently_pregnant"> No</label></div>
						<div class="large-2 column"><label for="yes"><input type="checkbox" id="yes" name="currently_pregnant"> Yes</label></div>
						<div class="large-8 column">&nbsp;</div>
						<div class="row">	
						</div>
					</div>
					<div class="row">
						<div class="large-6 column">
							<label for="currently_pregnant_if_yes_gestation_age" class="inline">If yes, age of gestation:</label>
						</div>
						<div class="large-6 column"><input type="text" id="currently_pregnant_if_yes_gestation_age" name="currently_pregnant_if_yes_gestation_age"></div>
					</div>
					<div class="row">
						<div class="large-6 column">
							<label class="inline">If delivered, date of delivery:</label>
						</div>
						<div class="large-6 column"><input type="text" class="fdatepicker"></div>
					</div>
					<div class="large-12 column smalltext">
						<small>*For live births, please accomplish the PMTCT-Newborn form.</small>
					</div>
					
				</div>
				<div class="large-6 column">
					<div class="large-12 column"><label>Type of infant feeding:</label></div>
					<div class="large-offset-1">
						<label for="breast_feeding">
							<input type="checkbox" id="breast_feeding" name="infant_type"> Breast Feeding
						</label>
					</div>
					<div class="large-offset-1">
						<label for="formula_feeding">
							<input type="checkbox" id="formula_feeding" name="infant_type"> Formula Feeding
						</label>
					</div>
					<div class="large-offset-1 ">
						<label for="mixed_feeding">
							<input type="checkbox" id="mixed_feeding" name="infant_type"> Mixed Feeding
						</label>
					</div>
			</div>
		</div>
</fieldset>
<fieldset>
	<legend>ART STATUS</legend>
	<div class="row">
		<div class="large-5 column">
			<label>Eligible for ART?</label>
			<div class="large-3 column"><label for="no_art_eligible"><input type="checkbox" id="no_art_eligible" name="art_eligible">No</label></div>
			<div class="large-3 column"><label for="yes_art_eligible"><input type="checkbox" id="yes_art_eligible" name="art_eligible">Yes</label></div>
			<div class="large-6 column"></div>
			
			<div class="large-12 column"><label for="if_deferred"><input type="checkbox" id="if_deferred" name="if_deferred"> Deffered, please specify reason:</label></div>
			<div class="large-12 column"><input type="text" name="if_deferred_specify"></div>

		</div>
		<div class="large-3 column">
			<div class="large-12 column"><label>Reason:</label></div>
			<div class="large-12 column"><label><input type="checkbox" name="reason"> Low CD4 count</label></div>
			<div class="large-12 column"><label><input type="checkbox" name="reason"> Active TB</label></div>
			<div class="large-12 column"><label><input type="checkbox" name="reason"> Child < 5 y.o.</label></div>
			<div class="large-12 column"><label><input type="checkbox" name="reason"> Hep B or C requiring treatment</label></div>
		</div> 
		<div class="large-4 column">
			<div class="large-12 column"><label><input type="checkbox"> Pregnant/ Breastfeeding</label></div>
			<div class="large-12 column"><label><input type="checkbox"> WHO Classification 3 or 4</label></div>
			<div class="large-12 column"><label><input type="checkbox"> Other:</label></div>
		</div>
		
	</div>
	<div class="row">
		<div class="large-12 column  smalltext"><small>(If yes will provide primary HIV care for patient, please fill up Form C)</small></div>
	</div>
</fieldset>
<fieldset>
<legend>FUTURE CARE</legend>
<div class="row">
	<div class="large-12 column">
		<div class="row">
			<div class="large-12 column">
				<label><input type="checkbox"> This facility will provide primary HIV care for the patient.</label>
			</div>
		</div>
		<div class="row">
			<div class="large-12 column">
				<label><input type="checkbox"> I have reffered the patient to:(please attach a copy of this accomplished form to the referral letter)</label>
			</div>
		</div>
		<div class="row">
			<div class="large-3 column">
				<label>Name of Facility:</label>
			</div>
			<div class="large-3 column">
				<input type="text" name="name_of_facility">
			</div>
			<div class="large-6 column">
			</div>
		</div>
		<div class="row">
			<div class="large-3 column">
				<label>Name of Physician:</label>
			</div>
			<div class="large-3 column">
				<input type="text" name="name_of_physician">
			</div>
			<div class="large-6 column">
			</div>
		</div>
	</div>
</div>
</div>
</fieldset>
<div class="row">	
	<div class="large-12 columns">
		<button type="submit" class="button small alert">Save</button>
		<a class="button small info" href=""><strong>Back</strong></a>
		{!! csrf_field() !!}
	</div>
</div>

<script type="text/javascript">
// var countChecked = function() {
//   var n = $( "input:checked" ).length;

//   	 // $( "div#count" ).text( n + (n === 1 ? " is" : " are") + " checked!" );
// 	$( "div#count" ).text(n+"is checked")
// };
// countChecked();
 
// $( "#stage_one input[type=checkbox]" ).on( "click", countChecked );
</script>
@endsection

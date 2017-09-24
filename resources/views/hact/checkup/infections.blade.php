<div class="row">
	<div class="large-12 columns">

			<fieldset>
				<legend>Infections</legend>
				<input type="hidden" id="patient_id" name="patient_id" value="{{ $patient_id }}" />
				<input type="hidden" id="result_date" name="result_date" class = "fdatepicker" value="{{ $checkup_date }}" readonly>
				{{--@if($previous_stage != null)--}}
				{{--@endif--}}
				<div class="row">
					<div class="large-3 columns">
						<label for="clinical_stage">Current Clinical Stage:</label>
						<input type="text" id="clinical_stage" name="clinical_stage" value="{{ @$clinical_stage }}" readonly>
					</div>
					<div class="large-3 columns">
						<label>Previous Clinical Stage:</label>
						<input type="text" id="previous_clinical_stage" name="previous_clinical_stage" value="{{ @$previous_stage }}" readonly>
					</div>
					<div class="large-3 columns">
						&nbsp;
						<input type="hidden" name="order_number" value="{{ @$next_order_number }}">
					</div>
				</div>

				<fieldset>
					<legend>WHO Classification</legend>
					@if($errors->has('clinical_stage'))
						<div class="highlight_error">
							<div class="alert alert-box notification-details fi-alert"> Please Check atleast 1 Clinical Stage Infections!</div><br>
					@endif
					<div class="row">
						<div class="large-6 columns">

							<fieldset>
								<legend>Clinical Stage 1 Infections</legend>
								<div class="row">
									<div class="large-1 columns">
										<input  type="checkbox" value="1" id="infection1_1" name="infections[1][1]" class="infection in_1">
									</div>
									<div class="large-11 columns">
										<label for="infection1_1">
											Asymptomatic
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="2" id="infection1_2" name="infections[1][2]" class="infection in_1">
									</div>
									<div class="large-11 columns">
										<label for="infection1_2">
											Persistent generalized lymphadenopathy (PGL)
										</label>
									</div>
								</div>
							</fieldset>

							<fieldset>
								<legend>Clinical Stage 2 Infections</legend>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="1" id="infection2_1" name="infections[2][1]" class="infection in_2">
									</div>
									<div class="large-11 columns">
										<label for="infection2_1">
											Moderate unexplained weight loss (&lt;10% of presumed or measured body weight)
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="2" id="infection2_2" name="infections[2][2]" class="infection in_2" >
									</div>
									<div class="large-11 columns">
										<label for="infection2_2">
											Recurrent respiratory tract infections (RTI's, sinusitis, bronchitis, otitis media, pharyngitis)
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="3" id="infection2_3" name="infections[2][3]" class="infection in_2" >
									</div>
									<div class="large-11 columns">
										<label for="infection2_3">
											Herpes zoster
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="4" id="infection2_4" name="infections[2][4]" class="infection in_2" >
									</div>
									<div class="large-11 columns">
										<label for="infection2_4">
											Angular cheilitis
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="5" id="infection2_5" name="infections[2][5]" class="infection in_2" >
									</div>
									<div class="large-11 columns">
										<label for="infection2_5">
											Recurrent oral ulcerations
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="6" id="infection2_6" name="infections[2][6]" class="infection in_2" >
									</div>
									<div class="large-11 columns">
										<label for="infection2_6">
											Papular pruritic eruptions
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="7" id="infection2_7" name="infections[2][7]" class="infection in_2" >
									</div>
									<div class="large-11 columns">
										<label for="infection2_7">
											Seborrhoeic dermatitis
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="8" id="infection2_8" name="infections[2][8]" class="infection in_2" >
									</div>
									<div class="large-11 columns">
										<label for="infection2_8">
											Fungal nail infections of fingers
										</label>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<legend>Clinical Stage 3 Infections</legend>
								<br/>
								<label class="smalltext">Conditions where a presumptive diagnosis can be made of the basis of clinical signs or simple investigations</label>
								<div class="row">
										<div class="large-1 columns">
											<input type="checkbox" value="1" id="infection3_1" name="infections[3][1]" class="infection in_3" >
										</div>
										<div class="large-11 columns">
											<label for="infection3_1">
												Severe weight loss (>10% of presumed or measured bodyweight)
											</label>
										</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="2" id="infection3_2" name="infections[3][2]" class="infection in_3" >
									</div>
									<div class="large-11 columns">
										<label for="infection3_2">
											Unexplained chronic diarrhoea for longer than one month
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="3" id="infection3_3" name="infections[3][3]" class="infection in_3">
									</div>
									<div class="large-11 columns">
										<label for="infection3_3">
											Unexplained persistent fever (intermittent or constant for longer than one month)
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="4" id="infection3_4" name="infections[3][4]" class="infection in_3" >
									</div>
									<div class="large-11 columns">
										<label for="infection3_4">
											Oral candidiasis
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="5" id="infection3_5" name="infections[3][5]" class="infection in_3" >
									</div>
									<div class="large-11 columns">
										<label for="infection3_5">
											Oral hairy leukoplakia
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="6" id="infection3_6" name="infections[3][6]" class="infection in_3" >
									</div>
									<div class="large-11 columns">
										<label for="infection3_6">
											Pulmonary tuberculosis (TB) diagnosed inlast two years
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="7" id="infection3_7"  name="infections[3][7]" class="infection in_3" >
									</div>
									<div class="large-11 columns">
										<label for="infection3_7">
											Severe presumed bacterial infections (e.g. pneumonia, empyema, pyomyositis, bone or joint infections, meningitis, bacteraemia)
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="8" id="infection3_8" name="infections[3][8]" class="infection in_3" >
									</div>
									<div class="large-11 columns">
										<label for="infection3_8">
											Acute necrotizing ulcerative stomatitis, gingivitis or periodontitis
										</label>
									</div>
								</div>
								<label class="smalltext">
										Conditions where confirmatory diagnostic testing is necessary
								</label>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="9" id="infection3_9" name="infections[3][8]" class="infection in_3" >
									</div>
									<div class="large-11 columns">
										<label for="infection3_9">
											Unexplained anaemia (&lt;8 g/dl), and or neutropenia (&lt;500/mm3) and or thrombocytopenia (&lt;50 000/mm3) for more than one month
										</label>
									</div>
								</div>
							</fieldset>
						</div>
						<div class="large-6 columns">
							<fieldset>
								<legend>Clinical Stage 4 Infections</legend>
								<br/>
								<label class="smalltext">Conditions where a presumptive diagnosis can be made on the basis of clinical signs or simple investigations</label>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="1" id="infection4_1" name="infections[4][1]" class="infection in_4" >
									</div>
									<div class="large-11 columns">
										<label for="infection4_1">
											HIV wasting syndrome
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="2" id="infection4_2" name="infections[4][2]" class="infection in_4" >
									</div>
									<div class="large-11 columns">
										<label for="infection4_2">
											Pneumocystis pneumonia
										</label>
									</div>
								</div>
								<div class="row" >
									<div class="large-1 columns">
										<input type="checkbox" value="3" id="infection4_3" name="infections[4][3]" class="infection in_4" >
									</div>
									<div class="large-11 columns">
										<label for="infection4_3">
											Recurrent severe or radiological bacteria; pneumonia
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="4" id="infection4_4" name="infections[4][4]" class="infection in_4" >
									</div>
									<div class="large-11 columns">
										<label for="infection4_4">
											Chronic herpes simplex infection (orolabial, genital or anorectal of more than one month\'s duration)
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="5" id="infection4_5" name="infections[4][5]" class="infection in_4" >
									</div>
									<div class="large-11 columns">
										<label for="infection4_5">
											Oesophageal candidiasis
										</label>
									</div>
								</div>
								<div class="row" name="infections[][]" class="infection in_">
									<div class="large-1 columns">
										<input type="checkbox" value="6" id="infection4_6" name="infections[4][6]" class="infection in_4">
									</div>
									<div class="large-11 columns">
										<label for="infection4_6">
											Extrapulmonary TB
										</label>
									</div>
								</div>
								<div class="row" name="infections[][]" class="infection in_">
									<div class="large-1 columns">
										<input type="checkbox" value="7" id="infection4_7" name="infections[4][7]" class="infection in_4" >
									</div>
									<div class="large-11 columns">
										<label for="infection4_7">
											Kaposi's sarcoma
										</label>
									</div>
								</div>
								<div class="row" name="infections[][]" class="infection in_">
									<div class="large-1 columns">
										<input type="checkbox" value="8" id="infection4_8" name="infections[4][8]" class="infection in_4" >
									</div>
									<div class="large-11 columns">
										<label for="infection4_8">
											Central nervous system (CNS) toxoplasmosis
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="9" id="infection4_9" name="infections[4][9]" class="infection in_4" >
									</div>
									<div class="large-11 columns">
										<label for="infection4_9">
											HIV encephalopathy
										</label>
									</div>
								</div>

								<label class="smalltext">Conditions where confirmatory diagnostic testing is necessary:</label>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="10" id="infection4_10" name="infections[4][10]" class="infection in_4" >
									</div>
									<div class="large-11 columns">
										<label for="infection4_10">
											Extrapulmonary cryptococcosis including meningitis
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="11" id="infection4_11" name="infections[4][11]" class="infection in_4" >
									</div>
									<div class="large-11 columns">
										<label for="infection4_11">
											Disseminated non-tuberculous mycobacteria infection
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="12" id="infection4_12" name="infections[4][12]" class="infection in_4" >
									</div>
									<div class="large-11 columns">
										<label for="infection4_12">
											Progressive multifocal leukoencephalopathy (PML)
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="13" id="infection4_13" name="infections[4][13]" class="infection in_4" >
									</div>
									<div class="large-11 columns">
										<label for="infection4_13">
											Candida of trachea, bronchi or lungs
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="14" name="infections[4][14]" class="infection in_4" id="infection4_14">
									</div>
									<div class="large-11 columns">
										<label for="infection4_14">
											Cryptosporidiosis
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="15" name="infections[4][15]" class="infection in_4" id="infection4_15">
									</div>
									<div class="large-11 columns">
										<label for="infection4_15">
											Isosporiasis
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="16" name="infections[4][16]" class="infection in_4" id="infection4_16">
									</div>
									<div class="large-11 columns">
										<label for="infection4_16">
											Visceral herpes simplex infection
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="17" name="infections[4][17]" class="infection in_4" id="infection4_17">
									</div>
									<div class="large-11 columns">
										<label for="infection4_17">
											Cytomegalovirus (CMV) infection (retinitis or of an organ other than liver, spleen or lymph nodes)
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="18" name="infections[4][18]" class="infection in_4" id="infection4_18">
									</div>
									<div class="large-11 columns">
										<label for="infection4_18">
											Any disseminated mycosis (e.g. histoplasmosis, coccidiomycosis, penicilliosis)
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="19" name="infections[4][19]" class="infection in_4" id="infection4_19">
									</div>
									<div class="large-11 columns">
										<label for="infection4_19">
											Recurrent non-typhoidal salmonella septicaemia
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="20" name="infections[4][20]" class="infection in_4" id="infection4_20">
									</div>
									<div class="large-11 columns">
										<label for="infection4_20">
											Lymphoma (cerebral or B cell non-Hodgkin)
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="21" name="infections[4][21]" class="infection in_4" id="infection4_21">
									</div>
									<div class="large-11 columns">
										<label for="infection4_21">
											Invasive cervical carcinoma
										</label>
									</div>
								</div>
								<div class="row">
									<div class="large-1 columns">
										<input type="checkbox" value="22" name="infections[4][22]" class="infection in_4" id="infection4_22">
									</div>
									<div class="large-11 columns">
										<label for="infection4_22">
											Visceral leishmaniasis
										</label>
									</div>
								</div>
							</fieldset>
						</div>
					</div>
					@if($errors->has('clinical_stage'))
						<div class="clearfix"></div>
						</div>
					@endif
				</fieldset>

				<fieldset>
					<legend>Currently Present Infections</legend>
					<div class="row">
						<div class="large-6 columns">
								<label for="hepatitis_b"><input type="checkbox" value="1" id="hepatitis_b" name="hepatitis_b"> Hepatitis B</label>
								<label for="hepatitis_c"><input type="checkbox" value="1" id="hepatitis_c" name="hepatitis_c"> Hepatitis C</label>
								<label for="pneumocystis_pneumonia"><input type="checkbox" value="1" id="pneumocystis_pneumonia" name="pneumocystis_pneumonia"> Pneumocystis Pneumonia</label>
								<label for="orpharyngeal_candidiasis"><input type="checkbox" value="1" id="orpharyngeal_candidiasis" name="orpharyngeal_candidiasis"> Oropharyngeal Candidiasis</label>
								<label for="syphilis"><input type="checkbox" value="1" id="syphilis" name="syphilis"> Syphilis</label>
						</div>
						<div class="large-6 columns">
							<div class="row">
								<div class="large-12 columns">
									<input type="checkbox" value="1" name="stis_checkbox" id="stis_checkbox"><label for="stis_checkbox">STIs</label>
									<input type="text" class="{{ ($errors->has('stis')) ? 'highlight_error' : '' }}" name="stis" value="{{ @$stis }}">
								</div>
							</div>
							<div class="row">
								<div class="large-12 columns">
									<input type="checkbox" value="1" name="others_checkbox" id="others_checkbox"><label for="others_checkbox">Others</label>
									<input type="text" name="others" class="{{ ($errors->has('others')) ? 'highlight_error' : '' }}" value="{{ @$others }}">
								</div>
							</div>
						</div>
					</div>
				</fieldset>
			</fieldset>
			<br/>

	</div>
</div>
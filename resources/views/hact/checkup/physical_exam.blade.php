<fieldset>
    <legend>Physical Examination</legend>
    <div class="row">
        <div class="medium-2 columns phys-test">General Survey:</div>
        <div class="medium-6 columns">
            <ul class="inline-list">
                <li><label for="gs_awake"><input type="checkbox" @if(isset($physical_exam['general_survey']['Awake'])) checked @endif id="gs_awake" name="physical_exam[general_survey][Awake]" value="1"> Awake</label></li>
                <li><label for="gs_drowsy"><input type="checkbox" @if(isset($physical_exam['general_survey']['Drowsy'])) checked @endif id="gs_drowsy" name=physical_exam[general_survey][Drowsy]" value="1"> Drowsy</label></li>
                <li><label for="gs_unconscious"><input type="checkbox" @if(isset($physical_exam['general_survey']['Unconscious'])) checked @endif id="gs_unconscious" name="physical_exam[general_survey][Unconscious]" value="1"> Unconscious</label></li>
                <li><label for="gs_ambulatory"><input type="checkbox" @if(isset($physical_exam['general_survey']['Ambulatory'])) checked @endif id="gs_ambulatory" name="physical_exam[general_survey][Ambulatory]" value="1"> Ambulatory</label></li>
                <li><label for="gs_cp_distress"><input type="checkbox" @if(isset($physical_exam['general_survey']['Distress'])) checked @endif id="gs_cp_distress" name="physical_exam[general_survey][Distress]" value="1"> CP Distress</label></li>
            </ul>
        </div>
        <div class="medium-4 columns">
            <textarea name="physical_exam[general_survey_remarks]" id="general_survey_remarks" placeholder="Remarks for General Survey...">{{ $physical_exam['general_survey_remarks'] }}</textarea>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="medium-2 columns phys-test">Skin:</div>
        <div class="medium-6 columns">
            <ul class="inline-list">
                <li><label for="skin_warm_to_touch"><input type="checkbox" @if(isset($physical_exam['skin']['Warm to touch'])) checked @endif id="skin_warm_to_touch" name="physical_exam[skin][Warm to touch]" value="1"> Warm to touch</label></li>
                <li><label for="skin_cyanosis"><input type="checkbox" @if(isset($physical_exam['skin']['Cyanosis'])) checked @endif id="skin_cyanosis" name="physical_exam[skin][Cyanosis]" value="1"> Cyanosis</label></li>
                <li><label for="skin_jaundice"><input type="checkbox" @if(isset($physical_exam['skin']['Jaundice'])) checked @endif id="skin_jaundice" name="physical_exam[skin][Jaundice]" value="1"> Jaundice</label></li>
                <li><label for="skin_rashes"><input type="checkbox" @if(isset($physical_exam['skin']['Rashes'])) checked @endif id="skin_rashes" name="physical_exam[skin][Rashes]" value="1"> Rashes</label></li>
            </ul>
        </div>
        <div class="medium-4 columns">
            <textarea name=physical_exam[skin_remarks]" id="skin_remarks" placeholder="Remarks for Skin...">{{ @$physical_exam['skin_remarks'] }}</textarea>
        </div>
    </div>
    <br/>
    <fieldset>
        <legend>HEENT</legend>
        <div class="row">
            <div class="medium-8 columns">
                <div class="row">
                    <div class="medium-4 columns phys-test">HEENT:</div>
                    <div class="medium-8 columns">
                        <ul class="inline-list">
                            <li><label for="nve"><input type="checkbox" @if(isset($physical_exam['heent']['NVE'])) checked @endif id="nve" name="physical_exam[heent][NVE]" value="1"> NVE</label></li>
                            <li><label for="clad"><input type="checkbox" @if(isset($physical_exam['heent']['Clad'])) checked @endif id="clad" name="physical_exam[heent][Clad]" value="1"> CLAD</label></li>
                            <li><label for="oral_thrush"><input type="checkbox" @if(isset($physical_exam['heent']['Oral thrush'])) checked @endif id="oral_thrush" name="physical_exam[heent][Oral thrush]" value="1"> Oral Thrush</label></li>
                            <li><label for="ear_discharges"><input type="checkbox" @if(isset($physical_exam['heent']['Ear discharges'])) checked @endif id="ear_discharges" name="physical_exam[heent][Ear discharges]" value="1"> Ear Discharges</label></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-4 columns phys-test">Lips/Buccal Mucosa:</div>
                    <div class="medium-8 columns">
                        <ul class="inline-list">
                            <li><label for="lbm_moist"><input type="checkbox" @if(isset($physical_exam['lips_buccal_mucosa']['Moist'])) checked @endif id="lbm_moist" name="physical_exam[lips_buccal_mucosa][Moist]" value="1"> Moist</label></li>
                            <li><label for="lbm_dry"><input type="checkbox" @if(isset($physical_exam['lips_buccal_mucosa']['Dry'])) checked @endif id="lbm_dry" name="physical_exam[lips_buccal_mucosa][Dry]" value="1"> Dry</label></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-4 columns phys-test">Sclerae:</div>
                    <div class="medium-8 columns">
                        <ul class="inline-list">
                            <li><label for="sclerae_anicteric"><input type="checkbox" @if(isset($physical_exam['sclerae']['Anicteric'])) checked @endif id="sclerae_anicteric" name="physical_exam[sclerae][Anicteric]" value="1"> Anicteric</label></li>
                            <li><label for="sclerae_icteric"><input type="checkbox" @if(isset($physical_exam['sclerae']['Icteric'])) checked @endif id="sclerae_icteric" name="physical_exam[sclerae][Icteric]" value="1"> Icteric</label></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-4 columns phys-test">Conjunctivae</div>
                    <div class="medium-8 columns">
                        <ul class="inline-list">
                            <li><label for="conj_pinkish"><input type="checkbox" @if(isset($physical_exam['conjunctivae']['Pinkish'])) checked @endif id="conj_pinkish" name="physical_exam[conjunctivae][Pinkish]" value="1"> Pinkish</label></li>
                            <li><label for="conj_pale"><input type="checkbox"  @if(isset($physical_exam['conjunctivae']['Pale'])) checked @endif id="conj_pale" name="physical_exam[conjunctivae][Pale]" value="1"> Pale</label></li>
                        </ul>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="medium-4 columns">
                <textarea rows="10" name="physical_exam[heent_remarks]" id="heant_remarks" placeholder="Remarks for HEENT...">{{ @$physical_exam['heent_remarks'] }}</textarea>
            </div>
        </div>
    </fieldset>
    <br/>
    <div class="row">
        <div class="medium-2 columns phys-test">Chest and Lungs:</div>
        <div class="medium-6 columns">
            <ul class="inline-list">
                <li><label for="cal_sce"><input type="checkbox" @if(isset($physical_exam['chest_and_lungs']['SCE'])) checked @endif name="physical_exam[chest_and_lungs][SCE]" id="cal_sce" value="1"> SCE</label></li>
                <li><label for="cal_retractions"><input type="checkbox" @if(isset($physical_exam['chest_and_lungs']['Retractions'])) checked @endif name="physical_exam[chest_and_lungs][Retractions]" id="cal_retractions"  value="1"> Retractions</label></li>
                <li><label for="cal_masses"><input type="checkbox" @if(isset($physical_exam['chest_and_lungs']['Masses'])) checked @endif name="physical_exam[chest_and_lungs][Masses]" id="cal_masses" value="1"> Masses</label></li>
                <li><label for="cal_cbs"><input type="checkbox" @if(isset($physical_exam['chest_and_lungs']['CBS'])) checked @endif name="physical_exam[chest_and_lungs][CBS]" id="cal_cbs"  value="1"> CBS</label></li>
                <li><label for="cal_wheeze"><input type="checkbox" @if(isset($physical_exam['chest_and_lungs']['Wheeze'])) checked @endif name="physical_exam[chest_and_lungs][Wheeze]" id="cal_wheeze"  value="1"> Wheeze</label></li>
                <li><label for="cal_crackles"><input type="checkbox" @if(isset($physical_exam['chest_and_lungs']['Crackles'])) checked @endif name="physical_exam[chest_and_lungs][Crackles]" id="cal_crackles"  value="1"> Crackles</label></li>
                <li><label for="cal_dec_absent_breath_sounds"><input type="checkbox" @if(isset($physical_exam['chest_and_lungs']['Dec absent breath sounds'])) checked @endif  name="physical_exam[chest_and_lungs][Dec absent breath sounds]" id="cal_dec_absent_breath_sounds"  value="1"> Dec/absent breath sounds</label></li>
            </ul>
        </div>
        <div class="medium-4 columns">
            <textarea name="physical_exam[chest_and_lungs_remarks]" id="chest_and_lungs_remarks" placeholder="Remarks for Chest and Lungs...">{{ @$physical_exam['chest_and_lungs_remarks'] }}</textarea>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="medium-2 columns phys-test">Cardiovascular:</div>
        <div class="medium-6 columns">
            <ul class="inline-list">
                <li><label for="cardio_ap"><input type="checkbox" @if(isset($physical_exam['cardial']['AP'])) checked @endif id="cardio_ap" name="physical_exam[cardial][AP]" value="1"> AP</label></li>
                <li><label for="cardio_nrrr"><input type="checkbox" @if(isset($physical_exam['cardial']['NRRR'])) checked @endif id="cardio_nrrr" name="physical_exam[cardial][NRRR]" value="1"> NRRR</label></li>
                <li><label for="cardio_tachycardia"><input type="checkbox" @if(isset($physical_exam['cardial']['Tachycardia'])) checked @endif id="cardio_tachycardia" name="physical_exam[cardial][Tachycardia]" value="1"> Tachycardia</label></li>
                <li><label for="cardio_distinct_s1_s2"><input type="checkbox" @if(isset($physical_exam['cardial']['Distinct s1/s2'])) checked @endif id="cardio_distinct_s1_s2" name="physical_exam[cardial][Distinct s1/s2]" value="1"> Distinct S1/S2</label></li>
                <li><label for="cardio_murmur"><input type="checkbox" @if(isset($physical_exam['cardial']['Murmur'])) checked @endif id="cardio_murmur" name="physical_exam[cardial][Murmur]" value="1"> Murmur</label></li>
            </ul>
        </div>
        <div class="medium-4 columns">
            <textarea name="physical_exam[cardial_remarks]" id="cardial_remarks" placeholder="Remarks for Cardiovascular...">{{ @$physical_exam['cardial_remarks'] }}</textarea>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="medium-2 columns phys-test">Abdomen</div>
        <div class="medium-6 columns">
            <ul class="inline-list">
                <li><label for="abdomen_flat"><input type="checkbox" @if(isset($physical_exam['abdomen']['Flat'])) checked @endif id="abdomen_flat" name="physical_exam[abdomen][Flat]" value="1"> Flat</label></li>
                <li><label for="abdomen_globular_distended"><input type="checkbox" @if(isset($physical_exam['abdomen']['Globular distended'])) checked @endif id="abdomen_globular_distended" name="physical_exam[abdomen][Globular distended]" value="1"> Globular/Distended</label></li>
                <li><label for="abdomen_soft"><input type="checkbox" @if(isset($physical_exam['abdomen']['Soft'])) checked @endif id="abdomen_soft" name="physical_exam[abdomen][Soft]" value="1"> Soft</label></li>
                <li><label for="abdomen_nontender"><input type="checkbox" @if(isset($physical_exam['abdomen']['Nontender'])) checked @endif id="abdomen_nontender" name="physical_exam[abdomen][Nontender]" value="1"> Nontender</label></li>
                <li><label for="abdomen_masses"><input type="checkbox" @if(isset($physical_exam['abdomen']['Masses'])) checked @endif id="abdomen_masses" name="physical_exam[abdomen][Masses]" value="1"> Masses</label></li>
            </ul>
        </div>
        <div class="medium-4 columns">
            <textarea name="physical_exam[abdomen_remarks]" id="abdomen_remarks" placeholder="Remarks for Abdomen...">{{ @$physical_exam['abdomen_remarks'] }}</textarea>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="medium-2 columns phys-test">Extremities</div>
        <div class="medium-6 columns">
            <ul class="inline-list">
                <li><label for="ex_grossly_normal"><input type="checkbox" @if(isset($physical_exam['extremities']['Grossly normal'])) checked @endif id="ex_grossly_normal" name="physical_exam[extremities][Grossly normal]" value="1"> Grossly normal</label></li>
                <li><label for="ex_edema"><input type="checkbox" @if(isset($physical_exam['extremities']['Edema'])) checked @endif id="ex_edema" name="physical_exam[extremities][Edema]" value="1"> Edema</label></li>
                <li><label for="ex_ulcerations"><input type="checkbox" @if(isset($physical_exam['extremities']['Ulceration'])) checked @endif id="ex_ulcerations" name="physical_exam[extremities][Ulceration]" value="1"> Ulcerations</label></li>
                <li><label for="ex_fpp"><input type="checkbox" @if(isset($physical_exam['extremities']['FPP'])) checked @endif id="ex_fpp" name="physical_exam[extremities][FPP]" value="1"> FPP</label></li>
                <li><label for="ex_good_rom"><input type="checkbox" @if(isset($physical_exam['extremities']['Good ROM'])) checked @endif id="ex_good_rom" name="physical_exam[extremities][Good ROM]" value="1"> Good ROM</label></li>
            </ul>
        </div>
        <div class="medium-4 columns">
            <textarea name="physical_exam[extremities_remarks]" id="extremities_remarks" placeholder="Remarks for Extremities...">{{ @$physical_exam['extremities_remarks'] }}</textarea>
        </div>
        </div>
    </div>
</fieldset>

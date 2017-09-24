<!---->
<!--label for="neurologic_examination">Neurologic Examination</label-->
<input type="hidden" name="neurologic_examination" id="neurologic_examination" value="">
<!---->
<fieldset id="neuro_exam">
    <legend>Neurologic Exam</legend>
    <fieldset>
        <legend>Mental Status</legend>
        <div class="row">
            <div class="medium-3 columns neuro-title">Level of consciousness:</div>
            <div class="medium-9 columns">
                <ul class="inline-list">
                    <li><div class="clear_radio">(clear)</div></li>
                    <li><label for="level_of_consciousness_alert"><input type="radio" @if(isset($neuro_exam['level_of_consciousness']) && $neuro_exam['level_of_consciousness'] == 'Alert') checked @endif id="level_of_consciousness_alert" name="neuro_exam[level_of_consciousness]" value="Alert"> Alert</label></li>
                    <li><label for="level_of_consciousness_lethargic"><input type="radio" @if(isset($neuro_exam['level_of_consciousness']) && $neuro_exam['level_of_consciousness'] == 'Lethargic') checked @endif id="level_of_consciousness_lethargic" name="neuro_exam[level_of_consciousness]" value="Lethargic"> Lethargic</label></li>
                    <li><label for="level_of_consciousness_obtunded"><input type="radio" @if(isset($neuro_exam['level_of_consciousness']) && $neuro_exam['level_of_consciousness'] == 'Obtunded') checked @endif id="level_of_consciousness_obtunded" name="neuro_exam[level_of_consciousness]" value="Obtunded"> Obtunded</label></li>
                    <li><label for="level_of_consciousness_stupor"><input type="radio" @if(isset($neuro_exam['level_of_consciousness']) && $neuro_exam['level_of_consciousness'] == 'Stupor') checked @endif id="level_of_consciousness_stupor" name="neuro_exam[level_of_consciousness]" value="Stupor"> Stupor</label></li>
                    <li><label for="level_of_consciousness_coma"><input type="radio" @if(isset($neuro_exam['level_of_consciousness']) && $neuro_exam['level_of_consciousness'] == 'Coma') checked @endif id="level_of_consciousness_coma" name="neuro_exam[level_of_consciousness]" value="Coma"> Coma</label></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="medium-3 columns neuro-title">Orientation:</div>
            <div class="medium-9 columns">
                <ul class="inline-list">
                    <li><label for="orientation_time"><input type="checkbox" @if(isset($neuro_exam['orientation']['Time'])) checked @endif name="neuro_exam[orientation][Time]" id="orientation_time" value="1"> Time</label></li>
                    <li><label for="orientation_place"><input type="checkbox" @if(isset($neuro_exam['orientation']['Place'])) checked @endif name="neuro_exam[orientation][Place]" id="orientation_place" value="1"> Place</label></li>
                    <li><label for="orientation_person"><input type="checkbox" @if(isset($neuro_exam['orientation']['Person'])) checked @endif name="neuro_exam[orientation][Person]" id="orientation_person" value="1"> Person</label></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="medium-3 columns neuro-title">Mood and Behavior:</div>
            <div class="medium-9 columns">
                <ul class="inline-list">
                    <li><div class="clear_radio">(clear)</div></li>
                    <li><label for="appropriate"><input type="radio" @if(isset($neuro_exam['mood_and_behavior']) && $neuro_exam['mood_and_behavior'] == 'Appropriate') checked @endif id="appropriate" name="neuro_exam[mood_and_behavior]" value="Appropriate"> Appropriate</label></li>
                    <li><label for="inappropriate"><input type="radio" @if(isset($neuro_exam['mood_and_behavior']) && $neuro_exam['mood_and_behavior'] == 'Inappropriate') checked @endif id="inappropriate" name="neuro_exam[mood_and_behavior]" value="Inappropriate"> Inappropriate</label></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="medium-3 columns neuro-title">Memory:</div>
            <div class="medium-9 columns">
                <ul class="inline-list">
                    <li><label for="memory_cognitive"><input type="checkbox" @if(isset($neuro_exam['memory']['Cognitive'])) checked @endif id="memory_cognitive" name="neuro_exam[memory][Cognitive]" value="1"> Immediate Recall</label></li>
                    <li><label for="memory_recent"><input type="checkbox" @if(isset($neuro_exam['memory']['Recent'])) checked @endif id="memory_recent" name="neuro_exam[memory][Recent]" value="1"> Recent</label></li>
                    <li><label for="memory_remote"><input type="checkbox" @if(isset($neuro_exam['memory']['Remote'])) checked @endif id="memory_remote" name="neuro_exam[memory][Remote]" value="1"> Remote</label></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="medium-3 columns neuro-title">Cognitive Function:</div>
            <div class="medium-9 columns">
                <ul class="inline-list">
                    <li><div class="clear_radio">(clear)</div></li>
                    <li><label for="cognitive_function_good"><input type="radio" @if(isset($neuro_exam['cognitive_function']) && $neuro_exam['cognitive_function'] == 'Good') checked @endif id="cognitive_function_good" name="neuro_exam[cognitive_function]" value="Good"> Good</label></li>
                    <li><label for="cognitive_function_poor"><input type="radio" @if(isset($neuro_exam['cognitive_function']) && $neuro_exam['cognitive_function'] == 'Poor') checked @endif id="cognitive_function_poor" name="neuro_exam[cognitive_function]" value="Poor"> Poor</label></li>
                </ul>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Cranial Nerve</legend>
        <fieldset>
            <legend>I</legend>
            <div class="row">
                <div class="medium-3 columns neuro-title">I:</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><div class="clear_radio">(clear)</div></li>
                        <li><label for="able_to_smell_present"><input type="radio" @if(isset($neuro_exam['able_to_smell']) && $neuro_exam['able_to_smell'] == 'Intact') checked @endif id="able_to_smell_present" name="neuro_exam[able_to_smell]" value="Intact"> Intact</label></li>
                        <li><label for="able_to_smell_absent"><input type="radio" @if(isset($neuro_exam['able_to_smell']) && $neuro_exam['able_to_smell'] == 'Impaired') checked @endif id="able_to_smell_absent" name="neuro_exam[able_to_smell]" value="Impaired"> Impaired</label></li>
                    </ul>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>II</legend>
            <div class="row">
                <div class="medium-3 columns neuro-title">Visual Acuity:</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><div class="clear_radio">(clear)</div></li>
                        <li><label for="va_intact"><input type="radio" @if(isset($neuro_exam['visual_acuity']) && $neuro_exam['visual_acuity'] == 'Intact') checked @endif name="neuro_exam[visual_acuity]" id="va_intact" value="Intact"> Intact</label></li>
                        <li><label for="va_impaired"><input type="radio" @if(isset($neuro_exam['visual_acuity']) && $neuro_exam['visual_acuity'] == 'Impaired') checked @endif name="neuro_exam[visual_acuity]" id="va_impaired" value="Impaired"> Impaired</label></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="medium-3 columns neuro-title">Visual Fields:</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><div class="clear_radio">(clear)</div></li>
                        <li><label for="p_full"><input type="radio" @if(isset($neuro_exam['pupils']) && $neuro_exam['pupils'] == 'Full') checked @endif name="neuro_exam[pupils]" id="p_full" value="Full"> Full</label></li>
                        <li><label for="p_defect"><input type="radio" @if(isset($neuro_exam['pupils']) && $neuro_exam['pupils'] == 'Presence of visual field defect') checked @endif name="neuro_exam[pupils]" id="p_defect" value="Presence of visual field defect"> Presence of visual field defect</label></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="medium-3 columns neuro-title"> Funduscopy</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><label for="f_ror"><input type="checkbox" @if(isset($neuro_exam['funduscopy']['ror'])) checked @endif id="f_ror" name="neuro_exam[funduscopy][ror]" value="1"> ROR</label></li>
                        <li><label for="f_papilledema"><input type="checkbox" @if(isset($neuro_exam['funduscopy']['Papilledema'])) checked @endif id="f_papilledema" name="neuro_exam[funduscopy][Papilledema]" value="1"> Papilledema</label></li>
                        <li><label for="f_hemorrhages"><input type="checkbox" @if(isset($neuro_exam['funduscopy']['Hemorrhages'])) checked @endif id="f_hemorrhages" name="neuro_exam[funduscopy][Hemorrhages]" value="1"> Hemorrhages</label></li>
                    </ul>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>II, III</legend>
            <div class="row">
                <div class="medium-3 columns neuro-title">II, III:</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><label for="2_3_isocoric"><input type="checkbox" @if(isset($neuro_exam['2_3']['Isocoric'])) checked @endif id="2_3_isocoric" name="neuro_exam[2_3][Isocoric]" value="1"> Isocoric</label></li>
                        <li><label for="2_3_anisocoric"><input type="checkbox" @if(isset($neuro_exam['2_3']['Anisocoric'])) checked @endif id="2_3_anisocoric" name="neuro_exam[2_3][Anisocoric]" value="1"> Aniscoric</label></li>
                        <li><label for="2_3_reactive"><input type="checkbox" @if(isset($neuro_exam['2_3']['Reactive'])) checked @endif id="2_3_reactive" name="neuro_exam[2_3][Reactive]" value="1"> Reactive</label></li>
                        <li><label for="2_3_unreactive"><input type="checkbox" @if(isset($neuro_exam['2_3']['Unreactive'])) checked @endif id="2_3_unreactive" name="neuro_exam[2_3][Unreactive]" value="1"> Unreactive</label></li>
                    </ul>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>III, IV, VI, EOMs:</legend>
            <div class="row">
                <div class="medium-3 columns neuro-title">III, IV, VI, EOMs:</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><div class="clear_radio">(clear)</div></li>
                        <li><label for="eoms_intact"><input type="radio" @if(isset($neuro_exam['3_4_6_eoms']) && $neuro_exam['3_4_6_eoms'] == 'Intact') checked @endif name="neuro_exam[3_4_6_eoms]" id="eoms_intact" value="Intact"> Intact</label></li>
                        <li><label for="eoms_impaired"><input type="radio" @if(isset($neuro_exam['3_4_6_eoms']) && $neuro_exam['3_4_6_eoms'] == 'Impaired') checked @endif name="neuro_exam[3_4_6_eoms]" id="eoms_impaired" value="Impaired"> Impaired</label></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="medium-3 columns neuro-title">Primary Gaze:</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><div class="clear_radio">(clear)</div></li>
                        <li><label for="pg_midline"><input type="radio" @if(isset($neuro_exam['lateralizing_gaze']) && $neuro_exam['lateralizing_gaze'] == 'Midline') checked @endif name="neuro_exam[lateralizing_gaze]" id="pg_midline" value="Midline"> Midline</label></li>
                        <li><label for="pg_lateral"><input type="radio" @if(isset($neuro_exam['lateralizing_gaze']) && $neuro_exam['lateralizing_gaze'] == 'Lateral') checked @endif name="neuro_exam[lateralizing_gaze]" id="pg_lateral" value="Lateral"> Lateral</label></li>
                    </ul>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>V</legend>
            <div class="row">
                <div class="medium-3 columns neuro-title">Temporal Strength:</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><div class="clear_radio">(clear)</div></li>
                        <li><label for="ts_intact"><input type="radio" @if(isset($neuro_exam['temporal_strength']) && $neuro_exam['temporal_strength'] == 'Intact') checked @endif name="neuro_exam[temporal_strength]" id="ts_intact" value="Intact"> Intact</label></li>
                        <li><label for="ts_impaired"><input type="radio" @if(isset($neuro_exam['temporal_strength']) && $neuro_exam['temporal_strength'] == 'Impaired') checked @endif name="neuro_exam[temporal_strength]" id="ts_impaired" value="Impaired"> Impaired</label></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="medium-3 columns neuro-title">Masseter Strength:</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><div class="clear_radio">(clear)</div></li>
                        <li><label for="ms_intact"><input type="radio" @if(isset($neuro_exam['able_to_clench_teeth']) && $neuro_exam['able_to_clench_teeth'] == 'Intact') checked @endif id="ms_intact" name="neuro_exam[able_to_clench_teeth]" value="Intact"> Intact</label></li>
                        <li><label for="ms_impaired"><input type="radio" @if(isset($neuro_exam['able_to_clench_teeth']) && $neuro_exam['able_to_clench_teeth'] == 'Impaired') checked @endif id="ms_impaired" name="neuro_exam[able_to_clench_teeth]" value="Impaired"> Impaired</label></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="medium-3 columns neuro-title">Facial Sensation:</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><div class="clear_radio">(clear)</div></li>
                        <li><label for="fs_intact"><input type="radio" @if(isset($neuro_exam['able_to_feel_pain_in_facial_area']) && $neuro_exam['able_to_feel_pain_in_facial_area'] == 'Impaired') checked @endif id="fs_intact" name="neuro_exam[able_to_feel_pain_in_facial_area]" value="Intact"> Intact</label></li>
                        <li><label for="fs_impaired"><input type="radio" @if(isset($neuro_exam['able_to_feel_pain_in_facial_area']) && $neuro_exam['able_to_feel_pain_in_facial_area'] == 'Intact') checked @endif id="fs_impaired" name="neuro_exam[able_to_feel_pain_in_facial_area]" value="Impaired"> Impaired</label></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="medium-3 columns neuro-title">Corneal Reflexes:</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><div class="clear_radio">(clear)</div></li>
                        <li><label for="corneal_reflex_present"><input type="radio" @if(isset($neuro_exam['corneal_reflex']) && $neuro_exam['corneal_reflex'] == 'Present') checked @endif id="corneal_reflex_present" name="neuro_exam[corneal_reflex]" value="Present"> Present</label></li>
                        <li><label for="corneal_reflex_absent"><input type="radio" @if(isset($neuro_exam['corneal_reflex']) && $neuro_exam['corneal_reflex'] == 'Absent') checked @endif id="corneal_reflex_absent" name="neuro_exam[corneal_reflex]" value="Absent"> Absent</label></li>
                    </ul>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>VII:</legend>
            <div class="row">
                <div class="medium-3 columns neuro-title">VII:</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><label for="facial_asymmetry"><input type="checkbox" @if(isset($neuro_exam['vii']['Facial asymmetry'])) checked @endif id="facial_asymmetry" name="neuro_exam[vii][Facial asymmetry]" value="1"> Facial Asymmetry</label></li>
                        <li><label for="nasolabial_flattening"><input type="checkbox" @if(isset($neuro_exam['vii']['Nasolabial flattening'])) checked @endif id="nasolabial_flattening" name="neuro_exam[vii][Nasolabial flattening]" value="1"> Nasolabial Flattening</label></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="medium-3 columns neuro-title">Taste:</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><div class="clear_radio">(clear)</div></li>
                        <li><label for="t_intact"><input type="radio" @if(isset($neuro_exam['taste']) && $neuro_exam['taste'] == 'Intact') checked @endif id="t_intact" name="neuro_exam[taste]" value="Intact"> Intact</label></li>
                        <li><label for="t_impaired"><input type="radio" @if(isset($neuro_exam['taste']) && $neuro_exam['taste'] == 'Impaired') checked @endif id="t_impaired" name="neuro_exam[taste]" value="Impaired"> Impaired</label></li>
                    </ul>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>VIII:</legend>
            <div class="row">
                <div class="medium-3 columns neuro-title">Response to whispered voice</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><div class="clear_radio">(clear)</div></li>
                        <li><label for="rtwv_intact"><input type="radio" @if(isset($neuro_exam['response_to_whispered_voice']) && $neuro_exam['response_to_whispered_voice'] == 'Intact') checked @endif id="rtwv_intact" name="neuro_exam[response_to_whispered_voice]" value="Intact"> Intact</label></li>
                        <li><label for="rtwv_impaired"><input type="radio" @if(isset($neuro_exam['response_to_whispered_voice']) && $neuro_exam['response_to_whispered_voice'] == 'Impaired') checked @endif id="rtwv_impaired" name="neuro_exam[response_to_whispered_voice]" value="Impaired"> Impaired</label></li>
                    </ul>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>IX, X</legend>
            <div class="row">
                <div class="medium-3 columns neuro-title">Gag Reflex</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><div class="clear_radio">(clear)</div></li>
                        <li><label for="gr_intact"><input type="radio" @if(isset($neuro_exam['gag_reflex']) && $neuro_exam['gag_reflex'] == 'Intact') checked @endif id="gr_intact" name="neuro_exam[gag_reflex]" value="Intact"> Intact</label></li>
                        <li><label for="gr_impaired"><input type="radio" @if(isset($neuro_exam['gag_reflex']) && $neuro_exam['gag_reflex'] == 'Impaired') checked @endif id="gr_impaired" name="neuro_exam[gag_reflex]" value="Impaired"> Impaired</label></li>
                    </ul>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>XI:</legend>
            <div class="row">
                <div class="medium-3 columns neuro-title">XI:</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><label for="able_to_shrug_both_shoulders_symmetrically"><input type="checkbox" @if(isset($neuro_exam['xi']['Able to shrug both shoulders symmetrically'])) checked @endif id="able_to_shrug_both_shoulders_symmetrically" name="neuro_exam[xi][Able to shrug both shoulders symmetrically]" value="1"> Able to shrug both shoulder symmetrically</label></li>
                        <li><label for="an_turn_head_to_each_side_with_resistance"><input type="checkbox" @if(isset($neuro_exam['xi']['Can turn head to each side with resistance'])) checked @endif id="can_turn_head_to_each_side_with_resistance" name="neuro_exam[xi][Can turn head to each side with resistance]" value="1"> Can turn head to each side with resistance</label></li>
                    </ul>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>XII</legend>
            <div class="row">
                <div class="medium-3 columns neuro-title">XII:</div>
                <div class="medium-9 columns">
                    <ul class="inline-list">
                        <li><label for="tongue_midline"><input type="checkbox" @if(isset($neuro_exam['xii']['Tongue midline'])) checked @endif name="neuro_exam[xii][Tongue midline]" id="tongue_midline" value="1"> Tongue Midline</label></li>
                        <li><label for="fasciculations"><input type="checkbox" @if(isset($neuro_exam['xii']['Fasciculations'])) checked @endif name="neuro_exam[xii][Fasciculations]" id="fasciculations" value="1"> Fasciculations</label></li>
                        <li><label for="atrophy"><input type="checkbox" @if(isset($neuro_exam['xii']['Atrophy'])) checked @endif name="neuro_exam[xii][Atrophy]" id="atrophy" value="1"> Atrophy</label></li>
                        <li><label for="weakness"><input type="checkbox" @if(isset($neuro_exam['xii']['Weakness'])) checked @endif name="neuro_exam[xii][Weakness]" id="weakness" value="1"> Weakness</label></li>
                    </ul>
                </div>
            </div>
        </fieldset>
    </fieldset>
    <fieldset>
        <legend>Motor Exam</legend>
        <div class="row">
            <div class="medium-3 columns neuro-title">Muscle Bulk:</div>
            <div class="medium-9 columns">
                <ul class="inline-list">
                    <li><div class="clear_radio">(clear)</div></li>
                    <li><label for="mb_good"><input type="radio" @if(isset($neuro_exam['muscle_bulk']) && $neuro_exam['muscle_bulk'] == 'Good') checked @endif name="neuro_exam[muscle_bulk]" id="mb_good" value="Good"> Good</label></li>
                    <li><label for="mb_poor"><input type="radio" @if(isset($neuro_exam['muscle_bulk']) && $neuro_exam['muscle_bulk'] == 'Poor') checked @endif name="neuro_exam[muscle_bulk]" id="mb_poor" value="Poor"> Poor</label></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="medium-3 columns neuro-title">Muscle Tone:</div>
            <div class="medium-9 columns">
                <ul class="inline-list">
                    <li><div class="clear_radio">(clear)</div></li>
                    <li><label for="mt_good"><input type="radio" @if(isset($neuro_exam['muscle_tone']) && $neuro_exam['muscle_tone'] == 'Good') checked @endif name="neuro_exam[muscle_tone]" id="mt_good" value="Good"> Good</label></li>
                    <li><label for="mt_poor"><input type="radio" @if(isset($neuro_exam['muscle_tone']) && $neuro_exam['muscle_tone'] == 'Poor') checked @endif name="neuro_exam[muscle_tone]" id="mt_poor" value="Poor"> Poor</label></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="medium-3 columns neuro-title">Cerebellars:</div>
            <div class="medium-9 columns">
                <ul class="inline-list">
                    <li><label for="nystagmus"><input type="checkbox" @if(isset($neuro_exam['cerebellars']['Nystagmus'])) checked @endif id="nystagmus" name="neuro_exam[cerebellars][Nystagmus]" value="1"> Nystagmus</label></li>
                    <li><label for="dysmetria"><input type="checkbox" @if(isset($neuro_exam['cerebellars']['Dysmetria'])) checked @endif id="dysmetria" name="neuro_exam[cerebellars][Dysmetria]" value="1"> Dysmetria</label></li>
                    <li><label for="dysdiadochokinesia"><input type="checkbox" @if(isset($neuro_exam['cerebellars']['Dysdiadochokinesia'])) checked @endif id="dysdiadochokinesia" name="neuro_exam[cerebellars][Dysdiadochokinesia]" value="1"> Dysdiadochokinesia</label></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="medium-3 columns neuro-title">Meningeals:</div>
            <div class="medium-9 columns">
                <ul class="inline-list">
                    <li><label for="nuchal_rigidity"><input type="checkbox" @if(isset($neuro_exam['meningeals']['Nuchal rigidity'])) checked @endif id="nuchal_rigidity" name="neuro_exam[meningeals][Nuchal rigidity]" value="1"> Nuchal Rigidity</label></li>
                    <li><label for="brudzunskis"><input type="checkbox" id="brudzunskis" @if(isset($neuro_exam['meningeals']['Brudzunskis'])) checked @endif name="neuro_exam[meningeals][Brudzunskis]" value="1"> Brudzunski's</label></li>
                    <li><label for="kernigs"><input type="checkbox" id="kernigs" @if(isset($neuro_exam['meningeals']['Kernigs'])) checked @endif name="neuro_exam[meningeals][Kernigs]" value="1"> Kernig's</label></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="medium-6 columns">
                <fieldset>
                    <legend>Muscle Strength</legend>
                    <div class="row">
                        <div class="medium-4 columns">
                            <div class="row">
                                <div class="medium-12 columns">
                                    <label for="motor_left_arm">Left Arm:
                                        <input type="text" id="motor_left_arm" name="neuro_exam[muscle_strength][left_arm]" value="{{ $neuro_exam['muscle_strength']['left_arm'] or "" }}">
                                    </label>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <div class="row">
                                <div class="medium-12 columns">
                                    <label for="motor_left_leg">Left Leg:
                                        <input type="text" id="motor_left_leg" name="neuro_exam[muscle_strength][left_leg]" value="{{ $neuro_exam['muscle_strength']['left_leg'] or ""  }}">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="medium-4 columns">
                            <img class="img-responsive" style="height:100%; width:100%" src="{{ asset('frontend/images/neuro_diagram.png') }}">
                        </div>
                        <div class="medium-4 columns">
                            <div class="row">
                                <div class="medium-12 columns">
                                    <label for="motor_right_arm">Right Arm:
                                        <input type="text" id="motor_right_arm" name="neuro_exam[muscle_strength][right_arm]" value="{{ $neuro_exam['muscle_strength']['right_arm'] or "" }}">
                                    </label>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <div class="row">
                                <div class="medium-12 columns">
                                    <label for="motor_right_leg">Right Leg:
                                        <input type="text" id="motor_right_leg" name="neuro_exam[muscle_strength][right_leg]" value="{{ $neuro_exam['muscle_strength']['right_leg'] or "" }}">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="medium-6 columns">
                <fieldset>
                    <legend>Sensory</legend>
                    <div class="row">
                        <div class="medium-4 columns">
                            <div class="row">
                                <div class="medium-12 columns">
                                    <label for="sensory_left_arm">Left Arm:
                                        <input type="text" id="sensory_left_arm" name="neuro_exam[sensory][left_arm]" value="{{ $neuro_exam['sensory']['left_arm'] or "" }}">
                                    </label>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <div class="row">
                                <div class="medium-12 columns">
                                    <label for="sensory_left_leg">Left Leg:
                                        <input type="text" id="sensory_left_leg" name="neuro_exam[sensory][left_leg]" value="{{ $neuro_exam['sensory']['left_leg'] or "" }}">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="medium-4 columns">
                            <img class="img-responsive" style="height:100%; width:100%" src="{{ asset('frontend/images/neuro_diagram.png') }}">
                        </div>
                        <div class="medium-4 columns">
                            <div class="row">
                                <div class="medium-12 columns">
                                    <label for="sensory_right_arm">Right Arm:
                                        <input type="text" id="sensory_right_arm" name="neuro_exam[sensory][right_arm]" value="{{ $neuro_exam['sensory']['right_arm'] or "" }}">
                                    </label>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <div class="row">
                                <div class="medium-12 columns">
                                    <label for="sensory_right_leg">Right Leg:
                                        <input type="text" id="sensory_right_leg" name="neuro_exam[sensory][right_leg]" value="{{ $neuro_exam['sensory']['right_leg'] or "" }}">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="row">
            <div class="medium-6 columns">
                <fieldset>
                    <legend>Reflexes</legend>
                    <div class="row">
                        <div class="medium-4 columns">
                            <div class="row">
                                <div class="medium-12 columns">
                                    <label for="reflexes_left_arm">Left Arm:
                                        <input type="text" id="reflexes_left_arm" name="neuro_exam[reflexes][left_arm]" value="{{ $neuro_exam['reflexes']['left_arm'] or "" }}">
                                    </label>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <div class="row">
                                <div class="medium-12 columns">
                                    <label for="reflexes_left_leg">Left Leg:
                                        <input type="text" id="reflexes_left_leg" name="neuro_exam[reflexes][left_leg]" value="{{ $neuro_exam['reflexes']['left_leg'] or "" }}">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="medium-4 columns">
                            <img class="img-responsive" style="height:100%; width:100%" src="{{ asset('frontend/images/neuro_diagram.png') }}">
                        </div>
                        <div class="medium-4 columns">
                            <div class="row">
                                <div class="medium-12 columns">
                                    <label for="reflexes_right">Right Arm:
                                        <input type="text" id="reflexes_right_arm" name="neuro_exam[reflexes][right_arm]" value="{{ $neuro_exam['reflexes']['right_arm'] or "" }}">
                                    </label>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <div class="row">
                                <div class="medium-12 columns">
                                    <label for="reflexes_right">Right Leg:
                                        <input type="text" id="reflexes_right_leg" name="neuro_exam[reflexes][right_leg]" value="{{ $neuro_exam['reflexes']['right_leg'] or "" }}">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="medium-6 columns">
                &nbsp;
            </div>
        </div>
        <script>
            $('.clear_radio').css('color','#990000');
            $('.clear_radio').click(function()
            {
                $(this).parent().parent().find('input:radio:checked').removeAttr('checked');
                console.log(1);
            });

        </script>
    </fieldset>
</fieldset>
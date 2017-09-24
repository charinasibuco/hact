<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/25/2016
 * Time: 11:56 AM
 */?>
@extends('hact.layouts.print_layout')

@section('content')
    <style>
        .sheading{text-align: center !important; padding: 1px}
        .coloryellowgreenbg{background: #79b220;}
        .coloryellowbg{background: #adff2f;}
        .colororangebg{background: #f08a24;}
        .colorredbg{background: #990000;color:#fff}
        .fontbig{font-size: 34px !important;}
        .colorred{color:#990000 !important;}
        .valign{vertical-align: middle !important; }
        .halgn{text-align: center !important;}
        .guideline_table thead tr td{white-space: nowrap; text-align: center;}
        .guideline_table tbody tr td{text-align: left;}
        .guideline_table tr td:first-child{border-left: solid 1px #000;}
        .guideline_table tr td{border-right: solid 1px #000;}
        .guideline_table td, .guideline_table li, .guideline_table a, .guideline_table p{font-size:11px;vertical-align:top;}
        .guideline_table tr:first-child{border-top: solid 1px #000;}
        .guideline_table tr{border-bottom: solid 1px #000;}
    </style>
    <br/>
    <input id="print" type="button" value="Print">
    <script>
        $('#print').click(function(){
            $(this).hide();
            window.print();
            $(this).show();
        });
    </script>
    <br/>
    <br/>
    <div class="row">
        <div class="large-12">
            <h4>PHILIPPINE GUIDELINE ON IMMUNIZATION FOR ADULTS LIVING WITH HIV (2010)</h4>
        </div>
        <div class="row">
            <div class="large-12">
                <table width="100%" class="guideline_table">
                    <thead>

                    <tr>
                        <td>VACCINE</td>
                        <td>INDICATION</td>
                        <td>PREPARATION & DOSE</td>
                        <td>ROUTE</td>
                        <td>SCHEDULE</td>
                        <td>ADVERSE OR HYPERSENSITIVITY REACTIONS</td>
                    </tr>

                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="6" class="sheading coloryellowgreenbg">A. Vaccines that MUST be given to all PLHIVs Regardless of CD4+T Cell Count</td>
                    </tr>
                    <tr>
                        <td>HEPATITIS B</td>
                        <td>All Patients with No or Insufficient Evidence of Immunity</td>
                        <td>20ug/ml/vial <stront>(2 vials)</stront></td>
                        <td>Intramuscular</td>
                        <td>
                            <ul>
                                <li>3-dose schedule: 0,1,6 months</li>
                                <li>Alternative: 4-dose accelerated schedule: 0,1,2,12 months)</li>
                                <li>If combined with Hep A: doses at days 0,7,21 and booster after 1 year</li>
                            </ul>
                        </td>
                        <td><p><u>Common:</u></p>
                            <p>Transient Soreness, erythema and induration at injection site</p>
                            <u>Uncommon:</u>
                            <ul>
                                <li>Fatigue, dizziness, syncope, hypotension, arthritis, arthralgia, lymphadenopathy, rash and urticaria</li>
                                <li>Influenza-like symptoms, such as low-grade fever, malaise, headache, myalgia</li>
                                <li>Gastrointestinal upsets, such as abdominal pain, diarrhea, vomiting, nausea and abnormal liver function tests</li>
                                <li>Neurological manifestations include rarely paresthesia and extremely rarely paralysis, neuropathy, and neuritis (including Guillain-Barre syndrome, multiple sclerosis and optic neuritis)</li>
                                <li>Severe skin disorders such as erythema multiforme</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>INFLUENZA (FLU VACCINE)</td>
                        <td></td>
                        <td>0.5 ml prefilled syringe, single dose</td>
                        <td>Intramuscular or deep subcutaneous; subcutaneous in case of bleeding disorders</td>
                        <td>Annually</td>
                        <td><p><u>Most frequent:</u></p>
                            <p>Soreness at injection site</p>
                            <p>Rare:</p>
                            <ul>
                                <li>Fever, malaise, muscle pain, arthralgia (beginning 6-12 hrs after immunization and I lasting up to 48 hrs)</li>
                                <li>Allergic reactions may occur most likely due to hypersensitivity to residual egg protein</li>
                                <li>Guillain-Barre syndrome has been reported but causal relationship with the vaccine has not been established</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>PNEUMOCOCCAL</td>
                        <td></td>
                        <td>23-polyvalent polysaccharide vaccine 0.5 ml single dose</td>
                        <td>Subcutaneous or Intramuscular, preferably into the deltoid</td>
                        <td>Single dose</td>
                        <td><p><u>Most frequent:</u></p>
                            <p>Soreness, swelling and redness at injection site (resolves within 48 hours)</p>
                            <p><u>Rare:</u></p>
                            <p>Fever, malaise and muscle pain Allergic reactions Local reactions reported more frequently following a second dose of PPV-23 than after the first dose, especially if < 3 years interval from the first injection</p>
                        </td>
                    </tr>
                    <tr><td class="sheading coloryellowbg" colspan="6">A. Vaccines that MAY BE given safely to all PLHIVs IF INDICATED Regardless of CD4+T Cell Count</td></tr>
                    <tr>
                        <td>CHOLERA</td>
                        <td>
                            <ul>
                                <li>Travelers to areas with ongoing outbreak/epidemic</li>
                                <li>Travelers to endemic areas with unsanitary conditions or poor access to medical care</li>
                            </ul>
                        </td>
                        <td>
                            <p>1 vial vaccine with buffer</p>
                            <p>Oral vaccine (against cholera and enterotoxigenic E. coli-ETEC)</p>
                        </td>
                        <td><p>Oral (Dissolve buffer in 1 glass of water, add 1 vial vaccine and mix well, the drink)</p>
                            <p>Oral</p>
                        </td>
                        <td>
                            <p>2 doses at 10-14 days interval</p>
                            <p>2 doses at 10-14 days interval</p>
                            <p>* If >6 weeks has elapsed between doses, repeat course; booster after 2 years if continuous protection is required</p>
                        </td>
                        <td>
                            <p><u>Common:</u></p>
                            <p>upset stomach, nausea, vomiting loss of appetite</p>

                            <p><u>Rare:</u></p>
                            <p>fever, malaise, dizziness, runny nose, cough, dizziness</p>
                            <p>Very rare: fatigue, joint pains, sweating, sore throat, rash, severe diarrhea, itching, swelling of lymph glands</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            HAEMOPHILUS INFLUENZA TYPE B
                        </td>
                        <td>
                            <ul>
                                <li>Acquired splenic dysfunction irregardless of prior immunizations</li>
                                <li>PLHIVs who have recovered from Hib disease and have risk factors for further disease, those with recurrent pulmonary infections or other risk factors for severe disease</li>
                            </ul>
                        </td>
                        <td>
                            0.5 ml
                        </td>
                        <td>
                            <p>Intramuscular</p>
                            <p>Subcutaneous in persons with bleeding disorders (preferably deltoid)</p>
                        </td>
                        <td>
                            Single dose
                        </td>
                        <td>
                            <p><u>Common:</u></p>
                            <p>Fever, restlessness, prolonged crying, loss of appetite, vomiting and diarrhea, redness and pain at injection site.</p>
                            <p><u>Potentially Fatal:</u></p>
                            <p>Anaphylaxis</p>
                        </td>
                    </tr>
                    <tr>
                        <td>HEPATITIS A</td>
                        <td>
                            <ul>
                                <li>People with chronic liver disease</li>
                                <li>People with occupational risk of infection (e.g. health care workers, some laboratoryl/mrkers)</li>
                                <li>Men who have sex with men (MSM)</li>
                                <li>Injecting drug users</li>
                                <li>People with clotting factor disorders (e.g.hemophiliacs)</li>
                                <li>People from non-endemic countries who are traveling to countries with high or intermediate risk of HAV infection</li>
                            </ul>
                        </td>
                        <td>1 ml</td>
                        <td>Intramuscular, deltoid</td>
                        <td>
                            <ul>
                                <li>CD4 count >300: 2 doses at either 0 and 6 through 12 months</li>
                                <li>CD4 count <300: 3-dose schedule over 6-12 months</li>
                                <li>Alternative dose schedule: 4-dose schedule days 0,7 and 21 to 30 followed by a booster dose at month 12</li>
                            </ul>
                            <p>*For travelers to endemic areas, vaccine should be given at least 2 weeks before travel</p>
                        </td>
                        <td>
                            <p><u>Common:</u></p>
                            <p>Injection site reactions such as soreness, induration, redness and swelling</p>
                            <p><u>Less common:</u></p>
                            <p>Headache, malaise, fatigue, fever, nausea, & loss of appetite</p>
                            <p><u>Rare:</u></p>
                            <p>Serious allergic reactions</p>
                        </td>
                    </tr>
                    <tr>
                        <td>HUMAN PAPILLOMA VIRUS</td>
                        <td>
                            <ul>
                                <li>Before potential exposure to HPV through sexual activity</li>
                                <li>Females who are sexually active, who have NOT been infected with any of the four HPV vaccine types</li>
                            </ul>
                        </td>
                        <td>
                            <p>Quadrivalent:</p>
                            <p>purified inactive proteins from HPV types 6,11,16,18 of 0.5 ml single dose pre-filled syringe</p>
                            <p>Bivalent: types 16 and 18, 0.5 ml</p>
                        </td>
                        <td>Intramuscular, deltoid</td>
                        <td>
                            <ul>
                                <li>Quadrivalent vaccine: 3 doses within 6 months at 0, 2, 6 months </li>
                                <li>Bivalent HPV vaccine: 3 doses within 6 months at O, 1,6 months</li>
                            </ul>
                            <p>Minimum intervals:</p>
                            <ul>
                                <li>4 weeks between doses 1 and 2</li>
                                <li>12 weeks between doses 2 and 3</li>
                            </ul>
                        </td>
                        <td>
                            <p><ul>Local reactions:</ul></p>
                            <p>Mostly pain and swelling injection site </p>
                            <p><u>Others: </u></p>
                            <p>Fever, Syncope (fainting) sometimes associated with falling, has occurred after vaccination with quadrivalent HPV recombinant vaccine.</p>
                            <p>*Vaccinees should be carefully observed for approximately 15 minutes after administration of quadrivalent HPV recombinant vaccine</p>
                        </td>
                    </tr>
                    <tr>
                        <td>JAPANESE B ENCEPHALITIS</td>
                        <td>
                            <ul>
                                <li>People living in endemic areas</li>
                                <li>Travelers to south-east Asia and the Far East who will be staying for more than 30 days in endemic areas, especially if travel will include rural areas</li>
                                <li>Travelers to and residents of areas experiencing epidemic transmission</li>
                                <li>Persons with extensive outdoor activities in rural areas, expatriates whose principal area of residence is an area where JEV is endemic or epidemic</li>
                            </ul>
                        </td>
                        <td></td>
                        <td>Deep subcutaneous</td>
                        <td>
                            <p>3 doses : Days 0, 7-14 and 28</p>
                            <ul>
                                <li>Last dose should be administered at least 10 days before the commencement of travel </li>
                                <li>For those aged >60 years, a 4th dose is recommended 1 month after completion of the initial course. </li>
                                <li>A booster is recommended after 3 years for those at continued risk</li>
                            </ul>
                        </td>
                        <td>
                            <p><u>Common:</u></p>
                            <p>Tenderness, redness, swelling, and other local effects</p>
                            <p><u>Less common:</u></p>
                            <p>Fever, headache, malaise, rash, and other reactions such as chills, dizziness, myalgia, nausea, vomiting, and abdominal pain</p>
                            <p><u>Rare:</u></p>
                            <p>Severe hypersensitivity, including angioedema or urticaria</p>
                        </td>
                    </tr>
                    <tr>
                        <td>MENINGOCOCCAL</td>
                        <td>
                            <ul>
                                <li>Household contacts of cases of meningococcal infection</li>
                                <li>Persons who travel to or reside in countries in which N. meningitdis is hyperendemic or epidemic</li>
                                <li>College students living in dormitories</li>
                                <li>Military recruits, microbiologists who are routinely exposed to isolates of N. meningitdis</li>
                                <li>Persons who have terminal complement component deficiencies</li>
                                <li>Persons who have anatomic or functional asplenia</li>
                                <li>PLHIV at risk of infection through travel</li>
                            </ul>
                        </td>
                        <td>0.5 ml single dose</td>
                        <td>Deep SC or IM injection preferably in the deltoid</td>
                        <td>Boosters are recommended after 5 years for those at continuous risk</td>
                        <td>
                            <p><u>Common:</u></p>
                            <p>Transient local pain with associated swelling or rednesss (neurological) complications or anaphylaxis</p>
                        </td>
                    </tr>
                    <tr>
                        <td>POLIO VACCINE (INACTIVATED)</td>
                        <td>
                            <ul>
                                <li>Household members or other household contacts</li>
                                <li>Nursing personnel in close contact</li>
                                <li>Unvaccinated or incompletely vaccinated PLHIV who intend to travel to a polio endemic area such as India, Pakistan, Afghanistan and Nigeria</li>
                                <li>PLHIV with a history of incomplete vaccination to complete a five-dose vaccination course, regardless of the interval since the last dose and type of vaccine received previously</li>
                            </ul>
                        </td>
                        <td>0.5 ml</td>
                        <td><p>Intramuscular<br>
                                Subcutaneous for those with bleeding disorders</p>
                        </td>
                        <td>
                            <p>3 doses:<br>
                                First 2 doses are given at 4-8 week interval and a 3rd dose 6 to 12 months after the second dose</p>
                            <p>Booster dose: given after 5 and 10 years</p>
                        </td>
                        <td>
                            <p><u>Common:</u><br>
                                Injection site reactions</p>
                        </td>
                    </tr>
                    <tr>
                        <td>RABIES</td>
                        <td>
                            <ul>
                                <li>Health care workers in hospitals that handle dog bites and rabies cases</li>
                                <li>Rabies research and diagnostic lab worker, rabies biologic production workers</li>
                                <li>Veterinarians and vet students, animal control and wildlife handlers, spelunkers and other animal handlers</li>
                                <li>Field workers (bill collectors, mailmen, delivery men)</li>
                                <li>Morticians and embalmers</li>
                            </ul>
                        </td>
                        <td>0.5 ml</td>
                        <td>Intramuscular, deltoid</td>
                        <td>
                            <p>Pre-exposure prophylaxis:
                            <ul>
                                <li>DO,D7, and D28 </li>
                            </ul>
                            </p>
                            <p>Post exposure prophylaxis:
                            <ul>
                                <li>1 dose each on Days 0, 3, 7, 14, 28 or 3U: or 2 doses on Day U, and 1 IM dose each on D7 and D21</li>
                                <li>If currently asymptomatic, with CD4 >400cells/mm, with completed pre-exposure prophylaxis: 1 IM dose on Day 0, and 1 IM dose on Day 3</li>
                            </ul>
                            </p>
                        </td>
                        <td>
                            <p><u>Common: </u><br>
                                Soreness, swelling or itching in duration at injection site headache, dizziness, nausea, abdominal pain</p>
                            <p><u>Rare:</u><br>
                                Neurologic reactions reported, resolved spontaneously</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Td/Tdap</td>
                        <td>
                            <p>Tetanus and Diptheria:
                            <ul>
                                <li>Adults who have NOT been immunized previously or have an uncertain vaccination history</li>
                            </ul>
                            </p>
                            <p>Pertussis:
                            <ul>
                                <li>For individuals at high risk of infection (for example those exposed in the household or in high-risk occupations)</li>
                            </ul>
                            </p>
                        </td>
                        <td>Td 0.5 mL</td>
                        <td>Intramuscular</td>
                        <td>
                            <ul>
                                <li>2 doses of Td at 4 to 8 weeks apart followed by 3rd dose Tetanus diphtheria pertussis (Tdap) to be given 6 to 12 months later </li>
                                <li>Booster every 10 years with Tdap</li>
                                <li>In pregnancy, 3rd dose given at least two weeks before delivery</li>
                                <li>Adults who have received a full primary course (three doses) as Infants and a booster at pre-school age (total of four doses) require a single booster dose. </li>
                                <li>Persons who have received five vaccine doses require a booster dose at 10-yearly intervals if with increased risk of exposure or if they are due to travel to remote areas where they may not be able to receive tetanus immunoglobulin (TIG) in the event of a tetanus-prone injury</li>
                                <li>single dose of a pertussis-containing vaccine (Tdap) could be considered</li>
                            </ul>
                        </td>
                        <td>
                            <p><u>Common:</u><br>Local: pain at the injection site Systemic: headache, generalized body aches,tiredness, fever </p>
                            <p><u>Rare: </u>severe systemic reactions such as generalized urticaria, anaphylaxis or neurological complications</p>
                        </td>
                    </tr>
                    <tr>
                        <td>TYPHOID Vi POLYSACCHARIDE</td>
                        <td>
                            <ul>
                                <li>Those with significant risk of exposure to S. typhi (i.e. local outbreaks, travel to high risk areas)</li>
                                <li>Those who will have close contact with a documented S. typhi carrier</li>
                                <li>Laboratory workers exposed to S. typhi</li>
                            </ul>
                        </td>
                        <td>25 meg (0.5 ml) - Single dose</td>
                        <td>Intramuscular, preferably in deltoid or Subcutaneously in patients with bleeding disorders</td>
                        <td>
                            <ul>
                                <li>At least 2 weeks before expected exposure</li>
                                <li>Booster recommended every 3 years in those who remain at risk</li>
                            </ul>
                            <p>*This interval might be reduced to 2 years if the CD4 count is <200 cells/uL</p>
                        </td>
                        <td>
                            <p><u>Common:</u><br>
                                Mild reactions: fever, headache, redness or swelling at the site of the injection</p>
                            <p><u>Very rare:</u><br>
                                Severe allergic</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="colororangebg sheading">B. Vaccines that CAN BE given safely to all PLHIVs IF INDICATED, and if they are ASYMPTOMATIC,
                            With a of CD4+T Cell Count of >200 cells/cumm
                        </td>
                    </tr>
                    <tr>
                        <td>MEASLES, MUMPS, RUBELLA (MMR)</td>
                        <td>
                            <ul>
                                <li>PLHIVs who want to be protected against measles, mumps, rubella infections</li>
                                <li>Rubella IgG seronegative women</li>
                                <li>Second MMR dose if patient remains Rubella IgG seronegative</li>
                            </ul>
                        </td>
                        <td></td>
                        <td>Deep subcutaneous or Intramuscular</td>
                        <td>Two doses with second dose at least 1 month after the first</td>
                        <td>
                            <p><u>Adverse reactions:</u><br>
                                Fever and rash ,arthalgia and /or arthritis are reported in up to 25% of vaccinated women and are usually mild and transient, transient lymphadenopathy vaccination, parotitis and deafness occur rarely and are attributable to the Mumps component</p>
                        </td>
                    </tr>
                    <tr>
                        <td>VARICELLA</td>
                        <td>
                            <ul>
                                <li>VZV IgG negative</li>
                                <li>Uncertain history of varicella infection</li>
                                <li>At risk for exposure (e.g. HCW)</li>
                            </ul>
                        </td>
                        <td>0.5 ml</td>
                        <td>Subcutaneous, preferably in the deltoid</td>
                        <td>Two doses at 3 months interval</td>
                        <td>Rash (localizedat the site of injection or generalized) within 1 month of immunization; fever</td>
                    </tr>
                    <tr>
                        <td>ELLOW FEVER</td>
                        <td>
                            <ul>
                                <li>Intent to travel or live in areas endemic with yellow fever (S. America or Africa)</li>
                            </ul>
                        </td>
                        <td>0.5 ml</td>
                        <td>Subcutaneous, preferably in the deltoid</td>
                        <td>
                            <p>Single dose</p>
                            <p>Booster after 10 years for those at risk</p>
                            <p></p>*Other live virus vaccines may be given concurrently; alternatively 4 weeks should be allowed to elapse between sequential vaccinations
                        </td>
                        <td>
                            <p><u>Common:</u><br>Injection site reactions</p>
                            <p><u>Rare:</u><br></p>
                            <p><u>Severe:</u><br>Risk of encephalitis</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="sheading colorredbg">C. Vaccines That Are CONTRAINDICATED</td>
                    </tr>
                    <tr>
                        <td class="colorred">ORAL POLIO VACCINE</td>
                        <td rowspan="5" colspan="5" class="valign halgn fontbig colorred">DO NOT GIVE!!!</td>
                    </tr>
                    <tr>
                        <td class="colorred">BCG</td>
                    </tr>
                    <tr>
                        <td class="colorred">Ty 21-Oral Typhoid Vaccine</td>
                    </tr>
                    <tr>
                        <td class="colorred">Influenza (Intranasal)</td>
                    </tr>
                    <tr>
                        <td class="colorred">Herpes Zoster (VZV)</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="large-12">
            <p>From the Philippine Society for Microbiology and Infectious Diseases</p>
        </div>
    </div>
@endsection
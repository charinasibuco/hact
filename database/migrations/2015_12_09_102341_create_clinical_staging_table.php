<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicalStagingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinical_staging', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stage');
            $table->integer('infection_number');
            $table->string('infection_name');
        });

        $data = [
            # Stage 1
            [ 'stage' => 1, 'infection_number' => 1, 'infection_name' => 'Asymptomatic' ],
            [ 'stage' => 1, 'infection_number' => 2, 'infection_name' => 'Persistent generalized lymphadenopathy (PGL)' ],
            # Stage 2
            [ 'stage' => 2, 'infection_number' => 1, 'infection_name' => 'Moderate unexplained weight loss (<10% of presumed or measured body weight)' ],
            [ 'stage' => 2, 'infection_number' => 2, 'infection_name' => 'Recurrent respiratory tract infections (RTI\'s, sinusitis, bronchitis, otitis media, pharyngitis)' ],
            [ 'stage' => 2, 'infection_number' => 3, 'infection_name' => 'Herpes zoster' ],
            [ 'stage' => 2, 'infection_number' => 4, 'infection_name' => 'Angular cheilitis' ],
            [ 'stage' => 2, 'infection_number' => 5, 'infection_name' => 'Recurrent oral ulcerations' ],
            [ 'stage' => 2, 'infection_number' => 6, 'infection_name' => 'Papular pruritic eruptions' ],
            [ 'stage' => 2, 'infection_number' => 7, 'infection_name' => 'Seborrhoeic dermatitis' ],
            [ 'stage' => 2, 'infection_number' => 8, 'infection_name' => 'Fungal nail infections of fingers' ],
            # Stage 3
            [ 'stage' => 3, 'infection_number' => 1, 'infection_name' => 'Severe weight loss (>10% of presumed or measured bodyweight)' ],
            [ 'stage' => 3, 'infection_number' => 2, 'infection_name' => 'Unexplained chronic diarrhoea for longer than one month' ],
            [ 'stage' => 3, 'infection_number' => 3, 'infection_name' => 'Unexplained persistent fever (intermittent or constant for longer than one month)' ],
            [ 'stage' => 3, 'infection_number' => 4, 'infection_name' => 'Oral candidiasis' ],
            [ 'stage' => 3, 'infection_number' => 5, 'infection_name' => 'Oral hairy leukoplakia' ],
            [ 'stage' => 3, 'infection_number' => 6, 'infection_name' => 'Pulmonary tuberculosis (TB) diagnosed inlast two years' ],
            [ 'stage' => 3, 'infection_number' => 7, 'infection_name' => 'Severe presumed bacterial infections (e.g. pneumonia, empyema, pyomyositis, bone or joint infections, meningitis, bacteraemia)' ],
            [ 'stage' => 3, 'infection_number' => 8, 'infection_name' => 'Acute necrotizing ulcerative stomatitis, gingivitis or periodontitis' ],
            // Conditions where a presumptive diagnosis can be made of the basis of clinical signs or simple investigations
            [ 'stage' => 3, 'infection_number' => 9,'infection_name' => 'Unexplained anaemia (<8 g/dl), and or neutropenia (<500/mm3) and or thrombocytopenia (<50 000/mm3) for more than one month' ],
            # Stage 4
            // Conditions where a presumptive diagnosis can be made on the basis of clinical signs or simple investigations
            [ 'stage' => 4, 'infection_number' => 1, 'infection_name' => 'HIV wasting syndrome' ],
            [ 'stage' => 4, 'infection_number' => 2, 'infection_name' => 'Pneumocystis pneumonia' ],
            [ 'stage' => 4, 'infection_number' => 3, 'infection_name' => 'Recurrent severe or radiological bacteria; pneumonia' ],
            [ 'stage' => 4, 'infection_number' => 4, 'infection_name' => 'Chronic herpes simplex infection (orolabial, genital or anorectal of more than one month\'s duration)' ],
            [ 'stage' => 4, 'infection_number' => 5, 'infection_name' => 'Oesophageal candidiasis' ],
            [ 'stage' => 4, 'infection_number' => 6, 'infection_name' => 'Extrapulmonary TB' ],
            [ 'stage' => 4, 'infection_number' => 7, 'infection_name' => 'Kaposi\'s sarcoma'],
            [ 'stage' => 4, 'infection_number' => 8, 'infection_name' => 'Central nervous system (CNS) toxoplasmosis' ],
            [ 'stage' => 4, 'infection_number' => 9, 'infection_name' => 'HIV encephalopathy' ],
            // Conditions where confirmatory diagnostic testing is necessary:
            [ 'stage' => 4, 'infection_number' => 10, 'infection_name' => 'Extrapulmonary cryptococcosis including meningitis' ],
            [ 'stage' => 4, 'infection_number' => 11, 'infection_name' => 'Disseminated non-tuberculous mycobacteria infection' ],
            [ 'stage' => 4, 'infection_number' => 12, 'infection_name' => 'Progressive multifocal leukoencephalopathy (PML)' ],
            [ 'stage' => 4, 'infection_number' => 13, 'infection_name' => 'Candida of trachea, bronchi or lungs' ],
            [ 'stage' => 4, 'infection_number' => 14, 'infection_name' => 'Cryptosporidiosis' ],
            [ 'stage' => 4, 'infection_number' => 15, 'infection_name' => 'Isosporiasis' ],
            [ 'stage' => 4, 'infection_number' => 16, 'infection_name' => 'Visceral herpes simplex infection' ],
            [ 'stage' => 4, 'infection_number' => 17, 'infection_name' => 'Cytomegalovirus (CMV) infection (retinitis or of an organ other than liver, spleen or lymph nodes)' ],
            [ 'stage' => 4, 'infection_number' => 18, 'infection_name' => 'Any disseminated mycosis (e.g. histoplasmosis, coccidiomycosis, penicilliosis)' ],
            [ 'stage' => 4, 'infection_number' => 19, 'infection_name' => 'Recurrent non-typhoidal salmonella septicaemia' ],
            [ 'stage' => 4, 'infection_number' => 20, 'infection_name' => 'Lymphoma (cerebral or B cell non-Hodgkin)' ],
            [ 'stage' => 4, 'infection_number' => 21, 'infection_name' => 'Invasive cervical carcinoma' ],
            [ 'stage' => 4, 'infection_number' => 22, 'infection_name' => 'Visceral leishmaniasis' ]
        ];

        foreach ($data as $key)
        {
            App\ClinicalStaging::create([
                'stage'     => $key['stage'],
                'infection_number'   => $key['infection_number'],
                'infection_name'   => $key['infection_name']

            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clinical_staging');
    }
}

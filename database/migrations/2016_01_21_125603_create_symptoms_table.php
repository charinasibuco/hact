<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSymptomsTable extends Migration
{
    public function up()
    {
        Schema::create('symptoms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pill');
            $table->string('symptoms');
            $table->string('monitoring');

            $table->index(['id']);
        });

        $data = [
            [
                'pill' => 'ZDV',
                'symptoms' => 'Anemia, Neutropenia, Myopathy, Lipodystrophy, Lactic Acidosis, Severe Hepatomegaly with stetaosis',
                'monitoring' => 'CBC at 2, 4, 8, 12 weeks then every 6 months'
            ],
            [
                'pill' => 'EFV',
                'symptoms' => 'CNS Toxicity (Abnormal dreams, depression or mental confusion), COnvulsions, Hypersensitivity Reaction, SJS, Male Gynecomastia',
                'monitoring' => 'Baseline Lipid Profile then every 12 months'
            ],
            [
                'pill' => 'Lopinavir/Ritonavir',
                'symptoms' => 'ECG Abnormalities (PR w/ QT prolongation), Torsades de Pointes, Hepatoxicity, Pancreatitis, Lipoatrophy, Metabolic Syndrome, Dyslipidemia, Severe Diarrhea',
                'monitoring' => '-'
            ],
            [
                'pill' => 'NVP',
                'symptoms' => 'Hepatoxicity, Severe Skin Rash or Hypersensitivy Reaction, SJS',
                'monitoring' => '-'
            ],
            [
                'pill' => 'TDF',
                'symptoms' => 'Tubular Dysfunction (crea, U/A), Bone Demineralization, Lactic Acidosis or Hepatomegaly with Steatosis, Exacerbation of Hp B',
                'monitoring' => 'Baseline creatinine then every 12 months'
            ],

        ];

        foreach ($data as $key)
        {
            App\Symptoms::create([
                'pill'              => $key['pill'],
                'symptoms'             => $key['symptoms'],
                'monitoring'          => $key['monitoring']
            ]);
        }


    }

    public function down()
    {
        Schema::drop('symptoms');
    }
}

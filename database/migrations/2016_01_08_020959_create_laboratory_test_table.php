<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboratoryTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratory_test', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group')->unsigned();
            $table->string('description');
            //  Foreign Keys
            //$table->foreign('checkup_id')->references('id')->on('checkup');
            //$table->foreign('symptoms_id')->references('id')->on('symptoms');

            $table->index(['id']);
        });

        $data = [
            [
                'group' => '1',
                'description' => 'CD4'
            ],
            [
                'group' => '1',
                'description' => 'Viral Load'
            ],
            [
                'group' => '2',
                'description' => 'CBC'
            ], 
            [
                'group' => '3',
                'description' => 'FBS'
            ],
            [
                'group' => '3',
                'description' => 'Lipid Prof'
            ],
            [
                'group' => '3',
                'description' => 'Crea'
            ],
            [
                'group' => '3',
                'description' => 'SGPT'
            ],
            [
                'group' => '4',
                'description' => 'RPR'
            ],
            [
                'group' => '4',
                'description' => 'HbsAg'
            ],
            [
                'group' => '4',
                'description' => 'HCV'
            ],
            [
                'group' => '5',
                'description' => 'U/A'
            ],
            [
                'group' => '5',
                'description' => 'S/E'
            ],

            [
                'group' => '6',
                'description' => 'CXR'
            ],
            [
                'group' => '6',
                'description' => 'Sputum AFB'
            ],
            [
                'group' => '6',
                'description' => 'Genexpert'
            ],
        ];

        foreach ($data as $key)
        {
            App\LaboratoryTest::create([
                'group'         => $key['group'],
                'description'    => $key['description']
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
        Schema::drop('laboratory_test');
    }
}

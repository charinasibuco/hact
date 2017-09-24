<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboratoryTypeTable extends Migration
{
    public function up()
    {
        Schema::create('laboratory_type', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('description');
            //  Foreign Keys
            //$table->foreign('laboratory_id')->references('id')->on('laboratory');
            
            //$table->index(['id', 'result_date']);
        });

        $data = [
            [ 'description' => 'CD4' ],
            [ 'description' => 'Viral Load' ],
            [ 'description' => 'Hgb' ], 
            [ 'description' => 'RBC' ],
            [ 'description' => 'WBC' ],
            [ 'description' => 'Plt' ],
            [ 'description' => 'FBS' ],
            [ 'description' => 'Chol' ],
            [ 'description' => 'HDL' ],
            [ 'description' => 'LDL' ],
            [ 'description' => 'Trigly' ],
            [ 'description' => 'Crea' ],
            [ 'description' => 'SGPT' ],
            [ 'description' => 'RPR' ],
            [ 'description' => 'HbsAg' ],
            [ 'description' => 'HCV' ],
            [ 'description' => 'U/A' ],
            [ 'description' => 'S/E' ],
            [ 'description' => 'CXR' ],
            [ 'description' => 'AFB-1' ],
            [ 'description' => 'AFB-2' ],
            [ 'description' => 'Genexpert' ],
        ];

        foreach ($data as $key)
        {
            App\LaboratoryType::create([ 'description' => $key['description'] ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('laboratory_type');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfectionsClinicalStageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('infections_clinical_stage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('infections_id')->unsigned();
            $table->integer('stage');
            $table->integer('infection');
            $table->timestamps();

            //  Foreign Keys
//            $table->foreign('infections_id')->references('id')->on('infections');
            
            //$table->index(['id', 'result_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('infections_clinical_stage');
    }
}

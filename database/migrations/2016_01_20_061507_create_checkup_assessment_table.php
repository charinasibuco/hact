<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckupAssessmentTable extends Migration
{
    public function up()
    {
        Schema::create('checkup_assessment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkup_id')->unsigned();
            $table->integer('clinical_staging_id')->unsigned();

            //  Foreign Keys
            $table->foreign('checkup_id')->references('id')->on('checkup');
            $table->foreign('clinical_staging_id')->references('id')->on('clinical_staging');
            
            $table->index(['id']);
        });
    }

    public function down()
    {
        Schema::drop('checkup_assessment');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckupSymptomsTable extends Migration
{
    public function up()
    {
        Schema::create('checkup_symptoms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkup_id')->unsigned();
            $table->integer('symptoms_id')->unsigned();

            //  Foreign Keys
            $table->foreign('checkup_id')->references('id')->on('checkup');
            $table->foreign('symptoms_id')->references('id')->on('symptoms');

            $table->index(['id']);
        });
    }

    public function down()
    {
        Schema::drop('checkup_symptoms');
    }
}

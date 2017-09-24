<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();

            $table->tinyInteger('hepatitis_b')->nullable();
            $table->tinyInteger('hepatitis_c')->nullable();
            $table->tinyInteger('pneumocystis_pneumonia')->nullable();
            $table->tinyInteger('orpharyngeal_candidiasis')->nullable();
            $table->tinyInteger('syphilis')->nullable();
            $table->string('stis')->nullable();
            $table->string('others')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('order_number')->unsigned();
            $table->integer('clinical_stage')->unsigned();
            $table->date('result_date');
            $table->timestamps();

            //  Foreign Keys
            $table->foreign('user_id')->references('id')->on('users');
            //$table->foreign('patient_id')->references('id')->on('patient');
            //$table->index(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('infections');
    }
}

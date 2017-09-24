<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkup', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            $table->date('checkup_date');

            $table->string('weight');
            $table->string('height');
            $table->float('bmi');

            $table->string('blood_pressure');
            $table->string('temperature');
            $table->string('pulse_rate');
            $table->string('respiration_rate');

            $table->text('subjective');
            //$table->text('objective');
            $table->string('physical_examination');
            $table->string('head_and_neck');
            $table->string('chest_and_lungs');
            $table->string('cardial');
            $table->string('abdomen');
            $table->string('extremities');
            $table->string('neurologic_examination');

            $table->tinyInteger('cough');
            $table->tinyInteger('fever');
            $table->tinyInteger('night_sweat');
            $table->tinyInteger('weight_loss');

            $table->text('remarks');
            $table->date('follow_up_date')->nullable()->default(NULL);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('patient_id')->references('id')->on('patient');
            $table->foreign('user_id')->references('id')->on('users');
            $table->index(['id', 'checkup_date', 'follow_up_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('checkup');
    }
}

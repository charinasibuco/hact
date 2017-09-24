<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmatoryDateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmatory_date', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            $table->date('confirmatory_date');

            //  Foreign Keys
            $table->foreign('patient_id')->references('id')->on('patient');
            
            $table->index( [ 'id', 'patient_id', 'confirmatory_date'] );
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('confirmatory_date');
    }
}

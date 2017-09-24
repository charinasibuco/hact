<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArvTable extends Migration
{
    public function up()
    {
        Schema::create('arv', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            //  Foreign Keys
            $table->foreign('patient_id')->references('id')->on('patient');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->index(['id', 'patient_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::drop('arv');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckUpArvTable extends Migration
{
    public function up()
    {
        Schema::create('checkup_arv', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkup_id')->unsigned();
            $table->integer('arv_id')->unsigned();

            //  Foreign Keys
            $table->foreign('checkup_id')->references('id')->on('checkup');
            $table->foreign('arv_id')->references('id')->on('arv');
            
            $table->index( [ 'id'] );
        });
    }

    public function down()
    {
        Schema::drop('checkup_arv');
    }
}

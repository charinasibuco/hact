<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckUpInfectionsTable extends Migration
{
    public function up()
    {
        Schema::create('checkup_infections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkup_id')->unsigned();
            $table->integer('infection_id')->unsigned();

            //  Foreign Keys
            $table->foreign('checkup_id')->references('id')->on('checkup');
            $table->foreign('infection_id')->references('id')->on('infections');
            
            $table->index( [ 'id', 'checkup_id', 'infection_id'] );
        });
    }

    public function down()
    {
        Schema::drop('checkup_infections');
    }
}

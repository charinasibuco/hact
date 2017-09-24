<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckupLaboratoryRequestTable extends Migration
{
    public function up()
    {
        Schema::create('checkup_laboratory_request', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkup_id')->unsigned();
            $table->integer('laboratory_test_id')->unsigned();
            $table->string('other_specify')->default('');
            //0-not done : 1-done
            $table->tinyInteger('status')->default(0);

            //  Foreign Keys
            $table->foreign('checkup_id')->references('id')->on('checkup');
            $table->foreign('laboratory_test_id')->references('id')->on('laboratory_test');
            
            $table->index(['id']);
        });
    }

    public function down()
    {
        Schema::drop('checkup_laboratory_request');
    }
}

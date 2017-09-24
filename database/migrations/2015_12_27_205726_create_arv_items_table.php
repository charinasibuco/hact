<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArvItemsTable extends Migration
{
    public function up()
    {
        Schema::create('arv_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('arv_id')->unsigned();
            $table->string('infection');
            $table->integer('medicine_id')->unsigned();
            $table->string('specified_medicine');
            $table->integer('pills_per_day');
            $table->date('date_started')->nullable();
            $table->date('date_discontinued')->nullable();
            // 1 = Treatment Failure, 2 = Clinical Progression/Hospitalization, 3 = Patient Decision/Request
            // 4 = Compliance Difficulties, 5 = Drug Interaction, 6 = Adverse Event (Specify),
            // 7 = Others (Specify), 8 = Death
            $table->tinyInteger('reason');
            $table->string('specify');

            //  Foreign Keys
            // $table->foreign('arv_id')->references('id')->on('arv');
            // $table->foreign('medicine_id')->references('id')->on('medicines');
            
            $table->index(['id', 'arv_id', 'medicine_id']);
        });
    }

    public function down()
    {
        Schema::drop('arv_items');
    }
}

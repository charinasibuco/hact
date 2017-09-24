<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('arv_item_id')->unsigned();
            $table->integer('pills_dispense');
            $table->date('date_dispense');
            $table->integer('user_id')->unsigned();
            $table->integer('pills_missed_in_30_days');
            $table->integer('pills_left');
            $table->timestamps();

            //  Foreign Keys
            $table->foreign('arv_item_id')->references('id')->on('arv_items');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->index(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('prescription');
    }
}

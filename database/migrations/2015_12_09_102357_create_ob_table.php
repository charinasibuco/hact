<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ob', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            // 0 = No, 1 = Yes
            $table->tinyInteger('currently_pregnant');
            $table->string('currently_pregnant_if_yes_gestation_age')->nullable();
            $table->date('if_delivered_date')->nullable();
            // 1 = Breastfeeding, 2 = Formula, 3 = Mixed feeding
            $table->tinyInteger('infant_type');
            $table->text('pap_smear');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            //  Foreign Keys
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
        Schema::drop('ob');
    }
}

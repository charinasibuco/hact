<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('art', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            # if Yes, Provide Primary HIV Care
            // 0 = No, 1 = Yes, 2 = Deferred
            $table->tinyInteger('art_eligible');
            $table->string('if_deferred_specify');
            // 1 = Low CD4 count, 2 = Active TB, 3 = Child < 5y.o., 
            // 4 = Hep B or C requiring tretment
            // 5 = Pregnnt/breastfeeding, 6 = WHO classifiction 3 or 4
            // 7 = other
            $table->tinyInteger('reason');
            $table->string('reason_other_specify');
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
        Schema::drop('art');
    }
}

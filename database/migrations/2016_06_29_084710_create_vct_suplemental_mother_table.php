<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVctSuplementalMotherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vct_suplemental_mother', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vct_id')->unsigned();
            // Encoder
            $table->integer('user_id')->unsigned();
            $table->engine = 'InnoDB';
            // Number of alive children
            $table->smallInteger('alive_children_count');
            $table->date('last_menstrual_period')->nullable()->default(null);
            $table->tinyInteger('months_pregnant');
            $table->tinyInteger('weeks_pregnant');
            $table->date('delivery_date')->nullable()->default(null);
            $table->string('has_parental_care');
            # Where do you plan to deliver the baby?
            // 1 = Hospital, 2 = Lying-in clinic, 3 = Home, 4 = No Plans yet, 5 = Others
            $table->tinyInteger('plan_to_deliver_baby');
            $table->string('plan_to_deliver_baby_specify');
            # Partners tested for HIV?
            // 0 = No, 1 = Yes, 3= Don't know
            $table->tinyInteger('partner_hiv_tested');
            $table->date('if_yes_when')->nullable()->default(null);
            $table->string('if_yes_facility');
            // 0 = Negative, 1 = Positive, 2 = Don't Know, 3 = Did not get result
            $table->tinyInteger('if_yes_result');
            # Partner taking ARV medication/s?
            // 0 = No, 1 = Yes, 2 = Don't Know, 3 = Stopped
            $table->tinyInteger('partner_taking_arv');
            $table->string('if_stopped_reason');


            // Date Encoded
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            //  Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('vct_id')->references('id')->on('vct')->onDelete('cascade');;
            
            //$table->index(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vct_suplemental_mother');
    }
}

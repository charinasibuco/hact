<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVctSuplementalChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vct_suplemental_children', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vct_id')->unsigned();
            # HIV status of mother?
            // 0 = Negative, 1 = Positive, 2 = Don't know
            $table->smallInteger('mother_hiv_status');
            $table->date('hiv_diagnosis_date')->nullable()->default(null);
            $table->string('mother_saccl', 25);
            $table->tinyInteger('month_pregnant');
            $table->tinyInteger('week_pregnant');
            // 0 = No, 1 = Yes, 2 = Don't know
            $table->tinyInteger('mother_took_arv_medication_during_pregnancy');
            $table->string('mother_took_arv_medication_during_pregnancy_reason_if_no');
            // 0 = No, 1 = Yes
            $table->tinyInteger('did_breastfeed_baby');
            // 0 = Dead, 1 = Yes
            $table->tinyInteger('mother_dead_or_alive');
            $table->date('mother_dead_or_alive_when')->nullable()->default(null);

            // Encoder
            $table->integer('user_id')->unsigned();
            // Date Encoded
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            //  Foreign Keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('vct_id')->references('id')->on('vct');
            
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
        Schema::drop('vct_suplemental_children');
    }
}

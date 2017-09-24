<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMortalityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mortality', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('date_of_death');
            $table->tinyInteger('is_hiv_related');
            $table->string('immediate_cause');
            $table->string('immediate_icd10_code')->nullable()->default(NULL);
            $table->string('antecedent_cause');
            $table->string('antecedent_icd10_code')->nullable()->default(NULL);
            $table->string('underlying_cause');
            $table->string('underlying_icd10_code')->nullable()->default(NULL);
            //OP present
            $table->tinyInteger('tuberculosis')->nullable()->default(NULL);
            $table->tinyInteger('pneumocystis_pneumonia')->nullable()->default(NULL);
            $table->tinyInteger('cryptococcal_meningitis')->nullable()->default(NULL);
            $table->tinyInteger('cytomegalovirus')->nullable()->default(NULL);
            $table->tinyInteger('candidiasis')->nullable()->default(NULL);
            $table->string('other')->nullable()->default(NULL);
            //cd4
            $table->string('cd4_count')->nullable()->default(NULL);
            $table->date('last_cd4_count')->nullable()->default(NULL);
            $table->tinyInteger('have_taken_arv')->nullable()->default(NULL);
            $table->tinyInteger('last_arv_regimen')->nullable()->default(NULL);
            $table->timestamps();

            //foreign key
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mortality');
    }
}

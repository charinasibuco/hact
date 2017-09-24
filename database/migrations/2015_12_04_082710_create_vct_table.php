<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vct', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            $table->date('vct_date')->nullable();
            # 0 = No/Negative, 1 = Yes/Positive
            $table->tinyInteger('result')->nullable();
            # Reason for HIV Testing: (Check all that apply)
            // Mother is infected with HIV
            $table->tinyInteger('reason_1')->default(0);
            // Sex partner is infected with HIV
            $table->tinyInteger('reason_2')->default(0);
            // Shared needles/syringes with IDU's
            $table->tinyInteger('reason_3')->default(0);
            // Accidental needle prick
            $table->tinyInteger('reason_4')->default(0);
            // Recommended by physician
            $table->tinyInteger('reason_5')->default(0);
            // Requirements for insurance
            $table->tinyInteger('reason_6')->default(0);
            // Received blood transfusion
            $table->tinyInteger('reason_7')->default(0);
            // Re-check previous HIV test result
            $table->tinyInteger('reason_8')->default(0);
            // Employement - Local/In the Philippines
            $table->tinyInteger('reason_9')->default(0);
            // Employment - Overseas/Abroad
            $table->tinyInteger('reason_10')->default(0);
            // Pregnant
            $table->tinyInteger('reason_11')->default(0);
            // TB Patient
            $table->tinyInteger('reason_12')->default(0);
            // Patient is infected with Hepatitis B/C
            $table->tinyInteger('reason_13')->default(0);
            // No particular reason
            $table->tinyInteger('reason_14')->default(0);
            // Other specify
            $table->string('reason_other');
            # 15
            $table->tinyInteger('is_your_mother_infected_with_hiv');
            # Answer all. have you experience any of the following?
            // Received blood transfusion
            $table->tinyInteger('experience_1');
            $table->string('experience_1_if_yes_what_year', 10)->default('');
            // Injected drugs without doctor's advice
            $table->tinyInteger('experience_2');
            $table->string('experience_2_if_yes_what_year', 10)->default('');
            // Accidental needle prick
            $table->tinyInteger('experience_3');
            $table->string('experience_3_if_yes_what_year', 10)->default('');
            // Sexually transmitted infections (STI)
            $table->tinyInteger('experience_4');
            $table->string('experience_4_if_yes_what_year', 10)->default('');
            // Sex with a female with no condom
            $table->tinyInteger('experience_5');
            $table->string('experience_5_if_yes_what_year', 10)->default('');
            // Sex with a male with no condom
            $table->tinyInteger('experience_6');
            $table->string('experience_6_if_yes_what_year', 10)->default('');
            // Sex with a person in prostitution
            $table->tinyInteger('experience_7');
            $table->string('experience_7_if_yes_what_year', 10)->default('');
            // Regularly accept payment for sex
            $table->tinyInteger('experience_8');
            $table->string('experience_8_if_yes_what_year', 10)->default('');
            # Answer both. If none, write "0" in the box
            // How many FEMALE sex partners have you ever had? Year of last sex
            $table->integer('number_of_female');
            $table->string('last_year_sex_female');
            // How many MALE sex partners have you ever had? Year of last sex
            $table->integer('number_of_male');
            $table->string('last_year_sex_male');
            # HIV Testing
            // Have you ever been tested for HIV before?
            $table->tinyInteger('been_tested_for_hiv_before');
            // If, yes when was the most recent year?
            $table->string('been_tested_for_hiv_before_month');
            $table->string('been_tested_for_hiv_before_year');
            // Which testing facility did you have the test?
            $table->string('which_testing_facility');
            // Municipality/City
            $table->string('which_testing_facility_city');
            // What was the result? 0 = Negative, 1 = Positve
            $table->tinyInteger('test_result');
            // Encoder
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            //  Foreign Keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('patient_id')->references('id')->on('patient');

            $table->index(['id', 'vct_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vct');
    }
}

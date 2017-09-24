<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient', function (Blueprint $table) {
            //  VCT Form
            $table->increments('id');
            $table->string('ui_code', 25);
            $table->string('code_name');
            $table->string('saccl_code')->nullable()->default(NULL);
            $table->string('phil_health_number');
            $table->date('birth_date');
            // 0 = Female, 1 = Male
            $table->tinyInteger('gender'); 
            // 1 = Single, 2 = Married, 3 = Separated, 4 = Widowed
            $table->tinyInteger('civil_status');
            $table->smallInteger('dependents');
            $table->string('nationality');
            // Address
            $table->string('permanent_address');
            $table->string('current_city');
            $table->string('current_province');
            // Birth Place
            $table->string('birth_place_city');
            $table->string('birth_place_province');
            // Contact Number
            $table->string('contact_number');
            $table->string('email');
            // 0 = None, 1 = Elementary, 2 = High School, 3 = Vocational, 4 = Post-Graduate, 5 = College
            $table->tinyInteger('highest_educational_attainment');
            $table->tinyInteger('is_working');
            //
            $table->tinyInteger('is_living_with_partner');
            $table->tinyInteger('is_presently_pregnant')->nullable()->default(NULL);
            // Employment
            $table->string('current_occupation')->nullable()->default(NULL);
            $table->string('previous_occupation')->nullable()->default(NULL);
            // Did you work overseas/abroad in the past 5 years?
            $table->tinyInteger('is_work_abroad_in_past_5years');
            // If yes, when did you return from your last contract?
            $table->date('last_contract')->nullable()->default(NULL);
            // Where were you based? 1 = On a Ship, 2 = Land
            $table->tinyInteger('is_based')->nullable()->default(NULL);
            // What country did you last work in?
            $table->string('last_work_country')->nullable()->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('patient');
    }
}

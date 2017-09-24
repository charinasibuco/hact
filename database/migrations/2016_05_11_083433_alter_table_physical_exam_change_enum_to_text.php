<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePhysicalExamChangeEnumToText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('checkup_physical_exam')) {
            Schema::drop('checkup_physical_exam');
        }

        Schema::create('checkup_physical_exam', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('checkup_id');
            $table->text('general_survey');
            $table->text('skin')->nullable()->default(NULL);
            $table->text('heent')->nullable()->default(NULL);
            $table->text('lips_buccal_mucosa')->nullable()->default(NULL);
            $table->text('sclerae')->nullable()->default(NULL);
            $table->text('conjunctivae')->nullable()->default(NULL);
            $table->text('chest_and_lungs')->nullable()->default(NULL);
            $table->text('cardial')->nullable()->default(NULL);
            $table->text('abdomen')->nullable()->default(NULL);
            $table->text('extremities')->nullable()->default(NULL);

            /**
             * Remarks
             */
            $table->text('general_survey_remarks')->nullable()->default(NULL);
            $table->text('skin_remarks')->nullable()->default(NULL);
            $table->text('heent_remarks')->nullable()->default(NULL);
            $table->text('chest_and_lungs_remarks')->nullable()->default(NULL);
            $table->text('cardial_remarks')->nullable()->default(NULL);
            $table->text('abdomen_remarks')->nullable()->default(NULL);
            $table->text('extremities_remarks')->nullable()->default(NULL);

//                $table->foreign('checkup_id')->references('id')->on('checkup')->onDelete('cascade');

            $table->index(['id','checkup_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkup_physical_exam', function (Blueprint $table) {
            //
        });
    }
}

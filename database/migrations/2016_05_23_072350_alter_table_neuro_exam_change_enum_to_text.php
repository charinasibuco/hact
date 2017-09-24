<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableNeuroExamChangeEnumToText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('checkup_neuro_exam')) {
            Schema::drop('checkup_neuro_exam');
        }

        Schema::create('checkup_neuro_exam', function(Blueprint $table) {
            /**
             * Mental Status Exam
             */
            $table->increments('id');
            $table->integer('checkup_id')->unsigned();
            $table->enum('level_of_consciousness', ['Alert', 'Lethargic', 'Obtunded', 'Stupor', 'Coma'])->nullable()->default(NULL);
            $table->text('orientation')->nullable()->default(NULL);
            $table->enum('mood_and_behavior', ['Appropriate', 'Inappropriate'])->nullable()->default(NULL);
            $table->text('memory')->nullable()->default(NULL);
            $table->enum('cognitive_function', ['Good', 'Poor'])->nullable()->default(NULL);

            /**
             * Cranial Nerve
             */
            $table->enum('able_to_smell', ['Intact', 'Impaired'])->nullable()->default(NULL);
            $table->enum('visual_acuity', ['Intact', 'Impaired'])->nullable()->default(NULL);
            $table->enum('pupils', ['Full', 'Presence of visual field defect'])->nullable()->default(NULL);
            $table->text('funduscopy')->nullable()->default(NULL);
            $table->text('2_3')->nullable()->default(NULL);
            $table->enum('3_4_6_eoms', ['Intact', 'Impaired'])->nullable()->default(NULL);
            $table->enum('lateralizing_gaze', ['Midline', 'Lateral'])->nullable()->default(NULL);
            $table->enum('temporal_strength', ['Intact', 'Impaired'])->nullable()->default(NULL);
            $table->enum('able_to_clench_teeth', ['Intact', 'Impaired'])->nullable()->default(NULL);
            $table->enum('able_to_feel_pain_in_facial_area', ['Intact', 'Impaired'])->nullable()->default(NULL);
            $table->enum('corneal_reflex', ['Present', 'Absent'])->nullable()->default(NULL);
            $table->text('vii')->nullable()->default(NULL);
            $table->enum('taste', ['Intact', 'Impaired'])->nullable()->default(NULL);
            $table->enum('response_to_whispered_voice', ['Intact', 'Impaired'])->nullable()->default(NULL);
            $table->text('gag_reflex')->nullable()->default(NULL);
            $table->text('xi')->nullable()->default(NULL);
            $table->text('xii')->nullable()->default(NULL);

            /**
             * Motor Exam
             */
            $table->enum('muscle_bulk', ['Good', 'Poor'])->nullable()->default(NULL);
            $table->enum('muscle_tone', ['Good', 'Poor'])->nullable()->default(NULL);
            $table->text('muscle_strength')->nullable()->default(NULL);
            $table->text('sensory')->nullable()->default(NULL);
            $table->text('reflexes')->nullable()->default(NULL);
            $table->text('cerebellars')->nullable()->default(NULL);
            $table->text('meningeals')->nullable()->default(NULL);

            $table->foreign('checkup_id')->references('id')->on('checkup')->onDelete('cascade');
            $table->index(['id', 'checkup_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}

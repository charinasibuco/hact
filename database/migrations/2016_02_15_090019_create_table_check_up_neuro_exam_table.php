<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCheckUpNeuroExamTable extends Migration
{
    public function up()
    {
        Schema::create('checkup_neuro_exam', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkup_id')->unsigned();

            $table->tinyInteger('consciousness_level_alert');
            $table->tinyInteger('consciousness_level_lethargic');
            $table->tinyInteger('consciousness_level_obtunded');
            $table->tinyInteger('consciousness_level_stupor');
            $table->tinyInteger('consciousness_level_coma');

            $table->tinyInteger('orientation_place');
            $table->tinyInteger('orientation_person');
            $table->tinyInteger('orientation_time');

            $table->tinyInteger('memory_recent');
            $table->tinyInteger('memory_remote');
            $table->tinyInteger('memory_cognitive');

            $table->tinyInteger('able_to_smell');
            $table->string('visual_acuity');
            $table->string('pupils');
            $table->string('fundoscopy');

            $table->tinyInteger('nystagmus');
            $table->tinyInteger('lateralizing_gaze');
            $table->tinyInteger('corneal_reflex');
            $table->tinyInteger('able_to_feel_pain_in_facial_area');
            $table->tinyInteger('able_to_clench_teeth');
            $table->tinyInteger('facial_asymmetry');
            $table->tinyInteger('nasolabial_flattening');

            $table->tinyInteger('response_to_whispered_voice');
            $table->tinyInteger('rhinne');
            $table->tinyInteger('weber');
            $table->tinyInteger('gag_reflex');
            $table->tinyInteger('able_to_shrug_both_shoulders_symmetrically');
            $table->tinyInteger('can_turn_head_to_each_side_with_resistance');
            $table->tinyInteger('tongue_midline');
            $table->tinyInteger('fasciculations');
            
            /*$table->string('muscle_bulk_and_tone');
            $table->string('motor_strength');
            $table->string('sensory');
            $table->string('reflexes');*/
            $table->string('motor');
            $table->string('sensory');
            $table->string('reflexes');
            
            $table->tinyInteger('dysmetria');
            $table->tinyInteger('dysdiadochokinesia');
            $table->tinyInteger('dystaxia');
            
            $table->tinyInteger('brudzunskis');
            $table->tinyInteger('kernigs');

            //  Foreign Keys
//            $table->foreign('checkup_id')->references('id')->on('checkup');
            
            $table->index( [ 'id', 'checkup_id'] );
        });
    }

    public function down()
    {
        Schema::drop('checkup_neuro_exam');
    }
}

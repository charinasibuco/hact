<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMedicalAbstract extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('medical_abstract')) {
            Schema::create('medical_abstract', function(Blueprint $table){
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('patient_id');
                $table->date('date');
                $table->text('body');



//                $table->foreign('patient_id')->references('id')->on('patient')->onDelete('cascade');
                $table->index(['id','patient_id']);
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

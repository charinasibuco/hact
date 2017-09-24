<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_transfer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            //0 - not transferred, 1 - transferred-in, 2 - transferred-out
            $table->tinyInteger('transfer')->nullable()->default(NULL);
            $table->date('transfer_date');


            //  Foreign Keys
            //$table->foreign('patient_id')->references('id')->on('patient');
            
            $table->index( [ 'id', 'patient_id', 'transfer'] );
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('patient_transfer');
    }
}

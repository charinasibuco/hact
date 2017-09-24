<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePrescriptionAddPatientId extends Migration
{
    public function up()
    {
        Schema::table('prescription', function (Blueprint $table) {
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patient');
        });
    }

    public function down()
    {
        Schema::table('prescription', function (Blueprint $table) {
            $table->dropForeign('prescription_patient_id_foreign');
            $table->dropColumn('patient_id');
        });
    }
}

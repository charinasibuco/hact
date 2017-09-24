<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMedicineIdPrescriptionTable extends Migration
{
    public function up()
    {
        Schema::table('prescription', function (Blueprint $table) {
        });
    }

    public function down()
    {
    }
}

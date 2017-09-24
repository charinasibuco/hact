<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPatientTypeToCheckupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('checkup', 'patient_type')){
            Schema::table('checkup', function (Blueprint $table) {
                $table->enum('patient_type',['InPatient', 'OutPatient']);
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
        Schema::table('checkup', function (Blueprint $table) {
//            $table->enum('patient_type',['InPatient', 'OutPatient']);
        });
    }
}

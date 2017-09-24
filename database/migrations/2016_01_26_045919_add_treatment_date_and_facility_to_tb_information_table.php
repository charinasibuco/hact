<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTreatmentDateAndFacilityToTbInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_information', function(Blueprint $table) {
            $table->date('tx_date_outcome')->nullable();;
            $table->string('tx_facility')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_information', function(Blueprint $table) {
            $table->dropColumn('tx_date_outcome');
            $table->dropColumn('tx_facility');
        });
    }
}

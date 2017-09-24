<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_information', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
            // 0 = No, 1 = Yes
            $table->tinyInteger('presence');
            // 0 = No Active TB, 1 = With Active TB
            $table->tinyInteger('tb_status');
            // 1 = Pulmonary, 2 = Extrapulmonary
            $table->tinyInteger('site')->nullable();
            // 1 = Category I,      2 = Category Ia,    3 = Category II,
            // 4 = Category IIa,    5 = SRDR,           6 = XDR-TB Regimen
            $table->tinyInteger('current_tb_regimen')->nullable();
            // 0 = No, 1 = Yes
            $table->tinyInteger('on_ipt')->nullable();
            // 0 = Failed, 1 = Completed, Other
            $table->tinyInteger('ipt_outcome')->nullable();
            $table->string('ipt_outcome_other')->nullable();
            // 1 = Subceptible, 2 = MDR/RR, 3 = XDR, 4 = Other
            $table->tinyInteger('drug_resistance')->nullable();
            $table->string('drug_resistance_other')->nullable();
            // 1 = Cured, 2 = Completed, 3 = Failed, 4 = Other
            $table->tinyInteger('tx_outcome')->nullable();
            $table->string('tx_outcome_other')->nullable();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            //  Foreign Keys
            $table->foreign('patient_id')->references('id')->on('patient');
            $table->foreign('user_id')->references('id')->on('users');

            $table->index(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tb_information');
    }
}

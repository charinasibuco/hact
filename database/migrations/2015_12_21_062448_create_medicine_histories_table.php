<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medicine_id');
            $table->integer('medicine_qty');
            $table->integer('user_id');
            $table->string('log_message');
            $table->dateTime('log_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medicine_histories');
    }
}

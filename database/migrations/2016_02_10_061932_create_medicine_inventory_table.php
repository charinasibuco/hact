<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineInventoryTable extends Migration
{
    public function up()
    {
        Schema::create('medicine_inventory', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medicine_id')->unsigned();
            $table->integer('tabs_per_bottle')->default(0);
            $table->string('lot_number')->nullable();
            $table->integer('quantity');
            $table->date('expiry_date');
            $table->timestamps();
            //  Foreign Keys
            $table->foreign('medicine_id')->references('id')->on('medicines');
        });
    }

    public function down()
    {
        Schema::drop('medicine_inventory');
    }
}

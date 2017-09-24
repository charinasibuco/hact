<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('item_code')->nullable();
            $table->integer('tabs_per_bottle')->default(0);
            $table->string('lot_number')->nullable();
            // classification: ARV = 1 & OI = 2
            $table->tinyInteger('classification')->nullable();
            $table->integer('quantity');
            $table->string('suggested_dosage')->nullable();
            $table->date('expiry_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *guursassdffffy7uuyr7y8iy
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medicines');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePrescriptionAddMedicineInventoryId extends Migration
{
    public function up()
    {
        Schema::table('prescription', function (Blueprint $table) {
            $table->integer('medicine_inventory_id')->unsigned();
            $table->foreign('medicine_inventory_id')->references('id')->on('medicine_inventory');
        });
    }

    public function down()
    {
        Schema::table('prescription', function (Blueprint $table) {
            $table->dropForeign('prescription_medicine_inventory_id_foreign');
            $table->dropColumn('medicine_inventory_id');
        });
    }
}

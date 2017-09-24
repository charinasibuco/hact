<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePrescriptionChangeMedicineIdToMedicineInventoryId extends Migration
{
    public function up()
    {
        Schema::table('prescription', function (Blueprint $table) {
            #$table->dropForeign('prescription_medicine_id_foreign');
            #$table->dropColumn('medicine_id');
            #$table->dropColumn('medicine_inventory_id');
        });
    }
}

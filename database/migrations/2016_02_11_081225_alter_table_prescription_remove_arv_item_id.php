<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePrescriptionRemoveArvItemId extends Migration
{
    public function up()
    {
        Schema::table('prescription', function (Blueprint $table) {
            $table->dropForeign('prescription_arv_item_id_foreign');
            $table->dropColumn('arv_item_id');
        });
    }

}

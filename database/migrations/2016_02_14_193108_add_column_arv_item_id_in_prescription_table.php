<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnArvItemIdInPrescriptionTable extends Migration
{
    public function up()
    {
        Schema::table('prescription', function (Blueprint $table) {
            $table->integer('arv_item_id')->unsigned();
            $table->foreign('arv_item_id')->references('id')->on('arv_items');
        });
    }
    
    public function down()
    {
        Schema::table('prescription', function (Blueprint $table) {
            $table->dropForeign('prescription_arv_item_id_foreign');
            $table->dropColumn('arv_item_id');
        });
    }
}

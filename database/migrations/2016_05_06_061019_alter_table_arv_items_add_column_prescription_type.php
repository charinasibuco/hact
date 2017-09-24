<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableArvItemsAddColumnPrescriptionType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('arv_items','prescription_type'))
        {
            Schema::table('arv_items', function (Blueprint $table)
            {
                $table->enum('prescription_type',['arv','oi','others']);
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
        Schema::table('arv_items', function (Blueprint $table) {
            //
        });
    }
}

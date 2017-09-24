<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableArvItemsAddInfectionAfterMigrateDrop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('arv_items', function (Blueprint $table) {
            if(!Schema::hasColumn('arv_items','infection'))
            {
                $table->integer('infection')->nullable()->default(NULL);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}

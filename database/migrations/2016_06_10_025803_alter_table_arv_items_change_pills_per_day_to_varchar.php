<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableArvItemsChangePillsPerDayToVarchar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('arv_items','pills_per_day'))
        {
            Schema::table('arv_items', function (Blueprint $table) {
                    $table->dropColumn('pills_per_day');
            });

        }
        Schema::table('arv_items', function (Blueprint $table) {
            $table->string('pills_per_day')->nullable()->default(NULL);
        });

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

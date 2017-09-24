<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCheckupRemovePhysicalExam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkup',function(Blueprint $table){
            Schema::hasColumn('checkup','neurologic_examination')?$table->dropColumn('neurologic_examination'):false;
            Schema::hasColumn('checkup','physical_examination')?$table->dropColumn('physical_examination'):false;
            Schema::hasColumn('checkup','head_and_neck')?$table->dropColumn('head_and_neck'):false;
            Schema::hasColumn('checkup','chest_and_lungs')?$table->dropColumn('chest_and_lungs'):false;
            Schema::hasColumn('checkup','cardial')?$table->dropColumn('cardial'):false;
            Schema::hasColumn('checkup','abdomen')?$table->dropColumn('abdomen'):false;
            Schema::hasColumn('checkup','extremities')?$table->dropColumn('extremities'):false;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

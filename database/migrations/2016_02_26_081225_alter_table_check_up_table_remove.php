<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCheckUpTableRemove extends Migration
{
    public function up()
    {
        Schema::table('checkup', function (Blueprint $table) {
            /*$table->dropForeign('checkup_laboratory_id_foreign');
            $table->dropColumn('laboratory_id');
            $table->dropForeign('checkup_infection_id_foreign');
            $table->dropColumn('infection_id');
            $table->dropForeign('checkup_arv_id_foreign');
            $table->dropColumn('arv_id');*/
        });
    }

    public function down()
    {
        //
    }

}

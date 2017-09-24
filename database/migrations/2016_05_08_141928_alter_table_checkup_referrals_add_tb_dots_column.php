<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCheckupReferralsAddTbDotsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            Schema::table('checkup_referrals', function (Blueprint $table) {
                if(Schema::hasColumn('checkup_referrals','others')) {
                    $table->dropColumn('others');
                }
                //$table->tinyInteger('others')->nullable();
                if(!Schema::hasColumn('checkup_referrals','tb_dots')) {
                    $table->tinyInteger('tb_dots')->nullable();
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
        Schema::table('checkup_referrals', function (Blueprint $table) {
            //
        });
    }
}

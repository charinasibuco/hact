<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableReferralsAddOthersWithNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('checkup_referrals','others')) {
            Schema::table('checkup_referrals', function (Blueprint $table) {
                    $table->string('others')->nullable();
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
        Schema::table('checkup_referrals', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckupReferralsTable extends Migration
{
    public function up()
    {
        Schema::create('checkup_referrals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkup_id')->unsigned();
            $table->tinyInteger('surgeon')->default(0);
            $table->tinyInteger('ob_gyne')->default(0);
            $table->tinyInteger('ophthamology')->default(0);
            $table->tinyInteger('dentis')->default(0);
            $table->tinyInteger('psychiatrist')->default(0);
            $table->string('others')->default('');
            $table->text('reason')->default('');
            //0-not referred : 1-not done : 2-done
            $table->tinyInteger('others_status')->default(0);

            //  Foreign Keys
            $table->foreign('checkup_id')->references('id')->on('checkup');
            
            $table->index(['id']);
        });
    }

    public function down()
    {
        Schema::drop('checkup_referrals');
    }
}

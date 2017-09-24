<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSiteExtraPulmonaryToTbInformationTable extends Migration
{
    public function up()
    {
      Schema::table('tb_information', function (Blueprint $table) {
        $table->string('site_extrapulmonary')->nullable();
      });
    }

    public function down()
    {
      Schema::table('tb_information', function (Blueprint $table) {
        $table->dropColumn('site_extrapulmonary');
      });
    }
}

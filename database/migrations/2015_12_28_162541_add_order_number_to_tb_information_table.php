<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderNumberToTbInformationTable extends Migration
{
    public function up()
    {
      Schema::table('tb_information', function (Blueprint $table) {
        $table->integer('order_number')->unsigned();
      });
    }

    public function down()
    {
      Schema::table('tb_information', function (Blueprint $table) {
        $table->dropColumn('order_number');
      });
    }
}

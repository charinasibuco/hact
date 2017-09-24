<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMedicinesTable extends Migration
{
    public function up()
    {
        Schema::table('medicines', function(Blueprint $table) {
            #$table->dropColumn(['tabs_per_bottle', 'lot_number', 'quantity', 'expiry_date']);
        });
    }

    public function down()
    {
    }
}

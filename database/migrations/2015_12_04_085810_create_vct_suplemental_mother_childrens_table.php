<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVctSuplementalMotherChildrensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vct_suplemental_mother_childrens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mother_id')->unsigned();
            # Number of alive children
            // 0 = Negative, 1 = Positive, 2 = Don't Know
            $table->tinyInteger('status');
            $table->string('place_tested');
            $table->date('date_tested')->nullable()->default(null);

            // Encoder
            $table->integer('user_id')->unsigned();
            // Date Encoded
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            //  Foreign Keys
            //$table->foreign('user_id')->references('id')->on('users');
            //$table->foreign('mother_id')->references('id')->on('vct_suplemental_mother');
            
            //$table->index(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vct_suplemental_mother_childrens');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHivInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hiv_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('type');
            $table->string('description');
            $table->string('file');
            $table->string('image');
            $table->tinyInteger('display')->default(0);
            $table->timestamps();

            //  Foreign Keys
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->index( [ 'id', 'user_id', 'type','description','file'] );
        });

        $data = [
            [
                'description' => 'HIV,AIDS and ART Registry of the Philippines November 2015',
                'file' => 'files/hiv_info/hiv-aids-and-art-registry-of-the-ph-nov-2015.pdf',
                'image' => 'images/doh-logo.jpg',
                'type' => 1,
                'display' => 1,
                'user_id' => 1
            ],
            [
                'description' => 'National and Regional Hiv Situationer as of November 2015 Update (For Dist)',
                'file' => 'files/hiv_info/national-regional-hiv-situationer-as-of-november-2015-update-for-dist.ppsx',
                'image' => 'images/doh-logo.jpg',
                'type' => 2,
                'display' => 1,
                'user_id' => 1
            ],
            [
                'description' => 'Western Visayas HIV and AIDS Registry November 2015',
                'file' => 'files/hiv_info/western-visayas-hiv-aids-registry-november-2015.pdf',
                'image' => 'images/doh-logo.jpg',
                'type' => 3,
                'display' => 1,
                'user_id' => 1
            ],

        ];

        foreach ($data as $key)
        {
            App\HIVInfo::create([
                'description'     => $key['description'],
                'file'            => $key['file'],
                'image'           => $key['image'],
                'type'            => $key['type'],
                'display'         => $key['display'],
                'user_id'         => $key['user_id']
            ]);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hiv_info');
    }
}

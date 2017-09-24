<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            // 0 = False, 1 = True
            $table->tinyInteger('reset');
            $table->string('contact_number');
            // 1 = Admin, 2 = Doctor
            $table->tinyInteger('access');
            // 1 = Active, 0 = Inactive
            $table->tinyInteger('active');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id']);
        });

        $data = [
            [
                'name'              => 'John Doe',
                'email'             => 'admin@hactbacolod.com',
                'password'          => 'p@ssw0rd',
                'contact_number'    => '123456',
                'access'            => 1,
                'active'            => 1
            ],
            [
                'name'              => 'Emman',
                'email'             => 'egrectra@hactbacolod.com',
                'password'          => 'p@ssw0rd',
                'contact_number'    => '123456',
                'access'            => 1,
                'active'            => 1
            ],
            [
                'name'              => 'JD',
                'email'             => 'john@hactbacolod.com',
                'password'          => 'p@ssw0rd',
                'contact_number'    => '123456',
                'access'            => 2,
                'active'            => 1
            ], 
            [
                'name'              => 'Gregory House',
                'email'             => 'house@hactbacolod.com',
                'password'          => 'p@ssw0rd',
                'contact_number'    => '123456',
                'access'            => 2,
                'active'            => 1
            ]
        ];

        foreach ($data as $key)
        {
            App\User::create([
                'name'              => $key['name'],
                'email'             => $key['email'],
                'password'          => bcrypt($key['password']),
                'contact_number'    => $key['contact_number'],
                'access'            => $key['access'],
                'active'            => $key['active']
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
        Schema::drop('users');
    }
}

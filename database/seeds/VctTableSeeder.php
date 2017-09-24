<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\VCT;
use App\User;

class VctTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Model::unguard();

        $this->call(VctMale18AboveTableSeeder::class);
        $this->call(VctMale18BelowTableSeeder::class);
        $this->call(VctFemale18AboveNotPregnantTableSeeder::class);
        $this->call(VctFemale18BelowNotPregnantTableSeeder::class);
        $this->call(VctFemale18AboveIsPregnantTableSeeder::class);
        $this->call(VctFemale18BelowIsPregnantTableSeeder::class);

        Model::reguard();
    }
}

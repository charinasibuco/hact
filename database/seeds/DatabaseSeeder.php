<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Model::unguard();

        $this->call(PatientTableSeeder::class);
        $this->call(MedicineTableSeeder::class);
        $this->call(VctTableSeeder::class);
        // Seed Patients
        #factory(App\Patient::class, 50)->create()->each(function($u) {
        #});

        Model::reguard();
    }
}

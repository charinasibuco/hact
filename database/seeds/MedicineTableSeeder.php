<?php

use Illuminate\Database\Seeder;
use App\MedicineModel;
class MedicineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();

        for($i = 0; $i < 10; $i++)
        {
            $expireDate = \Carbon\Carbon::createFromTimeStamp( $faker->dateTimeBetween( '2 years',   '10 years' )->getTimestamp() );
            $lotLetter  = strtoupper(substr(str_random(10), 0, 2));
            $lotNum     = $faker->ean8;
            $lotNumber  = $lotLetter.$lotNum;
            MedicineModel::create(array(
                'name'              => $faker->unique()->randomElement(array('Efavirenz + Tenofovir DF + Emtricitabine',
                                                            'Rilpivirine + Tenofovir DF + Emtricitabine','Elvitegravir + Cobicistat + Tenofovir AF + Emtricitabine',
                                                            'Elvitegravir + Cobicistat + Tenofovir DF + Emtricitabine','Dolutegravir + Abacavir + Lamivudine',
                                                            'Zidovudine + Lamivudine', 'Abacavir + Lamivudine', 'Abacavir + Zidovudine + Lamivudine',
                                                            'Tenofovir DF + Emtricitabine', 'Tenofovir Disoproxil Fumarate')),
                #'tabs_per_bottle'   => $faker->randomElement(array('300','100', '150', '600', '800', '60')),
                #'expiry_date'       => $expireDate,
                #'lot_number'        => $lotNumber,
                'classification'    => 1,
                'item_code'         => $faker->unique()->randomElement(array('EFV + TDF + EVG',
                                                            'RPG + TDF + EVG','EVG + c + TAF + EVG',
                                                            'EVG + c + TDF + EVG','DTG + ABC + 3TC',
                                                            'ZDV + 3TC', 'ABC + 3TC', 'ABC + ZDV + 3TC',
                                                            'Tenofovir DF + EVG', 'TFG')),
                #'quantity'          => $faker->numberBetween(0,300),
                ));
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Patient;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 200; $i++)
        {
        	$ui_code_1 		= strtoupper(substr(str_random(10), 0, 2));
        	$ui_code_2 		= strtoupper(substr(str_random(10), 0, 2));
        	$ui_code_3 		= rand(01, 12);

        	$birth_date_1 	= \Carbon\Carbon::createFromTimeStamp( $faker->dateTimeBetween( '-17 year', 'now' )->getTimestamp() );
        	$birth_date_2	= $birth_date_1->toDateTimeString();
        	$birth_date_3	= $faker->date($format = 'Y-m-d');
        	$ui_code 		= $ui_code_1 . '-' . $ui_code_2 . '-' . $ui_code_3 . '-' .$birth_date_3;

        	$random_gender	= $faker->numberBetween(0,1);
        	$gender         = ($random_gender == 1)? 'male' : 'female';

        	if($random_gender == 0){
        		$preggy = $faker->numberBetween(0,1);
        	}
        	else{
        		$preggy	= 0;
        	}
        	$abroad = $faker->numberBetween(0,1);
			if( $abroad === 1){
				$contract = $faker->date();
				$based = $faker->numberBetween(1,2);
				$work_country = $faker->country();
			}else{
				$contract = '';
				$based = 0;
				$work_country = "";
			}


        	Patient::create(array(
        		'ui_code'                   => $ui_code,
                'code_name'                 => $faker->firstName($gender),
                'phil_health_number'        => $faker->creditCardNumber,
                'birth_date'                => $birth_date_3,
                'gender'                    => $random_gender,
                'civil_status'              => $faker->numberBetween(1,4),
                'dependents'                => $faker->numberBetween(0,20),
                'nationality'               => $faker->randomElement(array ('Filipino','American','Korean')),
                'permanent_address'         => $faker->streetAddress,
                'current_city'              => $faker->city,
                'current_province'          => $faker->state,
                'birth_place_city'          => $faker->city,
                'birth_place_province'      => $faker->state,
                'contact_number'            => $faker->phoneNumber,
                'email'                     => $faker->email,
                'highest_educational_attainment'  => $faker->numberBetween(0,5),
                'is_working'                => $faker->numberBetween(0,1),
                'is_living_with_partner'    => $faker->numberBetween(0,1),
                'is_presently_pregnant'     => $preggy,
                'current_occupation'        => $faker->word,
                'previous_occupation'       => $faker->word,
                'is_work_abroad_in_past_5years' => $abroad,
                'last_contract'             => $contract,
                'is_based'                  => $based,
                'last_work_country'         => $work_country


        	));
        }
    }
}

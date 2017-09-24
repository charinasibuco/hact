<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/*$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
*/



$factory->define(App\Patient::class, function (Faker\Generator $faker) {
	$gender = rand(0,1);
	if($gender === 0){
		$preggy = rand(0,1);
	}else{
		$preggy = 0;
	}
	$abroad = rand(0,1);
	if( $abroad === 1){
		$contract = $faker->date();
		$based = rand(1,2);
		$work_country = $faker->country();
	}else{
		$contract = '';
		$based = 0;
		$work_country = "";
	}
    return [
        'ui_code' => $faker->bothify('??-??-0#-0#-0#-19##'),
		'phil_health_number' => $faker->creditCardNumber,
		'code_name'          => $faker->firstName,

		'birth_date' => $faker->date('Y-m-d', '-20 years'),
		// 0 = Female, 1 = Male
		'gender' =>$gender,
		// 1 = Single, 2 = Married, 3 = Separated, 4 = Widowed
		'civil_status' => rand(1,4),
		'dependents' => rand(0,12),
		'nationality' =>  $faker->randomElement(array ('Filipino','American','Korean')),
		// Address
		'permanent_address' => $faker->streetAddress(),
		'current_city' => $faker->city(),
		'current_province' => $faker->state(),
		// Birth Place
		'birth_place_city' => $faker->city(),
		'birth_place_province' => $faker->state(),
		// Contact Number
		'contact_number' => $faker->phoneNumber(),
		'email' => $faker->safeEmail(),
		// 0 = None, 1 = Elementary, 2 = High School, 3 = Vocational, 4 = Post-Graduate, 5 = College
		'highest_educational_attainment' => rand(0,5),
		'is_working' => rand(0,1),

		'is_living_with_partner' =>rand(0,1),
		'is_presently_pregnant' => $preggy,
		// Employment
		'current_occupation' => $faker->word(),
		'previous_occupation' => $faker->word(),
		// Did you work overseas/abroad in the past 5 years?
		'is_work_abroad_in_past_5years' => $abroad,
		// If yes, when did you return from your last contract?
		'last_contract' => $contract,
		// Where were you based? 1 = On a Ship, 2 = Land
		'is_based' => $based,
		// What country did you last work in?
		'last_work_country' => $work_country
    ];
});




<?php

use Illuminate\Database\Seeder;
use App\VCT;
use App\User;

class VctMale18AboveTableSeeder extends Seeder
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

        $patients = DB::table('patient')
                            ->where(DB::raw('DATEDIFF(CURDATE(), birth_date)/365'), '>', 18)
                            ->where('gender',1)->get();
        foreach ($patients as $patient) {
          $patientid                                       = $patient->id;
          $date                                         	 = \Carbon\Carbon::createFromTimeStamp($faker->dateTimeBetween( '-5 years', 'now' )->getTimestamp());
          $experience_1 	                                 = $faker->numberBetween(0,1);
          $experience_2 	                                 = $faker->numberBetween(0,1);
          $experience_3 	                                 = $faker->numberBetween(0,1);
          $experience_4 	                                 = $faker->numberBetween(0,1);
          $experience_5                                  	 = $faker->numberBetween(0,1);
          $experience_6                                  	 = $faker->numberBetween(0,1);
          $experience_7                                  	 = $faker->numberBetween(0,1);
          $experience_8 	                                 = $faker->numberBetween(0,1);
          $result                                          = $faker->numberBetween(0,3);
          ($experience_1 = 1)? $experience_1_year          = $date  : $experience_1_year ='';
          ($experience_2 = 1)? $experience_2_year          = $date  : $experience_2_year ='';
          ($experience_3 = 1)? $experience_3_year          = $date  : $experience_3_year ='';
          ($experience_4 = 1)? $experience_4_year          = $date  : $experience_4_year ='';
          ($experience_5 = 1)? $experience_5_year          = $date  : $experience_5_year ='';
          ($experience_6 = 1)? $experience_6_year          = $date  : $experience_6_year ='';
          ($experience_7 = 1)? $experience_7_year          = $date  : $experience_7_year ='';
          ($experience_8 = 1)? $experience_8_year          = $date  : $experience_8_year ='';
          $number_of_female                                = $faker->numberBetween(0,10);
          $number_of_male                                  = $faker->numberBetween(0,10);
          ($number_of_female = 0)? $last_year_sex_female   = '' : $last_year_sex_female = $date;
          ($number_of_male = 0)? $last_year_sex_male       = '' : $last_year_sex_male = $date;


           VCT::create(array(
              'patient_id'		  	  		          => $patientid,
              'vct_date'				  	  	  	      => $date,
              'result'						        	      => $result,
              'reason_1'						  	          => $faker->numberBetween(0,1),
              'reason_2'		  				          	=> $faker->numberBetween(0,1),
              'reason_3'			  				          => $faker->numberBetween(0,1),
              'reason_4'			  	  		        	=> $faker->numberBetween(0,1),
              'reason_5'				  	  	        	=> $faker->numberBetween(0,1),
              'reason_6'					  	          	=> $faker->numberBetween(0,1),
              'reason_7'				  		  	        => $faker->numberBetween(0,1),
              'reason_8'				    		        	=> $faker->numberBetween(0,1),
              'reason_9'			  		  	        	=> $faker->numberBetween(0,1),
              'reason_10'			  	  		        	=> $faker->numberBetween(0,1),
              'reason_11'			  	  		        	=> $faker->numberBetween(0,1),
              'reason_12'				  	  	        	=> $faker->numberBetween(0,1),
              'reason_13'			  		  	        	=> $faker->numberBetween(0,1),
              'reason_14'				  	  	        	=> $faker->numberBetween(0,1),
              'reason_other'			          			=> $faker->word,
              'experience_1'		        		  		=> $experience_1,
              'experience_2'	          					=> $experience_2,
              'experience_3'		          				=> $experience_3,
              'experience_4'        			  			=> $experience_4,
              'experience_5'		        		  		=> $experience_5,
              'experience_6'					    	      => $experience_6,
              'experience_7'						          => $experience_7,
              'experience_8'						          => $experience_8,
              'is_your_mother_infected_with_hiv'	=> $faker->numberBetween(0,1),
              'experience_1_if_yes_what_year'  		=> $experience_1_year,
              'experience_2_if_yes_what_year'	  	=> $experience_2_year,
              'experience_3_if_yes_what_year'		  => $experience_3_year,
              'experience_4_if_yes_what_year'	  	=> $experience_4_year,
              'experience_5_if_yes_what_year'		  => $experience_5_year,
              'experience_6_if_yes_what_year'	  	=> $experience_6_year,
              'experience_7_if_yes_what_year'	  	=> $experience_7_year,
              'experience_8_if_yes_what_year'	  	=> $experience_8_year,
              'number_of_female'					        => $number_of_female,
              'last_year_sex_female'				      => $last_year_sex_female,
              'number_of_male'					          => $number_of_male,
              'last_year_sex_male'				        => $last_year_sex_male,
              'been_tested_for_hiv_before'		    => $faker->numberBetween(0,1),
              'been_tested_for_hiv_before_month'	=> $faker->numberBetween(0,1),
              'been_tested_for_hiv_before_year'	  => $faker->numberBetween(0,1),
              'which_testing_facility'			      => $faker->randomElement(array('Alaminos Social Hygiene Clinic','Angeles Social Hygiene Clinic',
                                                                                 'Antipolo Social Hygiene Clinic','Bacolod Social Hygiene Clinic',
                                                                                 'Cabanatuan City Health Office', 'Davao Regional Hospital')),
              'which_testing_facility_city'		    => $faker->city,
              'test_result'						            => $faker->word,
              'user_id'                           => 1
            ));

            if($result == 1)
            {
              $patientUpdate = App\Patient::find($patientid);
              $patientUpdate->saccl_code = str_random(4)."-".str_random(3)."-".str_random(4);
              $patientUpdate->save();
            }
        }

    }
}

<?php
ini_set('display_errors', 1);
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

#Route::get('/', ['as' =>'login_page', 'uses' => 'Auth\AuthController@getLogin']);
#Route::post('/', ['as' =>'login_auth', 'uses' => 'Auth\AuthController@postLogin']);
// Route::get('/', ['as' =>'login_page', 'uses' => 'AuthCustomController@index']);
// Route::post('/', ['as' =>'login_auth', 'uses' => 'AuthCustomController@auth']);

// Web Page

Route::get('/', ['as' =>'login_page', 'uses' => 'WebController@index']);
//Reset Password
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}','Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
//Reset Password
Route::get('/about-hiv', ['as' =>'about_hiv', 'uses' => 'WebController@about']);
Route::get('/hiv-test', ['as' =>'hiv_test', 'uses' => 'WebController@hiv_test']);
Route::post('/submit-form', ['as' =>'submit_form', 'uses' => 'WebController@submit_form']);

Route::post('/authentication', ['as' =>'login_auth', 'uses' => 'AuthCustomController@auth']);
//	Portal
Route::group(['prefix' => 'portal', 'middleware' => ['auth', 'sessiontimeout']], function(){

	// Logout
	Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthCustomController@logout']);
	// Home
	Route::get('/', ['as' =>'home', 'uses' => 'HomeController@index']);

	// Patient
	Route::group(['prefix' => 'patient'], function(){
		Route::get('/', ['as' =>'patient', 'uses' => 'PatientController@index']);
		Route::get('/create', ['as' =>'patient_create', 'uses' => 'PatientController@create']);
		Route::post('/store', ['as' =>'patient_store', 'uses' => 'PatientController@store']);
		Route::get('/edit/{id}', ['as' =>'patient_edit', 'uses' => 'PatientController@edit']);
		Route::post('/update/{id}', ['as' =>'patient_update', 'uses' => 'PatientController@update']);
		Route::get('/profile/{id}', ['as' =>'patient_profile', 'uses' => 'PatientController@profile']);
		Route::get('/masterlist/{id}', ['as' =>'patient_masterlist', 'uses' => 'PatientController@masterlist']);
		Route::get('/print/{id}', ['as' =>'patient_masterlist_print', 'uses' => 'PatientController@printMasterList']);
		Route::get('/search', ['as' =>'patient_search', 'uses' => 'PatientController@search']);
		Route::get('/record', ['as' =>'patient_record', 'uses' => 'PatientController@record']);
		Route::get('/destroy/{id}', ['as' =>'patient_destroy', 'uses' => 'PatientController@destroy']);
		Route::post('/validation_ajax',['as' => 'validation_ajax', 'uses' => 'PatientController@validation_ajax']);

		//Checkup
		Route::group(['prefix' => 'checkup'], function(){
			//Route::get('/', ['as' =>'checkup', 'uses' => 'CheckupController@index']);
			Route::get('/records/{id}', ['as' =>'checkup_records', 'uses' => 'CheckupController@records']);
			Route::get('/show/{id}', ['as' =>'checkup_show', 'uses' => 'CheckupController@show']);
			Route::get('/create/{id?}', ['as' => 'checkup_create', 'uses' => 'CheckupController@create']);
			Route::get('/create/{id?}/{error?}', ['as' => 'checkup_create_error', 'uses' => 'CheckupController@create']);
			Route::post('/store', ['as' => 'checkup_store', 'uses' => 'CheckupController@store']);
			Route::get('/edit/{id}', ['as' => 'checkup_edit', 'uses' => 'CheckupController@edit']);
			Route::get('/edit/{id}/{error?}', ['as' => 'checkup_edit_error', 'uses' => 'CheckupController@edit']);
			Route::post('/update/{id}', ['as' => 'checkup_update', 'uses' => 'CheckupController@update']);
			Route::get('/ajax-store-session', 			['as' => 'checkup_store_session', 'uses' => 'CheckupController@store_session']);
			Route::get('/ajax-update-session', 			['as' => 'checkup_update_session', 'uses' => 'CheckupController@update_session']);
			Route::get('/ajax-edit-session', 			['as' => 'checkup_edit_session', 'uses' => 'CheckupController@getArvRegimen']);
			Route::get('/ajax-list-session', 			['as' => 'checkup_list_session', 'uses' => 'CheckupController@list_session']);
			Route::get('/ajax-oi-meds', 				['as' => 'checkup_oi_meds_session', 'uses' => 'CheckupController@oi_medicine']);
			Route::get('/ajax-other-meds', 				['as' => 'checkup_other_meds_session', 'uses' => 'CheckupController@other_medicine']);
			Route::get('/ajax-destroy-session/{key?}', 	['as' => 'checkup_destroy_session', 'uses' => 'CheckupController@destroy_session']);
			Route::get('/ajax-clear-session/{id}', 		['as' => 'checkup_clear_session', 'uses' => 'CheckupController@clear_session']);
			Route::post('/transfer', ['as' =>'patient_transfer', 'uses' => 'PatientTransferController@transfer']);
			Route::get('/immunization-guidelines', ['as' => 'immunization_guidelines', 'uses' => 'CheckupController@immunizationGuideLines']);
			Route::get('/history/{id}', ['as' => 'checkup_history', 'uses' => 'CheckupController@history']);
			Route::get('/history_small/{id}', ['as' => 'checkup_history_small', 'uses' => 'CheckupController@history_small']);
			Route::get('/destroy/{id}', ['as' => 'checkup_destroy', 'uses' => 'CheckupController@destroy']);
		});

		// VCT
		Route::group(['prefix' => 'vct'], function(){
			/*Route::get('/', ['as' =>'vct', 'uses' => 'VCTController@index']);*/
			Route::get('/records/{id}/{patient_id}', ['as' =>'vct_records', 'uses' => 'VCTController@records']);
			Route::get('/create/{id?}', ['as' =>'vct_create', 'uses' => 'VCTController@create']);
			Route::post('/store', ['as' =>'vct_store', 'uses' => 'VCTController@store']);
			Route::get('/edit/{id}', ['as' =>'vct_edit', 'uses' => 'VCTController@edit']);
			Route::post('/update/{id}', ['as' =>'vct_update', 'uses' => 'VCTController@update']);
			Route::post('/result', ['as' =>'vct_result', 'uses' => 'VCTController@result']);
			Route::get('/search', ['as' =>'vct_search', 'uses' => 'PatientController@search']);
			Route::get('/doctor/{id}', ['as' =>'vct_doctor', 'uses' => 'VCTController@doctor']);
			Route::post('/assign-doctor/{id}', ['as' =>'vct_assign_doctor', 'uses' => 'VCTController@assign_doctor']);
			Route::get('/enable-doctor/{id}/{patient_id}', ['as' =>'vct_enable_doctor', 'uses' => 'VCTController@enable_doctor']);
			Route::get('/disable-doctor/{id}/{patient_id}', ['as' =>'vct_disable_doctor', 'uses' => 'VCTController@disable_doctor']);
			Route::get('/destroy/{id}', ['as' =>'vct_destroy', 'uses' => 'VCTController@destroy']);
		});

		// Medical Abstract
		Route::group(['prefix' => 'medical_abstract'], function(){
			Route::get('/create/{id}', ['as' => 'medical_abstract_create', 'uses' => 'MedicalAbstractController@create']);
			Route::get('/edit/{id}',['as' => 'medical_abstract_edit', 'uses' => 'MedicalAbstractController@edit']);
			Route::post('/store', ['as' => 'medical_abstract_store', 'uses' => 'MedicalAbstractController@store']);
			Route::post('/update/{id}',['as' => 'medical_abstract_update', 'uses' => 'MedicalAbstractController@update']);
			Route::get('/destroy/{id}',['as' => 'medical_abstract_destroy', 'uses' => 'MedicalAbstractController@destroy']);
			Route::get('/print/{id}',['as' => 'medical_abstract_print', 'uses' => 'MedicalAbstractController@print_medical_abstract']);

		});

		// Laboratory
		Route::group(['prefix' => 'laboratory'], function(){

			/*Route::get('/', ['as' =>'laboratory', 'uses' => 'LaboratoryController@index']);*/

			Route::get('/create/{id?}/{order_number?}', ['as' => 'laboratory_create', 'uses' => 'LaboratoryController@create']);
			Route::post('/store', ['as' => 'laboratory_store', 'uses' => 'LaboratoryController@store']);

			Route::get('/edit/{id}', ['as' => 'laboratory_edit', 'uses' => 'LaboratoryController@edit']);
			Route::post('/update/{id}', ['as' => 'laboratory_update', 'uses' => 'LaboratoryController@update']);
			Route::get('/show/{id}', ['as' => 'laboratory_show', 'uses' => 'LaboratoryController@show']);
			Route::get('/destroy/{id}', ['as' => 'laboratory_destroy', 'uses' => 'LaboratoryController@destroy']);

			Route::get('/chart/{id}/{laboratory_test_id?}/{other?}', ['as' => 'laboratory_chart', 'uses' => 'LaboratoryController@chart']);
			Route::get('/generate_chart/{id}/{laboratory_test_id?}/{other?}', ['as' => 'laboratory_generate_chart', 'uses' => 'LaboratoryController@generate_chart']);

		});

		// Infections
		Route::group(['prefix' => 'infections'], function(){
			/*Route::get('/', ['as' =>'infections', 'uses' => 'InfectionsController@index']);*/
			Route::get('/create/{id}', ['as' =>'infections_create', 'uses' => 'InfectionsController@create']);
			Route::post('/store/{id}', ['as' =>'infections_store', 'uses' => 'InfectionsController@store']);
			Route::get('/edit/{id}/{order_number}', ['as' =>'infections_edit', 'uses' => 'InfectionsController@edit']);
			Route::post('/update/{id}/{order_number}', ['as' =>'infections_update', 'uses' => 'InfectionsController@update']);
			/*Route::post('/dropdown_edit', ['as' => 'infections_dropdown_edit', 'uses' => 'InfectionsController@dropdown_edit']);*/
			Route::get('/show/{id}', ['as' => 'infections_show', 'uses' => 'InfectionsController@show']);
		});

		// Mortality
		Route::group(['prefix' => 'mortality'], function(){
			Route::get('/', ['as' =>'mortality', 'uses' => 'MortalityController@index']);

			Route::get('/create/{id?}', ['as' => 'mortality_create', 'uses' => 'MortalityController@create']);
			Route::post('/store/{id?}', ['as' => 'mortality_store', 'uses' => 'MortalityController@store']);

			Route::get('/edit/{id}', ['as' => 'mortality_edit', 'uses' => 'MortalityController@edit']);
			Route::post('/update/{id}', ['as' => 'mortality_update', 'uses' => 'MortalityController@update']);
			Route::get('/destroy/{id}', ['as' => 'mortality_destroy', 'uses' => 'MortalityController@destroy']);
			Route::get('/show/{id}', ['as' => 'mortality_show', 'uses' => 'MortalityController@show']);
			Route::get('/search', ['as' =>'mortality_search', 'uses' => 'MortalityController@search']);
			Route::get('/search_edit', ['as' => 'mortality_search_edit', 'uses' => 'MortalityController@search_edit']);
		});

		// TB Information
		Route::group(['prefix' => 'tuberculosis'], function(){
			/*Route::get('/', ['as' =>'tuberculosis', 'uses' => 'TBInformationController@index']);*/

			Route::get('/create/{id}',['as' =>'tuberculosis_create','uses' => 'TBInformationController@create']);
			Route::post('/store', ['as' => 'tuberculosis_store', 'uses' => 'TBInformationController@store']);

			Route::get('/show/{id}',['as' =>'tuberculosis_show','uses' => 'TBInformationController@show']);

			Route::get('/edit/{id}',['as' =>'tuberculosis_edit','uses' => 'TBInformationController@edit']);
			Route::post('/update/{id}', ['as' =>'tuberculosis_update', 'uses' => 'TBInformationController@update']);
			Route::get('/destroy/{id}', ['as' =>'tuberculosis_destroy', 'uses' => 'TBInformationController@destroy']);
		});

		//OB-gyne
		Route::group(['prefix' => 'ob-gyne'], function(){
			Route::get('/', ['as' =>'ob_gyne', 'uses' => 'OBgyneController@index']);
			Route::get('/search', ['as' =>'ob_gyne_search', 'uses' => 'OBgyneController@search']);
			Route::get('/create',['as' =>'ob_gyne_create','uses' => 'OBgyneController@create']);
			Route::get('/create/{id}',['as' =>'ob_gyne_patient_create','uses' => 'OBgyneController@create']);
			Route::get('/{id}/history',['as' =>'ob_gyne_history','uses' => 'OBgyneController@history']);
			Route::get('/patients',['as' =>'ob_gyne_patients','uses' => 'OBgyneController@getPatients']);
			Route::get('/edit/{id}',['as' =>'ob_gyne_edit','uses' => 'OBgyneController@edit']);
			Route::post('/store', ['as' => 'ob_gyne_store', 'uses' => 'ObGyneController@store']);
			Route::post('/update/{id}', ['as' => 'ob_gyne_update', 'uses' => 'ObGyneController@update']);
			Route::get('/destroy/{id}', ['as' =>'ob_gyne_destroy', 'uses' => 'ObGyneController@destroy']);

		});
	});



	Route::group(['prefix' => 'lab_requests'], function(){
			Route::get('/{status?}', ['as' =>'lab_requests', 'uses' => 'LabRequestController@index']);

			Route::get('/complete/{id}/{source}',['as' =>'lab_requests_complete','uses' => 'LabRequestController@complete']);
			Route::get('/incomplete/{id}/{source}',['as' =>'lab_requests_incomplete','uses' => 'LabRequestController@incomplete']);
			Route::post('/remarks/{id}',['as' =>'lab_requests_remarks','uses' => 'LabRequestController@remarks']);
		});

	Route::group(['prefix' => 'referrals'], function(){
			Route::get('/', ['as' =>'referrals', 'uses' => 'ReferralsController@index']);

			Route::get('/complete/{id}/{referral}/{source}',['as' =>'referrals_complete','uses' => 'ReferralsController@complete']);
			Route::get('/incomplete/{id}/{referral}/{source}',['as' =>'referrals_incomplete','uses' => 'ReferralsController@incomplete']);
		});

	// Symptoms
		Route::group(['prefix' => 'symptoms'], function(){
			Route::get('/', ['as' =>'symptoms', 'uses' => 'SymptomsController@index']);

			Route::get('/create',['as' =>'symptoms_create','uses' => 'SymptomsController@create']);
			Route::post('/store', ['as' => 'symptoms_store', 'uses' => 'SymptomsController@store']);

			Route::get('/edit/{id}',['as' =>'symptoms_edit','uses' => 'SymptomsController@edit']);
			Route::post('/update/{id}', ['as' =>'symptoms_update', 'uses' => 'SymptomsController@update']);
		});

		

	// HIV Info
		Route::group(['prefix' => 'hiv_info'], function(){
			Route::get('/{type?}', ['as' =>'hiv_info', 'uses' => 'HIVInfoController@index']);
			Route::get('/create/{type?}',['as' =>'hiv_info_create','uses' => 'HIVInfoController@create']);
			Route::post('/store', ['as' => 'hiv_info_store', 'uses' => 'HIVInfoController@store']);
			Route::get('/edit/{id}',['as' =>'hiv_info_edit','uses' => 'HIVInfoController@edit']);
			Route::post('/update/{id}', ['as' =>'hiv_info_update', 'uses' => 'HIVInfoController@update']);
			Route::get('/display/{type}/{id}', ['as' =>'hiv_info_display', 'uses' => 'HIVInfoController@display']);
		});

	// ART
	Route::group(['prefix' => 'arv'], function(){

		Route::get('/', ['as' =>'arv', 'uses' => 'ARVController@index']);

		Route::get('/records/{id}', ['as' =>'arv_records', 'uses' => 'ARVController@records']);
		Route::get('/create/{id?}', ['as' => 'arv_create', 'uses' => 'ARVController@create']);
		Route::post('/store/{id}', ['as' => 'arv_store', 'uses' => 'ARVController@store']);

		Route::post('/store-session', ['as' => 'arv_store_session', 'uses' => 'ARVController@store_session']);
		Route::get('/destroy-session/{id}/{infection?}', ['as' => 'arv_destroy_session', 'uses' => 'ARVController@destroy_session']);
		Route::get('/clear-session/{id}', ['as' => 'arv_clear_session', 'uses' => 'ARVController@clear_session']);

		Route::get('/edit/{id}', ['as' => 'arv_edit', 'uses' => 'ARVController@edit']);
		Route::post('/update/{id}', ['as' => 'arv_update', 'uses' => 'ARVController@update']);
		Route::get('/destroy/{arv_id}/{id}', ['as' => 'arv_destroy', 'uses' => 'ARVController@destroy']);

		Route::group(['prefix' => 'prescription'], function(){
			Route::get('/', ['as' =>'prescription', 'uses' => 'PrescriptionController@index']);

			Route::get('/details/{arv_id}', ['as' =>'prescription_details', 'uses' => 'PrescriptionController@details']);
			Route::get('/history/{id}', ['as' =>'prescription_history', 'uses' => 'PrescriptionController@history']);

			Route::get('/create/{arv_id?}', ['as' => 'prescription_create', 'uses' => 'PrescriptionController@create']);
			Route::post('/store/{arv_id?}', ['as' => 'prescription_store', 'uses' => 'PrescriptionController@store']);

			Route::get('/search', ['as' =>'prescription_search_json', 'uses' => 'PrescriptionController@search']);
		});
	});

	// User
	Route::group(['prefix' => 'user', 'middleware' => 'auth'], function(){
		Route::get('/', ['as' =>'user', 'uses' => 'UserController@index']);

		Route::get('/create', ['as' =>'user_create', 'uses' => 'UserController@create']);
		Route::post('/store', ['as' =>'user_store', 'uses' => 'UserController@store']);

		Route::get('/edit/{id}', ['as' =>'user_edit', 'uses' => 'UserController@edit']);
		Route::post('/update/{id}', ['as' =>'user_update', 'uses' => 'UserController@update']);

		Route::get('/password/{id}', ['as' =>'user_password_reset', 'uses' => 'UserController@password_reset']);

		Route::get('/password-edit', ['as' =>'user_password_edit', 'uses' => 'UserController@password_edit']);
		Route::post('/password-update', ['as' =>'user_password_update', 'uses' => 'UserController@password_update']);
	});

	// Medicine
	Route::group(['prefix' => 'medicine'], function(){
		Route::get('/', ['as' =>'medicine', 'uses' => 'MedicineController@index']);
		Route::get('/add', ['as' =>'medicine_add', 'uses' => 'MedicineController@add']);
		Route::get('/restock', ['as' =>'medicine_restock', 'uses' => 'MedicineController@restock']);
		Route::get('/restock/{id}', ['as' =>'medicine_edit', 'uses' => 'MedicineController@edit']);
		Route::get('/edit/{id}', ['as' =>'medicine_show', 'uses' => 'MedicineController@show']);
        Route::post('/store', ['as' => 'medicine_store', 'uses' => 'MedicineController@store']);
        Route::post('/update/{id}', ['as' => 'medicine_update', 'uses' => 'MedicineController@update']);
        Route::post('/saverestock', ['as' => 'medicine_saverestock', 'uses' => 'MedicineController@restockSave']);
        Route::get('/search', ['as' => 'medicine_search', 'uses' => 'MedicineController@search']);
        Route::get('/history/{id}', ['as' => 'medicine_history', 'uses' => 'MedicineController@history']);
	});

	// Reports
	Route::group(['prefix' => 'reports'], function(){

		Route::group(['prefix' => 'patient'], function(){
			Route::get('/form', ['as' =>'reports_patient', 'uses' => 'ReportsPatientController@patient']);
			Route::get('/print', ['as' =>'reports_patient_print', 'uses' => 'ReportsPatientController@patient_print']);
			Route::get('/print-master-list', ['as' =>'reports_patient_print_master_list', 'uses' => 'ReportsPatientController@master_list']);
			Route::get('/registry_results', ['as' =>'registry_results', 'uses' => 'ReportsPatientController@registry_results']);
			Route::get('/print-monthly-report', ['as' =>'monthly_report', 'uses' => 'ReportsPatientController@monthly_report']);
			Route::get('/monthly-report-print', ['as' =>'monthly_report_print', 'uses' => 'ReportsPatientController@monthly_report_print']);
			Route::get('/lost-to-follow-up', ['as' =>'patient_lost_to_follow_up', 'uses' => 'ReportsPatientController@patient_lost_to_follow_up']);
			Route::get('/lost-to-follow-up-print', ['as' =>'patient_lost_to_follow_up_print', 'uses' => 'ReportsPatientController@patient_lost_to_follow_up_print']);
			Route::get('/transferred-out', ['as' =>'patient_transferred_out', 'uses' => 'ReportsPatientController@patient_transferred_out']);
			Route::get('/transferred-out-print', ['as' =>'patient_transferred_out_print', 'uses' => 'ReportsPatientController@patient_transferred_out_print']);
			Route::get('/registry', ['as' => 'reports_patient_registry', 'uses' => 'ReportsPatientController@registry_index']);
			Route::get('/registry-excel', ['as' => 'reports_patient_registry_excel', 'uses' => 'ReportsPatientController@registry_excel']);

		});

		Route::group(['prefix' => 'vct'], function(){
			Route::get('/current-year', ['as' => 'reports_vct_current_year', 'uses' => 'ReportsVCTController@current_year']);
			Route::get('/current-record', ['as' => 'reports_vct_current_record', 'uses' => 'ReportsVCTController@current_record']);

			Route::get('/results', ['as' => 'reports_get_vct_results', 'uses' => 'ReportsVCTController@getResults']);
			Route::get('/results-print', ['as' => 'reports_print_vct_results', 'uses' => 'ReportsVCTController@getResultsView']);

			Route::get('/scheduled', ['as' => 'reports_get_vct_scheduled', 'uses' => 'ReportsVCTController@getScheduled']);
			Route::get('/scheduled-print', ['as' => 'reports_print_vct_scheduled', 'uses' => 'ReportsVCTController@printScheduled']);

		});

		Route::group(['prefix' => 'tuberculosis'], function(){
			Route::get('/results', ['as' => 'reports_get_tb_results', 'uses' => 'ReportsTuberculosisController@getResults']);
			Route::get('/results-print', ['as' => 'reports_print_tb_results', 'uses' => 'ReportsTuberculosisController@getResultsView']);
		});

		Route::group(['prefix' => 'obgyne'], function(){
			Route::get('/chart', ['as' => 'reports_get_obgyne_chart', 'uses' => 'ReportsObgyneController@chart']);
			Route::get('/results', ['as' => 'reports_get_obgyne_results', 'uses' => 'ReportsObgyneController@getResults']);
			Route::get('/results-print', ['as' => 'reports_print_obgyne_results', 'uses' => 'ReportsObgyneController@getResultsView']);
			Route::get('/childbirth/', ['as' => 'reports_get_obgyne_childbirth', 'uses' => 'ReportsObgyneController@getChildbirth']);
			Route::get('/childbirth/generate', ['as' => 'reports_get_obgyne_childbirth_generate', 'uses' => 'ReportsObgyneController@getChildbirthView']);
			Route::get('/childbirth/excel', ['as' => 'reports_get_obgyne_childbirth_excel', 'uses' => 'ReportsObgyneController@getChildbirthExcel']);
		});

		Route::group(['prefix' => 'client'], function(){
			Route::get('/results', ['as' => 'client_results', 'uses' => 'ReportsClientController@results']);
			Route::get('/results_print', ['as' => 'client_results_print', 'uses' => 'ReportsClientController@results_print']);
		});



        Route::group(['prefix' => 'infections'], function(){
            Route::get('/results', ['as' =>'infections_results', 'uses' => 'ReportsInfectionsController@results']);
            Route::get('/results_print', ['as' =>'infections_results_print', 'uses' => 'ReportsInfectionsController@results_print']);
            Route::get('/cs_results', ['as' =>'infections_cs_results', 'uses' => 'ReportsInfectionsClinicalStageController@results']);
            Route::get('/cs_results_print', ['as' =>'infections_cs_results_print', 'uses' => 'ReportsInfectionsClinicalStageController@results_print']);
            Route::get('/hiv_care_results', ['as' =>'hiv_care_results', 'uses' => 'ReportsHIVCareController@results']);
            Route::get('/hiv_care_results_print', ['as' =>'hiv_care_results_print', 'uses' => 'ReportsHIVCareController@results_print']);
        });

        Route::group(['prefix' => 'laboratory'], function(){
            Route::get('/results', ['as' =>'laboratory_results', 'uses' => 'ReportsLaboratoryController@results']);
            Route::get('/results_print', ['as' =>'laboratory_results_print', 'uses' => 'ReportsLaboratoryController@results_print']);
        });

        Route::group(['prefix' => 'art'], function(){
            Route::get('/results', ['as' =>'art_registry_results', 'uses' => 'ReportsARTController@results']);
            Route::get('/results_print', ['as' =>'art_registry_results_print', 'uses' => 'ReportsARTController@results_print']);
        });

		Route::group(['prefix' => 'mortality'], function(){
			Route::get('/', ['as' =>'mortality_summary', 'uses' => 'ReportsController@mortality_summary']);
			Route::get('/show', ['as' =>'mortality_reports_show', 'uses' => 'UserController@show']);
			Route::get('/results', ['as' =>'mortality_results', 'uses' => 'ReportsMortalityController@results']);
            Route::get('/results_print', ['as' =>'mortality_results_print', 'uses' => 'ReportsMortalityController@results_print']);
            Route::get('/death', ['as' =>'mortality_death', 'uses' => 'ReportsMortalityController@death']);
            Route::get('/death_print', ['as' =>'mortality_death_print', 'uses' => 'ReportsMortalityController@death_print']);
			// changed alias due to conflict
		});

		Route::group(['prefix' => 'arv'], function(){
			Route::get('/patient-prescribe', ['as' =>'patient_prescribe', 'uses' => 'ReportsController@patient_prescribe']);
            Route::get('/patient-prescribe-print', ['as' =>'patient_prescribe_print', 'uses' => 'ReportsController@patient_prescribe_print']);
            Route::get('/patient-alive', ['as' =>'patient_alive', 'uses' => 'ReportsController@patient_alive']);
            Route::get('/patient-alive-print', ['as' =>'patient_alive_print', 'uses' => 'ReportsController@patient_alive_print']);
            Route::get('/patient-stop-taking-arv', ['as' =>'patient_stop_taking_arv', 'uses' => 'ReportsController@patient_stop_taking_arv']);
            Route::get('/patient-stop-taking-arv-print', ['as' =>'patient_stop_taking_arv_print', 'uses' => 'ReportsController@patient_stop_taking_arv_print']);
		});

        Route::group(['prefix' => 'medicine'], function(){
            Route::get('/generate', ['as' =>'medicine_stock_report_generate', 'uses' => 'ReportsController@getLowStockMedicines']);
			Route::get('/excel', ['as' =>'medicine_stock_report_excel', 'uses' => 'ReportsController@excelLowStockMedicines']);

            Route::get('/medicine-expired', ['as' =>'medicine_expired', 'uses' => 'ReportsController@indexExpiredMedicine']);
			Route::get('/medicine-expired/generate', ['as' =>'medicine_expired_results', 'uses' => 'ReportsController@getExpiredMedicine']);

	        Route::group(['prefix' => 'history'], function(){
            	Route::get('/restocking/generate', ['as' =>'medicine_history_generate', 'uses' => 'ReportsController@getMedicineRestockingHistory']);
				Route::get('/restocking/excel', ['as' =>'medicine_history_excel', 'uses' => 'ReportsController@excelMedicineRestockingHistory']);

            	Route::get('/dispense/', ['as' =>'medicine_history_dispense', 'uses' => 'ReportsController@medicine_history_dispense']);
            	Route::get('/dispense/print', ['as' =>'medicine_history_dispense_print', 'uses' => 'ReportsController@medicine_history_dispense_print']);
	        });

			Route::get('/patient-dispense', ['as' =>'patient_dispense', 'uses' => 'ReportsController@patient_dispense']);
            Route::get('/patient-dispense-print', ['as' =>'patient_dispense_print', 'uses' => 'ReportsController@patient_dispense_print']);

			Route::get('/infection-dispense', ['as' =>'infection_dispense', 'uses' => 'ReportsController@infection_dispense']);
            Route::get('/infection-dispense-print', ['as' =>'infection_dispense_print', 'uses' => 'ReportsController@infection_dispense_print']);
        });
	});

	// Chart
	Route::group(['prefix' => 'chart'], function(){
		Route::get('/years/{chart_type?}', ['as' =>'chart_years', 'uses' => 'ChartController@years']);
		Route::get('/current-year-record/{year?}', ['as' =>'chart_current_year_record', 'uses' => 'ChartController@current_year_record']);
		Route::get('/hiv-record-summary/{year?}', ['as' =>'chart_hiv_record_summary', 'uses' => 'ChartController@hiv_record_summary']);
		Route::get('/hiv-stages', ['as' =>'chart_hiv_stages', 'uses' => 'ChartController@hiv_stages']);
		Route::get('/mortality', ['as' =>'chart_mortality', 'uses' => 'ChartController@chart_mortality']);
		Route::get('/laboratory', ['as' =>'chart_laboratory', 'uses' => 'ChartController@chart_laboratory']);
		Route::get('/present_infections/{year?}', ['as' =>'chart_present_infections', 'uses' => 'ChartController@chart_present_infections']);
		Route::get('/clinical_stages/{year?}', ['as' =>'chart_clinical_stages', 'uses' => 'ChartController@chart_clinical_stages']);

		Route::get('/tuberculosis/{year?}', ['as' =>'chart_tuberculosis', 'uses' => 'ChartController@chart_tuberculosis']);
		Route::get('/mortality-result/{year?}', ['as' =>'chart_mortality_result', 'uses' => 'ChartController@chart_mortality_result']);
	});

	Route::group(['prefix' => 'activity-log'], function(){
		Route::get('/', ['as' =>'activity_log', 'uses' => 'ActivityLogController@index']);
	});
});

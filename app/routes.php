<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Register route bindings
 * FYI - Should be done in the service providers
 */

// Start a new visit
Route::bind('patient', function($value, $route){
	return $patient 	= Patient::find($value);
});

// Destroy a billing item
Route::bind('billing', function($value, $route){
	return 	Billing::where('id', $value)->first();
});

// Destroy a client
Route::bind('bima', function($value, $route){
	return Bima::find($value);
});

/**
 * Homepage
 */
Route::get('/', array(
	'as'	=> 'home',
	'uses'	=> 'HomeController@home'
));

/**
 * Authenticated Users
 */
Route::group(array('before' => 'auth'), function(){

	/**
	 * CSRF protection group
	 */
	Route::group(array('before' => 'csrf'), function(){

		/**
		 * Create new staff account (POST)
		 */
		Route::post('/account/create', array(
			'as'	=> 'account-create-post',
			'uses'	=> 'AccountController@postCreate'
		));

		/**
		 * Create a new role (POST)
		 */
		Route::post('/roles', array(
			'as'	=> 'roles-post',
			'uses'	=> 'RolesController@store'
		));

		/**
		 * Update a role (PUT)
		 */
		Route::put('/roles/{id}', array(
			'as'	=> 'roles-update',
			'uses'	=> 'RolesController@update'
		));

		/**
		 * Create a new patient (POST)
		 */
		Route::post('/patients', array(
			'as'	=> 'patients-post',
			'uses'	=> 'PatientsController@store'
		));

		/**
		 * Update a patient (PUT)
		 */
		Route::put('/patients/{id}', array(
			'as'	=> 'patients-update-put',
			'uses'	=> 'PatientsController@update'
		));

		/**
		 * Create a new test (POST)
		 */
		Route::post('/tests/store/{id}', array(
			'as'	=> 'test-create-post',
			'uses'	=> 'TestsController@store'
		));

		/**
		 * Update a test (PUT)
		 */
		Route::put('/tests/{id}', array(
			'as'	=> 'test-update-put',
			'uses'	=> 'TestsController@update'
		));

		/**
		 * Create a medication (POST)
		 */
		Route::post('/medications/{id}', array(
			'as'	=> 'medication-create-post',
			'uses'	=> 'MedicationsController@store'
		));

		/**
		 * Update a medication (PUT)
		 */
		Route::put('/medication/{id}', array(
			'as'	=> 'medication-update-put',
			'uses'	=> 'MedicationsController@update'
		));

		/**
		 * Create a new billing item (POST)
		 */
		Route::post('/billings', array(
			'as'	=> 'create-item-post',
			'uses'	=> 'BillingsController@store'
		));

		/**
		 * Update a billing item (PUT)
		 */
		Route::put('/billings/{id}', array(
			'as'	=> 'item-update-post',
			'uses'	=> 'BillingsController@update'
		));

		/**
		 * Create a new billing transaction (POST)
		 */
		Route::post('/transactions/{id}', array(
			'as'	=> 'create-transaction-post',
			'uses'	=> 'TransactionsController@store'
		));

		/**
		 * Create a new client (POST) 
		 */
		Route::post('/bimas', array(
			'as'	=> 'create-client-post',
			'uses'	=> 'BimasController@store'
		));

		/**
		 * Client Update (PUT)
		 */
		Route::put('/bimas/{id}', array(
			'as'	=> 'client-update-put',
			'uses'	=> 'BimasController@update'
		));

		/**
		 * Update a user (PUT)
		 */
		Route::put('/user/{id}', array(
			'as'	=> 'user-update-put',
			'uses'	=> 'AccountController@update'
		));

	});

	/**
	 * Selectize.js search Api route (GET)
	 */
	Route::get('/api/search', 'Api\ApiSearchController@index');

	/**
	 * Selectize.js transaction search Api route (GET)
	 */
	Route::get('/search', 'TransactionsController@index');

	/**
	 * Account Log Out (GET)
	 */
	Route::get('/account/log-out', array(
		'as'	=> 'account-log-out',
		'uses'	=> 'AccountController@getLogOut'
	));

	/**
	 * Create new staff account (GET)
	 */
	Route::get('/account/create', array(
		'as'	=> 'account-create',
		'uses'	=> 'AccountController@getCreate'
	));

	/**
	 * Health dashboard (GET)
	 */
	Route::get('/health', array(
		'as'	=> 'health',
		'uses'	=> 'HealthController@home'
	));

	/**
	 * List Users (GET)
	 */
	Route::get('/account/users', array(
		'as'	=> 'users',
		'uses'	=> 'AccountController@getUsers'
	));

	/**
	 * Update a user (GET)
	 */
	Route::get('/account/{id}/edit', array(
		'as'	=> 'user-update-get',
		'uses'	=> 'AccountController@edit'
	));

	/**
	 * List Roles (GET)
	 */
	Route::get('/roles', array(
		'as'	=> 'roles',
		'uses'	=> 'RolesController@index'
	));

	/**
	 * Create a new role (GET)
	 */
	Route::get('/roles/create', array(
		'as'	=> 'create-roles',
		'uses'	=> 'RolesController@create'
	));

	/**
	 * Update a role (GET)
	 */
	Route::get('/roles/{id}/edit', array(
		'as'	=> 'edit-roles',
		'uses'	=> 'RolesController@edit'
	));

	/**
	 * Destroy a role (GET) 
	 */
	Route::get('/roles/{id}', array(
		'as'	=> 'roles-destroy',
		'uses'	=> 'RolesController@destroy'
	));

	/**
	 * Display a list of patients (GET)
	 */
	Route::get('/patients', array(
		'as'	=> 'patients-get',
		'uses'	=> 'PatientsController@index'
	));

	/**
	 * Create a new patient (GET)
	 */
	Route::get('/patients/create', array(
		'as'	=> 'patients-create-get',
		'uses'	=> 'PatientsController@create'
	));

	/**
	 * Show a patient's chart (GET)
	 */
	Route::get('/patient/{id}', array(
		'as'	=> 'patient-chart-get',
		'uses'	=> 'PatientsController@show'
	));

	/**
	 * Update a patient (GET)
	 */
	Route::get('/patients/{id}/edit', array(
		'as'	=> 'patient-edit-get',
		'uses'	=> 'PatientsController@edit'
	));

	/**
	 * Destroy a patient (GET)
	 */
	Route::get('/patients/{id}', array(
		'as'	=> 'patient-destroy',
		'uses'	=> 'PatientsController@destroy'
	));

	/**
	 * Display a list of visits (GET)
	 */
	Route::get('/registrations', array(
		'as'	=> 'registrations-get',
		'uses'	=> 'RegistrationsController@index'
	));

	/**
	 * Start a visit (GET)
	 */
	Route::get('/registrations/{patient}', array(
		'as'	=> 'registrations-visit-get',
		'uses'	=> 'RegistrationsController@store'
	));

	/**
	 * Create a new test (GET)
	 */
	Route::get('/tests/create/{id}', array(
		'as'	=> 'test-create-get',
		'uses'	=> 'TestsController@create'
	));

	/**
	 * Update a test (GET)
	 */
	Route::get('/tests/{id}/edit', array(
		'as'	=> 'test-update-get',
		'uses'	=> 'TestsController@edit'
	));

	/**
	 * Destroy a test (GET)
	 */
	Route::get('/tests/{id}', array(
		'as'	=> 'test-destroy',
		'uses'	=> 'TestsController@destroy'
	));

	/**
	 * Create a new medication (GET)
	 */
	Route::get('/medications/create/{id}', array(
		'as'	=> 'medication-create-get',
		'uses'	=> 'MedicationsController@create'
	));

	/**
	 * Update Medication (GET)
	 */
	Route::get('/medications/{id}/edit', array(
		'as'	=> 'medication-update-get',
		'uses'	=> 'MedicationsController@edit'
	));

	/**
	 * Destroy medication (GET)
	 */
	Route::get('/medications/{id}', array(
		'as' 	=> 'medication-destroy',
		'uses'	=> 'MedicationsController@destroy'
	));

	/**
	 * Create a new billing item (GET)
	 */
	Route::get('/billings/create', array(
		'as'	=> 'create-item-get',
		'uses'	=> 'BillingsController@create'
	));

	/**
	 * Display a list of billing items (GET)
	 */
	Route::get('/billings', array(
		'as'	=> 'billings-item-get',
		'uses'	=> 'BillingsController@index'
	));

	/**
	 * Update billing item (GET)
	 */
	Route::get('/billings/{id}/edit', array(
		'as'	=> 'item-update-get',
		'uses'	=> 'BillingsController@edit'
	));

	/**
	 * Destroy a billing item (GET)
	 */
	Route::get('/billings/{billing}', array(
		'as'	=> 'item-destroy',
		'uses'	=> 'BillingsController@destroy'
	));

	/**
	 * Create a new transaction (GET)
	 */
	Route::get('/transactions/create', array(
		'as'	=> 'transaction-create-get',
		'uses'	=> 'TransactionsController@create'
	));

	/**
	 * Display a transaction (GET)
	 */
	Route::get('/transactions/{id}', array(
		'as'	=> 'create-transaction-get',
		'uses'	=> 'TransactionsController@show'
	));

	/**
	 * Display a list of bimas/clients (GET)
	 */
	Route::get('/bimas', array(
		'as'	=> 'bimas-get',
		'uses'	=> 'BimasController@index'
	));

	/**
	 * Display a single client (GET)
	 */
	Route::get('/bima/{id}', array(
		'as'	=> 'client-get',
		'uses' 	=> 'BimasController@show'
	));

	/**
	 * Create a new bimas/client (GET)
	 */
	Route::get('/bimas/create', array(
		'as'	=> 'create-client-get',
		'uses'	=> 'BimasController@create'
	));

	/**
	 * Update a client (GET)
	 */
	Route::get('/bimas/{id}/edit', array(
		'as'	=> 'client-update-get',
		'uses'	=> 'BimasController@edit'
	));

	/**
	 * Client destroy (GET)
	 */
	Route::get('/bimas/{bima}', array(
		'as'	=> 'client-destroy',
		'uses'	=> 'BimasController@destroy'
	));

});

/**
 * Unauthenticated Users
 */
Route::group(array('before' => 'guest'), function(){

	/**
	 * CSRF protection group
	 */
	Route::group(array('before' => 'csrf'), function(){

		/**
		 * Account log in (POST)
		 */
		Route::post('/account/log-in', array(
			'as'	=> 'account-log-in-post',
			'uses'	=> 'AccountController@postLogin'
		));

		/**
		 * Register a new member (POST)
		 */	
		Route::post('/account/register', array(
			'as'	=> 'account-register-post',
			'uses'	=> 'AccountController@postRegister'
		));

	});

	/**
	 * Account log in (GET)
	 */
	Route::get('/account/log-in', array(
		'as'	=> 'account-log-in',
		'uses'	=> 'AccountController@getLogin'
	));

	/**
	 * Register a new member (GET)
	 */
	Route::get('/account/register', array(
		'as'	=> 'account-register',
		'uses'	=>	'AccountController@getRegister'
	));

});

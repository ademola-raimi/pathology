<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    'uses' => 'HomeController@index',
    'as'   => 'index',
]);

Route::get('signup', [
	'uses' => 'Auth\AuthController@getSignupForm',
	'as'   => 'getSignup',
]);

Route::post('signup', [
	'uses' => 'Auth\AuthController@create',
	'as'   => 'postSignup',
]);

Route::get('login', [
	'uses' => 'Auth\AuthCOntroller@getLoginForm',
	'as' => 'getLogin',
]);

Route::post('login', [
	'uses' => 'Auth\AuthController@postLogin',
	'as'   => 'postLogin',
]);

Route::get('patient/login', [
	'uses' => 'Auth\AuthController@getPatientLoginForm',
	'as'   => 'getPatientLogin'
]);

Route::post('patient/report', [
	'uses' => 'PatientController@postPatientLoginForm',
	'as'   => 'postPatientLogin',
]);

Route::get('patient/report/{id}', [
	'uses' => 'PatientController@getSingleReport',
	'as'   => 'singleReport',
]);

Route::get('patient/report/{id}/download', [
	'uses' => 'PatientController@exportToPDF',
	'as'   => 'exportToPDF',
]);

Route::get('patient/report/{id}/mail', [
	'uses' => 'PatientController@sendAsMail',
	'as'   => 'sendAsMail',
]);

Route::get('logout', [
	'uses' => 'Auth\AuthController@logOut',
	'as'   => 'logout',
]);

Route::get('patient/autocomplete', [
	'uses' => 'PatientController@autocomplete',
	'as'   => 'autocomplete',
]);

Route::group(['middleware' => 'operator.user'], function () {

	Route::get('report', [
		'uses' => 'OperatorUserController@getReportForm',
		'as'   => 'getReportForm'
	]);

	Route::post('report', [
		'uses' => 'OperatorUserController@postReport',
		'as'   => 'postReport'
	]);

	Route::get('patient', [
		'uses' => 'OperatorUserController@getPatientForm',
		'as'   => 'getPatient'
	]);

	Route::post('patient', [
		'uses' => 'OperatorUserController@postPatient',
		'as'   => 'postPatient'
	]);

	Route::get('patient/{id}/edit', [
		'uses' => 'OperatorUserController@editPatientForm',
		'as'   => 'editPatient'
	]);

	Route::post('patient/{id}/update', [
		'uses' => 'OperatorUserController@updatePatient',
		'as'   => 'updatePatient'
	]);

	Route::get('patient/{id}/delete', [
		'uses' => 'OperatorUserController@deletePatient',
		'as'   => 'deletePatient'
	]);

	Route::get('report/{id}/edit', [
		'uses' => 'OperatorUserController@editReportForm',
		'as'   => 'editReport'
	]);

	Route::post('report/{id}/update', [
		'uses' => 'OperatorUserController@updateReport',
		'as'   => 'updateReport'
	]);

	Route::get('report/{id}/delete', [
		'uses' => 'OperatorUserController@deleteReport',
		'as'   => 'deleteReport'
	]);

});

Route::group(['middleware' => 'admin.user'], function () {

	Route::get('admin', [
		'uses' => 'AdminController@adminPage',
		'as'   => 'getAdminPage',
	]);

	Route::get('view/patients', [
		'uses' => 'AdminController@getPatients',
		'as' => 'getPatients',
	]);

	Route::get('view/reports', [
		'uses' => 'AdminController@getReports',
		'as' => 'getReports',
	]);

	Route::get('patient/{id}/sms', [
		'uses' => 'LabController@getSmsDetails',
		'as'   => 'getPatientDetails'
	]);
});

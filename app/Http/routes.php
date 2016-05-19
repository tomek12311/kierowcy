<?php

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

Route::get('/', 'WelcomeController@index');



//Route::post('home', 'HomeController@json');


Route::get('company_management', ['middleware' => ['auth','RedirectIfNotCompanyAdministrator'], 'as' => 'company_management', function () {
	return view('company_management/home');
}]);


Route::get('home', [
		'as' => 'home', 'uses' => 'HomeController@map'
]);
Route::post('home', 'HomeController@test');

Route::post('androidlogin', 'HomeController@android');

Route::get('map', 'HomeController@map');
Route::get('sendmail', 'HomeController@sendmail');

Route::resource('companies', 'companyController');
Route::resource('users', 'userController');
Route::resource('destinations', 'destinationController');
Route::get('destinations_sort', 'destinationController@sort');
Route::get('destinations_punkty', 'destinationController@getPunkty');

Route::post('android/add_coordinate', 'coordinateContoller@store');
Route::post('android/destinations_punkty_android', 'destinationController@getPunktyAndroid');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

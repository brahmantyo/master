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
/*Route::get('/', function() {
    $pdf = PDF::make();
    $pdf->addPage('<html><head></head><body><b>Hello World</b></body></html>');
    $pdf->send();
});*/

Route::get('home', 'HomeController@index');

Route::resource('user', 'UserController');

Route::get('mutasi', 'LaporanController@mutasi');
Route::get('penagihan', 'LaporanController@penagihan');
Route::get('pendapatan', 'LaporanController@pendapatan');
Route::get('resipengiriman', 'LaporanController@resipengiriman');
Route::get('sjt', 'LaporanController@sjt');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('print', 'HomeController@cetak');

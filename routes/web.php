<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/sports', 'SportController@index')->name('sports');
Route::get('/athletes', 'AthleteController@index')->name('athletes');
Route::get('/physicals', 'PhysicalController@index')->name('physicals');

Route::apiResources([
    'api/athletes'      => 'API\AthleteController',
    'api/physicals'     => 'API\PhysicalController',
    'api/sports/fall'   => 'API\FallSportController',
    'api/sports/spring' => 'API\SpringSportController',
    'api/sports/winter' => 'API\WinterSportController',
]);
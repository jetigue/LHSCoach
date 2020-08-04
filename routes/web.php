<?php

use App\Models\Sports\FallSport;
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

Route::get('/sports', 'SportController@index')->middleware('auth');
Route::get('/athletes', 'AthleteController@index')->middleware('auth');
Route::get('/athletes/{athlete:slug}', 'AthleteController@show')->middleware('auth');

Route::get('/physicals', 'PhysicalController@index')->middleware('auth');
Route::get('/physicals/{physical}', 'PhysicalController@show')->middleware('auth');

Route::get('fall/sports/{fall_sport:slug}', 'Sports\FallSportController@show')->middleware('auth');
Route::get('winter/sports/{winter_sport:slug}', 'Sports\WinterSportController@show')->middleware('auth');
Route::get('spring/sports/{spring_sport:slug}', 'Sports\SpringSportController@show')->middleware('auth');

Route::post('api/physicals/{physical}/physical-form','API\PhysicalFormController@store');

Route::get('api/athletes-physicals', 'API\AthletePhysicalController@index');

Route::apiResource('api/fall/sports', 'API\Sports\FallSportController')->parameters([
    'sports' => 'fall_sport'
]);
Route::apiResource('api/winter/sports', 'API\Sports\WinterSportController')->parameters([
    'sports' => 'winter_sport'
]);
Route::apiResource('api/spring/sports', 'API\Sports\SpringSportController')->parameters([
    'sports' => 'spring_sport'
]);

Route::apiResources([
    'api/athletes'      => 'API\AthleteController',
    'api/physicals'     => 'API\PhysicalController',
]);

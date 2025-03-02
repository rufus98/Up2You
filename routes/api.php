<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('authenticatekey')->group(function () {
Route::get('events/getEvent',  '\App\Http\Controllers\EventController@index');
Route::post('events/loadEvent',  '\App\Http\Controllers\EventController@show');
Route::post('events/createEvent',  '\App\Http\Controllers\EventController@create');
Route::post('events/updateEvent',  '\App\Http\Controllers\EventController@update');
Route::post('events/deleteEvent',  '\App\Http\Controllers\EventController@destroy');


Route::get('attende/getAttende',  '\App\Http\Controllers\AttendeController@index');
Route::post('attende/loadAttende',  '\App\Http\Controllers\AttendeController@show');
Route::post('attende/createAttende',  '\App\Http\Controllers\AttendeController@create');
Route::post('attende/updateAttende',  '\App\Http\Controllers\AttendeController@update');
Route::post('attende/deleteAttende',  '\App\Http\Controllers\AttendeController@destroy');
});
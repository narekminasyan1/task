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

/*Route::get('/', function () {
    return view('index');
});*/

Route::get('/',[\App\Http\Controllers\Country\CountryController::class,'getCountries']);
Route::get('get-state/{country}',[\App\Http\Controllers\Country\CountryController::class,'getState']);

Route::post('insert-result',[\App\Http\Controllers\Result\ResultController::class,'insertResult']);

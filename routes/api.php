<?php

use App\Http\Controllers\WeatherController;
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

Route::prefix('/v1')->group(function () {
    Route::get('/weather/current', [WeatherController::class, 'getCurrentWeather'])->name('weather.getCurrentWeather');
    Route::get('/weather/geocoding', [WeatherController::class, 'getGeocodingNameByCoordinates'])->name('weather.getGeocodingNameByCoordinates');
});

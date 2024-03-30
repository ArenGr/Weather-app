<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function getCurrentWeather(Request $request, WeatherService $weatherService)
    {
        return $weatherService->getCurrentWeather();
    }
}

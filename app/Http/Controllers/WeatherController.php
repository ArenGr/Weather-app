<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;

class WeatherController extends Controller
{
    public function __construct(private WeatherService $weatherService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->weatherService->getCurrentLocationWeather();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->weatherService->getWeatherByName($id);
    }
}

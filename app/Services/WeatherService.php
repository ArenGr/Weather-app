<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function getCurrentLocationWeather()
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather?q=Yerevan&appid=e55e616d0da8ba1edf9ab486b9b4ef6d');
        return $response->json();
    }

    public function getWeatherByName(string $id)
    {
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q=$id&appid=e55e616d0da8ba1edf9ab486b9b4ef6d");
        return $response->json();
    }
}

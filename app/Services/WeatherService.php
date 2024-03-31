<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    private string $openWeatherMapApiKey; // API key for OpenWeatherMap API

    private string $openWeatherMapApiUrl; // URL for OpenWeatherMap API

    private string $openWeatherMapReverseGeocodingUrl; // URL for OpenWeatherMap Reverse Geocoding API

    public function __construct(private Request $request)
    {
        // Initialize OpenWeatherMap API key and URLs
        $this->openWeatherMapApiKey = config('api.services.openweathermap.key');
        $this->openWeatherMapApiUrl = config('api.services.openweathermap.url');
        $this->openWeatherMapReverseGeocodingUrl = config('api.services.openweathermap.reverse_url');
    }

    /**
     * Build the URL for the OpenWeatherMap API request.
     *
     * @param  string  $baseUrl  The base URL for the API request
     * @return string  The complete URL with query parameters
     */
    private function buildUrl(string $baseUrl): string
    {
        // Get query parameters from the request
        $queryParams = $this->request->query();

        // Add the API key to the query parameters
        $queryParams['appid'] = $this->openWeatherMapApiKey;

        // Build the query string
        $queryString = http_build_query($queryParams);

        // Combine the URL and query string
        return sprintf('%s?%s', $baseUrl, $queryString);
    }

    /**
     * Make a request to the OpenWeatherMap API.
     *
     * @param  string  $url  The complete URL for the API request
     * @return \Illuminate\Http\JsonResponse  The JSON response from the API
     */
    private function makeRequest(string $url): mixed
    {
        try {
            // Build the complete URL with query parameters
            $fullUrl = $this->buildUrl($url);

            // Make the HTTP request
            $response = Http::get($fullUrl);

            // Process the response based on its status
            if ($response->successful()) {
                return response()->json([
                    'data' => $response->json(),
                ]);
            } elseif ($response->clientError()) {
                return response()->json([
                    'status' => $response->status(),
                    'message' => 'Bad Request',
                ]);
            } elseif ($response->serverError()) {
                return response()->json([
                    'status' => $response->status(),
                    'message' => 'Internal Server Error',
                ]);
            }
        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return response()->json([
                'error' => 'An error occurred while fetching data: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get the current weather data by city name from the OpenWeatherMap API.
     *
     * @return mixed  The JSON response from the API
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getCurrentWeatherByName(): mixed
    {
        return $this->makeRequest($this->openWeatherMapApiUrl);
    }

    /**
     * Get geocoding information based on geographical coordinates from the OpenWeatherMap API.
     *
     * @return mixed  The JSON response from the API
     */
    public function getGeocodingNameByCoordinates(): mixed
    {
        return $this->makeRequest($this->openWeatherMapReverseGeocodingUrl);
    }
}

<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    private string $owpUrl;
    private string $owpKey;

    public function __construct(private Request $request)
    {
        $this->owpUrl = config('api.services.openweathermap.url');
        $this->owpKey = config('api.services.openweathermap.key');
    }

    private function buildUrl()
    {
        $queries = $this->request->query();

        $queries['appid'] = $this->owpKey;

        $queries = http_build_query($queries);

        return sprintf('%s?%s', $this->owpUrl, $queries);
    }

    public function getCurrentWeather()
    {
        try {
            $url = $this->buildUrl();
            $response = Http::get($url);

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
            return response()->json([
                'error' => 'An error occurred while fetching data: ' . $e->getMessage(),
            ], 500);
        }
    }
}

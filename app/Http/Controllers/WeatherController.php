<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\JsonResponse;

class WeatherController extends Controller
{
    /**
     * Get the current weather data.
     *
     * @OA\Info(
     *      title="Weather API",
     *      version="1.0.0",
     *      description="API for retrieving weather data. For detailed information about how to use queries, see [OpenWeatherMap Documentation](https://openweathermap.org/current)",
     *      @OA\Contact(
     *          email="admin@example.com",
     *          name="API Support"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )    *
     *
     * @OA\Get(
     *     path="/api/v1/weather/current",
     *     summary="Get current weather data",
     *     tags={"Weather"},
     *     @OA\Parameter(
     *         name="appid",
     *         in="query",
     *         required=true,
     *         description="Your unique API key (you can always find it on your account page under the 'API key' tab)",
     *         example="your_api_key"
     *     ),
     *     @OA\Parameter(
     *         name="q",
     *         in="query",
     *         required=true,
     *         description="City name, state code, and country code divided by comma. Please refer to ISO 3166 for the state codes or country codes. You can specify the parameter not only in English. In this case, the API response should be returned in the same language as the language of the requested location name if the location is in our predefined list of more than 200,000 locations.",
     *         example="New York, US"
     *     ),
     *     @OA\Parameter(
     *         name="lat",
     *         in="query",
     *         required=false,
     *         description="Latitude. If you need the geocoder to automatic convert city names and zip-codes to geo coordinates and the other way around, please use our Geocoding API",
     *         example=40.7128
     *     ),
     *     @OA\Parameter(
     *         name="lon",
     *         in="query",
     *         required=false,
     *         description="Longitude. If you need the geocoder to automatic convert city names and zip-codes to geo coordinates and the other way around, please use our Geocoding API",
     *         example=-74.0060
     *     ),
     *     @OA\Parameter(
     *         name="mode",
     *         in="query",
     *         required=false,
     *         description="Response format. Possible values are xml and html. If you don't use the mode parameter format is JSON by default.",
     *         example="json"
     *     ),
     *     @OA\Parameter(
     *         name="units",
     *         in="query",
     *         required=false,
     *         description="Units of measurement. standard, metric and imperial units are available. If you do not use the units parameter, standard units will be applied by default.",
     *         example="metric"
     *     ),
     *     @OA\Parameter(
     *         name="lang",
     *         in="query",
     *         required=false,
     *         description="You can use this parameter to get the output in your language.",
     *         example="en"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 description="Weather data",
     *                 example={"temperature": 25, "condition": "sunny"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="status",
     *                 type="integer",
     *                 description="HTTP status code",
     *                 example=400
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 description="Error message",
     *                 example="Bad Request"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="status",
     *                 type="integer",
     *                 description="HTTP status code",
     *                 example=500
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 description="Error message",
     *                 example="Internal Server Error"
     *             )
     *         )
     *     )
     * )
     *
     * @param  \App\Services\WeatherService  $weatherService
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCurrentWeather(WeatherService $weatherService): JsonResponse
    {
        return $weatherService->getCurrentWeatherByName();
    }

    /**
     * Get geocoding information based on geographical coordinates.
     *
     * @OA\Get(
     *     path="/api/v1/weather/geocoding",
     *     summary="Get geocoding information based on coordinates",
     *     tags={"Geocoding"},
     *     @OA\Parameter(
     *         name="lat",
     *         in="query",
     *         required=true,
     *         description="Geographical latitude coordinate",
     *         example=40.7128,
     *         @OA\Schema(type="number", format="float")
     *     ),
     *     @OA\Parameter(
     *         name="lon",
     *         in="query",
     *         required=true,
     *         description="Geographical longitude coordinate",
     *         example=-74.0060,
     *         @OA\Schema(type="number", format="float")
     *     ),
     *     @OA\Parameter(
     *         name="appid",
     *         in="query",
     *         required=true,
     *         description="Your unique API key",
     *         example="your_api_key",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         required=false,
     *         description="Number of location names in the API response",
     *         example=5,
     *         @OA\Schema(type="integer", format="int32")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="city",
     *                 type="string",
     *                 description="City name",
     *                 example="New York"
     *             ),
     *             @OA\Property(
     *                 property="state",
     *                 type="string",
     *                 description="State code",
     *                 example="NY"
     *             ),
     *             @OA\Property(
     *                 property="country",
     *                 type="string",
     *                 description="Country code",
     *                 example="US"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="error",
     *                 type="string",
     *                 description="Error message",
     *                 example="An error occurred while fetching geocoding information"
     *             )
     *         )
     *     )
     * )
     *
     * @param WeatherService $weatherService
     * @return JsonResponse
     */
    public function getGeocodingNameByCoordinates(WeatherService $weatherService): JsonResponse
    {
        return $weatherService->getGeocodingNameByCoordinates();
    }
}

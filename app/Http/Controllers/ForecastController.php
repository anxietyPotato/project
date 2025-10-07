<?php





namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cities;
use App\Models\CitiesPrognoza;
use Illuminate\Support\Facades\Http;
use App\Services\WeatherServices;

class ForecastController extends Controller
{


    public function showForecast(CitiesPrognoza $cityPrognoza)
    {
        $weatherService = new WeatherServices();

        $astronomyResponse = $weatherService->getAstronomy($cityPrognoza->name);
        $forecastResponse = $weatherService->getForecast($cityPrognoza->name);

        if ($astronomyResponse->failed() || $forecastResponse->failed()) {
            return back()->with('error', 'Could not fetch data from WeatherAPI.');
        }

        $astronomy = $astronomyResponse->json()['astronomy']['astro'] ?? [];
        $forecast = $forecastResponse->json()['forecast']['forecastday'] ?? []; //- “If that nested value doesn't exist (i.e., it's null or missing), use an empty array instead.”


        return view('forecast', compact('cityPrognoza', 'astronomy', 'forecast'));
    }








}



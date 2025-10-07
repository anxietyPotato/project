<?php





namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cities;
use App\Models\CitiesPrognoza;
use Illuminate\Support\Facades\Http;

class ForecastController extends Controller
{




    public function showForecast(CitiesPrognoza $cityPrognoza)
    {
        // Fetch astronomy data (sunrise/sunset)
        $astronomyResponse = Http::get(env('WEATHER_API_URL') . 'v1/astronomy.json', [
            'key' => env('WEATHER_API_KEY'),
            'q' => $cityPrognoza->name,
            'lang' => 'en',
        ]);

        // Fetch forecast data
        $forecastResponse = Http::get(env('WEATHER_API_URL') . 'v1/forecast.json', [
            'key' => env('WEATHER_API_KEY'),
            'q' => $cityPrognoza->name,
            'days' => 5,
            'lang' => 'en',
        ]);

        if ($astronomyResponse->failed() || $forecastResponse->failed()) {
            return back()->with('error', 'Could not fetch data from WeatherAPI.');
        }

        $astronomy = $astronomyResponse->json()['astronomy']['astro'] ?? [];
        $forecast = $forecastResponse->json()['forecast']['forecastday'] ?? [];

        return view('forecast', compact('cityPrognoza', 'astronomy', 'forecast'));
    }



}



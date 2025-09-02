<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CitiesPrognoza;
use App\Http\forecastsAdminHelper\forecastsAdminHelper;

class AdminWeatherController extends Controller
{

    public function update(Request $request)
    {
        $request->validate([
            'temperature' => 'required|numeric',
            'city_id' => 'required|exists:cities,id',
        ]);

        $city = \App\Models\Cities::find($request->get('city_id'));

        if ($city) {
            $city->temperature = $request->get('temperature');
            $city->save();

            return redirect()->back()->with('success', 'Temperature updated successfully!');
        }

        return redirect()->back()->with('error', 'City not found.');
    }



    public function showWeatherIndex()
    {
        $cities = CitiesPrognoza::with('forecasts')->get();
        $weatherTypes = [
            'sunny',
            'rainy',
            'snowy',
            'rain',
            'snow',
        ];
        $weatherTypes = forecastsAdminHelper::getAvailableWeatherTypes();

        return view('Admin.weather_index', compact('cities', 'weatherTypes'));
    }
}

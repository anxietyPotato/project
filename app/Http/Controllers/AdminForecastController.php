<?php

namespace App\Http\Controllers;

use App\Models\CitiesPrognoza;
use Illuminate\Http\Request;
use App\Models\ForecastModel;

class AdminForecastController extends Controller
{
    public function showForm()
    {
        $cities = CitiesPrognoza::with(['forecasts' => function ($q) {
            $q->orderBy('forecast_date');
        }])->get();

        return view('admin.Forecasts', [
            'weatherTypes' => ForecastModel::WEATHERS,
            'cities' => $cities,
            'updatedForecastId' => session('updatedForecastId') // 👈 pass to Blade
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'city_id' => 'required|exists:cities_prognoza,id',
            'weather_type' => 'required|string',
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'Forecast_date' => 'required|date',
            'probability' => 'nullable|numeric|min:0|max:100',
        ]);

        $forecast = ForecastModel::create($validated);

        return redirect()
            ->route('forecast.form')
            ->with('success', 'Forecast successfully added.')
            ->with('updatedForecastId', $forecast->id); // 👈 store forecast ID
    }
}

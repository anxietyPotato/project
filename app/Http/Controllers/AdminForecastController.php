<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForecastModel;

class AdminForecastController extends Controller
{



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

        ForecastModel::create($validated);

        return redirect()->route('forecast.form')->with('success', 'Forecast successfully added.');

    }


}

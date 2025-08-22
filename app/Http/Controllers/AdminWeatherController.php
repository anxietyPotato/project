<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminWeatherController extends Controller
{

    public function update(Request $request) {
        $request->validate([
            'temperature' => 'required',
            'city_id' => 'required|exists:cities,id',
        ]);
        $weather = \App\Models\CitiesPrognoza::where(['city_id' => $request->get('city_id')])->first();
        dd($weather);
    }
}

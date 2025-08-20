<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\CitiesPrognoza;
use Illuminate\Http\Request;

class CitiesController extends Controller
{


    public function seeCities(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'temperature' => 'nullable|numeric|between:-999.99,999.99',
            'temperature_recorded_at' => 'nullable|date',
        ]);
    }



    public function welcome()
    {
        $cities = Cities::with('cityPrognoza.forecasts')->get(); // eager load relationships
        return view('welcome', compact('cities'));
    }



    public function showForm()
    {

        $cities = Cities::all();
        return view('addCities', compact('cities'));
    }


    public function addCities(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'temperature' => 'nullable|numeric|between:-999.99,999.99',


        ]);

        Cities::create($validated);

        return redirect()->route('addCities')->with('success', 'City added successfully!');
    }


    public function destroy($id)
    {
        $city = Cities::findOrFail($id);
        $city->delete();
        return redirect()->route('all.Cities')->with('success', 'City deleted.');
    }

    public function allCities()
    {
        $cities = Cities::all();
        return view('allCities', compact('cities'));
    }

    public function edit($id)
    {
        $city = Cities::findOrFail($id);
        return view('editCity', compact('city'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'temperature' => 'nullable|numeric|between:-999.99,999.99',
            'humidity' => 'nullable|numeric|between:0,100',
        ]);

        $city = Cities::findOrFail($id);
        $city->update($validated);

        return redirect()->route('all.Cities')->with('success', 'City updated successfully!');
    }


    // You can use $validated to create or update cities now!

// In Cities.php
    public function cityPrognoza()
    {
        return $this->hasOne(CitiesPrognoza::class);
    }

}



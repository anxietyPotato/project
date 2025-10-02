<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\CitiesPrognoza;
use App\Models\ForecastModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CitiesController extends Controller
{
    public function seeCities(Request $request)
    {
        $cityName = $request->get('city');

        Artisan::call('Weather:command', ['city' => $cityName]);

        $user = auth()->user();
        $cityfavorites = $user ? $user->cityfavorites->pluck('city_id')->toArray() : [];


        // If no name is provided, show all cities
        if (empty($cityName)) {
            $cities = CitiesPrognoza::with('oneForecast')->get();
            return view('search_results', compact('cities', 'cityName', 'cityfavorites'));
        }

        // Validate only if city name is provided
        $request->validate([
            'city' => 'string|max:255',
        ]);

        $cities = CitiesPrognoza::with('oneForecast', 'forecasts')
            ->where('name', 'LIKE', "%{$cityName}%")
            ->get();

        if ($cities->isEmpty()) {
            return redirect()->back()
                ->withInput()
                ->with('error', "City '{$cityName}' not found.");
        }

        return view('search_results', compact('cities', 'cityName', 'cityfavorites'));
    }

    public function welcome()
    {

        $user = auth()->user();
        // Get the user's favorite cities, include the related city model (CitiesPrognoza)
        // If not logged in, return an empty collection so Blade won't break
        $favorites = $user ? $user->cityfavorites()->with('city')->get() : collect();
        // Pass favorites to the welcome view
        return view('welcome', compact('favorites'));
    }


    public function showForm()
    {
        $cities = CitiesPrognoza::with('latestForecast')->get();
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
        $cities = Cities::with('cityPrognoza')->get();
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

    public function cityPrognoza()
    {
        return $this->hasOne(CitiesPrognoza::class);
    }

}

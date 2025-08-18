<?php





namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cities;
use App\Models\CitiesPrognoza;

class ForecastController extends Controller
{

    public function showForecast(CitiesPrognoza $cityPrognoza)
    {
        $cityPrognoza->load(['forecast']); // eager load forecast data
        return view('forecast', compact('cityPrognoza'));
    }






}



<?php

use App\Http\Controllers\CitiesController;
use App\Http\Controllers\ForecastController;
use App\Models\Cities;
use Illuminate\Support\Facades\Route;

/*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



Route::get('/', function () {
    $city = Cities::all();
    return view('welcome',compact('city')); //done
});

Route::prefix('admin')
    ->middleware('auth' )
    ->group(function () {
    Route::get('/add-Cities', [CitiesController::class, 'showForm'])->name('addCities'); //done
    Route::post('/add-Cities', [CitiesController::class, 'addCities'])->name('addCity'); //done
    Route::get('/all-cities', [CitiesController::class, 'allCities'])->name('all.Cities'); // done



        Route::get('/cities/{city}/edit', [CitiesController::class, 'edit'])->name('cities.edit');
        Route::put('/cities/{city}', [CitiesController::class, 'update'])->name('cities.update');
        Route::delete('/cities/{city}', [CitiesController::class, 'destroy'])->name('cities.destroy');
});
Route::get('/', [CitiesController::class, 'welcome']);

Route::get('/forecast/{cityPrognoza:name}', [ForecastController::class, 'showForecast'])->name('forecast.view');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/Weather', function () {
        return view('admin.weather_index');
    });

        Route::post('/Weather/update', [App\Http\Controllers\AdminWeatherController::class, 'update'])->name('weather.update');
});






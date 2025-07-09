<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\CitiesController;
use  App\Http\Middleware\IsAdmin ;
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
    $city = \App\Models\Cities::all();
    return view('welcome',compact('city')); //done
});

Route::prefix('admin')
    ->middleware('auth', App\Http\Middleware\IsAdmin::class)
    ->group(function () {
    Route::get('/add-Cities', [CitiesController::class, 'showForm'])->name('addCities'); //done
    Route::post('/add-Cities', [CitiesController::class, 'addCities'])->name('addCity'); //done
    Route::get('/all-cities', [CitiesController::class, 'allCities'])->name('all.Cities'); // done



        Route::get('/cities/{id}/edit', [CitiesController::class, 'edit'])->name('cities.edit');
        Route::put('/cities/{id}', [CitiesController::class, 'update'])->name('cities.update');
        Route::delete('/cities/{id}', [CitiesController::class, 'destroy'])->name('cities.destroy');
});


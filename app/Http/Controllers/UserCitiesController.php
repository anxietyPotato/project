<?php

namespace App\Http\Controllers;

use App\Models\CitiesPrognoza;
use Illuminate\Http\Request;

class UserCitiesController extends Controller
{
    public function favorite(Request $request, $city)
 {
  \App\Models\UserCitiesModel::create([
      'city_id' => $request->input('city_id'),
      'user_id' => $request->user()->id
  ]);
    $city = CitiesPrognoza::findOrFail($city);

    return redirect()->back()->with('message',"You just saved {$city->name} to your favorites." );
}}

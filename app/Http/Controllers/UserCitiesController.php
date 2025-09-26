<?php namespace App\Http\Controllers;

use App\Models\UserCitiesModel;
use App\Models\CitiesPrognoza;
use Illuminate\Http\Request;

class UserCitiesController extends Controller
{
public function favorite(Request $request, $cityId)
{
$userId = $request->user()->id;

// Check if already favorited
$existingFavorite = UserCitiesModel::where('user_id', $userId)
->where('city_id', $cityId)
->first();

if ($existingFavorite) {
// If exists, unfavorite this city
$existingFavorite->delete();
$message = "You removed this city from your favorites.";
} else {
// or add to favorites
UserCitiesModel::create([
'city_id' => $cityId,
'user_id' => $userId,
]);
$city = CitiesPrognoza::findOrFail($cityId);
$message = "You just saved {$city->name} to your favorites.";
}

return redirect()->back()->with('message', $message);
}
}

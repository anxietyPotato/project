<?php

namespace Database\Seeders;

use App\Models\CitiesPrognoza;
use App\Models\ForecastModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ForecastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = CitiesPrognoza::all();
        foreach ($cities as $city) {
           for ($i = 1; $i <= 5; $i++) {
               ForecastModel::create([
                   'city_id' => $city->id,
                   'temperature' => rand(15, 30),
                   'humidity' => rand(0,100),
                   'Forecast_date' => Carbon::now()->addDays(rand(1, 30)),
               ]);
           }
        }

    }
}

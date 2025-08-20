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
        $weatherTypes = ['sunny', 'snowy', 'rainy'];

        foreach ($cities as $city) {
            for ($i = 1; $i <= 5; $i++) {
                $weatherType = $weatherTypes[array_rand($weatherTypes)];
                $probability = in_array($weatherType, ['rainy', 'snowy']) ? rand(0, 100) : null;

                ForecastModel::create([
                    'city_id' => $city->id,
                    'temperature' => rand(15, 30),
                    'humidity' => rand(0, 100),
                    'Forecast_date' => Carbon::now()->addDays(rand(1, 30)),
                    'weather_type' => $weatherType,
                    'probability' => $probability,
                ]);
            }
        }
    }

}

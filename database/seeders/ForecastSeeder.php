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
            $lastTemperature = null;                  //  per city
            $start = \Carbon\Carbon::today();

            for ($i = 1; $i <= 30; $i++) {
                $weatherType = ForecastModel::WEATHERS[rand(0, 3)];
                $probability = in_array($weatherType, ['rainy','snowy','cloudy']) ? rand(1, 100) : null;

                // choose base range by weather
                [$minByType, $maxByType] = match ($weatherType) {
                    'sunny'  => [-50, 50],
                    'cloudy' => [-50, 15],
                    'rainy'  => [-10, 50],
                    'snowy'  => [-50, 1],
                    default  => [-50, 50],
                };

                if ($lastTemperature !== null) {
                    $min = $lastTemperature - 5;
                    $max = $lastTemperature + 5;

                    // Clamp to weather-specific bounds
                    $min = max($min, $minByType);
                    $max = min($max, $maxByType);

                    // If clamping breaks the range, force 5 within weather bounds
                    if ($min > $max) {
                        $temperature = $lastTemperature; // or skip this day
                    } else {
                        $temperature = rand($min, $max);
                    }
                } else {
                    $temperature = rand($minByType, $maxByType);
                }



                ForecastModel::create([
                    'city_id'       => $city->id,
                    'temperature'   => $temperature,
                    'humidity'      => rand(0, 100),
                    'Forecast_date' => $start->copy()->addDays($i), // sequential dates
                    'weather_type'  => $weatherType,
                    'probability'   => $probability,
                ]);

                $lastTemperature = $temperature;      //  now used next iteration
            }
        }
    }

}

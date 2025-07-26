<?php

namespace Database\Seeders;

use App\Models\Cities;
use App\Models\CitiesPrognoza;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = CitiesPrognoza::all();

        foreach($cities as $city)

        {
            $exists = Cities::where(['city_id' => $city->id])->first();

            if ($exists !== null) {
                $this->command->getOutput()->error("City already exists. Skipping...");
                continue;


            }
                Cities::create([
                    'city_id' => $city->id,
                    'temperature' => rand(15,30),
                    'humidity' => $city->humidity,

                ]);


        }
    }
}




<?php

namespace Database\Seeders;

use App\Models\Cities;
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
        $cities =[];

        foreach ($cities as $city) {
            $exists = Cities::where('name', $city['name'])->first();

            if ($exists) {
                $this->command->getOutput()->error("City '{$city['name']}' already exists. Skipping...");


            } else {
                Cities::create($city);
                $this->command->getOutput()->info("Added city successfully.");
            }
        }
    }
}




<?php

namespace Database\Seeders;

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
        $cities = [
            [
                'name' => 'Valjevo',
                'temperature' => 34,
                'humidity' => 24,
            ],
            [
                'name' => 'Beogra',
                'temperature' => 34,
                'humidity' => 28,
            ],
            [
                'name' => 'Mostar',
                'temperature' => 34,
                'humidity' => 28,
            ],
        ];

        foreach ($cities as $city) {
            $exists = \App\Models\Cities::where('name', $city['name'])->first();

            if ($exists) {
                $this->command->getOutput()->error("City '{$city['name']}' already exists. Skipping...");
            } else {
                \App\Models\Cities::create($city);
                $this->command->getOutput()->info("Added city successfully.");
            }
        }
    }
}





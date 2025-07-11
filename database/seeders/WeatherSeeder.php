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
            \App\Models\Cities::create($city);
        }
    }

}

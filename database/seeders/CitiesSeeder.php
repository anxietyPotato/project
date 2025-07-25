<?php

namespace Database\Seeders;

use App\Models\Cities;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $count = 0;

        for ($i = 0; $i < 100; $i++) {
            $cityName = $faker->city;

            // Skip if city already exists
            if (Cities::where('name', $cityName)->exists()) {
                $this->command->error("City '{$cityName}' already exists. Skipping...");
                continue;
            }

            Cities::create([
                'name' => $cityName,
                'temperature' => $faker->randomFloat(2, 15, 35),
                'humidity' => $faker->numberBetween(0, 100),
            ]);

            $this->command->info("Added city '{$cityName}' successfully.");
            $count++;
        }

        $this->command->info("✅ Total new cities added: $count");
    }
}

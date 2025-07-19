<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Cities;
use Faker\Factory as Faker;

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
                'temperature' => $faker->randomFloat(2, -10, 45),
                'humidity' => $faker->numberBetween(10, 90),
            ]);

            $this->command->info("Added city '{$cityName}' successfully.");
            $count++;
        }

        $this->command->info("✅ Total new cities added: $count");
    }
}

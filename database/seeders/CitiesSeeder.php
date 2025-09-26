<?php

namespace Database\Seeders;

use App\Models\Cities;
use App\Models\CitiesPrognoza;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $count = 0;

        $prognozaCities = CitiesPrognoza::all();

        if ($prognozaCities->isEmpty()) {
            $this->command->error("❌ No cities found in cities_prognoza. Seed that table first.");
            return;
        }

        foreach ($prognozaCities as $prognozaCity) {
            $cityName = $prognozaCity->name;

            if (Cities::where('city_id', $prognozaCity->id)->exists()) {
                $this->command->error("City '{$cityName}' already seeded. Skipping...");
                continue;
            }

            Cities::create([
                'name' => $cityName,
                'temperature' => $faker->randomFloat(2, 15, 35),
                'humidity' => $faker->numberBetween(0, 100),
                'city_id' => $prognozaCity->id,
            ]);

            $this->command->info("✅ Added city '{$cityName}' successfully.");
            $count++;
        }

        $this->command->info("🎯 Total new cities added: $count");
    }
}

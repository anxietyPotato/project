<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Cities;
use Faker\Factory as Faker;



class CityStatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


            public function run()
            {
                $faker = Faker::create();
                $cities = \App\Models\Cities::all();

                foreach ($cities as $city) {
                    DB::table('city_stats')->insert([
                        'city_id' => $city->id,
                        'temperature' => rand(15, 35),
                        'humidity' => rand(10, 90),
                        'recorded_at' => $faker->dateTimeBetween('now', '+30 days'),



                    ]);
                }
            }


}

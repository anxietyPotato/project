<?php

namespace Database\Seeders;

use App\Models\CitiesPrognoza;
use Illuminate\Database\Seeder;

class CitiesPrognozaseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker = \Faker\Factory::create();
        for($i = 0; $i < 100; $i++) CitiesPrognoza::create([
            'name' => $faker->city,
        ]);
    }


}

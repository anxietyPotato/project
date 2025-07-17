<?php

namespace Database\Seeders;

use App\Models\CityModel;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker= \Faker\Factory::create();

       for ($i=0; $i < 100; $i++ ){
           CityModel::create([
               'name' => $faker->city
           ]);


       }
    }
}

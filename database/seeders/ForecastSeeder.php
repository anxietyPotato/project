<?php

namespace Database\Seeders;

use App\Models\CityModel;
use App\Models\ForecastModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ForecastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $citys = CityModel::all();

       foreach($citys as $city)
       {
           for($i=0; $i<5; $i++)
           {
               ForecastModel::create([
                   'city_id' => $city->id,
                  'temperature' =>rand(15, 30),
                   'forecast_date' => Carbon::now()->addDays(rand(1, 30)),
               ]);
           }
       }
    }
}

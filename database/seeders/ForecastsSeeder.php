<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Cities;


class ForecastsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


                $cities = Cities::all();

                foreach ($cities as $city) {
                    for ($i = 0; $i < 5; $i++) {
                        DB::table('forecasts')->insert([
                            'city_id' => $city->id,
                            'temperature' => rand(15, 35),
                            'forecast_date' => now()->addDays($i)->toDateString(),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }

}

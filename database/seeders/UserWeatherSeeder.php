<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserWeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city=$this->command->getOutput()->ask('City name?');
             if ($city==null) {
                     $this->command->getOutput()->error('<error>City name not found</error>');
        }


        $temperature=$this->command->getOutput()->ask('insert Temperature?');
             if ($temperature==null) {
                     $this->command->getOutput()->error('<error>temperature not found</error>');
        }


        $humidity=$this->command->getOutput()->ask('insert Humidity?');

            if ($humidity==null) {
                    $this->command->getOutput()->error('<error>temperature not found</error>');
        }
                    \App\Models\Cities::create([
                        'name'=>$city,
                        'temperature'=>$temperature,
                        'humidity'=>$humidity
            ]);

            $this->command->getOutput()->info('successfully added new city $city with temperature $temperature and humidity $humidity');
    }
}

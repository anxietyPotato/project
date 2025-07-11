<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{

    public function run()
    {






        $amount = $this->command->ask('How many users would you like?',250);

        $password = $this->command->getOutput()->ask('Whic password?',11111111);

        $faker = \Faker\Factory::create();

             $this->command->getOutput()->progressStart(1000);

        for ($i = 0; $i < $amount ; $i++) {

             $faker->unique()->safeEmail;

            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('12345678')
            ]);
                $this->command->getOutput()->progressAdvance(1);
        }

                $this->command->getOutput()->progressFinish();
    }

}

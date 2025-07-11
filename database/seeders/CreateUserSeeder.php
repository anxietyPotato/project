<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param
     * @return void
     */
    public function run()
    {

        $user = $this->command->getOutput()->ask('insert Username name?');
        if ($user === null) {
            $this->command->getOutput()->error('<error> Username not inserted</error>');
        }


        $email = $this->command->getOutput()->ask('insert email?');
        if ($email === null) {
            $this->command->getOutput()->error('<error>email not inserted</error>');
        }


        $password = $this->command->getOutput()->ask('insert Password?');

        if ($password === null) {
            $this->command->getOutput()->error('<error>Password not inserted</error>');
        }


        $this->command->getOutput()->info("successfully added new  user '$user' with email '$email' and Password '$password'");


        {
            $exists = \App\Models\User::where('email', $email)->first();

            if ($exists) {
                $this->command->getOutput()->error(" ERROR: User '$email' already exists. Skipping...");
            } else {
                \App\Models\User::create([
                    'name' => $user,
                    'email' => $email,
                    'password' => Hash::make($password),
                ]);
                $this->command->getOutput()->info(" Successfully added new user '$user' with email '$email'.");
            }

        }
    }
}



<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
        $name =$this->command->ask('insert your Usernname?');

        if($name === null) {
            $this->command->getOutput()->error('Username not inserted');
        }

        $email = $this->command->getOutput()->ask('Enter your email');

        if($email === null){
            $this->command->getOutput()->error('Email is required');
        }
        $password =$this->command->ask('insert your password?');

        if($password === null) {
            $this->command->getOutput()->error('password not inserted');
        }





        DB::connection('mysql')->table('users')->insert([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $this->command->getOutput()->success('User created successfully');


    }
}



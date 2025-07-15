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
        $name = $this->command->ask('Insert your Username?');
        if (empty($name)) {
            $this->command->error('Username not inserted');
            return;
        }

        $email = $this->command->ask('Enter your email');
        if (empty($email)) {
            $this->command->error('Email is required');
            return;
        }

        $user = User::where(['email' => $email])->first();

        if ($user instanceof User) {
            $this->command->error('A user with this email already exists.');
            return;
        }

        $password = $this->command->ask('Insert your password?');
        if (empty($password)) {
            $this->command->error('Password not inserted');
            return;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->command->info('✅ User created successfully');
    } }



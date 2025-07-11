<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => 'Alice Rossi',
                'email' => 'alice@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Marco Bianchi',
                'email' => 'marco@example.com',
                'password' => Hash::make('secret456'),
                'role' => 'user',
            ],
            [
                'name' => 'Luca Verdi',
                'email' => 'luca@example.com',
                'password' => Hash::make('welcome789'),
                'role' => 'user',
            ],
        ];

        foreach ($users as $user) {
            $exists = \App\Models\User::where('email', $user['email'])->first();

            if ($exists) {
                $this->command->getOutput()->error("User '{$user['email']}' already exists. Skipping...");
            } else {
                \App\Models\User::create($user);
                $this->command->getOutput()->info("User '{$user['email']}' created.");
            }
        }
    }

}

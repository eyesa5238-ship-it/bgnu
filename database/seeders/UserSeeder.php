<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Admin is created here by developer; sign up only allows Teacher and Student.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'profile_image' => '',
                'bio' => '',
                'type' => User::ROLE_ADMIN,
            ]
        );

        // Optional: seed some teachers and students
        User::factory(5)->create(['type' => User::ROLE_TEACHER]);
        User::factory(10)->create(['type' => User::ROLE_STUDENT]);
    }
}

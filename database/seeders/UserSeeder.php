<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::insert([
            [
                'email' => 'admin@gmail.com',
                'username' => 'Admin',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ],
            [
                'email' => 'hod@gmail.com',
                'username' => 'Hod',
                'password' => Hash::make('12345678'),
                'role' => 'hod',
            ],
            [
                'email' => 'student@lifeun.edu.kh',
                'username' => 'Student',
                'password' => Hash::make('12345678'),
                'role' => 'student',
            ],
            [
                'email' => 'guest@gmail.com',
                'username' => 'Guest',
                'password' => Hash::make('12345678'),
                'role' => 'guest',
            ],
        ]);
    }
}

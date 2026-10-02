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
                'email' => 'admin@lifeun.edu.kh',
                'username' => 'Admin',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ],
            [
                'email' => 'hodInformationTechnology@lifeun.edu.kh',
                'username' => 'Sambath',
                'password' => Hash::make('12345678'),
                'role' => 'hod',
            ],
            [
                'email' => 'hodComputerScience@lifeun.edu.kh',
                'username' => 'Sitha',
                'password' => Hash::make('12345678'),
                'role' => 'hod',
            ],
            [
                'email' => 'hodChineseLanguage@lifeun.edu.kh',
                'username' => 'Piseth',
                'password' => Hash::make('12345678'),
                'role' => 'hod',
            ],
            [
                'email' => 'hodEnglishLiterature@lifeun.edu.kh',
                'username' => 'Andy',
                'password' => Hash::make('12345678'),
                'role' => 'hod',
            ],
            [
                'email' => 'hodCivilEngineering@lifeun.edu.kh',
                'username' => 'Mac',
                'password' => Hash::make('12345678'),
                'role' => 'hod',
            ],
            [
                'email' => 'studentInformationTechnology@lifeun.edu.kh',
                'username' => 'Sophea',
                'password' => Hash::make('12345678'),
                'role' => 'student',
            ],
            [
                'email' => 'studentComputerScience@lifeun.edu.kh',
                'username' => 'Rattana',
                'password' => Hash::make('12345678'),
                'role' => 'student',
            ],
            [
                'email' => 'studentChineseLanguage@lifeun.edu.kh',
                'username' => 'Sreyneang',
                'password' => Hash::make('12345678'),
                'role' => 'student',
            ],
            [
                'email' => 'studentEnglishLiterature@lifeun.edu.kh',
                'username' => 'Sopheak',
                'password' => Hash::make('12345678'),
                'role' => 'student',
            ],
            [
                'email' => 'studentCivilEngineering@lifeun.edu.kh',
                'username' => 'Sovan',
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

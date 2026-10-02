<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'user_id' => 7,
            'full_name' => 'Sok Sophea',
            'upload_permission' => true,
            'department_id' => 1,
            'started_year' => 2019,
        ]);
        Student::create([
            'user_id' => 8,
            'full_name' => 'Ry Rattana',
            'upload_permission' => false,
            'department_id' => 2,
            'started_year' => 2022,
        ]);
        Student::create([
            'user_id' => 9,
            'full_name' => 'Som Sreyneang',
            'upload_permission' => false,
            'department_id' => 3,
            'started_year' => 2023,
        ]);
        Student::create([
            'user_id' => 10,
            'full_name' => 'Chum Sopheak',
            'upload_permission' => true,
            'department_id' => 4,
            'started_year' => 2023,
        ]);
        Student::create([
            'user_id' => 11,
            'full_name' => 'Kim Sovan',
            'upload_permission' => true,
            'department_id' => 5,
            'started_year' => 2023,
        ]);
    }
}
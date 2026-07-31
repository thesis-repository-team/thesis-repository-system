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
            'user_id' => 3,
            'full_name' => 'John Student',
            'upload_permission' => true,
            'department_id' => 1,
            'started_year' => 2022,
        ]);
    }
}

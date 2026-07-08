<?php

namespace Database\Seeders;

use App\Models\Hod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpParser\Builder\TraitUseAdaptation;
use SebastianBergmann\Type\FalseType;

class HodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Hod::create([
            'user_id' => 2,
            'full_name' => 'Dr. Smith',
            'department_id' => 1,
            'is_active' => True,
            'started_year' => 2026,
        ]);
    }
}

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
            'full_name' => 'Soeung Sambath',
            'department_id' => 1,
            'is_active' => True,
            'started_year' => 2009,
        ]);
        Hod::create([
            'user_id' => 3,
            'full_name' => 'Pho Sitha',
            'department_id' => 2,
            'is_active' => True,
            'started_year' => 2018,
        ]);
        Hod::create([
            'user_id' => 4,
            'full_name' => 'San Piseth',
            'department_id' => 3,
            'is_active' => false,
            'started_year' => 2018,
        ]);
        Hod::create([
            'user_id' => 5,
            'full_name' => 'Andy Jung',
            'department_id' => 4,
            'is_active' => True,
            'started_year' => 2019,
        ]);
        Hod::create([
            'user_id' => 6,
            'full_name' => 'Chrin Mac',
            'department_id' => 5,
            'is_active' => false,
            'started_year' => 2009,
        ]);

    }
}
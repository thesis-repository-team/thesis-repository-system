<?php

namespace Database\Seeders;

use App\Models\Keyword;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Keyword::insert([
            ['keyword_name' => 'Artificial Intelligence'],
            ['keyword_name' => 'Machine Learning'],
            ['keyword_name' => 'Web Development'],
            ['keyword_name' => 'Data Science'],
            ['keyword_name' => 'Cyber Security'],
        ]);
    }
}

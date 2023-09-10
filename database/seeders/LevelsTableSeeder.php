<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($level = 1; $level <= 100; $level++) {
            DB::table('levels')->insert([
                'level' => $level,
                'required_experience' => 100 * pow($level, 2)
            ]);
        }
    }
}

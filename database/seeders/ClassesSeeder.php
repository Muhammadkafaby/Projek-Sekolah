<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classes;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classes::create([
            'name' => '10 A',
            'teacher_id' => 2,
            'year' => '2023/2024',
        ]);

        Classes::create([
            'name' => '11 B',
            'teacher_id' => 1,
            'year' => '2023/2024',
        ]);
    }
}

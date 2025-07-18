<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendance;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attendance::create([
            'student_id' => 1,
            'class_id' => 1,
            'date' => '2024-07-18',
            'status' => 'Hadir',
        ]);

        Attendance::create([
            'student_id' => 2,
            'class_id' => 2,
            'date' => '2024-07-18',
            'status' => 'Sakit',
        ]);
    }
}

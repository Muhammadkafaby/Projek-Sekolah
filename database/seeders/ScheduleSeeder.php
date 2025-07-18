<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::create([
            'class_id' => 1,
            'teacher_id' => 2,
            'subject' => 'Matematika',
            'day' => 'Senin',
            'start_time' => '07:00',
            'end_time' => '09:00',
        ]);

        Schedule::create([
            'class_id' => 2,
            'teacher_id' => 1,
            'subject' => 'Bahasa Indonesia',
            'day' => 'Selasa',
            'start_time' => '09:00',
            'end_time' => '11:00',
        ]);
    }
}

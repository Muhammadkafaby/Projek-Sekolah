<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            UserSeeder::class,
            TeacherSeeder::class,
            ClassesSeeder::class,
            StudentSeeder::class,
            AttendanceSeeder::class,
            ScheduleSeeder::class,
            AnnouncementSeeder::class,
            DocumentSeeder::class,
            PaymentTypeSeeder::class,
            BillingSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::create([
            'nip' => '1234567890',
            'name' => 'Budi Santoso',
            'position' => 'Kepala Sekolah',
            'subject' => 'Manajerial',
            'phone' => '081234567891',
        ]);

        Teacher::create([
            'nip' => '0987654321',
            'name' => 'Siti Aminah',
            'position' => 'Guru',
            'subject' => 'Matematika',
            'phone' => '081234567892',
        ]);
    }
}

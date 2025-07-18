<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Announcement;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Announcement::create([
            'title' => 'Pengumuman Libur Sekolah',
            'content' => 'Diberitahukan kepada seluruh siswa bahwa sekolah akan libur pada tanggal 20-25 Juli 2024.',
        ]);

        Announcement::create([
            'title' => 'Pengumuman Lomba 17 Agustus',
            'content' => 'Dalam rangka memeriahkan HUT RI ke-79, sekolah akan mengadakan berbagai macam lomba.',
        ]);
    }
}

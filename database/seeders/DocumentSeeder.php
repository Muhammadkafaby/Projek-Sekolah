<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Document;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Document::create([
            'title' => 'Kalender Akademik 2023/2024',
            'file' => 'kalender-akademik.pdf',
        ]);

        Document::create([
            'title' => 'Buku Panduan Siswa',
            'file' => 'buku-panduan-siswa.pdf',
        ]);
    }
}

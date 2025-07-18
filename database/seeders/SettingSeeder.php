<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create(['key' => 'school_name', 'value' => 'SMA Negeri 1 Contoh']);
        Setting::create(['key' => 'school_logo', 'value' => '']);
        Setting::create(['key' => 'school_address', 'value' => 'Jl. Contoh No. 123']);
        Setting::create(['key' => 'school_phone', 'value' => '081234567890']);
        Setting::create(['key' => 'school_email', 'value' => 'info@sman1contoh.sch.id']);
        Setting::create(['key' => 'school_vision', 'value' => 'Menjadi sekolah unggul yang menghasilkan lulusan berkarakter, cerdas, dan kompetitif.']);
        Setting::create(['key' => 'school_mission', 'value' => 'Meningkatkan kualitas pembelajaran, mengembangkan potensi siswa, dan menjalin kerjasama dengan berbagai pihak.']);
        Setting::create(['key' => 'theme_color', 'value' => '#4a90e2']);
    }
}

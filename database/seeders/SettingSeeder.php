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
        Setting::updateOrCreate(['key' => 'school_name'], ['value' => 'SMA Negeri 1 Contoh']);
        Setting::updateOrCreate(['key' => 'school_logo'], ['value' => '']);
        Setting::updateOrCreate(['key' => 'school_address'], ['value' => 'Jl. Contoh No. 123']);
        Setting::updateOrCreate(['key' => 'school_phone'], ['value' => '081234567890']);
        Setting::updateOrCreate(['key' => 'school_email'], ['value' => 'info@sman1contoh.sch.id']);
        Setting::updateOrCreate(['key' => 'school_vision'], ['value' => 'Menjadi sekolah unggul yang menghasilkan lulusan berkarakter, cerdas, dan kompetitif.']);
        Setting::updateOrCreate(['key' => 'school_mission'], ['value' => 'Meningkatkan kualitas pembelajaran, mengembangkan potensi siswa, dan menjalin kerjasama dengan berbagai pihak.']);
        Setting::updateOrCreate(['key' => 'theme_color'], ['value' => '#4a90e2']);
    }
}

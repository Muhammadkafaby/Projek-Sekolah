<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentType;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentType::create([
            'name' => 'SPP Bulanan',
            'description' => 'Sumbangan Penyelenggaraan Pendidikan',
        ]);

        PaymentType::create([
            'name' => 'Uang Gedung',
            'description' => 'Biaya pembangunan dan pemeliharaan gedung sekolah',
        ]);
    }
}

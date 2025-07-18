<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'nis' => '12345',
            'name' => 'Agus Setiawan',
            'gender' => 'Laki-laki',
            'date_of_birth' => '2007-08-17',
            'class_id' => 1,
            'address' => 'Jl. Merdeka No. 1',
            'parent_name' => 'Bambang Setiawan',
            'parent_phone' => '081234567893',
        ]);

        Student::create([
            'nis' => '54321',
            'name' => 'Citra Lestari',
            'gender' => 'Perempuan',
            'date_of_birth' => '2007-05-20',
            'class_id' => 2,
            'address' => 'Jl. Pahlawan No. 2',
            'parent_name' => 'Joko Susilo',
            'parent_phone' => '081234567894',
        ]);
    }
}

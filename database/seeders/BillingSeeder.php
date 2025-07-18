<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Billing;

class BillingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Billing::create([
            'student_id' => 1,
            'payment_type_id' => 1,
            'amount' => 150000,
            'due_date' => '2024-07-25',
            'status' => 'unpaid',
        ]);

        Billing::create([
            'student_id' => 2,
            'payment_type_id' => 1,
            'amount' => 150000,
            'due_date' => '2024-07-25',
            'status' => 'paid',
        ]);
    }
}

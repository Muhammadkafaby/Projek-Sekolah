<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::create([
            'billing_id' => 2,
            'amount' => 150000,
            'payment_date' => '2024-07-18',
            'payment_method' => 'Transfer Bank',
        ]);
    }
}

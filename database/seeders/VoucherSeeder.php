<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        Voucher::create([
            'insurance_id' => '019c1221-40bf-73ed-aba3-a455d36f1971',
            'discount_type' => 'percent',
            'discount_value' => 5,
            'max_discount' => 35000,
            'start_date' => '2026-01-01',
            'end_date' => '2026-01-31'
        ]);
        Voucher::create([
            'insurance_id' => '019c1221-40b9-7136-a79d-2e4e282b978e',
            'discount_type' => 'percent',
            'discount_value' => 1,
            'start_date' => '2026-01-01',
        ]);
        Voucher::create([
            'insurance_id' => '019c1221-40bb-72e6-95fc-fc3a2c9f78b5',
            'discount_type' => 'fixed',
            'discount_value' => 15000,
            'start_date' => '2026-01-01',
        ]);
    }
}

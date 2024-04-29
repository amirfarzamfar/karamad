<?php

namespace Database\Seeders;

use App\Models\PaymentPackage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentPackage::create([
            'title'=>'یک اگهی',
            'price'=>95000,
            'advertisement_limit'=>1,
            'advertisement_data_limit'=>60,
        ]);
    }
}

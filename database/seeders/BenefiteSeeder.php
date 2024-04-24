<?php

namespace Database\Seeders;

use App\Models\Karamad_benefit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BenefiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Karamad_benefit::create([
            'title'=>'جستجو سریع',
        ]);
        Karamad_benefit::create([
            'title'=>'کارفرما',
        ]);
        Karamad_benefit::create([
            'title'=>'رزومه ساز انلاین',
        ]);
        Karamad_benefit::create([
            'title'=>'پشتیبانی انلاین',
        ]);
    }
}

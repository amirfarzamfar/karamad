<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'support_phone_number'=>'021- 4539',
            'support_email'=>'info@karamad.com',
        ]);
        About::create([
            'support_phone_number'=>'021 - 42546',
            'support_email'=>'',
        ]);
    }
}

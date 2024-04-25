<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'طاها',
            'job_category_id'=> 1 ,
            'family'=>'بیدخوری',
            'phone_number'=>'09197210143',
            'phone_number_verified_at'=>now(),
            'national_id'=>1111111,
            'password'=>Hash::make(1111),
            'password_confirmation'=>Hash::make(1111),

        ]);

        User::create([
            'name'=>'کارفرما 1',
            'job_category_id'=> 1 ,
            'family'=>'کارفرما زاده',
            'phone_number'=>'09197210144',
            'phone_number_verified_at'=>now(),
            'national_id'=>1111111,
            'password'=>Hash::make(1111),
            'password_confirmation'=>Hash::make(1111),
        ])->assignRole('admin');
        User::create([
            'name'=>'کارفرما 2',
            'family'=>'کارفرما زاده',
            'job_category_id'=> 1 ,
            'phone_number'=>'09197210145',
            'phone_number_verified_at'=>now(),
            'national_id'=>1111111,
            'password'=>Hash::make(1111),
            'password_confirmation'=>Hash::make(1111),
        ])->assignRole('admin');
    }
}

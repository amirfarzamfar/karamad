<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::create([
            'user_id'=>2,
            'organizations_name'=>'مکین',
            'job_category_id'=>'1',
            'organizations_phone_number'=>'09197210143',
            'organizations_email'=>'makeen@gmail.com',
            'city_id'=>1,
            'province_id'=>2,
            'organizations_web_address'=>'یه جایی نزدیکای مترو علم و صنعت',
            'organizations_about'=>'فلان بهمان بیسار',
            'organizations_address'=>'فلان بهمان بیسار',
            'number_of_staff'=>'100'
        ]);
        Organization::create([
            'user_id'=>3,
            'organizations_name'=>' شبعه2مکین',
            'job_category_id'=>'1',
            'organizations_phone_number'=>'09197210143',
            'organizations_email'=>'makeen2@gmail.com',
            'city_id'=>1,
            'province_id'=>2,
            'organizations_web_address'=>'یه جایی نزدیکای مترو علم و صنعت',
            'organizations_about'=>'فلان بهمان بیسار',
            'organizations_address'=>'فلان بهمان بیسار',
            'number_of_staff'=>'100'
        ]);
    }
}

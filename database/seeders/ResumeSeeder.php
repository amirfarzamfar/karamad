<?php

namespace Database\Seeders;

use App\Models\Educational_record;
use App\Models\Skill;
use App\Models\Social_network;
use App\Models\User_data;
use App\Models\Work_experience;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $user_data =  User_data::create([
            'user_id'=>1,
            'name'=>'محمد علی',
            'family'=>'رستگار',
            'gender'=>'male',
            'marital_status'=>'single',
            'city_id'=>1,
            'province_id'=>2,
            'year_of_birth'=>'1381-10-10',
            'military_exemption'=>'Not Exempt',
            'email'=>'rastegar@gmail.com',
            'phone_number'=>'09192525014',
            'address'=>' تهران',
        ]);
        Educational_record::create([
            'user_data_id'=>$user_data->id,
            'grade' => 'دیپلم',
            'field_of_study' => 'تجربی',
            'university_name' =>'تهران شمال',
            'entering_year' => '1395-10-10',
            'graduation_year' => null ,
            'currently_studying' =>'true' ,
        ]);
        Skill::create([
            'model'=>'app/model/resume',
            'model_id'=>$user_data->id,
            'skill_name'=>'هک و امنیت',
            'skill_percentage'=>100
            ]);
        Social_network::create([
            'user_data_id'=>$user_data->id,
            'instagram_id'=>'tahabidkhory',
            'github_id'=>'https//:github.io/felan bahman bisar',
            'linkedin_id'=>'test'
        ]);
        Work_experience::create([
            'user_data_id'=>$user_data->id,
            'job_title'=>'بک اند',
            'organization_name'=>'makfa',
            'start_of_work'=>'1395-10-10',
            'end_of_work'=>null,
            'currently_employed'=>'true',
        ]);
    }
}

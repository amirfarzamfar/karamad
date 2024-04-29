<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Adseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $ad1 = Advertisement::create([
            'organization_id'=>'1',
            'job_category_id'=>'1',
            'title'=>'گرافیست',
            'gender'=>'male',
            'type_of_cooperation'=>'full_time',
            'military_exemption'=>'Exempt',
            'salary'=>'200',
            'city_id'=>1,
            'province_id'=>2,
            'degree_of_education'=>'دیپلم',
            'address'=>'یه جایی تو تهران',
            'about'=>'فلان بهمان بیسار',
            'Advantages'=>'میان وعده'
        ]);
        Skill::create([
            'model'=>'app/model/advertisement',
            'model_id'=>$ad1->id,
            'skill_name'=>'هک و امنیت',
            'skill_percentage'=>100
        ]);
       $ad2 = Advertisement::create([
            'organization_id'=>'2',
            'job_category_id'=>'1',
            'title'=>'برنامه نویس فرانت ',
            'gender'=>'male',
            'type_of_cooperation'=>'full_time',
            'military_exemption'=>'Exempt',
            'salary'=>'200',
            'city_id'=>1,
            'province_id'=>2,
            'degree_of_education'=>'دیپلم',
            'address'=>'یه جایی تو تهران',
            'about'=>'به یک فرانت کار حونیور نیاز مندیم',
            'Advantages'=>'نهار میدن'
        ]);
        Skill::create([
            'model'=>'app/model/advertisement',
            'model_id'=>$ad2->id,
            'skill_name'=>'خرید و فروش',
            'skill_percentage'=>100
        ]);
        $ad3 = Advertisement::create([
            'organization_id'=>'2',
            'job_category_id'=>'1',
            'title'=>'بکند دولوپر',
            'gender'=>'male',
            'type_of_cooperation'=>'full_time',
            'military_exemption'=>'Exempt',
            'salary'=>'200',
            'city_id'=>1,
            'province_id'=>2,
            'degree_of_education'=>'دیپلم',
            'address'=>' تهران',
            'about'=>'به یک بکند کار حونیور نیاز مندیم',
            'Advantages'=>'اضافه کار'
        ]);
        Skill::create([
            'model'=>'app/model/advertisement',
            'model_id'=>$ad3->id,
            'skill_name'=>'خرید و فروش',
            'skill_percentage'=>100
        ]);
    }
}

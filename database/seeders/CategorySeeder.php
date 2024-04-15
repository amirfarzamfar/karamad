<?php

namespace Database\Seeders;

use App\Models\Job_category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['دیجیتال مارکتینگ,سئو','طراحی گرافیک / انیمیشن','طراحی رابط کاربری','تست نرم افزار','طراحی بازی','توسعه نرم افزار و برنامه نویسی','طراحی صنعتی'];
        foreach ($categories as $category)
        {
            Job_category::create([
                'job_category_name'=>$category
            ]);
        }

    }
}

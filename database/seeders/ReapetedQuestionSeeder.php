<?php

namespace Database\Seeders;

use App\Models\Reapeted_question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReapetedQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reapeted_question::create([
            'question'=>'آیا ساخت و ارسال رزومه در کارآمد برای من هزینه‌ای دارد؟',
            'answer'=>'1'
        ]);
        Reapeted_question::create([
            'question'=>'چگونه می‌توانم فرصت‌های شغلی را فقط در شهر خودم ببینم و رزومه ارسال کنم؟',
            'answer'=>'خیر کارآمد یک سرویس رایگان برای تمام متقاضیان استخدامی در ایران است. شما با ثبت نام در کارآمد میتوانید رزومه به صورت رایگان بسازید'
        ]);
    }
}

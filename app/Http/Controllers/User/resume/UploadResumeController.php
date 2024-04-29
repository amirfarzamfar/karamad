<?php

namespace App\Http\Controllers\User\resume;

use App\Http\Controllers\Controller;
use App\Models\Educational_record;
use App\Models\Personal_resume;
use App\Models\Skill;
use App\Models\User_data;
use App\Models\Work_experience;
use Illuminate\Http\Request;

class UploadResumeController extends Controller
{
    public function uploadEducationalRecord(int $user_data_id , Request $request)
    {
        try {
            Educational_record::create([
                'user_data_id'=>$user_data_id,
                'grade'=>$request->grade,
                'field_of_study'=>$request->field_of_study,
                'university_name'=>$request->university_name,
                'entering_year'=>$request->entering_year,
                'graduation_year'=>$request->graduation_year,
                'currently_studying'=>$request->currently_studying
            ]);
            return response()->json('success');
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }

    public function uploadSkill(int $user_data_id , Request $request)
    {
        try {
            Skill::create([
                'model'=>'app/model/resume',
                'model_id'=>$user_data_id,
                'skill_name'=>$request->skill_name,
                'skill_percentage'=>$request->skill_percentage
            ]);
            return response()->json('success');
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }

    public function uploadWorkExperience(int $user_data_id , Request $request)
    {
        try {
            Work_experience::create([
                'user_data_id'=>$user_data_id,
                'job_title'=>$request->job_title,
                'organization_name'=>$request->organization_name,
                'start_of_work'=>$request->start_of_work,
                    'end_of_work'=>$request->end_of_work,
                'currently_employed'=>$request->currently_employed
            ]);
            return response()->json('success');
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }

    public function uploadPersonalResume(int $user_data_id , Request $request)
    {
        try {
            $file = $request->file;

            $unique_name =time().$file->getClientOriginalName();

            $name = $file->getClientOriginalName();

            $destination = storage_path('app/public/files/' . $unique_name);

            move_uploaded_file($file, $destination);

            Personal_resume::create([
                'user_data_id'=>$user_data_id,
                'name'=>$name,
                'unique_name'=>$unique_name
            ]);
            return response()->json('success');
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }

    public function uploadImage(int $user_data_id , Request $request)
    {
        try {
            $user_data = User_data::find($user_data_id);
            if ($user_data->hasMedia()){
                $mediaItems = $user_data->getMedia();
                $mediaItems[0]->delete();
            }
            $user_data->addMediaFromRequest('image')->toMediaCollection();
            return response()->json('success');
        }catch (\Throwable $th)
        {
            return response()->json($th->getMessage());
        }
    }
}

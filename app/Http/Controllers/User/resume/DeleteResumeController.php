<?php

namespace App\Http\Controllers\User\resume;

use App\Http\Controllers\Controller;
use App\Models\Educational_record;
use App\Models\Personal_resume;
use App\Models\Skill;
use App\Models\User_data;
use App\Models\Work_experience;
use Illuminate\Support\Facades\Storage;

class DeleteResumeController extends Controller
{
    public function deleteEducationalRecord(int $educationalRecord_id): \Illuminate\Http\JsonResponse
    {
        try {
            Educational_record::where('id' , $educationalRecord_id)->delete();

            return response()->json('success');
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }

    public function deleteSkill(int $skill_id): \Illuminate\Http\JsonResponse
    {
        try {
            Skill::where('id' , $skill_id)->delete();

            return response()->json('success');
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }

    public function deleteWorkExperience(int $workExperience_id): \Illuminate\Http\JsonResponse
    {
        try {
            Work_experience::where('id' , $workExperience_id)->delete();

            return response()->json('success');
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }

    public function deletePersonalResume(int $personalResume_id): \Illuminate\Http\JsonResponse
    {
        try {
            $personalResume = Personal_resume::where('id' , $personalResume_id)->first();
            $unique_name = $personalResume->unique_name;
            Storage::delete('files/'.$unique_name);
            Personal_resume::where('id' , $personalResume_id)->delete();
            return response()->json('success');
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }
    public function deleteImage(int $user_data_id): \Illuminate\Http\JsonResponse
    {
        try {
            $yourModel = User_data::find($user_data_id);
            $mediaItems = $yourModel->getMedia();
            $mediaItems[0]->delete();
            return response()->json('success');
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }
}

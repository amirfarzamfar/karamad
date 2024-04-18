<?php

namespace App\Http\Controllers\User\resume;

use App\Http\Controllers\Controller;
use App\Models\Educational_record;
use App\Models\Personal_resume;
use App\Models\Skill;
use App\Models\Work_experience;
use Illuminate\Support\Facades\Storage;

class DeleteResumeController extends Controller
{
    public function deleteEducationalRecord(int $educationalRecord_id)
    {
        try {
            Educational_record::where('id' , $educationalRecord_id)->delete();

            return response()->json('success');
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }

    public function deleteSkill(int $skill_id)
    {
        try {
            Skill::where('id' , $skill_id)->delete();

            return response()->json('success');
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }

    public function deleteWorkExperience(int $workExperience_id)
    {
        try {
            Work_experience::where('id' , $workExperience_id)->delete();

            return response()->json('success');
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }

    public function deletePersonalResume(int $personalResume_id)
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
}

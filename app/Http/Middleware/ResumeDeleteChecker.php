<?php

namespace App\Http\Middleware;

use App\Models\Educational_record;
use App\Models\Personal_resume;
use App\Models\Skill;
use App\Models\Work_experience;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResumeDeleteChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      $user_data_id = self::getUserDataId($request);
      if ($user_data_id == auth()->id()){
          return $next($request);
      }else{
          return \response()->json('you do not have permission');
      }
    }

    public function getUserDataId($request)
    {
        if ($request->route()->named('user.Resume.educationalRecord.delete')){
            $educationalRecord_id = $request->route('educationalRecord_id');
            $educationalRecord = Educational_record::find($educationalRecord_id);
            return $educationalRecord->user_data_id;
        }elseif ($request->route()->named('user.Resume.skill.delete')){
            $skill_id = $request->route('skill_id');
            $skill = Skill::find($skill_id);
            return $skill->user_data_id;
        }elseif ($request->route()->named('user.Resume.workExperience.delete')){
            $workExperience_id = $request->route('workExperience_id');
            $workExperience =  Work_experience::find($workExperience_id);
            return $workExperience->user_data_id;
        }else{
            $personalResume_id = $request->route('personalResume_id');
            $personalResume = Personal_resume::where('model' , 'app/model/resume')->where('id' , $personalResume_id)->first();
            return $personalResume->model_id;
        }
    }
}

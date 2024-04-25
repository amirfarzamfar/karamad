<?php

namespace App\Http\Controllers\User\resume;

use App\Http\Controllers\Controller;
use App\Models\Educational_record;
use App\Models\Personal_resume;
use App\Models\Skill;
use App\Models\Social_network;
use App\Models\User_data;
use App\Models\Work_experience;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function auth;
use function response;
use function storage_path;


class UpdateResumeController extends Controller
{
    public function update(Request $request)
    {
        try {
            $id = 1;
            $user_data = User_data::where('user_id' , $id)->first();
            $user_data_id= $user_data->id;
            self::updateUserData($request , $user_data_id);
            self::updateEducationalRecord($request , $user_data_id);
            self::updateSkill($request  , $user_data_id);
            self::updateSocialNetwork($request , $user_data_id);
            self::updateWorkExperience($request , $user_data_id);
            return response()->json('success');
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }

    public function updateUserData($request , $id): void //
    {
        User_data::find($id)->update([
            'name'=>$request->name,
            'family'=>$request->family,
            'gender'=>$request->gender,
            'marital_status'=>$request->marital_status,
            'year_of_birth'=>Carbon::create($request->year_of_birth),
            'military_exemption'=>$request->military_exemption,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'city_id'=>$request->city,
            'Province_id'=>$request->Province,
            'address'=>$request->address,
            'about_me'=>$request->about_me,
        ]);
    }

    public function updateEducationalRecord($request , $id): void //
    {
        $EducationalRecords = $request->EducationalRecord;
        Educational_record::where('user_data_id' , $id)->forceDelete();
        foreach ($EducationalRecords as $EducationalRecord)
        {
            Educational_record::create([
                'user_data_id'=>$id,
                'grade' => $EducationalRecord['grade'],
                'field_of_study' => $EducationalRecord['field_of_study'],
                'university_name' => $EducationalRecord['university_name'],
                'entering_year' => Carbon::create($EducationalRecord['entering_year']),
                'graduation_year' =>isset($EducationalRecord['graduation_year']) ? Carbon::create($EducationalRecord['graduation_year']) : null,
                'currently_studying' => $EducationalRecord['currently_studying'],
            ]);
        }
    }

    public function updateSkill($request , $id): void //
    {
        $skills = $request->skill;
            Skill::where('model_id' , $id)->where('model' , '=' ,'app/model/resume')->forceDelete();
        foreach ($skills as $skill){
            Skill::create([
                'model'=>'app/model/resume',
                'model_id'=>$id,
                'skill_name'=>$skill['skill_name'],
                'skill_percentage'=>$skill['skill_percentage']
            ]);
        }
    }

    public function updateSocialNetwork($request , $id): void //
    {

        Social_network::where('user_data_id',$id)->update([
            'instagram_id'=>$request->instagram,
            'github_id'=>$request->github,
            'linkedin_id'=>$request->linkedin
        ]);
    }

    public function updateWorkExperience($request , $id): void //
    {

        $WorkExperiences = $request->workexperince;
        Work_experience::where('user_data_id' , $id)->forceDelete();
        foreach ($WorkExperiences as $workExperience){
            Work_experience::create([
                'user_data_id'=>$id,
                'job_title'=>$workExperience['job_title'],
                'organization_name'=>$workExperience['organization_name'],
                'start_of_work'=>Carbon::create($workExperience['start_of_work']),
                'end_of_work'=>isset($workExperience['end_of_work']) ? Carbon::create($workExperience['end_of_work']) : null,
                'currently_employed'=>$workExperience['currently_employed'],
            ]);
        }
    }
}

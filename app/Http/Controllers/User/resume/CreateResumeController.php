<?php

namespace App\Http\Controllers\User\resume;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResumeRequest;
use App\Models\Educational_record;
use App\Models\Personal_resume;
use App\Models\Skill;
use App\Models\Social_network;
use App\Models\User_data;
use App\Models\Work_experience;
use Carbon\Carbon;
use function auth;
use function response;
use function storage_path;


class CreateResumeController extends Controller
{
    public function index()
    {

    }

    public function create(ResumeRequest $request)
    {
        try {
            self::createUserData($request);
            self::createEducationalRecord($request);
            self::createWorkExperience($request);
            self::createSkill($request);
            self::createSocialNetwork($request);
            self::createPersonalResume($request);

            return response()->json('success');
        }catch (\Throwable $th){
            return response()->json(
               $th->getMessage()
            );
        }
    }

    public function createUserData($request): void //
    {
        User_data::create([
            'user_id'=> auth()->id(),
            'name'=>$request->name,
            'family'=>$request->family,
            'gender'=>$request->gender,
            'marital_status'=>$request->marital_status,
            'year_of_birth'=>Carbon::create($request->year_of_birth),
            'military_exemption'=>$request->military_exemption,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'city'=>$request->city,
            'address'=>$request->address,
            'about_me'=>$request->about_me,
        ])->addMediaFromRequest('image')
            ->toMediaCollection();
    }

    public function createEducationalRecord($request): void //
    {
       $EducationalRecords = $request->EducationalRecord;

       $user_data = User_data::where('user_id' , auth()->id())->first();

       foreach ($EducationalRecords as $EducationalRecord)
       {
           Educational_record::create([
               'user_data_id'=>$user_data->id,
               'grade' => $EducationalRecord['grade'],
               'field_of_study' => $EducationalRecord['field_of_study'],
               'university_name' => $EducationalRecord['university_name'],
               'entering_year' => Carbon::create($EducationalRecord['entering_year']),
               'graduation_year' =>isset($EducationalRecord['graduation_year']) ? Carbon::create($EducationalRecord['graduation_year']) : null,
               'currently_studying' => $EducationalRecord['currently_studying'],
           ]);
       }
    }

    public function createSkill($request): void //
    {
        $skills = $request->skill;

        $user_data = User_data::where('user_id' , auth()->id())->first();

        foreach ($skills as $skill){
            Skill::create([
                'model'=>'app/model/resume',
                'model_id'=>$user_data->id,
                'skill_name'=>$skill['skill_name'],
                'skill_percentage'=>$skill['skill_percentage']
        ]);
        }
    }

    public function createSocialNetwork($request): void //
    {
        $user_data = User_data::where('user_id' , auth()->id())->first();

        Social_network::create([
            'user_data_id'=>$user_data->id,
            'instagram_id'=>$request->instagram,
            'github_id'=>$request->github,
            'linkedin_id'=>$request->linkedin
        ]);
    }

    public function createWorkExperience($request) //
    {
        $user_data = User_data::where('user_id' , auth()->id())->first();

        $WorkExperiences = $request->workexperince;

        foreach ($WorkExperiences as $workExperience){
            Work_experience::create([
                'user_data_id'=>$user_data->id,
                'job_title'=>$workExperience['job_title'],
                'organization_name'=>$workExperience['organization_name'],
                'start_of_work'=>Carbon::create($workExperience['start_of_work']),
                'end_of_work'=>isset($workExperience['end_of_work']) ? Carbon::create($workExperience['end_of_work']) : null,
                'currently_employed'=>$workExperience['currently_employed'],
            ]);
        }
    }

    public function createPersonalResume($request)
    {
        $personalResumes = $request->personalResume;

        $user_data = User_data::where('user_id' , auth()->id())->first();

        foreach ($personalResumes as $personalResume){

            $file = $personalResume['file'];

            $unique_name =time().$file->getClientOriginalName();

            $name = $file->getClientOriginalName();

            $destination = storage_path('app/public/files/' . $unique_name);

            move_uploaded_file($file, $destination);

            Personal_resume::create([
                'user_data_id'=>$user_data->id,
                'name'=>$name,
                'unique_name'=>$unique_name
            ]);
        }
    }
}

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
use Illuminate\Http\JsonResponse;
use function auth;
use function response;
use function storage_path;


class CreateResumeController extends Controller
{
    protected $user_data_id;
    public function create(ResumeRequest $request): JsonResponse
    {

        try {
            self::createUserData($request);
            self::createEducationalRecord($request , $this->user_data_id);
            self::createWorkExperience($request , $this->user_data_id);
            self::createSkill($request , $this->user_data_id);
            self::createSocialNetwork($request , $this->user_data_id);
            self::createPersonalResume($request , $this->user_data_id);

            return response()->json('success');
        }catch (\Throwable $th){
            return response()->json(
               $th->getMessage()
            );
        }
    }

    public function createUserData($request): void //
    {
       $user_data =  User_data::create([
            'user_id'=> auth()->id(),
            'name'=>$request->name,
            'family'=>$request->family,
            'gender'=>$request->gender,
            'marital_status'=>$request->marital_status,
            'year_of_birth'=>$request->year_of_birth,
            'military_exemption'=>$request->military_exemption,
            'email'=>$request->email,
            'city_id'=>$request->city,
            'province_id'=>$request->Province,
            'phone_number'=>$request->phone_number,
            'address'=>$request->address,
            'about_me'=>$request->about_me,
        ]);
       if ($request->image !== null) {
           $user_data->addMediaFromRequest('image')
               ->toMediaCollection();
       }
       $this->user_data_id = $user_data->id;
    }

    public function createEducationalRecord($request , $id): void //
    {
       $EducationalRecords = $request->EducationalRecord;

       foreach ($EducationalRecords as $EducationalRecord)
       {
           Educational_record::create([
               'user_data_id'=>$id,
               'grade' => $EducationalRecord['grade'],
               'field_of_study' => $EducationalRecord['field_of_study'],
               'university_name' => $EducationalRecord['university_name'],
               'entering_year' => $EducationalRecord['entering_year'],
               'graduation_year' => $EducationalRecord['graduation_year'] ?? null,
               'currently_studying' => $EducationalRecord['currently_studying'],
           ]);
       }
    }

    public function createSkill($request , $id): void //
    {
        $skills = $request->skill;

        foreach ($skills as $skill){
            Skill::create([
                'model'=>'app/model/resume',
                'model_id'=>$id,
                'skill_name'=>$skill['skill_name'],
                'skill_percentage'=>$skill['skill_percentage']
        ]);
        }
    }

    public function createSocialNetwork($request , $id): void //
    {
        Social_network::create([
            'user_data_id'=>$id,
            'instagram_id'=>$request->instagram,
            'github_id'=>$request->github,
            'linkedin_id'=>$request->linkedin
        ]);
    }

    public function createWorkExperience($request , $id): void //
    {
        $WorkExperiences = $request->workexperince;

        foreach ($WorkExperiences as $workExperience){
            Work_experience::create([
                'user_data_id'=>$id,
                'job_title'=>$workExperience['job_title'],
                'organization_name'=>$workExperience['organization_name'],
                'start_of_work'=>Carbon::create($workExperience['start_of_work']),
                'end_of_work'=> $workExperience['end_of_work'] ?? null,
                'currently_employed'=>$workExperience['currently_employed'],
            ]);
        }
    }

    public function createPersonalResume($request , $id): void
    {
        $personalResumes = $request->personalResume;

        foreach ($personalResumes as $personalResume){

            $file = $personalResume['name'];
            if ($file !== null){
                $unique_name =time().$file->getClientOriginalName();

                $name = $file->getClientOriginalName();

                $destination = storage_path('app/public/files/' . $unique_name);

                move_uploaded_file($file, $destination);

                Personal_resume::create([
                    'user_data_id'=>$id,
                    'name'=>$name,
                    'unique_name'=>$unique_name
                ]);
            }

        }
    }
}



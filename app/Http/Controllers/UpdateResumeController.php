<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeRequest;
use App\Models\Educational_record;
use App\Models\Personal_resume;
use App\Models\Skill;
use App\Models\Social_network;
use App\Models\User_data;
use App\Models\Work_experience;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UpdateResumeController extends Controller
{
    public function update(Request $request)
    {
        try {
            $id = 1;
            $user_data = User_data::where('user_id' , $id)->first();
            $user_data_id= $user_data->id;
            self::updateUserData($request , $user_data_id);
            self::updateImage($request , $user_data_id);
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
            'city'=>$request->city,
            'address'=>$request->address,
            'about_me'=>$request->about_me,
        ]);
    }

    public function updateEducationalRecord($request , $id): void //
    {
        $EducationalRecords = $request->EducationalRecord;

        foreach ($EducationalRecords as $EducationalRecord)
        {
            Educational_record::where('user_data_id',$id)->update([
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

        foreach ($skills as $skill){
            Skill::where('user_data_id',$id)->update([
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

        foreach ($WorkExperiences as $workExperience){
            Work_experience::where('user_data_id',$id)->update([
                'job_title'=>$workExperience['job_title'],
                'organization_name'=>$workExperience['organization_name'],
                'start_of_work'=>Carbon::create($workExperience['start_of_work']),
                'end_of_work'=>isset($workExperience['end_of_work']) ? Carbon::create($workExperience['end_of_work']) : null,
                'currently_employed'=>$workExperience['currently_employed'],
            ]);
        }
    }
    public function updateImage($request , $id): void
    {
        $user_data = User_data::find($id);
        $mediaItems_status = $user_data->hasMedia();
      if ($mediaItems_status == true){
          $mediaItems =  $user_data->getMedia();
          $mediaItems[0]->delete();
      }
        $user_data->addMediaFromRequest('image')->toMediaCollection();
    }

    public function createPersonalResume($request , $id)
    {
        $personalResumes = $request->personalResume;

        foreach ($personalResumes as $personalResume){

            $file = $personalResume['file'];

            $unique_name =time().$file->getClientOriginalName();

            if (Storage::exists('files/' . $unique_name)){}

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
// first idea => deleted_at -> !null and if it exists in storage it will be deleted for accept
//second idea => deleted_at -> !null and if it !exists in storage its deleted_at -> null for not accept
    public function deletePersonalResume(string $unique_name)
    {
        $id = auth()->id();
        $user_data = User_data::where('user_id' , $id)->first();
        $user_data_id= $user_data->id;
        Storage::delete('files/'.$unique_name);
        Personal_resume::where('user_data_id' , $user_data_id)
            ->where('unique_name' , $unique_name)
            ->delete();
    }
}

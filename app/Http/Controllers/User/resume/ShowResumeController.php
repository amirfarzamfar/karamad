<?php

namespace App\Http\Controllers\User\resume;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResumeMakerWorkplaceCollection;
use App\Models\Educational_record;
use App\Models\Personal_resume;
use App\Models\Skill;
use App\Models\Social_network;
use App\Models\User_data;
use App\Models\Work_experience;
use Illuminate\Support\Facades\Storage;
use function response;

class ShowResumeController extends Controller
{
    protected $resume;
    public function index($avatar_id , $User_data_id , $User_data)
    {
        try {

            if ($this->resume !== 'no resume') {
                $educational_record = self::FindEducationalRecord($User_data_id);

                $work_experience = self::FindWorkExperience($User_data_id);

                $skill = self::FindSkill($User_data_id);

                $social_network = self::FindSocialNetwork($User_data_id);

                $personal_resume = self::FindPersonalResume($User_data_id);
                return (new ResumeMakerWorkplaceCollection($User_data))->additional([
                    'avatar' => $avatar_id,
                    'educational_record' => $educational_record,
                    'work_experience' => $work_experience,
                    'skill' => $skill,
                    'social_network' => $social_network,
                    'personal_resume' => $personal_resume
              ]);
            }else{
                 return response()->json(['resume' => null]);
            }
        }catch (\Throwable $th){
            return response()->json($th->getMessage());
        }
    }

    //

    public function adminSeeResume(int $User_data_id)
    {
        if (User_data::where('id',$User_data_id)->exists()) {
            $User_data = User_data::with('City', 'Province')->where('id', $User_data_id)->get();
            if ($User_data[0]->hasMedia()) {
                $image = $User_data[0]->getMedia();

                $avatar_id = $image[0]->getUrl();
                return self::index($avatar_id , $User_data_id , $User_data);
            } else {
                $avatar_id = null;
                return self::index($avatar_id , $User_data_id , $User_data);
            }
        }else{
            $this->resume = 'no resume';
            return self::index(null , null , null);
        }
    }

    //

    public function userSeeResume()
    {
        $id = auth()->id();
        if (User_data::where('user_id' , $id)->exists()){
            $User_data = User_data::with('City', 'Province')->where('user_id' , $id)->get();

            $User_data_id = $User_data[0]->id;
            if ($User_data[0]->hasMedia()){
                $image = $User_data[0]->getMedia();
                $avatar_id = $image[0]->getUrl();
                return self::index($avatar_id , $User_data_id , $User_data);
            }else{
                $avatar_id = null ;
                return self::index($avatar_id , $User_data_id , $User_data);
            }
        }else{
            $this->resume = 'no resume';
            return self::index(null , null , null);
        }
    }

    //

    public function FindEducationalRecord($id)
    {
      return Educational_record::where('user_data_id' , $id)->get();
    }

    //

    public function FindWorkExperience($id)
    {
      return Work_experience::where('user_data_id' , $id)->get();
    }

    //

    public function FindSkill($id)
    {
      return Skill::where('model','app/model/resume')->where('model_id' , $id)->get(['skill_name','skill_percentage']);
    }

    //

    public function FindSocialNetwork($id)
    {
        return Social_network::where('user_data_id' , $id)->get();
    }

    //

    public function FindPersonalResume($id)
    {
      $personal_resumes =  Personal_resume::where('user_data_id' , $id)->get();

      $resume = [];

      foreach ($personal_resumes as $personal_resume)
      {
          $resume_name = $personal_resume->name;

          $resume_unique_name =  $personal_resume->unique_name;

          $url = Storage::url('files/'. $resume_unique_name);

          $resume []= ['url'=>$url , 'name'=>$resume_name ];
      }

      return $resume;
    }
}



/*if ($User_data_id == null){
                $id = auth()->id();
                if (User_data::where('user_id' , $id)->exists()){
                    $User_data = User_data::with('city','province')->where('user_id' , $id)->get();

                    $User_data_id = $User_data[0]->id;
                    if ($User_data[0]->hasMedia()){
                        $image = $User_data[0]->getMedia();

                        $avatar_id = $image[0]->getUrl();
                    }else{
                        $avatar_id = null ;
                    }
                }else{
                    $this->resume = 'no resume';
                    return response()->json(['resume' => null]);
                }
            }else{
                if (User_data::where('id',$User_data_id)->exists()){
                    $User_data = User_data::with('city','province')->where('id',$User_data_id)->get();
                    if ($User_data[0]->hasMedia()){
                        $image = $User_data[0]->getMedia();

                        $avatar_id = $image[0]->getUrl();
                    }else{
                        $avatar_id = null ;
                    }
                }else{
                    $this->resume = 'no resume';
                    return response()->json(['resume' => null]);
                }
            }*/

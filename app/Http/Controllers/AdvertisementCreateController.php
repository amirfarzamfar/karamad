<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Organization;
use App\Models\Skill;
use Illuminate\Http\Request;

class AdvertisementCreateController extends Controller
{
    protected int $advertisement_id;

    public function create(Request $request)
    {
        try {
            $id = 1;
            $organization = Organization::where('user_id' , $id)->first();
            $organization_id = $organization->id;
            self::createAdvertisement($request , $organization_id);
            self::createAdvertisementSkills($request , $this->advertisement_id);
            return response()->json(['success'],200);
        }catch (\Throwable $th){
            return  response()->json($th->getMessage());
        }
    }

    public function createAdvertisement($request , $id): void
    {
       $advertisement = Advertisement::create([
            'organization_id'=> $id,
            'title'=>$request->title,
            'gender'=>$request->gender,
            'type_of_cooperation'=>$request->type_of_cooperation,
            'military_exemption'=>$request->military_exemption,
            'salary'=>$request->salary,
            'city/province'=>$request->cityProvince,
            'degree_of_education'=>$request->degree_of_education,
            'address'=>$request->address,
            'about'=>$request->about,
        ]);
       $this->advertisement_id = $advertisement->id;
    }

    public function createAdvertisementSkills($request , $id): void
    {
        $skillRequests = $request->Skill;
        foreach ($skillRequests as $skillRequest){
            Skill::create([
                'model'=>'app/model/advertisement',
                'model_id'=> $id,
                'skill_name'=>$skillRequest['skill_name'],
                'skill_percentage'=>$skillRequest['skill_percentage'],
            ]);
        }
    }
}

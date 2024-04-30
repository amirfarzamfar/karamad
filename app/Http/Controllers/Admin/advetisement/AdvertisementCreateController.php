<?php

namespace App\Http\Controllers\Admin\advetisement;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdRequest;
use App\Models\Advertisement;
use App\Models\Organization;
use App\Models\Skill;
use function response;


class AdvertisementCreateController extends Controller
{
    protected int $advertisement_id;

    public function create(CreateAdRequest $request)
    {
        try {
            $id = auth()->id();
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
            'job_category_id'=>$request->job_category_id,
            'type_of_cooperation'=>$request->type_of_cooperation,
            'military_exemption'=>$request->military_exemption,
            'salary'=>$request->salary,
            'city_id'=>$request->city,
            'province_id'=>$request->Province,
            'degree_of_education'=>$request->degree_of_education,
            'address'=>$request->address,
            'about'=>$request->about,
            'Advantages'=>$request->Advantages,
        ]);
       $this->advertisement_id = $advertisement->id;
    }

    public function createAdvertisementSkills($request , $id): void
    {
        $skillRequests = $request->skill;
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

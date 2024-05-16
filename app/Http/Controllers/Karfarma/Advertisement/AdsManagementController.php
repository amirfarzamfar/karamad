<?php

namespace App\Http\Controllers\Karfarma\Advertisement;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdRequest;
use App\Http\Resources\AdManagement\AdvertisementResource;
use App\Models\Advertisement;
use App\Models\Organization;
use App\Models\Skill;
use Illuminate\Http\Request;

class AdsManagementController extends Controller
{


    public function AdManagement()
    {

    }

    public function allAds(Request $request)
    {

        $user = $request->user();
        $organization = Organization::where('user_id', $user->id)->first();


        $advertisements = Advertisement::where('organization_id', $organization->id)
            ->latest()
            ->paginate(20);


        if ($advertisements->isEmpty()) {
            return response()->json([
                'message' => 'هیچ آگهی برای این کاربر یافت نشد.'
             ], 404);
        }

        return AdvertisementResource::collection($advertisements);

    }


    public function editAdd(Request $request)
    {

        $user_id = auth()->id();
        $organization = Organization::where('user_id', $user_id)->first();
        $advertisements = Advertisement::where('organization_id', $organization->id)->first();



        $advertisements->update([
            'title'=>$request->title,
            'gender'=>$request->gender,
            'military_exemption'=>$request->military_exemption,
            'type_of_cooperation'=>$request->type_of_cooperation,
            'salary'=>$request->salary,
            'city/province'=>$request->cityProvince,
            'degree_of_education'=>$request->degree_of_education,
            'address'=>$request->address,
            'about'=>$request->about,
            'organization_id'=>$request->organization_id,
            'status'=>$request->status
        ]);
        self::updateSkill($request , $advertisements->id);
       return response()->json([
          'message' => 'آگهی آپدیت شد'
       ]);
    }
    public function updateSkill($request , $id): void //
    {
        $skills = $request->skill;
        Skill::where('model_id' , $id)->where('model' , '=' ,'app/model/advertisement')->forceDelete();
        foreach ($skills as $skill){
            Skill::create([
                'model'=>'app/model/advertisement',
                'model_id'=>$id,
                'skill_name'=>$skill['skill_name'],
                'skill_percentage'=>$skill['skill_percentage']
            ]);
        }
    }
}

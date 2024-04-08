<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdvertisementCollection;
use App\Models\Advertisement;
use App\Models\Organization;
use App\Models\Skill;

class ShowAdController extends Controller
{
    public function show(int $id)
    {
        try {
         $advertisement = self::showAd($id);

         $skills = self::findSkills($advertisement[0]->id);

         $organization = self::findOrganization($advertisement[0]->organization_id);

         $allOtherAd = self::allAd($advertisement[0]->organization_id , $advertisement[0]->id);

            return (new AdvertisementCollection($advertisement))->additional([
                'skills'=>$skills,
                'organization'=>$organization,
                'otherAdvertisement'=>$allOtherAd
            ]);
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }

    public function showAd($id)
    {
        return Advertisement::find($id)->get();
    }

    public function findSkills($id)
    {
        return Skill::where('model','app/model/advertisement')->where('model_id', $id)->get(['skill_name','skill_percentage']);
    }

    public function findOrganization($id)
    {
       return Organization::find($id);
    }

    public function allAd($id , $advertisementId)
    {
        return Advertisement::where('organization_id' , $id)->whereNot('id' , $advertisementId)->get();
    }
}

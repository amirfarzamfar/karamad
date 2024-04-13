<?php

namespace App\Http\Controllers\User\Advertisement;

use App\Http\Controllers\Controller;
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
        $advertisements = Advertisement::find($id)->get();
        if($advertisements[0]->hasMedia()){
            $image = $advertisements[0]->getMedia();
            $Url = $image[0]->getUrl();
            $advertisements[0]->setAttribute('avatar_url', $Url);
        }else{
            $advertisements[0]->setAttribute('avatar_url', null);
        }
        return $advertisements;
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
       $advertisements = Advertisement::where('organization_id' , $id)->whereNot('id' , $advertisementId)->get();
        foreach ($advertisements as $advertisement) {
            if($advertisement->hasMedia()){
                $image = $advertisement->getMedia();
                $Url = $image[0]->getUrl();
                $advertisement->setAttribute('avatar_url', $Url);
            }else{
                $advertisement->setAttribute('avatar_url', null);
            }
        }
        return $advertisements;
    }
}

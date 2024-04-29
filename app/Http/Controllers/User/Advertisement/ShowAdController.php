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
        $advertisements = Advertisement::with(['jobCategory', 'City', 'Province'])->where('id',$id)->get();
        $advertisements[0]->setAttribute('decoded_category' , base64_decode($advertisements[0]->jobCategory->job_category_name));
        return $advertisements;
    }

    public function findSkills($id)
    {
        return Skill::where('model','app/model/advertisement')->where('model_id', $id)->get(['skill_name','skill_percentage']);
    }

    public function findOrganization($id)
    {
        $organization = Organization::with(['jobCategory', 'City', 'Province'])->where('id',$id)->get();
        $organization[0]->setAttribute('decoded_category' , base64_decode($organization[0]->jobCategory->job_category_name));
        if ($organization[0]->hasMedia('logo')){
            $image = $organization[0]->getMedia('logo');
            $Url = $image[0]->getUrl();
            $organization[0]->setAttribute('logo_url', $Url);
        }
        if($organization[0]->hasMedia('hero')){
            $image = $organization[0]->getMedia('hero');
            $Url = $image[0]->getUrl();
            $organization[0]->setAttribute('hero_url', $Url);
        }
        if ($organization[0]->hasMedia('image_1')) {
            $image = $organization[0]->getMedia('image_1');
            $Url = $image[0]->getUrl();
            $organization[0]->setAttribute('image_1_url', $Url);
        }
        if($organization[0]->hasMedia('image_2')){
            $image = $organization[0]->getMedia('image_2');
            $Url = $image[0]->getUrl();
            $organization[0]->setAttribute('image_2_url', $Url);
        }
       return $organization[0];
    }

    public function allAd($id , $advertisementId)
    {
       $advertisements = Advertisement::with(['jobCategory', 'City', 'Province'])->where('organization_id' , $id)->whereNot('id' , $advertisementId)->get();
        foreach ($advertisements as $advertisement) {
            $advertisement->setAttribute('decoded_category' , base64_decode($advertisement->jobCategory->job_category_name));
        }
        return $advertisements;
    }
}

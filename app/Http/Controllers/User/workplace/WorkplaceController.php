<?php

namespace App\Http\Controllers\User\workplace;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkplaceCollection;
use App\Models\About;
use App\Models\Advertisement;
use App\Models\Karamad_benefit;
use App\Models\Karamad_tip;
use App\Models\Organization;
use App\Models\Reapeted_question;
use App\Models\User;
use function response;

class WorkplaceController extends Controller
{

    //
    public function Advertisements(): WorkplaceCollection|\Illuminate\Http\JsonResponse
    {
        try {
            $recentRecords = Advertisement::with([
                'jobCategory' => function ($query){
                $query->select('id' , 'job_category_name');
            },
                'Organization'=> function ($query){
                $query->select('id','organizations_name');
            } ,
                'City', 'Province'])
                ->latest()
                ->take(6)
                ->get([ 'id' , 'title', 'type_of_cooperation' , 'salary','organization_id','job_category_id','province_id','city_id' ]);

            foreach ($recentRecords as $recentRecord){
                $recentRecord->setAttribute('decoded_category' , base64_decode($recentRecord->jobCategory->job_category_name));
                $Organization = Organization::find($recentRecord->Organization->id);
                if($Organization->hasMedia('logo')){
                    $image = $Organization->getMedia('logo');
                    $Url = $image[0]->getUrl();
                    $recentRecord->setAttribute('avatar_url', $Url);
                }
            }

            $recentRecords = $recentRecords->sortByDesc('id')->values();

            return new WorkplaceCollection($recentRecords);
        }catch (\Throwable $th){
            return response()->json([$th->getMessage()]);
        }
    }
    //
    public  function Benefits(): WorkplaceCollection|\Illuminate\Http\JsonResponse
    {
        try {
        $karamad_benefits = Karamad_benefit::take(4)->get();

        foreach ($karamad_benefits as $karamad_benefit){
            if ($karamad_benefit->title == 'کارفرما'){
                $superAdminCount = User::with('roles')->get()->filter(
                    fn ($user) => $user->roles->where('name', 'admin')->toArray()
                )->count();
                $karamad_benefit->setAttribute('Karfarmas' ,  $superAdminCount);
            }
        }
        return new WorkplaceCollection($karamad_benefits);
    }catch (\Throwable $th){
        return response()->json([$th->getMessage()]);
       }
    }

    public function Tips()
    {
       $karamad_tips = Karamad_tip::paginate(3);

        foreach ($karamad_tips as $karamad_tip){
            if($karamad_tip->hasMedia()){
                $image = $karamad_tip->getMedia();
                $Url = $image[0]->getUrl();
                $karamad_tip->setAttribute('avatar_url', $Url);
            }
        }

       return $karamad_tips;
    }
    //
    public function Questions(): WorkplaceCollection|\Illuminate\Http\JsonResponse
    {
        try{
        $Reapeted_resume = Reapeted_question::all();

        return new WorkplaceCollection($Reapeted_resume);
    }catch (\Throwable $th){
       return response()->json([$th->getMessage()]);
       }
    }
    //
    public function Supports(): WorkplaceCollection|\Illuminate\Http\JsonResponse
    {
        try {
            $KaramadSupport = About::all();

            return new WorkplaceCollection($KaramadSupport);
        }catch (\Throwable $th){
            return response()->json([$th->getMessage()]);
        }
    }
}

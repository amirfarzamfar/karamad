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
    public function Advertisements()
    {
        try {
            $recentRecords = Advertisement::with(['jobCategory', 'Organization' , /*'City', 'Province'*/])
                ->latest()
                ->take(6)
                ->get();

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
    public  function Benefits()
    {
        try {
        $karamad_benefits = Karamad_benefit::take(4)->get();

        foreach ($karamad_benefits as $karamad_benefit){
            if ($karamad_benefit->title == 'کارفرما'){
                $superAdminCount = User::with('roles')->get()->filter(
                    fn ($user) => $user->roles->where('name', 'admin')->toArray()
                )->count();
                $karamad_benefit->setAttribute('Karfarmas' , 'کارفرما'. $superAdminCount);
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
    public function Questions()
    {
        try{
        $Reapeted_resume = Reapeted_question::all();

        return new WorkplaceCollection($Reapeted_resume);
    }catch (\Throwable $th){
       return response()->json([$th->getMessage()]);
       }
    }
    //
    public function Supports()
    {
        try {
            $KaramadSupport = About::all();

            return new WorkplaceCollection($KaramadSupport);
        }catch (\Throwable $th){
            return response()->json([$th->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers\User\workplace;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkplaceCollection;
use App\Models\About;
use App\Models\Advertisement;
use App\Models\Karamad_benefit;
use App\Models\Karamad_tip;
use App\Models\Reapeted_question;
use function response;

class WorkplaceController extends Controller
{

    public function index()
    {
        try {
            $Advertisements = self::Advertisements();

            $Benefits = self::Benefits();

            $Tips = self::Tips();

            $Questions = self::Questions();

            $Supports = self::Supports();

            return (new WorkplaceCollection($Advertisements))->additional([
                'benefits'=>$Benefits,
                'tips'=>$Tips,
                'questions'=>$Questions,
                'support'=>$Supports
            ]);
        }catch (\Throwable $th){
            return response()->json(
                $th->getMessage()
            );
        }
    }
    //
    public function Advertisements()
    {
        $recentRecords = Advertisement::latest()->take(1)->get();

        foreach ($recentRecords as $recentRecord){
           if($recentRecord->hasMedia()){
             $image = $recentRecord->getMedia();
             $Url = $image[0]->getUrl();
             $recentRecord->setAttribute('avatar_url', $Url);
           }
        }

        $recentRecords = $recentRecords->sortByDesc('id')->values();

        return $recentRecords;
    }
    //
    public  function Benefits()
    {
        $karamad_benefit = Karamad_benefit::take(2)->get();


        return $karamad_benefit;
    }

    public function Tips()
    {
       $karamad_tips = Karamad_tip::paginate(2);

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
        $Reapeted_resume = Reapeted_question::all();

        return $Reapeted_resume;
    }
    //
    public function Supports()
    {
        $KaramadSupport = About::all();

        return $KaramadSupport;
    }
}

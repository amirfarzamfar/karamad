<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkplaceCollection;
use App\Models\About;
use App\Models\Karamad_benefit;
use App\Models\Karamad_tip;
use App\Models\Reapeted_question;
use App\Models\User;



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
        $recentRecords = User::latest()->take(1)->get(['name' , 'family']);

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

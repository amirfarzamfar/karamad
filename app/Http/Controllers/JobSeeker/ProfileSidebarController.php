<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Job_ad;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileSidebarController extends Controller
{
    public function editProfile(){

    }

    public function sideBar()
    {
        self::markedAd();


    }

    public function markedAd(Request $request)
    {


        $ids = $request->input('id');
        $selectedRecords = Job_ad::whereIn('id', $ids)->get();
        $user = auth()->user();

        $user->job_ad()->attach($selectedRecords);
        return response()->json([
            'message' => 'marked job',
            'makrked job' => $user
        ]);


    }


    public function postedResume(){
        $user = User::find(1);

        $resumes = $user->resumes;

        foreach ($resumes as $resume)
        {
            $jobAds = $resume->jobAds;

            foreach ($jobAds as $jobAd){

        }
        }

    }


}

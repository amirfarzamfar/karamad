<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Auth\EditUserController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Advertisement_user_data;
use App\Models\Marked_ad;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileSidebarController extends Controller
{


    public function sideBar(Request $request)
    {

        $markedAd = self::markedAd($request);
        $postedResume = self::postedResume();
        $logout = new LogoutController();
        $editUser = new EditUserController($request->user());
        $editUser->edit_user_profile($request->user());


        return[
            $markedAd,
            $postedResume,
            $logout,
            $editUser,
        ];
    }

    public function markedAd(Request $request)
    {


//        $ids = $request->input('id');
//        $selectedRecords = Organization::whereIn('id', $ids)->get();
//        $user = auth()->user();
//
//        $user->organization()->advertisements()->saveMany($selectedRecords);
//
//        return response()->json([
//            'message' => 'marked job',
//            'makrked job' => $user
//        ]);

        $user_id =  auth()->id();
        $ads_id = $request->input('ads_id');

        $markedAd =  Marked_ad::create([
            'user_id' => $user_id,
            'ads_id' => $ads_id
        ]);

        return response()->json([
            'markedAd' => $markedAd
        ]);



    }


    public function postedResume()
    {

        $user = auth()->user();
        $user_data = $user->user_data;
        $posted_resume = Advertisement_user_data::where('user_data_id',$user_data->id)->get();

        return response()->json([
            'postedResume'=> $posted_resume
        ]);

    }


}

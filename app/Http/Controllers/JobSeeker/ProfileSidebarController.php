<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Auth\EditUserController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdManagement\AdvertisementResource;
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

    public function markedAdRegiter(Request $request)
    {


        $user_id = auth()->id();
        $ads_id = $request->input('ads_id');

        $existingMarkedAd = Marked_ad::where('user_id', $user_id)
            ->where('ads_id', $ads_id)
            ->first();

        if ($existingMarkedAd) {
            return response()->json([
                'message' => 'This ad is already marked by the user.'
            ]);
        } else {
            $markedAd = Marked_ad::create([
                'user_id' => $user_id,
                'ads_id' => $ads_id
            ]);

            return response()->json([
                'markedAd' => $markedAd
            ]);
        }
    }



    public function markedAdShow(){

        $user_id =  auth()->id();
        $markedAdUsers = Marked_ad::where('user_id', $user_id )->get();
        $arr = [];
        foreach ($markedAdUsers as $markedAdUser){
            $arr[] =[
                $markedAdUser->ads_id,
            ];
        }
        $AdMarkeds = Advertisement::with('Organization')->whereIn('id',$arr)->get();


        $array = [];
        foreach ($AdMarkeds as $AdMarked) {
            if ($AdMarked->Organization || $AdMarked->jobCategory ) {
                $array[] = [
                    'organization_name' => $AdMarked->Organization->organizations_name,
                    'organization_logo' => $AdMarked->Organization->getFirstMediaUrl('logo'),
                    'advertisements' => new AdvertisementResource($AdMarked),
                ];
            }
        }
        return response()->json([
            'message' => 'markedAdShow',
            'arr' => $array
        ]);

    }


    public function postedResume()
    {
        $user = auth()->user();
        $user_data = $user->user_data;

        if ($user_data != null) {
            $posted_resume = Advertisement_user_data::where('user_data_id', $user_data->id)->paginate(10);

            return response()->json([
                'postedResume'=> $posted_resume
            ]);
        }else{
            return response()->json([
               'message' => 'you dont have posted resume'
            ]);
        }
    }




}

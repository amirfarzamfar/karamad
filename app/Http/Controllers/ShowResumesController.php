<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowResumesCollection;
use App\Models\Advertisement_user_data;
use App\Models\User;
use App\Models\User_data;

class ShowResumesController extends Controller
{
    public function index(int $advertisement_id)
    {
        try {
            $user_data_ids = Advertisement_user_data::where('advertisement_id',$advertisement_id)->pluck('user_data_id')->toArray();
            $user_id = User_data::whereIn('id', $user_data_ids)->pluck('user_id')->toArray();
            $users = User::whereIn('id' , $user_id)->get(['id','name' , 'family']);
            foreach ($users as $user) {
                $resume = User_data::where('user_id' , $user->id)->first();
                $pivot = Advertisement_user_data::where('user_data_id' , $resume->id)->where('advertisement_id' , $advertisement_id)->first();
                $user->setAttribute('status' , $pivot->status);
                $user->setAttribute('resume_id', $resume->id);
                if ($user->hasMedia()){
                    $mediaItems = $user->getMedia();
                    $Url = $mediaItems[0]->getUrl();
                    $user->setAttribute('avatar_url', $Url);
                }
            }
            return new ShowResumesCollection($users);
        }catch (\Throwable $th){
            return response()->json($th->getMessage());
        }
    }
}

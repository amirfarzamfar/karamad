<?php

namespace App\Http\Controllers;



use App\Models\Advertisement;
use App\Models\User_data;

class SendResumeController extends Controller
{
    public function send(int $advertisement_id)
    {
        try {
          $user_data = User_data::where('user_id' , 1)->first();
          $advertisement = Advertisement::find($advertisement_id);
          $advertisement->userDatas()->attach($user_data->id , ['created_at' => now(), 'updated_at' => now()]);
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }
}

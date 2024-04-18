<?php

namespace App\Http\Controllers\User\resume;



use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\User_data;
use function now;
use function response;

class SendResumeController extends Controller
{
    public function send(int $advertisement_id)
    {
        try {
          $user_data = User_data::where('user_id' , auth()->id())->first();
          $advertisement = Advertisement::find($advertisement_id);
          $advertisement->userDatas()->attach($user_data->id , ['created_at' => now(), 'updated_at' => now()]);
            return response()->json(['success']);
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\resume;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Advertisement_user_data;
use App\Models\Organization;
use Illuminate\Http\Request;
use function response;

class SetResumeStatusController extends Controller
{
    public function Set(Request $request , int $user_data_id)
    {
        try {
            $id= 2;
            $organization = Organization::where('user_id' , $id)->first();
            $advertisement = Advertisement::where('organization_id' , $organization->id)->first();
            Advertisement_user_data::where('advertisement_id' , $advertisement->id)->where('user_data_id' , $user_data_id)->update([
                'status'=>$request->status,
            ]);
            return response()->json('success');
        }catch (\Throwable $th){
            return response()->json($th->getMessage());
        }
    }
}

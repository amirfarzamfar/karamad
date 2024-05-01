<?php

namespace App\Http\Controllers\Admin\Counter;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Payment;

class CounterController extends Controller
{
    public function packages(): \Illuminate\Http\JsonResponse
    {
        try {
            $user_id = auth()->id();
            $payments = Payment::with([
                'payment_package'=> function ($query){
                    $query->select('id' , 'title');
                },])->where('user_id' , $user_id)
                ->where('paid_at' , '!=' , null)
                ->whereNot('status' , '=' , 'not active')
                ->get(['payment_package_id','limit']);
            return response()->json($payments);
        }catch (\Throwable $throwable){
            return response()->json($throwable->getMessage());
        }
    }

    public function organization(): \Illuminate\Http\JsonResponse
    {
        try {
            $user_id = auth()->id();
            $organization = Organization::with(['User'=>function($query){
                $query->select('id' , 'name' , 'family');
            }])->where('user_id',$user_id)
                ->get(['organizations_name','user_id']);
            if ($organization[0]->hasMedia('logo')){
                $image =$organization[0]->getMedia('logo');
                $avatar_id = $image[0]->getUrl();
                $organization->setAttribute('avatar' , $avatar_id);
            }
            return response()->json($organization);
        }catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}

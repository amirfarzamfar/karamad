<?php

namespace App\Http\Controllers\Admin\Organization;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class UpdateOrganizationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user_id = auth()->id();
            Organization::where('user_id' , $user_id)->update([
                "job_category_id"=>$request->job_category_id,
                "organizations_name"=>$request->organizations_name,
                "organizations_phone_number"=>$request->organizations_phone_number,
                "organizations_email"=>$request->organizations_email,
                "organizations_web_address"=>$request->organizations_web_address,
                "organizations_about"=>$request->organizations_about,
                "province_id"=>$request->province_id,
                "city_id"=>$request->city_id,
                "organizations_address"=>$request->organizations_address,
                "number_of_staff"=>$request->number_of_staff,
            ]);
            $organization = Organization::where('user_id' , $user_id)->first();
            if ($organization->hasMedia('logo')){
                $organization->clearMediaCollection('logo');
            }
            if ($organization->hasMedia('hero'))
            {
                $organization->clearMediaCollection('hero');
            }
            if ($organization->hasMedia('image_1'))
            {
                $organization->clearMediaCollection('image_1');
            }
            if ($organization->hasMedia('image_2'))
            {
                $organization->clearMediaCollection('image_2');
            }
            if ($request->logo !==null ){
                    $organization->addMedia($request->logo)->toMediaCollection('logo');
            }
            if ($request->hero !==null ){
                    $organization->addMedia($request->hero)->toMediaCollection('hero');
            }
            if ($request->image_2 !==null ){
                    $organization->addMedia($request->image_1)->toMediaCollection('image_1');
            }
            if ($request->image_1 !==null ){
                    $organization->addMedia($request->image_2)->toMediaCollection('image_2');
            }
            return response()->json('success');
        }catch (\Throwable $th){
            return response()->json([$th->getMessage()]);
        }
    }
}

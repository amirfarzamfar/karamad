<?php

namespace App\Http\Controllers\Admin\Organization;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    protected $organization;
    public function __construct()
    {
        $user_id=auth()->id();
        $this->organization = Organization::where('user_id' , $user_id)->first();
    }
    public function uploadLogo(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->organization->addMedia($request->logo)->toMediaCollection('logo');
            return response()->json('success');
        }catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
    public function uploadHero(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->organization->addMedia($request->hero)->toMediaCollection('hero');
            return response()->json('success');
        }catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
    public function uploadImage_1(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->organization->addMedia($request->image_1)->toMediaCollection('image_1');
            return response()->json('success');
        }catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
    public function uploadImage_2(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->organization->addMedia($request->image_2)->toMediaCollection('image_2');
            return response()->json('success');
        }catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}

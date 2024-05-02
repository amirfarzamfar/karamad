<?php

namespace App\Http\Controllers\Admin\Organization;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class ShowOrganizationController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            $user_id = auth()->id();
            $Organization = Organization::with( 'jobCategory' ,'city' , 'province')->where('user_id' , $user_id)->first();
            $Organization->setAttribute('decoded_category' , base64_decode($Organization->jobCategory->job_category_name));
            if ($Organization->hasMedia('logo')){
                $mediaItems =  $Organization->getMedia('logo');
                $Url = $mediaItems[0]->getUrl();
                $Organization->setAttribute('logo_url' , $Url);
            }
            if ($Organization->hasMedia('hero')){
                $mediaItems =  $Organization->getMedia('hero');
                $Url = $mediaItems[0]->getUrl();
                $Organization->setAttribute('hero_url' , $Url);
            }
            if ($Organization->hasMedia('image_1')){
                $mediaItems =  $Organization->getMedia('image_1');
                $Url = $mediaItems[0]->getUrl();
                $Organization->setAttribute('image_1_url' , $Url);
            }
            if ($Organization->hasMedia('image_2')){
                $mediaItems =  $Organization->getMedia('image_2');
                $Url = $mediaItems[0]->getUrl();
                $Organization->setAttribute('image_2_url' , $Url);
            }
            return response()->json([$Organization]);
        }catch (\Throwable $th){
            return response()->json([$th->getMessage()]);
        }

    }
}

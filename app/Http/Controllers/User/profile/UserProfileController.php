<?php

namespace App\Http\Controllers\User\profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use function auth;
use function response;


class UserProfileController extends Controller
{
    public function index(): UserProfileResource|JsonResponse
    {
        $id = auth()->id();

        if( $id !== null){
            $user = User::find($id);

            if ($user->hasMedia()){
                $image = $user->getMedia();

                $avatar_id = $image[0]->getUrl();
            }else{
                $avatar_id = null;
            }
            $user_data = array(
                'user_name' => $user->name ,
                'user_family'=> $user->family,
                'avatar_url' => $avatar_id
            );

            return new UserProfileResource($user_data);
        }
        return response()->json(null);
    }
}

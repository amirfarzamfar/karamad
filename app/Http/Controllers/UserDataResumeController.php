<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowUserDataResource;
use App\Models\User;
use App\Models\User_data;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserDataResumeController extends Controller
{
    public function index(): ShowUserDataResource
    {
        $user_id = auth()->id();

        $user_data_status = User_data::where('user_id' , $user_id)->first();

        if ($user_data_status == null){

            $user = self::showUser($user_id);

            return new ShowUserDataResource($user);
        }else{
           $user_data = self::showUserData($user_id);

           return new ShowUserDataResource($user_data);
        }
    }

    public function showUser($user_id): array
    {
        $user = auth()->user();

        $avatar_status = User::find($user_id)->hasMedia();

        if ($avatar_status == true)
        {
            $avatar = User::find($user_id)->getMedia();

            $avatar_url = $avatar[0]->getUrl();

            return array(
                'name' => $user->name,
                'family' => $user->family,
                'phone_number' => $user->phone_number,
                'email' => $user->email,
                'avatar_url' => $avatar_url
            );
        }else{
            return array(
                'name' => $user->name,
                'family' => $user->family,
                'phone_number' => $user->phone_number,
                'email' => $user->email,
            );
        }
    }

    public function showUserData($user_id): array
    {
        $user_data = User_data::where('user_id' , $user_id)->first();

        $user_data_id = $user_data->id;

        $avatar_status = User_data::find($user_data_id)->hasMedia();

        if ($avatar_status == true)
        {
            $avatar = User_data::find($user_data_id)->getMedia();

            $avatar_url = $avatar[0]->getUrl();

            return array(
                'name' => $user_data->name,
                'family' => $user_data->family,
                'gender'=> $user_data->gender,
                'marital_status'=> $user_data->marital_status,
                'year_of_birth'=> $user_data->year_of_birth,
                'military_exemption'=> $user_data->military_exemption,
                'city'=> $user_data->city,
                'address' => $user_data->address,
                'about_me' => $user_data->about_me,
                'phone_number' => $user_data->phone_number,
                'email' => $user_data->email,
                'avatar_url' => $avatar_url
            );
        }else{
            return array(
                'name' => $user_data->name,
                'family' => $user_data->family,
                'gender'=> $user_data->gender,
                'marital_status'=> $user_data->marital_status,
                'year_of_birth'=> $user_data->year_of_birth,
                'military_exemption'=> $user_data->military_exemption,
                'city'=> $user_data->city,
                'address' => $user_data->address,
                'about_me' => $user_data->about_me,
                'phone_number' => $user_data->phone_number,
                'email' => $user_data->email,
            );
        }
    }

    public function UserData(Request $request): JsonResponse
    {
            $user_id = auth()->id();

            $user_data_status = User_data::where('user_id' , $user_id)->first();

            if ($user_data_status == null) {
                return self::createUserData($request);
            }else{
                return self::updateUserData($request , $user_id);
            }
    }

    public function createUserData($request): JsonResponse
    {
        try {
        User_data::create([
            'user_id'=> auth()->id(),
            'name'=>$request->name,
            'family'=>$request->family,
            'gender'=>$request->gender,
            'marital_status'=>$request->marital_status,
            'year_of_birth'=>$request->year_of_birth,
            'military_exemption'=>$request->military_exemption,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'city'=>$request->city,
            'address'=>$request->address,
            'about_me'=>$request->about_me,
        ])->addMediaFromRequest('image')
            ->toMediaCollection();

            return response()->json('Success');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function updateUserData($request , $user_id): JsonResponse
    {
        try {
            $user_data = User_data::where('user_id' , $user_id)->first();

            $user_data_id = $user_data->id;

            $avatar_status = User_data::find($user_data_id)->hasMedia();

            if ($avatar_status == true)
            {
                $user_data_avatar = User_data::find($user_data_id)->getMedia();

                $user_data_avatar[0]->delete();
            }

           $x = User_data::find($user_data_id)->update([
                'name'=>$request->name,
                'family'=>$request->family,
                'gender'=>$request->gender,
                'marital_status'=>$request->marital_status,
                'year_of_birth'=>$request->year_of_birth,
                'military_exemption'=>$request->military_exemption,
                'email'=>$request->email,
                'phone_number'=>$request->phone_number,
                'city'=>$request->city,
                'address'=>$request->address,
                'about_me'=>$request->about_me,
            ]);

             User_data::find($user_data_id)->addMediaFromRequest('image')->toMediaCollection();

            return response()->json('Success');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}

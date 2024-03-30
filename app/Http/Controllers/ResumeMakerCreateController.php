<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateResumeRequest;
use App\Http\Resources\ShowUserDataResource;
use App\Models\Resume;
use App\Models\User;
use App\Models\User_data;

class ResumeMakerCreateController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $user_id = auth()->id();

        $avatar = User::find($user_id)->getMedia();

        $avatar_url = $avatar[0]->getUrl();

        $user_avatar_array = array(
            'name' => $user->name,
            'family' => $user->family,
            'phone_number' => $user->phone_number,
            'email' => $user->email,
            'avatar_url' => $avatar_url
        );

        return new ShowUserDataResource($user_avatar_array);
    }


    public function create(CreateResumeRequest $request)
    {
        try {

            return 'ok';
        } catch (\Throwable $th) {

            return $th->getMessage();
        }
    }

   public function userData($request)
   {
         User_data::create([
           'user_id'=> 1,
           'name'=>$request->name,
           'family'=>$request->family,
           'year_of_birth'=>"2024-03-28 10:50:09",
           'military_exemption'=>$request->military_exemption,
           'email'=>$request->email,
           'phone_number'=>$request->phone_number,
           'city'=>$request->city,
           'address'=>$request->address,
           'about_me'=>$request->about_me,
       ])->addMediaFromRequest('image')
           ->toMediaCollection();
   }

   public function resume($request)
   {
        Resume::create([

        ]);
   }
}

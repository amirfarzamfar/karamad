<?php

namespace App\Http\Controllers\User\profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvatarRequest;
use App\Http\Requests\SidebarUser\EmailRequest;
use App\Http\Requests\SidebarUser\FamilyRequest;
use App\Http\Requests\SidebarUser\NameRequest;
use App\Http\Requests\SidebarUser\PhoneNumberRequest;
use App\Http\Resources\User\UserSidebarResource;
use App\Models\User;
use Illuminate\Http\Request;

class SidebarController extends Controller
{
    public function SidebarUserInfo()
    {
       $user = auth()->user();
//        if ($user->hasMedia()){
//            $image = $user->getMedia();
//            $url = $image[0]->getUrl();
//            $user->setAttribute('url' , $url);
//        }
        return  UserSidebarResource::make($user);

    }

    public function SetProfileAvatar(AvatarRequest $request)
    {

            $user = auth()->user();
            $user->addMedia($request->image)->toMediaCollection('avatar');

            return response()->json([
                'message' => 'آواتار با موفقیت ایجاد شد'
            ]);
    }

    public function EditName(NameRequest $request)
    {

         $user = auth()->user();
         $user->update([
             'name' =>$request->name,
         ]);
         return response()->json([
            'message' => 'success'
         ]);
    }
    public function EditFamily(FamilyRequest $request)
    {

         $user = auth()->user();
         $user->update([
             'family' =>$request->family,
         ]);
         return response()->json([
            'message' => 'success'
         ]);
    }
    public function EditEmail(EmailRequest $request)
    {

         $user = auth()->user();
         $user->update([
             'email' =>$request->email,
         ]);
         return response()->json([
            'message' => 'success'
         ]);
    }
    public function EditPhoneNumber(PhoneNumberRequest $request)
    {

         $user = auth()->user();
         $user->update([
             'phone_number' =>$request->phone_number,
         ]);
         return response()->json([
            'message' => 'success'
         ]);
    }

}

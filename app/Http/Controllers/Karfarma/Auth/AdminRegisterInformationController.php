<?php

namespace App\Http\Controllers\Karfarma\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Organization;
use App\Models\User;
use App\Models\User_data;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminRegisterInformationController extends Controller
{

//    public $user_id;
//    public function createAdminInformation(Request $request)
//    {
//
//        try {
//
//           self::createAdminData($request);
//            self::organizationCreate($request);
//
//
//            return response()->json('success');
//        }catch (\Throwable $th){
//            return response()->json(
//                $th->getMessage()
//            );
//        }
//    }

    public function organizationCreate(Request $request)
    {
//        dd($request);
        $phoneNumber = $request->input('phone_number');
        $admin = User::where('phone_number', $phoneNumber)->with('organization')->first();
        $this->user_id = $admin->id;

        if ($admin) {
            if ($admin->is_phone_verified()) {

                $organization = Organization::create([
                    'user_id' => $this->user_id,
                    'job_category_id'=> $request->input('job_category_id'),
                    'organizations_name'=>$request->input('organizations_name'),
                    'organizations_phone_number'=>$request->input('organizations_phone_number'),
                    'organizations_email'=>$request->input('organizations_email'),
                    'organizations_about'=>$request->input('organizations_about'),
                    'province_id'=>$request->input('province_id'),
                    'city_id'=>$request->input('city_id'),
                    'organizations_address'=>$request->input('organizations_address'),
                    'organizations_web_address'=>$request->input('organizations_web_address'),
                    'number_of_staff'=>$request->input('number_of_staff'),
                ]);

                if ($request->hasFile('image')) {
                    $organization->addMediaFromRequest('image')->toMediaCollection('OrganizationLogo');
                }



                return response()->json([
                    'message' =>'Your account information has been registered',
                ]);


            } else {
                return \response()->json([
                    'message' => 'First must verify your phone number.'
                ], 422);
            }}
        else {
            return \response()->json([
                'message' => 'Phone number not found.'
            ], 422);
        }

            }


}



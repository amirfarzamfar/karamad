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

    public $user_id;
    public function createAdminInformation(Request $request)
    {

        try {

           self::createAdminData($request);
            self::organizationCreate($request);


            return response()->json('success');
        }catch (\Throwable $th){
            return response()->json(
                $th->getMessage()
            );
        }
    }

    public function createAdminData($request)
    {
        $phoneNumber = $request->input('phone_number');
        $admin = User::where('phone_number', $phoneNumber)->with('organization')->first();
        $this->user_id = $admin->id;

        if ($admin) {
            if ($admin->is_phone_verified()) {

                $admin->update([
                    'name' => $request->input('name'),
                    'family' => $request->input('family'),
                    'email' => $request->input('email'),
                    'national_id' => $request->input('national_id'),
                    'password' => Hash::make($request->input('password')),
                    'password_confirmation' => Hash::make($request->input('password_confirmation')),

                ]);


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

            public function organizationCreate($request)
            {

                Organization::create([
                    'user_id' => $this->user_id,
                    'organization_name'=>$request->input('organization_name'),
                    'organization_phone_number'=>$request->input('organization_phone_number'),
                    'organization_email'=>$request->input('organization_email'),
                    'organization_about'=>$request->input('organization_about'),
                    'city/province'=>$request->input('city/province'),
                    'organization_address'=>$request->input('organization_web_address'),
                    'organization_web_address'=>$request->input('organization_address'),
                    'number_of_staff'=>$request->input('number_of_staff')
                ]);
            }
}



<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{


    public function create_user(CreateUserRequest $request)
    {


        $user = User::where('phone_number', $request->input('phone_number'))->first();

        if ($user) {
            if ($user->is_phone_verified()) {
                $user->update([
                    'name' => $request->validated('name'),
                    'family' => $request->validated('family'),
                    'email' => $request->validated('email'),
                    'password' => Hash::make($request->validated('password')),
                    'password_confirmation' => Hash::make($request->validated('password_confirmation')),

                ]);


                return response()->json([
                    'message' =>'Your account information has been registered'
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

        }}

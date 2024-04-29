<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\RegisterEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Phone_number_check;
use App\Models\PhoneNumbercheck;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

        public function __invoke(RegisterRequest $request)
    {

        $user_exist_check = User::where('phone_number', $request->validated('phone_number'))->exists();

        if (!$user_exist_check) {
            $user = User::create([
                'phone_number' => $request->validated('phone_number')
            ]);
            $code = rand(100000, 999999);

            Phone_number_check::create([
                'phone_number' => $user->phone_number,
                'password' => $code
            ]);

            event(new RegisterEvent($user, $code));
            $user->assignRole('user');

            return \response()->json([
                'message' => 'Code sent.',
                'otpCode'=>$code
            ]);
        } else {
            return \response()->json([
                'message' => 'User already registered.'
            ], 422);
        }

    }
    }




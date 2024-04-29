<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PhoneNumberCheckRequest;
use App\Http\Resources\User\UserResource;
use App\Models\Phone_number_check;
use App\Models\User;
use Carbon\Carbon;

class PhoneNumberCheckController extends Controller
{


    public function number_check(PhoneNumberCheckRequest $request)
    {

        // get data from database
        $user = User::where('phone_number', $request->validated('phone_number'))->first();
        $pass = Phone_number_check::where('phone_number', $request->validated('phone_number'))->orderByDesc('created_at')->first();
        /*(new User())->phone_verfied_at();*/

        // check password
        if ($pass->created_at->addMinute(2) > Carbon::now()) {

            if ($pass->password == $request->input('password')) {

                $pass->delete();
                $user->phone_number_verified_at();

                return \response()->json([
                    'message' => 'Phone number verified.'
                ]);
            } else {
                return response()->json([
                    'message' => 'Code was incorrect.'
                ], 422);
            }
        } else {
            $pass->delete();
            $user->delete();
            return response()->json([
                "message" => "Code Expired."
            ], 422);
        }
    }
}

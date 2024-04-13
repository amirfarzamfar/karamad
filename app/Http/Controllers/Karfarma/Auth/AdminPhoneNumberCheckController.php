<?php

namespace App\Http\Controllers\Karfarma\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PhoneNumberCheckRequest;
use App\Models\Phone_number_check;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminPhoneNumberCheckController extends Controller
{
    public function admin_number_check(PhoneNumberCheckRequest $request)
    {

        // get data from database
        $user = User::where('phone_number', $request->input('phone_number'))->first();
        $pass = Phone_number_check::where('phone_number', $request->input('phone_number'))->orderByDesc('created_at')->first();


        // check password
        if ($pass->created_at->addMinute(5) > Carbon::now()) {

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

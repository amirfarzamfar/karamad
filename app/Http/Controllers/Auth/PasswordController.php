<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\ResetPasswordEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetCheckRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\PhoneNumbercheck;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function reset_password_send_sms(ResetPasswordRequest $request)
    {
        $user = User::where('phone_number', $request->validated('phone_number'))->first();

        if ($user) {
            $code = rand(100000, 999999);
            PhoneNumbercheck::create([
                'phone_number' => $user->phone_number,
                'password' => $code
            ]);

            event(new ResetPasswordEvent($user, $code));

            return \response()->json([
                'message' => 'Code sent.'
            ]);

        } else {
            return \response()->json([
                'message' => 'Phone number not found.'
            ], 404);
        }
    }

    public function check_reset_password(PasswordResetCheckRequest $request)
    {

        $user = User::where('phone_number', $request->validated('phone_number'))->first();
        $code = PhoneNumbercheck::where('phone_number', $request->validated('phone_number'))->orderByDesc('created_at')->first();

        if ($code->created_at->addMinute(3) > Carbon::now()) {
            if ($code->password == $request->validated('code')) {
                $code->delete();
                $user->reset_pass_verified_at();
                return \response()->json([
                    'message' => 'Phone number verified.'
                ]);
            } else {
                return response()->json([
                    'message' => 'Code was incorrect.'
                ], 422);
            }
        } else {
            $code->delete();
            return response()->json([
                "message" => "Code Expired."
            ], 422);
        }
    }


}

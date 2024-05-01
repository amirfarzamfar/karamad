<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\ResetPasswordEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetCheckRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SetPasswordRequest;
use App\Http\Requests\Auth\UpdateForgetPassRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Resources\User\LoginResource;
use App\Models\Phone_number_check;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{



    public function reset_password_send_sms(ResetPasswordRequest $request)
    {

        $user = User::where('phone_number', $request->validated('phone_number'))->first();

        if ($user) {
            $code = rand(100000, 999999);
            Phone_number_check::create([
                'phone_number' => $user->phone_number,
                'password' => $code
            ]);

            event(new ResetPasswordEvent($user, $code));

            return \response()->json([
                'message' => 'Code sent.',
                'code'=> $code
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
        $code = Phone_number_check::where('phone_number', $request->validated('phone_number'))->orderByDesc('created_at')->first();

        if ($code->created_at->addMinute(3) > Carbon::now()) {
            if ($code->password == $request->validated('password')) {
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

    public function update_password(UpdateForgetPassRequest $request)
    {
        $user = User::where('phone_number', $request->validated('phone_number'))->first();

        if ($user->is_reset_verified()) {

            $user->update([
                'password' => Hash::make($request->validated('new_password')),
                'password_confirmation' => Hash::make($request->validated('password_confirmation')),

            ]);

            $user->undo_reset_pass_verified();

            return \response()->json([
                'message' => 'Password updated.'
            ]);
        } else {
            return \response()->json([
                'message' => 'First you must verify your phone number.'
            ], 422);
        }
    }

    public function new_password(UpdatePasswordRequest $request)
    {
        $user = auth()->user();

        if (Hash::check($request->validated('old_password'), $user->password)) {
            $user->update([
                'password' => Hash::make($request->validated('new_password'))
            ]);

            return \response()->json([
                'message' => 'Password updated.'
            ]);
        }

        return \response()->json([
            'message' => 'Password not match'
        ], 422);
    }
}

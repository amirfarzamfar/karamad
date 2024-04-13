<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EditProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditUserController extends Controller
{

    public function __construct(User $user)
    {
        $this->middleware('auth');
    }
    public function edit_user_profile(EditProfileRequest $request)
    {

        $user = \auth()->user();

        $user->update([
            'name' => $request->name,
            'family' => $request->name,
            'email' => $request->email,
        ]);
        return response()->json([
           'message' => 'your profile has been edited'
        ]);


    }
}

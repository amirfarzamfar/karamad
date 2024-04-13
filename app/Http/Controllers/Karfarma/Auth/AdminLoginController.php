<?php

namespace App\Http\Controllers\Karfarma\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\LoginResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {


        $admin = User::where('phone_number', $request->validated('input'))
            ->orWhere('email', $request->validated('input'))
            ->first();


        if (!$admin || !Hash::check($request->validated('password'), $admin->password)) {
            throw ValidationException::withMessages([
                'message' => 'Incorrect inputs.'
            ]);
        }





        return  LoginResource::make($admin);
    }
}

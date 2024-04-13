<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthControlller extends Controller
{

   public function redirectToGoogle()
   {


       return Socialite::driver('google')->redirect();
   }


public function callbackGoogle()
{

    $user = Socialite::driver('google')->user();

    $userQuery = User::query()->where('email' , $user->getEmail());

    if($userQuery->exists()){
        $authenticateUser = $userQuery->first();
    }else{
        $authenticateUser = User::query()->create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => bcrypt(Carbon::now()->timestamp),
            'phone_number'=> rand(0, 99999),
        ]);

    }
    \auth()->login($authenticateUser);




}
}

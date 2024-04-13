<?php

use App\Http\Controllers\Auth\GoogleAuthControlller;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/auth", function () {
    $user = \App\Models\User::whereEmail('amir@gmail.com')->first();
    Auth::login($user, true);
});

Route::get("/login", function () {
    return Socialite::driver('google')->redirect();
});
Route::get("/google-login", [GoogleAuthControlller::class, 'callbackGoogle']);

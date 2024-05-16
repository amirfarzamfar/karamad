<?php

use App\Http\Controllers\Auth\EditUserController;
use App\Http\Controllers\Auth\GoogleAuthControlller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PhoneNumberCheckController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Karfarma\Auth\AdminLoginController;
use App\Http\Controllers\Karfarma\Auth\AdminLogoutController;
use App\Http\Controllers\Karfarma\Auth\AdminPhoneNumberCheckController;
use App\Http\Controllers\Karfarma\Auth\AdminRegisterInformationController;
use App\Http\Controllers\Karfarma\Auth\RegisterAdminController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

//karjoo

Route::post('/register', RegisterController::class)->name('user.register');
Route::post('/register_user', [UserRegisterController::class, 'create_user'])->name('user.create');
Route::post('/number-check', [PhoneNumberCheckController::class, 'number_check'])->name('phone-number-check');
Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth:sanctum')->name('user.logout');
Route::post('/login', LoginController::class)->name('login');
Route::post('/edit-user-profile', [EditUserController::class, 'edit_user_profile'])->middleware('auth:sanctum')->name('user.edit-user-profile');
Route::post('/forget-password', [PasswordController::class, 'reset_password_send_sms'])->name('user.reset_password');
Route::post('/check_reset_pass', [PasswordController::class, 'check_reset_password'])->name('user.reset.password');
Route::post('/update-password', [PasswordController::class, 'update_password'])->name('user.reset.password1');
Route::post('/new-password', [PasswordController::class, 'new_password'])->middleware('auth:sanctum')->name('user.new_password');


//karfarma

Route::prefix('admin')->name('admin.')->group(function () {

    Route::post('/register', RegisterAdminController::class)->name('user.register');
    Route::post('/number-check', [AdminPhoneNumberCheckController::class, 'admin_number_check'])->name('phone-number-check');
    Route::post('/register_admin_information',[AdminRegisterInformationController::class,'organizationCreate'])->name('create_admin');
//    Route::post('/admin_information',[AdminRegisterInformationController::class,'createAdminInformation'])->name('create_admin');
    Route::post('/login', AdminLoginController::class)->name('login');
    Route::post('/logout', AdminLogoutController::class)->middleware('auth:sanctum')->name('logout');
    Route::post('/forget-password', [PasswordController::class, 'reset_password_send_sms'])->name('user.reset_password');
    Route::post('/check_reset_pass', [PasswordController::class, 'check_reset_password'])->name('user.reset.password');
    Route::post('/update-password', [PasswordController::class, 'update_password'])->name('user.reset.password1');
    Route::post('/new-password', [PasswordController::class, 'new_password'])->middleware('auth:sanctum')->name('user.new_password');
});


//google

Route::post("/login-with-google", [GoogleAuthControlller::class, 'redirectToGoogle']);

//Route::get("/login-with-google",function (){
//
//    return Socialite::driver('google')->redirect();
//});

Route::get("/google-login",[GoogleAuthControlller::class,'callbackGoogle']);



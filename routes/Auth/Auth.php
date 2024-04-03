<?php

use App\Http\Controllers\Auth\EditUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PhoneNumberCheckController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserRegisterController;
use Illuminate\Support\Facades\Route;


Route::post('/register', RegisterController::class)->name('user.register');
Route::post('/register_user', [UserRegisterController::class,'create_user'])->name('user.create');
Route::post('/set-password', [PasswordController::class, 'set_password'])->name('user.set_password');
Route::post('/number-check',[PhoneNumberCheckController::class, 'number_check'])->name('phone-number-check');
Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth:sanctum')->name('user.logout');
Route::post('/forget-password', [PasswordController::class, 'reset_password_send_sms'])->name('user.reset_password');
Route::post('/update-password', [PasswordController::class, 'update_password'])->name('user.reset.password1');
Route::post('/login', LoginController::class)->name('login');
Route::post('/new-password', [PasswordController::class, 'new_password'])->middleware('auth:sanctum')->name('user.new_password');
Route::post('/check_reset_pass', [PasswordController::class, 'check_reset_password'])->name('user.reset.password');
Route::post('/edit-user-profile',[EditUserController::class,'edit_user_profile'])->middleware('auth:sanctum')->name('user.edit-user-profile');

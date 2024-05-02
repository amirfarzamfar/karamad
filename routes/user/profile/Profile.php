<?php
use App\Http\Controllers\User\profile\UserProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/userProfile' , [UserProfileController::class , 'index'])->name('UserProfile')->middleware('auth:sanctum');

<?php
use App\Http\Controllers\User\profile\UserProfileController;
use Illuminate\Support\Facades\Route;


Route::post('/userProfile' , [UserProfileController::class , 'index'])->name('UserProfile');

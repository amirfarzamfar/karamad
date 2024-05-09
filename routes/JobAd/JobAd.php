<?php


use App\Http\Controllers\jobAd\MarkedAdController;
use App\Http\Controllers\jobAd\PostedResumeController;
use App\Http\Controllers\JobSeeker\ProfileSidebarController;
use App\Http\Controllers\Karfarma\Advertisement\AdsManagementController;
use Illuminate\Support\Facades\Route;




Route::post('/marked_ad_register',[ProfileSidebarController::class,'markedAdRegiter'])->middleware('auth:sanctum');
Route::post('/marked_ad_show',[ProfileSidebarController::class,'markedAdShow'])->middleware('auth:sanctum');
Route::post('/profile_sidebar',[ProfileSidebarController::class,'sideBar'])->middleware('auth:sanctum');
Route::post('/posted_resume',[ProfileSidebarController::class,'postedResume'])->middleware('auth:sanctum');
Route::post('/all_ads',[AdsManagementController::class,'allAds'])->middleware('auth:sanctum');
Route::post('/edit_ads',[AdsManagementController::class,'editAdd'])->middleware('auth:sanctum');


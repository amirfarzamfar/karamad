<?php


use App\Http\Controllers\jobAd\MarkedAdController;
use App\Http\Controllers\jobAd\PostedResumeController;
use App\Http\Controllers\JobSeeker\ProfileSidebarController;
use Illuminate\Support\Facades\Route;




Route::post('/marked_ad',[ProfileSidebarController::class,'markedAd']);
Route::post('/posted_resume',[ProfileSidebarController::class,'postedResume']);


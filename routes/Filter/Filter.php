<?php


use App\Http\Controllers\Filter\FilterController;
use Illuminate\Support\Facades\Route;



Route::get('/newest_job_ad',[FilterController::class,'newestJobAd']);
Route::post( '/filter_job_ad',[FilterController::class,'FilterJobAd']);
Route::post( '/search',[FilterController::class,'SearchJobAd']);

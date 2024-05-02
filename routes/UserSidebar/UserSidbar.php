<?php


use App\Http\Controllers\User\profile\SidebarController;
use Illuminate\Support\Facades\Route;




Route::get('/user/info' , [SidebarController::class , 'SidebarUserInfo'])->middleware('auth:sanctum');
Route::post('/user/set-avatar' , [SidebarController::class , 'SetProfileAvatar'])->middleware('auth:sanctum');


    Route::post('edit/name',[SidebarController::class,'EditName'])->middleware('auth:sanctum');
    Route::post('edit/family',[SidebarController::class,'EditFamily'])->middleware('auth:sanctum');
    Route::post('edit/phone-number',[SidebarController::class,'EditPhoneNumber'])->middleware('auth:sanctum');
    Route::post('edit/email',[SidebarController::class,'EditEmail'])->middleware('auth:sanctum');


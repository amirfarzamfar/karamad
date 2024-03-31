<?php

use App\Http\Controllers\UserDataResumeController;
use App\Http\Controllers\ResumeMakerWorkplaceController;
use App\Http\Controllers\WorkplaceController;
use Illuminate\Support\Facades\Route;



/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/', function () {
    return redirect()->route('user.workplace.Authenticated');
});

//work place
Route::get('/workplace',[WorkplaceController::class , 'index'])->name('user.workplace.Authenticated');

Route::get('/ResumeMaker/workplace' , [ResumeMakerWorkplaceController::class , 'index'])->name('ResumeMaker.workplace');
Route::get('/ResumeMaker/show/userdata' , [UserDataResumeController::class , 'index'])->name('ResumeMaker.show.userdata');
Route::post('/ResumeMaker/create/userdata' , [UserDataResumeController::class , 'UserData'])->name('ResumeMaker.create.userdata');

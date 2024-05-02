<?php
use App\Http\Controllers\Admin\resume\SetResumeStatusController;
use App\Http\Controllers\Admin\resume\ShowResumesController;
use App\Http\Controllers\User\resume\DownloadResumeController;
use App\Http\Controllers\User\resume\ShowResumeController;
use Illuminate\Support\Facades\Route;


Route::prefix('advertisement')->group(function (){
    Route::get('/show/resumes/{advertisement_id}',[ShowResumesController::class , 'index'])->whereNumber('advertisement_id')->name('admin.show.resumes')->middleware(['auth:sanctum','checkAdminForAd']);
    Route::get('/show/resume/{resume_id}',[ShowResumeController::class , 'adminSeeResume'])->whereNumber('resume_id')->name('admin.show.resume')->middleware(['auth:sanctum','checkAdminForResume']);
    Route::post('/set/resume/status/{resume_id}/{status}', [SetResumeStatusController::class , 'Set'])->whereNumber('resume_id')->name('admin.set.resumeStatus')->middleware(['auth:sanctum','checkAdminForResume']);
    Route::post('/download/admin/{personalResume_id}',[DownloadResumeController::class , 'index'])->name('admin.download.resume')->middleware('auth:sanctum');

});

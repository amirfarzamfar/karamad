<?php
use App\Http\Controllers\Admin\resume\SetResumeStatusController;
use App\Http\Controllers\Admin\resume\ShowResumeController;
use App\Http\Controllers\Admin\resume\ShowResumesController;
use Illuminate\Support\Facades\Route;


Route::prefix('advertisement')->group(function (){
    Route::get('/show/resumes/{advertisement_id}',[ShowResumesController::class , 'index'])->whereNumber('advertisement_id')->name('admin.show.resumes')/*->middleware(['checkAdminForAd'])*/;
    Route::get('/show/resume/{resume_id}',[ShowResumeController::class , 'index'])->whereNumber('resume_id')->name('admin.show.resume')/*->middleware(['checkAdminForResume'])*/;
    Route::post('/set/resume/status/{resume_id}', [SetResumeStatusController::class , 'Set'])->whereNumber('resume_id')->name('admin.set.resumeStatus')/*->middleware(['checkAdminForResume'])*/;
});

<?php
use App\Http\Controllers\User\resume\CreateResumeController;
use App\Http\Controllers\User\resume\ResumeMakerWorkplaceController;
use App\Http\Controllers\User\resume\SendResumeController;
use App\Http\Controllers\User\resume\UpdateResumeController;
use Illuminate\Support\Facades\Route;





Route::prefix('resume')->group(function (){
    Route::get('/workplace' , [ResumeMakerWorkplaceController::class , 'index'])->name('user.Resume.workplace');
    Route::get('/show' , [CreateResumeController::class , 'index'])->name('user.Resume.show');
    Route::post('/create' , [CreateResumeController::class , 'create'])->name('user.Resume.create');
    Route::post('/send/{advertisement_id}' , [SendResumeController::class , 'send'])->name('user.Resume.send')/*->middleware(['hasResume','sendOnce'])*/;
    Route::patch('/update' , [UpdateResumeController::class, 'update'])->name('user.Resume.update');
    Route::delete('/delete/personalResume/{unique_name}' , [UpdateResumeController::class , 'deletePersonalResume'])->name('user.Resume.PersonalResume.delete');
});

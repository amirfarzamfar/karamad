<?php
use App\Http\Controllers\User\resume\CreateResumeController;
use App\Http\Controllers\User\resume\DeleteResumeController;
use App\Http\Controllers\User\resume\ShowResumeController;
use App\Http\Controllers\User\resume\SendResumeController;
use App\Http\Controllers\User\resume\UpdateResumeController;
use App\Http\Controllers\User\resume\UploadResumeController;
use Illuminate\Support\Facades\Route;





Route::prefix('resume')->group(function (){
    Route::get('/workplace' , [ShowResumeController::class , 'index'])->name('user.Resume.workplace');
    Route::get('/show' , [CreateResumeController::class , 'index'])->name('user.Resume.show');
    Route::post('/create' , [CreateResumeController::class , 'create'])->name('user.Resume.create');
    Route::post('/send/{advertisement_id}' , [SendResumeController::class , 'send'])->whereNumber('advertisement_id')->name('user.Resume.send')/*->middleware(['hasResume','sendOnce'])*/;
    Route::post('/upload/educationalRecord/{user_data_id}',[UploadResumeController::class , 'uploadEducationalRecord'])->name('user.resume.upload.educationalRecord');
    Route::post('/upload/skills/{user_data_id}',[UploadResumeController::class , 'uploadSkill'])->name('user.resume.upload.skill');
    Route::post('/upload/workExperience/{user_data_id}',[UploadResumeController::class , 'uploadWorkExperience'])->name('user.resume.upload.workExperience');
    Route::post('/upload/personalResume/{user_data_id}',[UploadResumeController::class , 'uploadPersonalResume'])->name('user.resume.upload.personalResume');
    Route::delete('/delete/educationalRecord/{educationalRecord_id}' , [DeleteResumeController::class , 'deleteEducationalRecord'])->name('user.Resume.educationalRecord.delete');
    Route::delete('/delete/Skills/{skill_id}' , [DeleteResumeController::class , 'deleteSkill'])->name('user.Resume.skill.delete');
    Route::delete('/delete/workExperience/{workExperience_id}' , [DeleteResumeController::class , 'deleteWorkExperience'])->name('user.Resume.workExperience.delete');
    Route::delete('/delete/personalResume/{personalResume_id}' , [DeleteResumeController::class , 'deletePersonalResume'])->name('user.Resume.personalResume.delete');
    Route::patch('/update' , [UpdateResumeController::class, 'update'])->name('user.Resume.update');
});

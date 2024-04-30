<?php
use App\Http\Controllers\User\resume\CreateResumeController;
use App\Http\Controllers\User\resume\DeleteResumeController;
use App\Http\Controllers\User\resume\DownloadResumeController;
use App\Http\Controllers\User\resume\ShowResumeController;
use App\Http\Controllers\User\resume\SendResumeController;
use App\Http\Controllers\User\resume\UpdateResumeController;
use App\Http\Controllers\User\resume\UploadResumeController;
use Illuminate\Support\Facades\Route;





Route::prefix('resume')->group(function (){
    Route::get('/workplace' , [ShowResumeController::class , 'userSeeResume'])->name('user.Resume.workplace');
    Route::post('/create' , [CreateResumeController::class , 'create'])->name('user.Resume.create');
    Route::post('/send/{advertisement_id}' , [SendResumeController::class , 'send'])->whereNumber('advertisement_id')->name('user.Resume.send')->middleware(['hasResume','sendOnce']);
    Route::post('/upload/educationalRecord/{user_data_id}',[UploadResumeController::class , 'uploadEducationalRecord'])->name('user.resume.upload.educationalRecord')->middleware('checkUserForUploadResume');
    Route::post('/upload/skills/{user_data_id}',[UploadResumeController::class , 'uploadSkill'])->name('user.resume.upload.skill')->middleware('checkUserForUploadResume');
    Route::post('/upload/workExperience/{user_data_id}',[UploadResumeController::class , 'uploadWorkExperience'])->name('user.resume.upload.workExperience')->middleware('checkUserForUploadResume');
    Route::post('/upload/personalResume/{user_data_id}',[UploadResumeController::class , 'uploadPersonalResume'])->name('user.resume.upload.personalResume')->middleware('checkUserForUploadResume');
    Route::post('/upload/image/{user_data_id}',[UploadResumeController::class , 'uploadImage'])->name('user.resume.upload.image')->middleware('checkUserForUploadResume');
    Route::post('/download/user/{personalResume_id}',[DownloadResumeController::class , 'index'])->name('user.download.resume')/*->middleware()*/;

    Route::delete('/delete/educationalRecord/{educationalRecord_id}' , [DeleteResumeController::class , 'deleteEducationalRecord'])->name('user.Resume.educationalRecord.delete')->middleware('checkUserForDeleteResume');
    Route::delete('/delete/Skills/{skill_id}' , [DeleteResumeController::class , 'deleteSkill'])->name('user.Resume.skill.delete')->middleware('checkUserForDeleteResume');
    Route::delete('/delete/workExperience/{workExperience_id}' , [DeleteResumeController::class , 'deleteWorkExperience'])->name('user.Resume.workExperience.delete')->middleware('checkUserForDeleteResume');
    Route::delete('/delete/personalResume/{personalResume_id}' , [DeleteResumeController::class , 'deletePersonalResume'])->name('user.Resume.personalResume.delete')->middleware('checkUserForDeleteResume');
    Route::delete('/delete/image/{user_data_id}' , [DeleteResumeController::class , 'deleteImage'])->name('user.Resume.image.delete')->middleware('checkUserForDeleteResume');

    Route::patch('/update' , [UpdateResumeController::class, 'update'])->name('user.Resume.update');
});

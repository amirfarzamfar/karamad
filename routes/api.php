<?php

use App\Http\Controllers\AdvertisementCreateController;
use App\Http\Controllers\CreateResumeController;
use App\Http\Controllers\ResumeMakerWorkplaceController;
use App\Http\Controllers\SendResumeController;
use App\Http\Controllers\ShowAdController;
use App\Http\Controllers\UpdateResumeController;
use App\Http\Controllers\UserProfileController;
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
Route::post('/userProfile' , [UserProfileController::class , 'index'])->name('UserProfile');

Route::prefix('resume')->group(function (){
Route::get('/workplace' , [ResumeMakerWorkplaceController::class , 'index'])->name('user.Resume.workplace');
Route::get('' , [CreateResumeController::class , 'index'])->name('user.Resume.show');
Route::post('/create' , [CreateResumeController::class , 'create'])->name('user.Resume.create');
Route::post('/send/{advertisement_id}' , [SendResumeController::class , 'send'])->name('user.Resume.send');
Route::patch('/update' , [UpdateResumeController::class, 'update'])->name('user.Resume.update');
Route::delete('/delete/personalResume/{unique_name}' , [UpdateResumeController::class , 'deletePersonalResume'])->name('user.Resume.PersonalResume.delete');
});

Route::prefix('advertisement')->group(function (){
Route::get('show/{advertisement_id}' , [ShowAdController::class, 'show'])->name('user.advertisement.show');
Route::post('/create' , [AdvertisementCreateController::class, 'create'])->name('admin.advertisement.create');
});





Route::get('/download',function (){
    try {
        $file = 'files/1712046205scurm.pdf';
        $filePath = \Illuminate\Support\Facades\Storage::path($file);

        return response()->download($filePath);
    }catch (\Throwable $th){
        return response()->json($th->getMessage());
    }
})->name('file.download');


<?php

use App\Http\Controllers\CreateResumeController;
use App\Http\Controllers\ResumeMakerWorkplaceController;
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

Route::prefix('resumeMaker')->group(function (){
Route::get('/workplace' , [ResumeMakerWorkplaceController::class , 'index'])->name('ResumeMaker.workplace');
Route::get('' , [CreateResumeController::class , 'index'])->name('ResumeMaker.show');
Route::post('/create' , [CreateResumeController::class , 'create'])->name('ResumeMaker.create');
Route::patch('/update' , [UpdateResumeController::class, 'update'])->name('ResumeMaker.update');
});







Route::get('/test',function (){
    try {
        $file = 'files/1712046205scurm.pdf';
        $filePath = \Illuminate\Support\Facades\Storage::path($file);

        return response()->download($filePath);
    }catch (\Throwable $th){
        return response()->json($th->getMessage());
    }
})->name('file.download');


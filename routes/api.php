<?php

use Illuminate\Support\Facades\Route;



//my middlewares hasResume / sendOnce / checkAdminForAd / checkAdminForResume
/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/', function () {return redirect()->route('user.workplace');});

//user
require __DIR__ . '/user/workplace/Workplace.php';
require __DIR__ . '/user/profile/Profile.php';
require __DIR__ . '/user/resume/Resume.php';
require __DIR__ . '/user/advertisement/advertisement.php';

//admin
require __DIR__ . '/admin/advertisement/advertisement.php';






Route::get('/download',function (){
    try {
        $file = 'files/1712046205scurm.pdf';
        $filePath = \Illuminate\Support\Facades\Storage::path($file);

        return response()->download($filePath);
    }catch (\Throwable $th){
        return response()->json($th->getMessage());
    }
})->name('file.download');


Route::post('/test' , function (\Illuminate\Http\Request $request){
    \App\Models\Advertisement::find(3)->addMediaFromRequest('image')->toMediaCollection();
});


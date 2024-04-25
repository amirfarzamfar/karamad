<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('resume', [\App\Http\Controllers\FileController::class, 'saveFile']);

require __DIR__ . '/Auth/Auth.php';
require __DIR__ . '/JobAd/JobAd.php';
require __DIR__ . '/Filter/Filter.php';
require __DIR__ . '/Ticket/Ticket.php';







//my middlewares hasResume / sendOnce / checkAdminForAd / checkAdminForResume
/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/', function () {
    return redirect()->route('user.workplace');
});

//user
require __DIR__ . '/user/workplace/Workplace.php';
require __DIR__ . '/user/profile/Profile.php';
require __DIR__ . '/user/resume/Resume.php';
require __DIR__ . '/user/advertisement/advertisement.php';

//admin
require __DIR__ . '/admin/advertisement/advertisement.php';
require __DIR__ . '/admin/resume/resume.php';

//provinceCity
require __DIR__ . '/ProvinceCity/ProvinceCity.php';

//categories
require __DIR__ . '/Category/Category.php';


Route::get('/download', function () {
    try {
        $file = 'files/1712046205scurm.pdf';
        $filePath = \Illuminate\Support\Facades\Storage::path($file);

        return response()->download($filePath);
    } catch (\Throwable $th) {
        return response()->json($th->getMessage());
    }
})->name('file.download');


Route::post('/test', function (\Illuminate\Http\Request $request) {
  $x = base64_encode('ظاها');
    dd(base64_decode($x));
});

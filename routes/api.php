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
require __DIR__ . '/UserSidebar/UserSidbar.php';


//user
require __DIR__ . '/user/workplace/Workplace.php';
require __DIR__ . '/user/profile/Profile.php';
require __DIR__ . '/user/resume/Resume.php';
require __DIR__ . '/user/advertisement/advertisement.php';

//admin
require __DIR__ . '/admin/advertisement/advertisement.php';
require __DIR__ . '/admin/resume/resume.php';
require __DIR__ . '/admin/Organization/Organization.php';
require __DIR__ . '/admin/Payment/Payment.php';
require __DIR__ . '/admin/Counter/Counter.php';

//provinceCity
require __DIR__ . '/ProvinceCity/ProvinceCity.php';

//categories
require __DIR__ . '/Category/Category.php';


Route::post('/test', function (\Illuminate\Http\Request $request) {
  \App\Models\User::find(1)->addMedia($request->image)->toMediaCollection();
  return 'ok ';
});


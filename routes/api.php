<?php

use App\Http\Controllers\WorkplaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('/workplace',[WorkplaceController::class , 'index']);

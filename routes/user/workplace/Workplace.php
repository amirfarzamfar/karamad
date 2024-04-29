<?php

use App\Http\Controllers\User\workplace\WorkplaceController;
use Illuminate\Support\Facades\Route;


Route::get('/workplace/advertisement',[WorkplaceController::class , 'Advertisements'])->name('user.workplace.advertisement');
Route::get('/workplace/Benefits',[WorkplaceController::class , 'Benefits'])->name('user.workplace.Benefits');
Route::get('/workplace/Questions',[WorkplaceController::class , 'Questions'])->name('user.workplace.Questions');
Route::get('/workplace/Supports',[WorkplaceController::class , 'Supports'])->name('user.workplace.Supports');

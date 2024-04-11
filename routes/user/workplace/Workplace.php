<?php

use App\Http\Controllers\User\workplace\WorkplaceController;
use Illuminate\Support\Facades\Route;


Route::get('/workplace',[WorkplaceController::class , 'index'])->name('user.workplace');

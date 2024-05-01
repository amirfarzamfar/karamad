<?php

use App\Http\Controllers\Admin\Counter\CounterController;
use Illuminate\Support\Facades\Route;

Route::get('/counter/packages' , [CounterController::class , 'packages'])->name('admin.counter.packages');
Route::get('/counter/organization' , [CounterController::class , 'organization'])->name('admin.counter.organization');

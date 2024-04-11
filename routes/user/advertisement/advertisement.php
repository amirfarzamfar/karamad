<?php
use App\Http\Controllers\User\Advertisement\ShowAdController;
use Illuminate\Support\Facades\Route;


Route::get('advertisement/show/{advertisement_id}' , [ShowAdController::class, 'show'])->whereNumber('advertisement_id')->name('user.advertisement.show');

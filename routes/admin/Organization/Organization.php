<?php


use App\Http\Controllers\Admin\Organization\ShowOrganizationController;
use App\Http\Controllers\Admin\Organization\UpdateOrganizationController;
use Illuminate\Support\Facades\Route;

Route::get('/show/organization' , [ShowOrganizationController::class , 'index']);
Route::post('/update/organization' , [UpdateOrganizationController::class , 'index']);

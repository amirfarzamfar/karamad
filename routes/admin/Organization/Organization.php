<?php


use App\Http\Controllers\Admin\Organization\DeleteOrganizationController;
use App\Http\Controllers\Admin\Organization\ShowOrganizationController;
use App\Http\Controllers\Admin\Organization\UpdateOrganizationController;
use App\Http\Controllers\Admin\Organization\UploadImageController;
use Illuminate\Support\Facades\Route;

Route::get('/show/organization' , [ShowOrganizationController::class , 'index']);
Route::patch('/update/organization' , [UpdateOrganizationController::class , 'index']);
Route::delete('/delete/logo/organization' , [DeleteOrganizationController::class , 'index'])->name('admin.delete.logo.organization');
Route::delete('/delete/hero/organization' , [DeleteOrganizationController::class , 'index'])->name('admin.delete.hero.organization');
Route::delete('/delete/image_1/organization' , [DeleteOrganizationController::class , 'index'])->name('admin.delete.image_1.organization');
Route::delete('/delete/image_2/organization' , [DeleteOrganizationController::class , 'index'])->name('admin.delete.image_2.organization');
Route::post('/upload/logo/organization', [UploadImageController::class, 'uploadLogo'])->name('admin.upload.logo.organization');
Route::post('/upload/hero/organization' , [UploadImageController::class, 'uploadHero'])->name('admin.upload.hero.organization');
Route::post('/upload/image_1/organization', [UploadImageController::class, 'uploadImage_1'])->name('admin.upload.image_1.organization');
Route::post('/upload/image_2/organization', [UploadImageController::class, 'uploadImage_2'])->name('admin.upload.image_2.organization');

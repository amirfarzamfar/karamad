<?php
use App\Http\Controllers\Admin\advetisement\AdvertisementCreateController;
use Illuminate\Support\Facades\Route;


Route::post('advertisement/create' , [AdvertisementCreateController::class, 'create'])->name('admin.advertisement.create')->middleware(['auth:sanctum','AdminLimit']);

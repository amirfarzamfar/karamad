<?php

use App\Http\Controllers\ProvinceCity\ProvinceCityController;
use Illuminate\Support\Facades\Route;


Route::get('/ProvinceCity' , [ProvinceCityController::class , 'getProvincesWithCities']);

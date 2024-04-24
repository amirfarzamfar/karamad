<?php


use App\Http\Controllers\Category\ShowCategoryController;
use Illuminate\Support\Facades\Route;


Route::get('/Categories' , [ShowCategoryController::class , 'getCategories']);

<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Job_category;

class ShowCategoryController extends Controller
{
    public function getCategories()
    {
        $categories = Job_category::all();
        foreach ($categories as $category){
            $category->setAttribute('Category_name' , base64_decode($category->job_category_name));
        }
        return response()->json($categories);
    }
}

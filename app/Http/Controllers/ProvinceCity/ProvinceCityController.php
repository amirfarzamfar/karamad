<?php

namespace App\Http\Controllers\ProvinceCity;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\JsonResponse;

class ProvinceCityController extends Controller
{
    public function getProvincesWithCities(): JsonResponse
    {
        $provinces = Province::with('cities')->get()->toArray();

        return response()->json($provinces);

    }
}

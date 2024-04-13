<?php

namespace App\Http\Controllers\Filter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fliter\FilterRequest;
use App\Http\Resources\AdManagement\AdvertisementResource;
use App\Models\Advertisement;
use App\Models\Job_category;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FilterController extends Controller
{
    public function sortBy()
    {

    }

    public function newestJobAd()
    {


        $newestAd = Advertisement::orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            'message' => 'newestJobAd',
//            'newestJobAd' => $newestAd
          AdvertisementResource::collection($newestAd)
        ]);

    }

    public function FilterJobAd(Request $request)
    {

        // دریافت والیدیت شده فیلترها از درخواست
        $validatedData = $request->validate([
            'category' => 'nullable|string',
            'title' => 'nullable|string',
            'salary' => 'nullable|numeric',
            'city/province' => 'nullable|string',
            'type_of_cooperation' => 'nullable|string',
        ]);

        // Query Builder برای ساخت کوئری فیلتر شده
        $query = QueryBuilder::for(Advertisement::class)
            ->allowedFilters([
                'category' => AllowedFilter::partial('job_category_name'),
                'title' => 'nullable|string',
                'salary',
                'city/province',
                'type_of_cooperation',
            ]);

        // اعمال فیلترها
        if ($validatedData['category']) {
            $query->whereHas('Job_category', function ($q) use ($validatedData) {
                $q->where('job_category_name', 'like', '%' . $validatedData['category'] . '%');
            });
        }
        if ($validatedData['province']) {
            $query->where('province', 'like', '%' . $validatedData['province'] . '%');
        }
        if ($validatedData['salary']) {
            $query->where('salary', '>=', $validatedData['salary']);
        }
        if ($validatedData['experience']) {
            $query->where('experience', '>=', $validatedData['experience']);
        }
        if ($validatedData['city']) {
            $query->where('city', 'like', '%' . $validatedData['city'] . '%');
        }
        if ($validatedData['type_of_cooperation']) {
            $query->where('type_of_cooperation', 'like', '%' . $validatedData['type_of_cooperation'] . '%');
        }

        // دریافت نتایج و پاسخ دادن به درخواست
        $filteredAds = $query->orderByDesc('id')->get();

        return response()->json([
            'message' => 'Filter result',
            'result' => $filteredAds
        ]);
    }





}

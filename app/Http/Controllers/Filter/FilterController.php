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

        $validatedData = $request->validate([
            'category' => 'nullable|string',
            'title' => 'nullable|string',
            'salary' => 'nullable|numeric',
            'city/province' => 'nullable|string',
            'type_of_cooperation' => 'nullable|string',
            'experience' => 'nullable|numeric',
        ]);


        $query = QueryBuilder::for(Advertisement::class)
            ->allowedFilters([
                'category' => AllowedFilter::partial('job_category_name'),
                'title' => 'nullable|string',
                'salary',
                'city/province',
                'type_of_cooperation',
            ]);

        // اعمال فیلترها
        if (array_key_exists('category', $validatedData)) {
            $query->whereHas('Job_category', function ($q) use ($validatedData) {
                $q->where('job_category_name', 'like', '%' . $validatedData['category'] . '%');
            });
        }
        if (array_key_exists('city/province', $validatedData)) {
            $query->where('city/province', 'like', '%' . $validatedData['city/province'] . '%');
        }

        if (array_key_exists('salary', $validatedData)) {
            $query->where('salary', '>=', $validatedData['salary']);
        }

        if (array_key_exists('experience', $validatedData)) {
            $query->where('experience', '>=', $validatedData['experience']);
        }
//        if ($validatedData['city']) {
//            $query->where('city', 'like', '%' . $validatedData['city'] . '%');
//        }

        if (array_key_exists('type_of_cooperation', $validatedData)) {
            $query->where('type_of_cooperation', 'like', '%' . $validatedData['type_of_cooperation'] . '%');
        }

        // دریافت نتایج و پاسخ دادن به درخواست
        $filteredAds = $query->orderByDesc('id')->get();

        return response()->json([
            'message' => 'Filter result',
            'result' => $filteredAds
        ]);
    }


    public function SearchJobAd(Request $request)
    {

        $job_category_id = $request->input('job_category_id');
        $city_id = $request->input('city_id');
        $province_id = $request->input('province_id');
        $advertisements = Advertisement::when($job_category_id, function ($query) use ($job_category_id) {
            $query->whereHas('jobCategory', function ($query) use ($job_category_id) {
                $query->where('job_category_id', $job_category_id);
            });
        })
            ->when($city_id, function ($query) use ($city_id) {
                $query->whereHas('City', function ($query) use ($city_id) {
                    $query->where('city_id', $city_id);
                });
            })
            ->when($province_id, function ($query) use ($province_id) {
                $query->whereHas('Province', function ($query) use ($province_id) {
                    $query->where('province_id', $province_id);
                });
            })
            ->when($request->input('title'), function ($query) use ($request) {
                $query->where('title', $request->input('title'));
            })

            ->get();

        return $advertisements;
    }

}



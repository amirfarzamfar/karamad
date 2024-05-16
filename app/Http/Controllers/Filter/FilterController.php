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

        $newestAds = Advertisement::with('Organization')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $arr = [];
        foreach ($newestAds as $newestAd) {
            if ($newestAd->Organization) {
                $arr[] = [
                    'organization_name' => $newestAd->Organization->organizations_name,
                    'organization_logo' => $newestAd->Organization->getFirstMediaUrl('logo'),
                    'advertisements' => new AdvertisementResource($newestAd),
                ];
            }
        }

        return response()->json([
            'message' => 'newestJobAd',
            'arr' => $arr
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
        $organizations_name = $request->input('organizations_name');

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
                $query->where('title','like', '%'.$request->input('title').'%');
            })
            ->when($organizations_name , function ($query) use ($organizations_name){
                $query->whereHas('Organization' , function ($query) use ($organizations_name){
                    $query->where('organizations_name','like','%'.$organizations_name.'%');
                });
            })

            ->get();


        $arr = [];
        foreach ($advertisements as $advertisement) {
            if ($advertisement->Organization || $advertisement->jobCategory ) {
                $arr[] = [
                    'organization_name' => $advertisement->Organization->organizations_name,
                    'organization_logo' => $advertisement->Organization->getFirstMediaUrl('logo'),
                    'advertisements' => new AdvertisementResource($advertisement),
                ];
            }
        }

        return response()->json([
            'message' => 'آگهی های جستجو شده',
            'arr' => $arr
        ]);



    }

}



<?php

namespace App\Http\Controllers\Admin\Organization;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class DeleteOrganizationController extends Controller
{
    protected $collection = null;
    public function __construct(Request $request)
    {
        if ($request->route()->named('admin.delete.logo.organization')){
            $this->collection = 'logo';
        }elseif ($request->route()->named('admin.delete.hero.organization')){
            $this->collection = 'hero';
        }elseif ($request->route()->named('admin.delete.image_1.organization')){
            $this->collection = 'image_1';
        }elseif ($request->route()->named('admin.delete.image_2.organization')){
            $this->collection = 'image_2';
        }
    }
    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            $user_id = auth()->id();
            $organization = Organization::where('user_id' , $user_id)->first();
            if ($organization->hasMedia($this->collection))
            {
                $organization->clearMediaCollection($this->collection);
            }
            return response()->json('success');
        }catch (\Throwable $th){
            return response()->json($th->getMessage());
        }
    }
}

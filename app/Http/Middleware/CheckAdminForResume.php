<?php

namespace App\Http\Middleware;

use App\Models\Advertisement;
use App\Models\Advertisement_user_data;
use App\Models\Organization;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminForResume
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_data_id = $request->route('resume_id');
        $id = auth()->id();
        $organization = Organization::where('user_id',$id)->first();
        $advertisement = Advertisement::where('organization_id' , $organization->id)->first();
        if (Advertisement_user_data::where('advertisement_id' , $advertisement->id)->where('user_data_id',$user_data_id)->exists()){
            return $next($request);
        }else{
            return response()->json('you do not have permission');
        }
    }
}


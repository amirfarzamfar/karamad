<?php

namespace App\Http\Middleware;

use App\Models\Advertisement;
use App\Models\Organization;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminForAd
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $advertisement = Advertisement::find($request->route('advertisement_id'));
       $organization_id = $advertisement->organization_id;
       if (Organization::where('id',$organization_id)->where('user_id' , auth()->id())->exists()){
           return $next($request);
       }
        return response()->json('you do not have permission');
    }
}

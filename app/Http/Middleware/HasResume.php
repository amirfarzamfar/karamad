<?php

namespace App\Http\Middleware;

use App\Models\User_data;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasResume
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = auth()->id();
        if (!User_data::where('user_id' , $id)->exists()){
            return \response()->json('you do not have resume');
        }
        return $next($request);
    }
}

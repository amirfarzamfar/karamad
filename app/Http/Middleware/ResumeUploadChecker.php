<?php

namespace App\Http\Middleware;

use App\Models\User_data;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResumeUploadChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_data_id = $request->route('user_data_id');
        $user_data = User_data::where('id' , $user_data_id)->first();
        if($user_data->user_id == auth()->id()){
            return $next($request);
        }else{
            return \response()->json('you do not have permission');
        }
    }
}

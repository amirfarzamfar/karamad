<?php

namespace App\Http\Middleware;

use App\Models\Advertisement_user_data;
use App\Models\User_data;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SendOnce
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $advertisement_id = (int)$request->route('advertisement_id');
        $user_id = auth()->id();
        $user_data = User_data::where('user_id' , $user_id)->first();
        $user_data_id = $user_data->id;
        if(Advertisement_user_data::where('advertisement_id' , $advertisement_id)->where('user_data_id',$user_data_id)->exists()){
            return response()->json('you cant send more than one resume');
        }else{
            return $next($request);
        }
    }
}

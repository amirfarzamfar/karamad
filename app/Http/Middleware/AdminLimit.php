<?php

namespace App\Http\Middleware;


use App\Trait\AdminLimitTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminLimit
{
    use AdminLimitTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
       if ($this->checkActive()){
           return $next($request);
       }else{
           return \response()->json('buy more package');
       }
    }
}





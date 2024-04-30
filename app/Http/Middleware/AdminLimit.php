<?php

namespace App\Http\Middleware;

use App\Models\Payment;
use App\Models\Payment_package;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
       if (self::checkActive()){

           return $next($request);
       }else{
           return \response()->json('buy more package');
       }
    }

    public function checkActive()
    {
       if (Payment::where('user_id',auth()->id())->where('paid_at','!=',null)->where('status','=','active')->exists())
       {
           $payment_active = Payment::where('user_id',auth()->id())->where('paid_at','!=',null)->where('status','=','active')->get();
           return self::checkLimit($payment_active);
       }else{
           return false;
       }
    }

    public function checkLimit($payment_active)
    {
       if ($payment_active[0]->limit > 0 && $payment_active[0]->expired_at > now()) {
           Payment::find($payment_active[0]->id)->update(['limit' => $payment_active[0]->limit - 1]);
           return true;
       }else{
           Payment::find($payment_active[0]->id)->update(['status'=>'not active']);
           return self::checkReserve();
       }
    }
    public function checkReserve()
    {
        if (Payment::where('user_id',auth()->id())->where('paid_at','!=',null)->where('status','=','reserve')->exists())
        {
           $payment=Payment::with([
               'payment_package'=> function ($query){
                   $query->select('id' , 'advertisement_data_limit');
               },])->where('user_id',auth()->id())
               ->where('paid_at','!=',null)
               ->where('status','=','reserve')
               ->get();
           Payment::find($payment[0]->id)->update([
               'status'=>'active',
               'limit'=>$payment[0]->limit - 1,
           ]);
            return true;
        }else{
            return false;
        }
    }
}





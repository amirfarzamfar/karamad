<?php

namespace App\Trait;

use App\Models\Payment;
use App\Models\Payment_package;
use Carbon\Carbon;

trait AdminLimitTrait
{
    public function checkActive(): bool
    {
        if (Payment::where('user_id',auth()->id())->where('paid_at','!=',null)->where('status','=','active')->exists())
        {
            $payment_active = Payment::where('user_id',auth()->id())->where('paid_at','!=',null)->where('status','=','active')->get();
            return $this->checkLimit($payment_active);
        }else{
            return false;
        }
    }

    public function checkLimit($payment_active): bool
    {
        if ($payment_active[0]->limit > 0 && $payment_active[0]->expired_at > now()) {
            Payment::find($payment_active[0]->id)->update(['limit' => $payment_active[0]->limit - 1]);
            return true;
        }else{
            Payment::find($payment_active[0]->id)->update(['status'=>'not active']);
            return $this->checkReserve();
        }
    }
    public function checkReserve(): bool
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
            $dateLimit = $this->adDateLimit($payment);
            Payment::find($payment[0]->id)->update([
                'status'=>'active',
                'limit'=>$payment[0]->limit - 1,
                'expired_at' => Carbon::now()->addDays($dateLimit->advertisement_data_limit),
            ]);
            return true;
        }else{
            return false;
        }
    }

    public function adDateLimit($payment)
    {
       return Payment_package::find($payment[0]->payment_package_id);
    }
}

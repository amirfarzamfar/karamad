<?php

namespace App\Http\Controllers\Admin\paymentServices;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Payment_package;
use Carbon\Carbon;
use Evryn\LaravelToman\Facades\Toman;
use Evryn\LaravelToman\CallbackRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $status = 'active';
    public function index()
    {
        try {
            $packages = Payment_package::all();
            return response()->json($packages);
        }catch (\Throwable $th){
            return response()->json($th->getMessage());
        }
    }

    public function store(Request $request , int $payment_package_id): JsonResponse|RedirectResponse
    {
        try {
            $payment_package = Payment_package::find($payment_package_id);

            $newPayment = Toman::amount($payment_package->price)
                ->description($payment_package->title)
                ->callback(route('payment.callback'))
                ->request();

            if ($newPayment->failed()) {
                return response()->json($newPayment->message());
            }

            if (Payment::where('user_id' , auth()->id())->where('paid_at' ,'!=', null)->where('status' , 'active')->exists()){
                $this->status = 'reserve';
            }

             Payment::create([
                'user_id' => auth()->id(),
                'payment_package_id' => $payment_package_id,
                'amount' => $payment_package->price,
                'transaction_id' => $newPayment->transactionId(),
                'expired_at' => Carbon::now()->addDays($payment_package->advertisement_data_limit),
                'limit' => $payment_package->advertisement_limit,
                'status'=>$this->status
            ]);
            return response()->json($newPayment->paymentUrl());
        }catch (\Throwable $th){
            return response()->json($th->getMessage());
        }
    }

    public function callback(CallbackRequest $request): JsonResponse
    {
        $payment = Payment::whereTransactionId($request->transactionId())->firstOrFail();

        $verification = $request->amount($payment->amount)->verify();

        if ($verification->failed()) {
            $payment->failed_at = now();
        }

        if ($verification->alreadyVerified()) {
            $payment->reference_id = $verification->referenceId();
        }

        if ($verification->successful()) {
            $payment->reference_id = $verification->referenceId();
            $payment->paid_at = now();
        }

        $payment->save();

        return response()->json('verificated');
    }
}

<?php
use App\Http\Controllers\Admin\paymentServices\PaymentController;
use Illuminate\Support\Facades\Route;


Route::get('/payment/packages' , [PaymentController::class, 'index'])->name('payment.get');
Route::post('/payment/{payment_package_id}', [PaymentController::class, 'store'])->name('payment.store')->middleware(['auth:sanctum','CheckAdminForPayment' ,'CheckPaymentCount']);
Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

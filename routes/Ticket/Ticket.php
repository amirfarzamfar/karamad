<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::prefix('chats')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [ChatController::class, 'store'])->name('chat.store');

    Route::get('/all', [ChatController::class, 'index'])
//        ->middleware('permission:chat.all')
        ->name('chat.index');

    Route::delete('/{chat}', [ChatController::class, 'destroy'])
        ->middleware('permission:chat.destroy')
        ->name('chat.destroy')
        ->missing(function () {
            return response()->json(['message' => 'Chat not found.'], 404);
        });

    Route::get('/{chat}', [ChatController::class, 'show'])
        ->middleware('permission:chat.see')
        ->name('chat.show')

        ->missing(function () {
            return response()->json(['message' => 'Chat not found.'], 404);
        });

    // messages
    Route::post('/message-store', [MessageController::class, 'store'])
//        ->middleware('permission:message.store')
        ->name('message.store');

    Route::delete('/message/{message}', [MessageController::class, 'destroy'])
        ->middleware('permission:message.destroy')
        ->name('message.destroy')
        ->missing(function () {
            return response()->json(['message' => 'Message not found.'], 404);
        });

    Route::put('/message/{message}', [MessageController::class, 'update'])
//        ->middleware('permission:message.update')
        ->name('message.update')
        ->missing(function () {
            return response()->json(['message' => 'Message not found']);
        });

    Route::patch('/message/{message}', [MessageController::class, 'mark_as_seen'])
//        ->middleware('message.mark_as_seen')
        ->name('message.mark_as_seen');
});

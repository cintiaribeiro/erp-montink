<?php

use App\Http\Controllers\Api\WebhookOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/webhook/order', [WebhookOrderController::class, 'updateOrderStatus']);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController; 
use App\Http\Controllers\Api\ProductApiController; 
use App\Http\Controllers\Api\SalesOrderApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductApiController::class, 'index']);
    Route::post('/sales-orders', [SalesOrderApiController::class, 'store']);
    Route::get('/sales-orders/{id}', [SalesOrderApiController::class, 'show']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentContoller;


Route::get('/user', function (Request $request) {
     return $request->user()->toResource();
})->middleware('auth:sanctum');

//for payment
Route::post('/payment/initiate',[PaymentContoller::class,'paymentIntent'])->middleware('auth:sanctum');
// Route::post('/payment/verify',[PaymentContoller::class,'paymentVerify']);
Route::post('/stripe/webhook',[PaymentContoller::class,'webHook']);

// Auth
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class ,'logout'])->middleware('auth:sanctum');

//  user 
Route::apiResource('/product', ProductController::class)->only(['index', 'show']);
Route::apiResource('/category', CategoryController::class)->only(['index', 'show']);

// Admin
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('/product', ProductController::class)->except(['index', 'show']);
    Route::apiResource('/category', CategoryController::class)->except(['index', 'show']);
    Route::get('/dashboard-info',[DashboardController::class,'index']);
});

//  Orders
Route::middleware('auth:sanctum')->group(function () {
    // Users can place/view their own orders but admin can view all
    Route::apiResource('/order', OrderController::class)->only(['index', 'store', 'show']);
});

//  Admin can manage orders
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('/order', OrderController::class)->only(['update', 'destroy']);
});
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;


Route::get('/user', function (Request $request) {
     return $request->user()->toResource();
})->middleware('auth:sanctum');


// Route::apiResource('/product',ProductController::class);
// Route::apiResource('/category',CategoryController::class);
// Route::apiResource('/order',OrderController::class)->middleware('auth:sanctum');

// Route::post('/signup',[AuthController::class,'signup']);

// Route::post('/login',[AuthController::class,'login']);

// Route::get('/logout',[AuthController::class ,'logout'])->middleware('auth:sanctum');


// Auth
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class ,'logout'])->middleware('auth:sanctum');

//  Public viewing (no auth required)
Route::apiResource('/product', ProductController::class)->only(['index', 'show']);
Route::apiResource('/category', CategoryController::class)->only(['index', 'show']);

// Admin can manage product/category
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('/product', ProductController::class)->except(['index', 'show']);
    Route::apiResource('/category', CategoryController::class)->except(['index', 'show']);
    Route::get('/dashboard-info',[DashboardController::class,'index']);
});

//  Orders
Route::middleware('auth:sanctum')->group(function () {
    // Users can place/view their own orders
    Route::apiResource('/order', OrderController::class)->only(['index', 'store', 'show']);
});

//  Admin can manage orders
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('/order', OrderController::class)->only(['update', 'destroy']);
});
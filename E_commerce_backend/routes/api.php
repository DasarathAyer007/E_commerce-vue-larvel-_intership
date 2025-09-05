<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;


Route::get('/user', function (Request $request) {
     return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/product',ProductController::class);
Route::apiResource('/category',CategoryController::class);
Route::apiResource('/order',OrderController::class)->middleware('auth:sanctum');

Route::post('/signup',[AuthController::class,'signup']);

Route::post('/login',[AuthController::class,'login']);

Route::get('/logout',[AuthController::class ,'logout'])->middleware('auth:sanctum');
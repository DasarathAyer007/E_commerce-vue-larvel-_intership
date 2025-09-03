<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/user', function (Request $request) {
     return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/product',ProductController::class)->middleware('auth:sanctum');
Route::apiResource('/category',CategoryController::class);

Route::post('/signup',[AuthController::class,'signup']);

Route::post('/login',[AuthController::class,'login']);

Route::get('/logout',[AuthController::class ,'logout'])->middleware('auth:sanctum');;
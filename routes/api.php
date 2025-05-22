<?php

use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource("properties", PropertiesController::class);
Route::apiResource("transactions", TransactionsController::class);
Route::apiResource('reviews', ReviewController::class);
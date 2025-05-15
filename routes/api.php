<?php

use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource("properties", PropertiesController::class);
Route::apiResource("transactions", TransactionsController::class);
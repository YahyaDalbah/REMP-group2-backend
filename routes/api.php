<?php

use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/reports/overview', [ReportController::class, 'overview']);
    Route::get('/reports/monthly', [ReportController::class, 'monthly']);
});
Route::apiResource("properties", PropertiesController::class)->middleware('auth:sanctum');
Route::post('/properties/upload-images', [PropertiesController::class, 'uploadImages']);
Route::apiResource("transactions", TransactionsController::class)->middleware('auth:sanctum');
Route::post('/register', [AuthController::class ,'register']);
Route::post('/login', [AuthController::class ,'login']);
Route::apiResource('reviews', ReviewController::class);

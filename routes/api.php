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
use App\Http\Controllers\ReportController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/reports/overview', [ReportController::class, 'overview']);
    Route::get('/reports/monthly', [ReportController::class, 'monthly']);
});

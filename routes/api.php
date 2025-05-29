<?php

use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\TransactionsController;
<<<<<<< HEAD
use App\Http\Controllers\AuthController;

=======
use App\Http\Controllers\ReviewController;
>>>>>>> d48a8e63f9ccdd998b91892fd6a2e61fd464355b
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource("properties", PropertiesController::class);
Route::apiResource("transactions", TransactionsController::class);
<<<<<<< HEAD

Route::post('/register', [AuthController::class ,'register']);
Route::post('/login', [AuthController::class ,'login']);
=======
Route::apiResource('reviews', ReviewController::class);
>>>>>>> d48a8e63f9ccdd998b91892fd6a2e61fd464355b

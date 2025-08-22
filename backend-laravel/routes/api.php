<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('vehicles', VehicleController::class);
    Route::post('/vehicles/many', [VehicleController::class, 'storeMany'])->middleware('auth:sanctum');

});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SensorController;
use App\Http\Controllers\API\SensorDataController;
use App\Http\Controllers\API\RelayController;
use App\Http\Controllers\API\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);

Route::get('sensor', [SensorController::class, 'index']);
Route::get('sensor/{id}', [SensorController::class, 'show']);
Route::post('sensor', [SensorController::class, 'store']);
Route::put('sensor/{id}', [SensorController::class, 'update']);
Route::delete('sensor/{id}', [SensorController::class, 'destroy']);

Route::get('data', [SensorDataController::class, 'index']);
Route::post('data', [SensorDataController::class, 'store'])->name('data.store');
Route::apiResource('sensors', SensorController::class);

Route::get('/relay', [RelayController::class, 'getStatus']);
Route::post('/relay/{status}', [RelayController::class, 'setStatus']);

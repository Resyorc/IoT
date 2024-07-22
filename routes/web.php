<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/login', [AuthController::class, 'login'])->name('page.login');
Route::get('/register', [AuthController::class, 'register'])->name('page.register');
Route::post('/login', [AuthController::class, 'loginProses'])->name('login');
Route::post('/register', [AuthController::class, 'prosesRegister'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes requiring authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('page.dashboard');
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('page.analytics');
    Route::get('/monitor', [MonitorController::class, 'index'])->name('page.monitor');
    Route::get('/device', [DeviceController::class, 'index'])->name('page.device');
    
    Route::get('/devices/create', [DeviceController::class, 'create'])->name('device.create');
    Route::post('/devices', [DeviceController::class, 'store'])->name('device.store');
    Route::get('/devices/{device}', [DeviceController::class, 'show'])->name('device.show');
    Route::get('/devices/{device}/edit', [DeviceController::class, 'edit'])->name('device.edit');
    Route::put('/devices/{device}', [DeviceController::class, 'update'])->name('device.update');
    Route::delete('/devices/{device}', [DeviceController::class, 'destroy'])->name('device.destroy');

    Route::get('profile', [ProfileController::class, 'show'])->name('page.profile');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
});



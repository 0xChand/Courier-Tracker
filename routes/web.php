<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShipmentRequestController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\TrackingController;

Route::get('/', [TrackingController::class, 'search'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // User request submission
    Route::get('/requests/create', [ShipmentRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [ShipmentRequestController::class, 'store'])->name('requests.store');
    Route::get('/requests/{shipment}', [ShipmentRequestController::class, 'show'])->name('requests.show');

    // Admin only
    Route::middleware('admin')->group(function () {
        Route::get('/requests', [ShipmentRequestController::class, 'index'])->name('requests.index');
        Route::post('/requests/{shipment}/approve', [ShipmentRequestController::class, 'approve'])->name('requests.approve');
        Route::post('/requests/{shipment}/deny', [ShipmentRequestController::class, 'deny'])->name('requests.deny');

        Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
        Route::get('/packages/{package}/edit', [PackageController::class, 'edit'])->name('packages.edit');
        Route::put('/packages/{package}', [PackageController::class, 'update'])->name('packages.update');
        Route::delete('/packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');

        Route::post('/packages/{package}/tracking', [TrackingController::class, 'storeUpdate'])->name('tracking.update');
    });
});

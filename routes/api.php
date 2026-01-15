<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\HairstylistController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\TreatmentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
Route::get('/check-admin', [AuthController::class, 'checkAdmin'])->middleware('auth:sanctum');

// Public Routes
Route::get('/treatments', [TreatmentController::class, 'index']);
Route::get('/treatments/{id}', [TreatmentController::class, 'show']);

Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{id}', [NewsController::class, 'show']);

Route::get('/sliders', [SliderController::class, 'index']);
Route::get('/sliders/{id}', [SliderController::class, 'show']);

Route::get('/hairstylists', [HairstylistController::class, 'index']);
Route::get('/hairstylists/{id}', [HairstylistController::class, 'show']);

// Booking Routes (Protected)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings/{id}', [BookingController::class, 'show']);
});

// Admin Routes (protected by admin middleware)
Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    // Treatments Management
    Route::get('/treatments', [\App\Http\Controllers\Admin\TreatmentController::class, 'index']);
    Route::post('/treatments', [\App\Http\Controllers\Admin\TreatmentController::class, 'store']);
    Route::get('/treatments/{id}', [\App\Http\Controllers\Admin\TreatmentController::class, 'show']);
    Route::post('/treatments/{id}', [\App\Http\Controllers\Admin\TreatmentController::class, 'update']);
    Route::delete('/treatments/{id}', [\App\Http\Controllers\Admin\TreatmentController::class, 'destroy']);
    
    // News Management
    Route::get('/news', [\App\Http\Controllers\Admin\NewsController::class, 'index']);
    Route::post('/news', [\App\Http\Controllers\Admin\NewsController::class, 'store']);
    Route::get('/news/{id}', [\App\Http\Controllers\Admin\NewsController::class, 'show']);
    Route::post('/news/{id}', [\App\Http\Controllers\Admin\NewsController::class, 'update']);
    Route::delete('/news/{id}', [\App\Http\Controllers\Admin\NewsController::class, 'destroy']);
    
    // Sliders Management
    Route::get('/sliders', [\App\Http\Controllers\Admin\SliderController::class, 'index']);
    Route::post('/sliders', [\App\Http\Controllers\Admin\SliderController::class, 'store']);
    Route::get('/sliders/{id}', [\App\Http\Controllers\Admin\SliderController::class, 'show']);
    Route::post('/sliders/{id}', [\App\Http\Controllers\Admin\SliderController::class, 'update']);
    Route::delete('/sliders/{id}', [\App\Http\Controllers\Admin\SliderController::class, 'destroy']);
    
    // Hairstylists Management
    Route::get('/hairstylists', [\App\Http\Controllers\Admin\HairstylistController::class, 'index']);
    Route::post('/hairstylists', [\App\Http\Controllers\Admin\HairstylistController::class, 'store']);
    Route::get('/hairstylists/{id}', [\App\Http\Controllers\Admin\HairstylistController::class, 'show']);
    Route::post('/hairstylists/{id}', [\App\Http\Controllers\Admin\HairstylistController::class, 'update']);
    Route::delete('/hairstylists/{id}', [\App\Http\Controllers\Admin\HairstylistController::class, 'destroy']);
    
    // Bookings Management
    Route::get('/bookings', [\App\Http\Controllers\Admin\BookingController::class, 'index']);
    Route::get('/bookings/statistics', [\App\Http\Controllers\Admin\BookingController::class, 'statistics']);
    Route::get('/bookings/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'show']);
    Route::post('/bookings/{id}/status', [\App\Http\Controllers\Admin\BookingController::class, 'updateStatus']);
    Route::delete('/bookings/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'destroy']);
});

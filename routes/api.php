<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\HairstylistController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\TreatmentController;
use Illuminate\Support\Facades\Route;

Route::get('/treatments', [TreatmentController::class, 'index']);
Route::get('/treatments/{id}', [TreatmentController::class, 'show']);

Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{id}', [NewsController::class, 'show']);

Route::get('/sliders', [SliderController::class, 'index']);
Route::get('/sliders/{id}', [SliderController::class, 'show']);

Route::get('/hairstylists', [HairstylistController::class, 'index']);
Route::get('/hairstylists/{id}', [HairstylistController::class, 'show']);

Route::get('/bookings', [BookingController::class, 'index']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/bookings/{id}', [BookingController::class, 'show']);

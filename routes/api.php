<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomBookingController;
use App\Http\Controllers\SpecialOfferCategoryController;
use App\Http\Controllers\SpecialOfferController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('/special-offer-category', SpecialOfferCategoryController::class);
Route::apiResource('/special-offer', SpecialOfferController::class);
Route::get('/room-booking', [RoomBookingController::class, 'index']);

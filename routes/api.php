<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomBookingController;
use App\Http\Controllers\SpecialOfferCategoryController;
use App\Http\Controllers\SpecialOfferController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\FAQ_CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);



Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('room', RoomController::class);
    Route::resource('faq_category', FAQ_CategoryController::class);
    Route::resource('faq', FAQController::class);
    Route::apiResource('/special-offer-category', SpecialOfferCategoryController::class);
    Route::apiResource('/special-offer', SpecialOfferController::class);
    Route::get('/room-booking', [RoomBookingController::class, 'index']);
});



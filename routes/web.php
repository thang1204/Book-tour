<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;

Route::get('/tour/area/{area_id?}', [TourController::class, 'index'])->name('tour.index');
Route::resource('/tour', TourController::class)->except(['index']);

Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/booking', [BookingController::class, 'store'])->name('bookings.store');



Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    
});
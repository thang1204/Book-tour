<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;

Route::resource('/tour', TourController::class);

Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/booking', [BookingController::class, 'store'])->name('bookings.store');



Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    
});
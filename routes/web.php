<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TourGuideController;

Route::get('/areas/search', [AreaController::class, 'search'])->name('areas.search');
Route::get('areas/{area_id?}', [AreaController::class, 'index'])->name('areas.index');

Route::resource('/tour', TourController::class);

Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/booking', [BookingController::class, 'store'])->name('bookings.store');



Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::resource('hotels', HotelController::class);
    Route::resource('tour_guides', TourGuideController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('customers', CustomerController::class);
});
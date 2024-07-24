<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\AreaNewController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TourGuideController;
use App\Http\Controllers\StatisticsController;

Route::get('/areas/search', [AreaController::class, 'search'])->name('areas.search');
Route::get('areas/{area_id?}', [AreaController::class, 'index'])->name('areas.index');
Route::resource('areanew', AreaNewController::class);

Route::resource('/tour', TourController::class);
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('bookings/search', [BookingController::class, 'search'])->name('bookings.search');

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::resource('hotels', HotelController::class);
    Route::resource('tour_guides', TourGuideController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('bookings', BookingController::class);
    Route::post('/bookings/update-payment-status', [BookingController::class, 'updatePaymentStatus'])->name('bookings.updatePaymentStatus');
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
    Route::resource('banks', BankController::class);
});
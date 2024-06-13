<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function index()
    {
        return view('pay');
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $userId = $user->id;
            $tourId = $request->tour_id;
            $adults = $request->number_of_adults;
            $children = $request->number_of_children;
            $totalPrice = $request->total_price;

            $existingBooking = Booking::where('user_id', $userId)->where('tour_id', $tourId)->first();

            if ($existingBooking) {
                return response()->json(['error' => 'Bạn đã đặt tour này trước đó.'], 400);
            }

            $booking = new Booking();
            $booking->user_id = $userId;
            $booking->tour_id = $tourId;
            $booking->number_of_adults = $adults;
            $booking->number_of_children = $children;
            $booking->total_price = $totalPrice;
            $booking->save();

            return view('pay', ['success' => 'Đặt tour thành công.']);


        } else {
            // Xử lý khi không có người dùng đăng nhập
        }
        
    }
}

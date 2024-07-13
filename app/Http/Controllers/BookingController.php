<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Mail\BookingConfirmed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 1) {
            $bookings = Booking::with(['tour.area', 'tour.hotel', 'tour.vehicle', 'tour.guide'])->get();
            return view('bookings.index_admin', compact('bookings'));
        } else {
            $bookings = Booking::where('user_id', $user->id)
                            ->with(['tour.area', 'tour.hotel', 'tour.vehicle', 'tour.guide'])
                            ->get();
            return view('bookings.index', compact('bookings'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'start_date' => 'required|date',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0',
            // 'discount_code' => 'nullable|string',
        ]);

        $existingBooking = Booking::where('user_id', Auth::id())
                                   ->where('tour_id', $request->input('tour_id'))
                                   ->exists();

        if ($existingBooking) {
            return redirect()->back()->withErrors(['error' => 'Bạn đã đặt tour này rồi.']);
        }

        $tour = Tour::find($request->input('tour_id'));
        $pricePerAdult = $tour->price;
        $pricePerChild = $pricePerAdult * 0.5;

        $totalPrice = ($request->input('adults') * $pricePerAdult) +
                      ($request->input('children') * $pricePerChild);


        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->tour_id = $request->input('tour_id');
        $booking->start_date = $request->input('start_date');
        $booking->number_of_adults = $request->input('adults');
        $booking->number_of_children = $request->input('children');
        $booking->total_price = $totalPrice;
        $booking->save();

        $bank = Bank::first();
        Mail::to(Auth::user()->email)->send(new BookingConfirmed($booking, $bank));

        return redirect()->route('bookings.index')->with('success', 'Đặt tour thành công!');
    }

    public function destroy($id)
    {
        $booking = Booking::find($id);

        if ($booking && $booking->user_id == auth()->id()) {
            $booking->delete();
            return redirect()->route('bookings.index')->with('success', 'Hủy tour thành công!');
        }

        return redirect()->route('bookings.index')->with('error', 'Không thể hủy tour này.');
    }

    public function updatePaymentStatus(Request $request)
    {
        $booking = Booking::find($request->id);
        if ($booking) {
            $booking->payment_status = $request->payment_status;
            $booking->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}

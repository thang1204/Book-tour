<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Bank;
use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Mail\BookingConfirmed;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 1) {
            $bookings = Booking::with(['tour.area', 'tour.hotel', 'tour.vehicle', 'tour.guide'])
                            ->orderBy('created_at', 'desc')
                            ->get();
            return view('bookings.index_admin', compact('bookings'));
        } else {
            $bookings = Booking::where('user_id', $user->id)
                            ->with(['tour.area', 'tour.hotel', 'tour.vehicle', 'tour.guide'])
                            ->orderBy('created_at', 'desc')
                            ->get();
            return view('bookings.index', compact('bookings'));
        }
    }

    public function store(Request $request)
    {
        try{
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0',

        ]);

        $start_date = explode("|", $request->tour_dates)[0];
        $end_date = explode("|", $request->tour_dates)[1];



        $tour = Tour::find($request->input('tour_id'));
        $pricePerAdult = $tour->price;
        $pricePerChild = $pricePerAdult * 0.5;

        $totalPrice = ($request->input('adults') * $pricePerAdult) +
                      ($request->input('children') * $pricePerChild);

        $bookings = Booking::where('tour_id', $tour->id)->get();
        $totalNumberOfAdultsBooked = $bookings->sum('number_of_adults');
        $totalNumberOfChildrenBooked = $bookings->sum('number_of_children');
        $totalNumberOfPeopleBooked = $totalNumberOfAdultsBooked + $totalNumberOfChildrenBooked;

        $newAdults = $request->input('adults');
        $newChildren = $request->input('children');
        $totalNumberOfPeopleIncludingNew = $totalNumberOfPeopleBooked + $newAdults + $newChildren;

        if ($totalNumberOfPeopleIncludingNew > $tour->number_of_participants) {
            return redirect()->back()->withErrors(['error' => 'Tour đã hết chỗ'])->withInput();
        }

        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->tour_id = $request->input('tour_id');
        $booking->start_date = $start_date;
        $booking->end_date = $end_date; 
        $booking->number_of_adults = $request->input('adults');
        $booking->number_of_children = $request->input('children');
        $booking->total_price = $totalPrice;
        $booking->save();

        $bank = Bank::first();
        Mail::to(Auth::user()->email)->send(new BookingConfirmed($booking, $bank));

        return redirect()->route('bookings.index')->with('success', 'Đặt tour thành công!');
        }
        catch(Exception $e){
            dd($e);
        }
    }

    public function destroy($id)
    {
        $booking = Booking::find($id);
        $user = auth()->user();

        if ($user->role === 1) {
            if ($booking) {
                $booking->delete();
                return redirect()->route('bookings.index')->with('success', 'Hủy tour thành công!');
            }
        } else {
            if ($booking && $booking->user_id == $user->id) {
                $booking->delete();
                return redirect()->route('bookings.index')->with('success', 'Hủy tour thành công!');
            }
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

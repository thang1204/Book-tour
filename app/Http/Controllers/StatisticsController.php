<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            
            if ($user && $user->role !== 1) {
                session()->flash('error', 'Bạn không có quyền truy cập.');
                return redirect()->route('home');
            }

            return $next($request);
        });
    }
    
    public function index(Request $request)
    {
        $selectedYear = $request->input('year', Carbon::now()->year);

        $years = Booking::selectRaw('YEAR(booking_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        $currentYearIndex = array_search($selectedYear, $years);

        $previousYear = $years[$currentYearIndex + 1] ?? null;
        $nextYear = $years[$currentYearIndex - 1] ?? null;

        $totalTours = Tour::count();

        $totalBookings = Booking::whereYear('booking_date', $selectedYear)->count();

        $totalAdults = Booking::whereYear('booking_date', $selectedYear)->sum('number_of_adults');
        $totalChildren = Booking::whereYear('booking_date', $selectedYear)->sum('number_of_children');

        $totalRevenue = Booking::whereYear('booking_date', $selectedYear)->sum('total_price');

        $monthlyBookings = Booking::selectRaw('MONTH(booking_date) as month, COUNT(*) as total_bookings')
            ->whereYear('booking_date', $selectedYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];
        $bookingsCount = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('F');
            $bookingsCount[] = $monthlyBookings->firstWhere('month', $i)->total_bookings ?? 0;
        }

        return view('statistics.index', compact(
            'years',
            'selectedYear',
            'previousYear',
            'nextYear',
            'totalTours',
            'totalBookings',
            'totalAdults',
            'totalChildren',
            'totalRevenue',
            'months',
            'bookingsCount'
        ));
    }
}


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
            
            // Kiểm tra xem người dùng có role = 1 không
            if ($user && $user->role !== 1) {
                // Đặt thông báo vào session
                session()->flash('error', 'Bạn không có quyền truy cập.');
                // Chuyển hướng về trang home
                return redirect()->route('home');
            }

            return $next($request);
        });
    }
    
    public function index(Request $request)
    {
        // Lấy năm hiện tại hoặc năm được chọn từ request
        $selectedYear = $request->input('year', Carbon::now()->year);

        // Lấy danh sách các năm có dữ liệu
        $years = Booking::selectRaw('YEAR(booking_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        // Tìm chỉ số của năm hiện tại trong danh sách các năm
        $currentYearIndex = array_search($selectedYear, $years);

        // Xác định năm trước và năm sau
        $previousYear = $years[$currentYearIndex + 1] ?? null;
        $nextYear = $years[$currentYearIndex - 1] ?? null;

        // Thống kê tổng số tour
        $totalTours = Tour::count();

        // Thống kê tổng số lượt đặt tour
        $totalBookings = Booking::whereYear('booking_date', $selectedYear)->count();

        // Thống kê tổng số người lớn và trẻ em đã đặt
        $totalAdults = Booking::whereYear('booking_date', $selectedYear)->sum('number_of_adults');
        $totalChildren = Booking::whereYear('booking_date', $selectedYear)->sum('number_of_children');

        // Thống kê tổng doanh thu
        $totalRevenue = Booking::whereYear('booking_date', $selectedYear)->sum('total_price');

        // Thống kê số lượng đặt tour theo tháng cho năm được chọn
        $monthlyBookings = Booking::selectRaw('MONTH(booking_date) as month, COUNT(*) as total_bookings')
            ->whereYear('booking_date', $selectedYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Chuẩn bị dữ liệu cho Chart.js
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


<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index($area_id)
    {
        $area = Area::findOrFail($area_id);
        $tours = Tour::where('area_id', $area_id)->get();
        $bookings = Booking::whereIn('tour_id', $tours->pluck('id'))->get();
        return view('areas.index', [
            'area' => $area,
            'tours' => $tours,
            'bookings' => $bookings,
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $areas = Area::where('name', 'LIKE', "%{$query}%")->get();

        return response()->json($areas);
    }
}

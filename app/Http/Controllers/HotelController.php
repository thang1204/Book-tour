<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    
    public function index()
    {
        $hotels = Hotel::all();
        return view('hotels.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hotels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'nullable',
            'stars' => 'nullable|integer|min:1|max:5',
            'phone' => 'nullable',
            'email' => 'nullable|email',
            'description' => 'nullable',
        ]);

        Hotel::create($request->all());

        return redirect()->route('hotels.index')->with('success', 'Hotel created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('hotels.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'stars' => 'nullable|integer|min:1|max:5',
            'phone' => 'nullable|string|max:20',
            'description' => 'nullable|string',
        ]);

        // Tìm và cập nhật khách sạn
        $hotel = Hotel::findOrFail($id);
        $hotel->update($validated);

        // Chuyển hướng về trang chi tiết với thông báo thành công
        return redirect()->route('hotels.index', $hotel)->with('success', 'Khách sạn đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return redirect()->route('hotels.index')->with('success', 'Khách sạn đã được xóa thành công.');
    }
}

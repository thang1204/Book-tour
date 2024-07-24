<?php

namespace App\Http\Controllers;

use App\Models\TourGuide;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TourGuideController extends Controller
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
    
    public function index()
    {
        $tourGuides = TourGuide::all();
        return view('tour_guides.index', compact('tourGuides'));
    }

    public function create()
    {
        return view('tour_guides.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'bio' => 'nullable|string',
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        TourGuide::create($validated);

        return redirect()->route('tour_guides.index')->with('success', 'Hướng dẫn viên đã được thêm thành công.');
    }

    public function edit($id)
    {
        $tourGuide = TourGuide::findOrFail($id);
        return view('tour_guides.edit', compact('tourGuide'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'bio' => 'nullable|string',
        ]);

        $tourGuide = TourGuide::findOrFail($id);

        if ($request->hasFile('avatar')) {
            if ($tourGuide->avatar) {
                \Storage::disk('public')->delete($tourGuide->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $tourGuide->update($validated);

        return redirect()->route('tour_guides.index', $tourGuide)->with('success', 'Thông tin hướng dẫn viên đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $tourGuide = TourGuide::findOrFail($id);

        if ($tourGuide->avatar) {
            \Storage::disk('public')->delete($tourGuide->avatar);
        }

        $tourGuide->delete();

        return redirect()->route('tour_guides.index')->with('success', 'Hướng dẫn viên đã được xóa thành công.');
    }
}

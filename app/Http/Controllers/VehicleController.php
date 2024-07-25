<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
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
        $vehicles = Vehicle::with('driver')->get();
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        $drivers = Driver::all();
        return view('vehicles.create', compact('drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'model' => 'nullable',
            'license_plate' => 'required|unique:vehicles',
            'capacity' => 'nullable|integer',
            'driver_id' => 'required',
        ]);

        Vehicle::create($request->all());

        return redirect()->route('vehicles.index')
                         ->with('success', 'Phương tiện đã được tạo thành công');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $drivers = Driver::all();
        return view('vehicles.edit', compact('vehicle', 'drivers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'model' => 'nullable',
            'license_plate' => 'required|unique:vehicles,license_plate,' . $id,
            'capacity' => 'nullable|integer',
            'driver_id' => 'required',
            // 'driver_id' => 'required|exists:drivers,id',

        ]);

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($request->all());

        return redirect()->route('vehicles.index')
                         ->with('success', 'Phương tiện đã được cập nhật thành công');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('vehicles.index')
                         ->with('success', 'Phương tiện đã được xóa thành công');
    }
}

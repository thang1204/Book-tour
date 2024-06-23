<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
                         ->with('success', 'Vehicle created successfully.');
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
                         ->with('success', 'Vehicle updated successfully.');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('vehicles.index')
                         ->with('success', 'Vehicle deleted successfully.');
    }
}

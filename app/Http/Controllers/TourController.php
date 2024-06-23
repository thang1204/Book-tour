<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Area;
use App\Models\Tour;
use App\Models\Hotel;
use App\Models\TourGuide;
use App\Models\TourImage;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Guid\Guid;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $tours = Tour::with(['area', 'hotel', 'vehicle', 'guide'])->paginate(10);
        return view('tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Area::all();
        $hotels = Hotel::all();
        $vehicles = Vehicle::all();
        $guides = TourGuide::all();
        return view('tours.create', compact('areas', 'hotels', 'vehicles', 'guides'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $tour = Tour::create([
                'area_id' => $request->input('area'),
                'hotel_id' => $request->input('hotel_id'),
                'vehicle_id' => $request->input('vehicle_id'),
                'guide_id' => $request->input('guide_id'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'start_date' =>$request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'price' => $request->input('price'),
                'number_of_participants' => $request->input('number_of_participants'),
            ]);

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('public/images/tours/' . $tour->id, $imageName);
        
                    TourImage::create([
                        'tour_id' => $tour->id,
                        'image' => Storage::url($path),
                    ]);
                }
            }
            } catch (Exception $e) {
                dd($e->getMessage());
            }
            return redirect()->route('tour.index')->with('success', 'Tour updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tour = Tour::findOrFail($id);
        return view('tours.show', compact('tour'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $areas = Area::all();
        $hotels = Hotel::all();
        $vehicles = Vehicle::all();
        $guides = TourGuide::all();
        $tour = Tour::findOrFail($id);
        return view('tours.edit', compact('tour', 'areas', 'hotels', 'vehicles', 'guides'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $tour = Tour::findOrFail($id);

            $tour->update([
                'area_id' => $request->input('area'),
                'hotel_id' => $request->input('hotel_id'),
                'vehicle_id' => $request->input('vehicle_id'),
                'guide_id' => $request->input('guide_id'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'price' => $request->input('price'),
                'number_of_participants' => $request->input('number_of_participants'),
            ]);

            
            $imageArrs = $request->images;
            $oldTourImageIds = $tour->images()->pluck('id')->toArray();
            $newImageIds = [];

            foreach ($imageArrs as $imageItem) {
                
                if (empty($imageItem['id']) && empty($imageItem['file'])) {
                    continue;
                }

                if (isset($imageItem['id'])) {
                    $newImageIds[] = $imageItem['id'];
                }

                
                $imageData = [
                    'tour_id' => $id,
                ];
            
                if (isset($imageItem["file"])) {
                    $imageFile = $imageItem["file"];
                    $imageName = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
                    $path = $imageFile->storeAs('public/images/tours/' . $tour->id, $imageName);
                    $imageUrl = Storage::url($path);
            
                    $imageData['image'] = $imageUrl;
                }
            
                $tourImage = TourImage::updateOrCreate(
                    ['id' => $imageItem['id']],
                    $imageData
                );
            }

            $tourImageDelete = array_diff($oldTourImageIds, $newImageIds);
            $tour->images()->whereIn('id', $tourImageDelete)->delete();
        } catch (Exception $e) {
            dd($e->getMessage());
        }

        return redirect()->route('tour.index')->with('success', 'Tour updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $tour = Tour::findOrFail($id);
            DB::beginTransaction();
            $tour->images()->delete();
            $tour->delete();
            DB::commit();
            return redirect()->route('tour.index')->with('message', 'Xóa thành công tour');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('tour.index')->with('error', 'Xóa tour thất bại');
        }
    }
}

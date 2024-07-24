<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Area;
use App\Models\Tour;
use App\Models\Hotel;
use App\Models\Vehicle;
use App\Models\TourDate;
use App\Models\TourGuide;
use App\Models\TourImage;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         $currentRouteName = $request->route()->getName();

    //         // Nếu route là 'index', cho phép truy cập mà không cần đăng nhập
    //         if ($currentRouteName === 'index') {
    //             return $next($request);
    //         }

    //         // Kiểm tra xác thực người dùng
    //         if (!Auth::check()) {
    //             // Đặt thông báo vào session
    //             session()->flash('error', 'Bạn cần đăng nhập.');
    //             // Chuyển hướng về trang login
    //             return redirect()->route('login');
    //         }

    //         $user = Auth::user();

    //         // Kiểm tra xem người dùng có role = 1 không
    //         if ($user->role !== 1) {
    //             // Đặt thông báo vào session
    //             session()->flash('error', 'Bạn không có quyền truy cập.');
    //             // Chuyển hướng về trang home
    //             return redirect()->route('home');
    //         }

    //         return $next($request);
    //     });
    // }

    public function index()
    {
        $tours = Tour::with(['area', 'hotel', 'vehicle', 'guide', 'tourDates'])->paginate(100);
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
        $request->validate([
            'area' => 'required|exists:areas,id',
            'hotel' => 'required|exists:hotels,id',
            'vehicle' => 'required|exists:vehicles,id',
            'guide' => 'required|exists:tour_guides,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'number_of_participants' => 'required|integer|min:1',
            'start_date.*' => 'required|date',
            'end_date.*' => 'required|date|after_or_equal:start_date.*',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'end_date.*.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
        ]);
    
        try {
            $tour = Tour::create([
                'area_id' => $request->input('area'),
                'hotel_id' => $request->input('hotel'),
                'vehicle_id' => $request->input('vehicle'),
                'guide_id' => $request->input('guide'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'number_of_participants' => $request->input('number_of_participants'),
            ]);
    
            $startDates = $request->input('start_date');
            $endDates = $request->input('end_date');
    
            for ($i = 0; $i < count($startDates); $i++) {
                TourDate::create([
                    'tour_id' => $tour->id,
                    'start_date' => $startDates[$i],
                    'end_date' => $endDates[$i],
                ]);
            }

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
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
        return redirect()->route('tour.index')->with('success', 'Tour đã được tạo thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tour = Tour::findOrFail($id);
        $bookings = $tour->bookings;
        $totalNumberOfAdults = $bookings->sum('number_of_adults');
        $totalNumberOfChildren = $bookings->sum('number_of_children');
        $totalNumberOfPeople = $totalNumberOfAdults + $totalNumberOfChildren;

        $area = $tour->area;
        $hotel = $tour->hotel;
        $vehicle = $tour->vehicle;
        $guide = $tour->guide;

        return view('tours.show', compact('tour', 'bookings', 'totalNumberOfPeople', 'area', 'hotel', 'vehicle', 'guide'));
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
        $request->validate([
            'area' => 'required|exists:areas,id',
            'hotel' => 'required|exists:hotels,id',
            'vehicle' => 'required|exists:vehicles,id',
            'guide' => 'required|exists:tour_guides,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'number_of_participants' => 'required|integer|min:1',
            'start_date.*' => 'required|date',
            'end_date.*' => 'required|date|after_or_equal:start_date.*',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'end_date.*.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
        ]);
        try {
            $tour = Tour::findOrFail($id);

            $tour->update([
                'area_id' => $request->input('area'),
                'hotel_id' => $request->input('hotel'),
                'vehicle_id' => $request->input('vehicle'),
                'guide_id' => $request->input('guide'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'number_of_participants' => $request->input('number_of_participants'),
            ]);

            $tour->tourDates()->delete();

            $startDates = $request->input('start_date');
            $endDates = $request->input('end_date');

            for ($i = 0; $i < count($startDates); $i++) {
                $tour->tourDates()->create([
                    'start_date' => $startDates[$i],
                    'end_date' => $endDates[$i],
                ]);
            }

            
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

        return redirect()->route('tour.index')->with('success', 'Tour đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $tour = Tour::findOrFail($id);
            DB::beginTransaction();
            $tour->tourDates()->delete();
            $tour->images()->delete();
            $tour->delete();
            $tour->bookings()->delete();
            DB::commit();
            return redirect()->route('tour.index')->with('success', 'Xóa thành công tour');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('tour.index')->with('error', 'Xóa tour thất bại');
        }
    }
}

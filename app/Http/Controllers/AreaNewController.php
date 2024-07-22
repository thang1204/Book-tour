<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AreaNewController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        return view('areanews.index', compact('areas'));
    }

    public function create()
    {
        return view('areanews.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        Area::create([
            'name' => $request->name,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('areanew.index')->with('success', 'Khu vực đã được tạo thành công.');
    }

    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('areanews.edit', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        try {
            // Xác thực dữ liệu đầu vào
            $request->validate([
                'name' => 'required|string|max:255',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Chuẩn bị dữ liệu để cập nhật
            $data = [
                'name' => $request->name,
            ];
    
            // Nếu có file hình ảnh được tải lên
            if ($request->hasFile('thumbnail')) {
                // Xóa hình ảnh cũ nếu tồn tại
                if ($area->thumbnail) {
                    Storage::disk('public')->delete($area->thumbnail);
                }
    
                // Lưu hình ảnh mới và cập nhật đường dẫn
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $data['thumbnail'] = $thumbnailPath;
            }
    
            // Cập nhật khu vực
            $area->update($data);
    
            // Chuyển hướng về trang danh sách với thông báo thành công
            return redirect()->route('areanew.index')->with('success', 'Khu vực đã được cập nhật thành công.');
        } catch (\Exception $e) {
            // Ghi log lỗi nếu cần
            dd($e);
            \Log::error('Error updating area: ' . $e->getMessage());
    
            // Chuyển hướng về trang danh sách với thông báo lỗi
            return redirect()->route('areanew.index')->with('error', 'Đã xảy ra lỗi khi cập nhật khu vực.');
        }
    }

    public function destroy(Area $area)
    {
        if ($area->thumbnail) {
            Storage::disk('public')->delete($area->thumbnail);
        }

        $area->delete();

        return redirect()->route('areanew.index')->with('success', 'Khu vực đã được xóa thành công.');
    }
}
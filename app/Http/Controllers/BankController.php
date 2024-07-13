<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banks = Bank::all();
        return view('banks.index', compact('banks'));
    }

    // Hiển thị form tạo mới ngân hàng
    public function create()
    {
        return view('banks.create');
    }

    // Lưu ngân hàng mới
    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_holder_name' => 'required|string|max:255',
            'qr_code' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $qrCodePath = null;
        if ($request->hasFile('qr_code')) {
            $qrCodePath = $request->file('qr_code')->store('public/images');
        }

        Bank::create([
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'account_holder_name' => $request->account_holder_name,
            'qr_code_path' => $qrCodePath,
        ]);

        return redirect()->route('home')->with('success', 'Tạo ngân hàng thành công!');
    }

    // Hiển thị thông tin chi tiết ngân hàng
    public function show($id)
    {
        
    }

    // Hiển thị form chỉnh sửa ngân hàng
    public function edit($id)
    {
        $bank = Bank::findOrFail($id);
        return view('banks.edit', compact('bank'));
    }

    // Cập nhật ngân hàng
    public function update(Request $request, $id)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_holder_name' => 'required|string|max:255',
            'qr_code' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $bank = Bank::findOrFail($id);

        if ($request->hasFile('qr_code')) {
            if ($bank->qr_code_path && Storage::exists($bank->qr_code_path)) {
                Storage::delete($bank->qr_code_path);
            }
            $qrCodePath = $request->file('qr_code')->store('public/images');
            $bank->qr_code_path = $qrCodePath;
        }

        $bank->update([
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'account_holder_name' => $request->account_holder_name,
        ]);

        return redirect()->route('banks.edit', $id)->with('success', 'Cập nhật ngân hàng thành công!');
    }

    // Xóa ngân hàng
    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        if ($bank->qr_code_path && Storage::exists($bank->qr_code_path)) {
            Storage::delete($bank->qr_code_path);
        }
        $bank->delete();

        return redirect()->route('banks.index')->with('success', 'Xóa ngân hàng thành công!');
    }
}

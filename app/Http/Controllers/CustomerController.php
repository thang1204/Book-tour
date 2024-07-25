<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 1) {
            $customers = Customer::all();
            session()->flash('success', 'Cập nhật thông tin tài khoản thành công');
            return view('customers.index', compact('customers'));
        } else {
            session()->flash('success', 'Cập nhật thông tin tài khoản thành công');
            return redirect()->route('home');
        }
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'required|string|max:15',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $validated['user_id'] = Auth::id();

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Khách hàng đã được tạo thành công.');
    }

    public function edit(Customer $customer)
    {
        $this->authorize('update', $customer);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $this->authorize('update', $customer);

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'required|string|max:15',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            if ($customer->avatar) {
                Storage::disk('public')->delete($customer->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Khách hàng đã được cập nhật thành công.');
    }

    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);

        DB::transaction(function () use ($customer) {
            if ($customer->avatar) {
                Storage::disk('public')->delete($customer->avatar);
            }

            $user = $customer->user;

            $customer->delete();

            if ($user) {
                $user->delete();
            }
        });

        return redirect()->route('customers.index')->with('success', 'Customer and associated user deleted successfully.');
    }
}

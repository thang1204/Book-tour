@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh Sách Khách Hàng</h1>
    {{-- <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Thêm Khách Hàng</a> --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Họ Tên</th>
                <th>Địa Chỉ</th>
                <th>Điện Thoại</th>
                <th>Giới Tính</th>
                <th>Ngày Sinh</th>
                <th>Ảnh Đại Diện</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->full_name }}</td>
                    <td>{{ $customer->address ?? 'N/A' }}</td>
                    <td>{{ $customer->phone ?? 'N/A' }}</td>
                    <td>{{ ucfirst($customer->gender) ?? 'N/A' }}</td>
                    <td>
                        @if ($customer->date_of_birth instanceof \Illuminate\Support\Carbon)
                            {{ $customer->date_of_birth->format('d/m/Y') }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($customer->avatar)
                            <img src="{{ asset('storage/' . $customer->avatar) }}" alt="Avatar" width="50">
                        @else
                            <span>Không có ảnh</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        @if (auth()->user()->role != 1)
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')

@endsection
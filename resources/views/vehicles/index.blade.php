@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Danh sách xe</h1>
    <a href="{{ route('vehicles.create') }}" class="btn btn-primary mb-3">Thêm xe mới</a>
    <table class="table">
        <thead>
            <tr>
                <th>Phương tiện</th>
                <th>Loại xe</th>
                <th>Biển số xe</th>
                <th>Sức chứa</th>
                <th>Tài xế</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
            <tr>
                <td>{{ $vehicle->type }}</td>
                <td>{{ $vehicle->model }}</td>
                <td>{{ $vehicle->license_plate }}</td>
                <td>{{ $vehicle->capacity }}</td>
                <td>
                    @if($vehicle->driver)
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/' . $vehicle->driver->avatar) }}" alt="Avatar" width="50" height="50" class="rounded-circle mr-2">
                            <span>{{ $vehicle->driver->name }}</span>
                        </div>
                    @else
                        <span>Chưa Có Tài Xế</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                    <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')

@endsection
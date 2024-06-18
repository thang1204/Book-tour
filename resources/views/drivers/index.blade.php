@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh Sách Tài Xế</h1>
    <a href="{{ route('drivers.create') }}" class="btn btn-success mb-3">Thêm Tài Xế</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Avatar</th>
                <th>Điện Thoại</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drivers as $driver)
                <tr>
                    <td>{{ $driver->name }}</td>
                    <td>
                        @if($driver->avatar)
                            <img src="{{ asset('storage/' . $driver->avatar) }}" alt="Avatar" width="100">
                        @else
                            <img src="https://via.placeholder.com/100" alt="Default Avatar" width="100">
                        @endif
                    </td>
                    <td>{{ $driver->phone }}</td>
                    <td>
                        <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-warning">Chỉnh Sửa</a>
                        <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
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
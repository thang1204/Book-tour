@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh Sách Hướng Dẫn Viên</h1>
    <a href="{{ route('tour_guides.create') }}" class="btn btn-success mb-3">Thêm Hướng Dẫn Viên</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Ảnh Đại Diện</th>
                <th>Điện Thoại</th>
                <th>Email</th>
                <th>Tiểu Sử</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tourGuides as $tourGuide)
                <tr>
                    <td>{{ $tourGuide->id }}</td>
                    <td>{{ $tourGuide->name }}</td>
                    <td>
                        @if($tourGuide->avatar)
                            <img src="{{ \Storage::url($tourGuide->avatar) }}" alt="Avatar" width="50">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $tourGuide->phone }}</td>
                    <td>{{ $tourGuide->email }}</td>
                    <td>{{ $tourGuide->bio }}</td>
                    <td style="text-align: left; white-space: nowrap;">
                        <a href="{{ route('tour_guides.edit', $tourGuide->id) }}" class="btn btn-warning">Chỉnh Sửa</a>
                        <form action="{{ route('tour_guides.destroy', $tourGuide->id) }}" method="POST" style="display:inline-block;">
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
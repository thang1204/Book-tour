@extends('layouts.app')

@section('content')
<div class="container pt-3" style="min-height: 880px;">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="btn-create-ai" id="btn-back-ai"><i class="fas fa-long-arrow-alt-left"></i>&nbsp; Trở lại</a>
    </div>
    <a href="{{ route('hotels.create') }}" class="btn btn-success mb-3">Thêm khách sạn</a>

    <div id="message-err" class="text-danger mt-4"></div> 
    <label for="name-tour" class="control-label text-muted mb-0">Danh sách khách sạn</label>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên khách sạn</th>
                <th>Địa chỉ</th>
                <th>Đánh giá</th>
                <th>Số điện thoại</th>
                <th>Mô tả</th>
                <th>Thêm sửa xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hotels as $hotel)
                <tr>
                    <td>{{ $hotel->name }}</td>
                    <td>{{ $hotel->address ?? 'N/A' }}</td>
                    <td>{{ $hotel->stars ?? 'N/A' }}<i class="fa-solid fa-star" style="color: rgb(255, 242, 0)"></i></td>
                    <td>{{ $hotel->phone ?? 'N/A' }}</td>
                    <td>{{ $hotel->description ?? 'N/A' }}</td>
                    <td style="text-align: left; white-space: nowrap;">
                        <a href="{{ route('hotels.edit', ['hotel' => $hotel->id]) }}" class="btn btn-warning">Chỉnh Sửa</a>
                        <form action="{{ route('hotels.destroy', ['hotel' => $hotel->id]) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa khách sạn này?')">Xóa</button>
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